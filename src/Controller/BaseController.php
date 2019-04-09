<?php

/**
 * Melis Technology (http://www.melistechnology.com)
 *
 * @copyright Copyright (c) 2015 Melis Technology (http://www.melistechnology.com)
 *
 */

namespace MelisDemoCms\Controller;

use MelisFront\Controller\MelisSiteActionController;
use MelisFront\Service\MelisSiteConfigService;
use Zend\Mvc\MvcEvent;
use Zend\View\Model\ViewModel;

class BaseController extends MelisSiteActionController
{
    public $view = null;
    
    function __construct()
    {
        $this->view = new ViewModel();
    }
    
    public function onDispatch(MvcEvent $event)
    {
        // Getting the Site config "MelisDemoCms.config.php"
        $sm = $event->getApplication()->getServiceManager();
        $pageId = $this->params()->fromRoute('idpage');

        /** @var MelisSiteConfigService $siteConfigSrv */
        $siteConfigSrv = $sm->get('MelisSiteConfigService');
        $siteConfig = $siteConfigSrv->getSiteConfigByPageId($pageId);

        $homePageId = (!empty($siteConfig['siteConfig']['homePageId'])) ? $siteConfig['siteConfig']['homePageId'] : null;
        $this->layout()->setVariable('siteConfig', $siteConfig['siteConfig']);
        $this->layout()->setVariable('allSites', $siteConfig['allSites']);
        $this->layout()->setVariable('homepage', $homePageId);
        
		/**
		 * Generating Site Menu using MelisFrontMenuPlugin Plugin
		 */
	    $menuPlugin = $this->MelisFrontMenuPlugin();
	    $menuParameters = array(
	        'template_path' => 'MelisDemoCms/plugin/menu',
	        'pageIdRootMenu' => $homePageId,
	    );
	    
		// add generated view to children views for displaying it in the contact view
		$menu = $menuPlugin->render($menuParameters);
		$this->layout()->addChild($menu, 'siteMenu');
		
		/**
		 * Generating Page Breadcrumb using MelisFrontBreadcrumbPlugin Plugin
		 * @var unknown $breadcrumbPlugin
		 */
	    $breadcrumbPlugin = $this->MelisFrontBreadcrumbPlugin();
	    $breadcrumbParameters = array(
	        'template_path' => 'MelisDemoCms/plugin/breadcrumb',
	        'pageIdRootBreadcrumb' => $pageId,
	    );
		// add generated view to children views for displaying it in the contact view
		$breadcrumb = $breadcrumbPlugin->render($breadcrumbParameters);
        $this->layout()->addChild($breadcrumb, 'pageBreadcrumb');
        
        return parent::onDispatch($event);
    }
}