<?php 

/**
 * Melis Technology (http://www.melistechnology.com)
 *
 * @copyright Copyright (c) 2016 Melis Technology (http://www.melistechnology.com)
 *
 */

namespace MelisDemoCms\Listener;

use MelisFront\Service\MelisSiteConfigService;
use Laminas\EventManager\EventManagerInterface;
use Laminas\EventManager\ListenerAggregateInterface;
use Laminas\View\Model\ViewModel;

class SiteMenuCustomizationListener implements ListenerAggregateInterface
{
    private $serviceManager;
	
    public function attach(EventManagerInterface $events, $priority = 1)
    {
        $sharedEvents      = $events->getSharedManager();
        
        $callBackHandler = $sharedEvents->attach(
        	'*',
            'MelisFrontMenuPlugin_melistemplating_plugin_end',
        	function($e){
        	    // Getting the Service Locator from param target
        	    $this->serviceManager = $e->getTarget()->getServiceManager();

        	    // Getting the Datas from the Event Parameters
        	    $params = $e->getParams();
	            $viewVariables = $params['view']->getVariables();

        	    if ($params['view']->getTemplate() == 'MelisDemoCms/plugin/menu' && !empty($viewVariables['menu']))
        	    {
                    $frontConfig = $params['pluginFronConfig'];
                    $pageId = $frontConfig['pageId'];

                    /** @var MelisSiteConfigService $siteConfigSrv */
                    $siteConfigSrv = $this->serviceManager->get('MelisSiteConfigService');
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
        	        $melisDemoCmsSrv = $this->serviceManager->get('DemoCmsService');
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