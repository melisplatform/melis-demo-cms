<?php

/**
 * Melis Technology (http://www.melistechnology.com)
 *
 * @copyright Copyright (c) 2015 Melis Technology (http://www.melistechnology.com)
 *
 */

namespace MelisDemoCms\Controller;

use MelisFront\Controller\MelisSiteActionController;
use MelisFront\Controller\Plugin\MelisFrontMenuPlugin;
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
        $renderMode = $this->params()->fromRoute('renderMode');
        $pageId = $this->params()->fromRoute('idpage');
        // Get service manager
        $sm = $event->getApplication()->getServiceManager();
        // Use service manager to get the site config service
        $siteConfigSrv = $sm->get('MelisSiteConfigService');
        // Use site config service to get data from the config
        $homePageId = $siteConfigSrv->getSiteConfigByKey('homePageId', $pageId);
        $whiteMenu = $siteConfigSrv->getSiteConfigByKey('whiteMenu', 1, 'allSites') ?? [];

        // Check if we will use the black or white menu for the page based on the config
        if (! in_array($pageId, $whiteMenu)) {
            $template_path = 'MelisDemoCms/plugins/menu';
            $menuFlag = 'black';
        }

        // Get menu plugin
        /** @var MelisFrontMenuPlugin $menuPlugin */
        $menuPlugin = $this->MelisFrontMenuPlugin();
        // Set parameters for the menu
        $menuParameters = [
            'template_path' => $template_path ?? 'MelisDemoCms/plugins/white-menu',
            'pageIdRootMenu' => $homePageId
        ];
        // Render plugin
        $menu = $menuPlugin->render($menuParameters);
        // Add rendered menu to the layout
        $this->layout()->addChild($menu, 'menu');

        // Set parameters
        $footerMenuParameter = [
            'template_path' => 'MelisDemoCms/plugins/footer-menu',
            'pageIdRootMenu' => $homePageId
        ];
        // Render plugin
        $footerMenu = $menuPlugin->render($footerMenuParameter);
        // Add rendered footer menu to the layout
        $this->layout()->addChild($footerMenu, 'footerMenu');
        $this->layout()->setVariable('renderMode', $renderMode);
        $this->layout()->setVariable('menuFlag', $menuFlag ?? 'white');
        $this->layout()->setVariable('pageId', $pageId);

        return parent::onDispatch($event);
    }
}