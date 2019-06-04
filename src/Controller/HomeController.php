<?php

/**
 * Melis Technology (http://www.melistechnology.com)
 *
 * @copyright Copyright (c) 2015 Melis Technology (http://www.melistechnology.com)
 *
 */

namespace MelisDemoCms\Controller;

use MelisDemoCms\Controller\BaseController;
use Zend\View\Model\JsonModel;
use Zend\View\Model\ViewModel;
class HomeController extends BaseController
{
    public function indexAction()
    {
        /**
         * get the site config
         */
        $siteConfigSrv = $this->getServiceLocator()->get('MelisSiteConfigService');
        /**
         * Generating Homepage header Slider using MelisCmsSliderShowSliderPlugin Plugin
         */
        $showSlider = $this->MelisCmsSliderShowSliderPlugin();
        $showSliderParameters = array(
            'template_path' => 'MelisDemoCms/plugin/homepage-slider',
            'id' => 'showSliderHomepage',
            'pageId' => $this->idPage,
            'sliderId' => $siteConfigSrv->getSiteConfigByKey('homepage_header_slider'),
        );
        // add generated view to children views for displaying it in the contact view
        $this->view->addChild($showSlider->render($showSliderParameters), 'homePageSlider');

        /**
         * Generating Homepage Latest News slider using MelisCmsNewsLatestNewsPlugin Plugin
         */
	    $latestNewsPluginView = $this->MelisCmsNewsLatestNewsPlugin();
	    $latestNewsParameters = array(
	        'template_path' => 'MelisDemoCms/plugin/latest-news',
	        'pageIdNews'    => $siteConfigSrv->getSiteConfigByKey('news_details_page_id'),
	        'filter' => array(
	            'column' => 'cnews_publish_date',
	            'order' => 'DESC',
	            'date_min' => null,
	            'date_max' => null,
	            'unpublish_filter' => true,
	            'site_id' => $siteConfigSrv->getSiteConfigByKey('site_id'),
	            'search' => '',
	            'limit' => 6,
	        )
	    );

		// add generated view to children views for displaying it in the contact view
		$this->view->addChild($latestNewsPluginView->render($latestNewsParameters), 'latestNews');

	    $showListForFolderPlugin = $this->MelisFrontShowListFromFolderPlugin();
	    $menuParameters = array(
	        'template_path' => 'MelisDemoCms/plugin/testimonial-slider',
            'pageId' => $this->idPage,
	        'pageIdFolder' => $siteConfigSrv->getSiteConfigByKey('testimonial_id'),
	        'renderMode' => $this->renderMode,
	    );
		// add generated view to children views for displaying it in the contact view
		$this->view->addChild($showListForFolderPlugin->render($menuParameters), 'testimonialList');

        /**
         * Displaying a GDPR/Cookie banner using MelisGdprBanner plugin
         * @var \MelisFront\Controller\Plugin\MelisFrontGdprBannerPlugin $gdprBannerPlugin
         */
        $gdprBannerPlugin = $this->MelisFrontGdprBannerPlugin();
        $this->view->addChild($gdprBannerPlugin->render(['template_path' => 'MelisDemoCms/plugin/gdpr-banner']), 'gdprBanner');

        $this->view->setVariable('idPage', $this->idPage);
        $this->view->setVariable('renderType', $this->renderType);
        $this->view->setVariable('renderMode', $this->renderMode);
        return $this->view;
    }
}