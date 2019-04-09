<?php 

/**
 * Melis Technology (http://www.melistechnology.com)
 *
 * @copyright Copyright (c) 2016 Melis Technology (http://www.melistechnology.com)
 *
 */

namespace MelisDemoCms\Listener;

use MelisFront\Service\MelisSiteConfigService;
use Zend\EventManager\EventManagerInterface;
use Zend\EventManager\ListenerAggregateInterface;
use Zend\View\Model\ViewModel;

class SiteMenuCustomizationListener implements ListenerAggregateInterface
{
    private $serviceLocator;
	
    public function attach(EventManagerInterface $events)
    {
        $sharedEvents      = $events->getSharedManager();
        
        $callBackHandler = $sharedEvents->attach(
        	'*',
            array(
                'MelisFrontMenuPlugin_melistemplating_plugin_end',
            ),
        	function($e){
        	    // Getting the Service Locator from param target
        	    $this->serviceLocator = $e->getTarget()->getServiceLocator();

        	    // Getting the Datas from the Event Parameters
        	    $params = $e->getParams();
	            $viewVariables = $params['view']->getVariables();

        	    if ($params['view']->getTemplate() == 'MelisDemoCms/plugin/menu' && !empty($viewVariables['menu']))
        	    {
                    $frontConfig = $params['pluginFronConfig'];
                    $pageId = $frontConfig['pageId'];

                    /** @var MelisSiteConfigService $siteConfigSrv */
                    $siteConfigSrv = $this->serviceLocator->get('MelisSiteConfigService');
                    $siteConfig = $siteConfigSrv->getSiteConfigByPageId($pageId);

        	        // Geeting the custom datas from site config
        	        $limit = (!empty($siteConfig['siteConfig']['sub_menu_limit'])) ? $siteConfig['siteConfig']['sub_menu_limit'] : null;
        	        $newsMenuPageId = (!empty($siteConfig['siteConfig']['news_menu_page_id'])) ? $siteConfig['siteConfig']['news_menu_page_id'] : null;
        	        
        	        $sitePages = (!empty($viewVariables['menu'][0]['pages'])) ? $viewVariables['menu'][0]['pages'] : array();
        	        if (!empty($viewVariables['menu']))
        	        {
        	            /**
        	             * Modifying the heirarchy of site menu
        	             * this process will make the Homepage and subpages at the same level
        	             */
        	            $homePage = $viewVariables['menu'];
        	            // Removing page children on home page
        	            $homePage[0]['pages'] = array();
        	            $sitePages = array_merge($homePage, $sitePages);
        	        }
        	        
        	        // Customize Site menu using MelisDemoCmsService
        	        $melisDemoCmsSrv = $this->serviceLocator->get('DemoCmsService');
        	        $params['view']->menu = $melisDemoCmsSrv->customizeSiteMenu($sitePages, 1, $limit, $newsMenuPageId);
        	    }
        	},
        100);
        
        $this->listeners[] = $callBackHandler;
    }
    
    public function detach(EventManagerInterface $events)
    {
        foreach ($this->listeners as $index => $listener) {
            if ($events->detach($listener)) {
                unset($this->listeners[$index]);
            }
        }
    }
}