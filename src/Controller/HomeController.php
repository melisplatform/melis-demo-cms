<?php

/**
 * Melis Technology (http://www.melistechnology.com)
 *
 * @copyright Copyright (c) 2015 Melis Technology (http://www.melistechnology.com)
 *
 */

namespace MelisDemoCms\Controller;

use MelisCmsSlider\Controller\Plugin\MelisCmsSliderShowSliderPlugin;
use MelisFront\Controller\Plugin\MelisFrontGdprBannerPlugin;
use MelisFront\Controller\Plugin\MelisFrontShowListFromFolderPlugin;

class HomeController extends BaseController
{
    public function indexAction()
    {
        // Get config
        $siteConfigSrv = $this->getServiceManager()->get('MelisSiteConfigService');

        // Initialize slider plugin
        /** @var MelisCmsSliderShowSliderPlugin $sliderPlugin */
        $sliderPlugin = $this->MelisCmsSliderShowSliderPlugin();
        // Set parameters
        $slider1Parameters = [
            'template_path' => 'MelisDemoCms/plugins/home-carousel-slider',
            'id' => 'homeSlider1',
            'pageId' => $this->idPage,
            'sliderId' => $siteConfigSrv->getSiteConfigByKey('home_page_slider_1_id', $this->idPage)
        ];
        // Render plugin
        $homeSlider1 = $sliderPlugin->render($slider1Parameters);
        // Add rendered plugin to the view
        $this->view->addChild($homeSlider1, 'homeSlider1');

        // Set parameters for another slider
        $slider2Parameters = [
            'template_path' => 'MelisDemoCms/plugins/home-slider2',
            'id' => 'homeSlider2',
            'pageId' => $this->idPage,
            'sliderId' => $siteConfigSrv->getSiteConfigByKey('home_page_slider_2_id', $this->idPage)
        ];
        // Render plugin
        $homeSlider2 = $sliderPlugin->render($slider2Parameters);
        // Add rendered plugin to the view
        $this->view->addChild($homeSlider2, 'homeSlider2');

    	// Initialize show list from folder plugin
        /** @var MelisFrontShowListFromFolderPlugin $showListForFolderPlugin */
        $showListForFolderPlugin = $this->MelisFrontShowListFromFolderPlugin();
        // Get folder id for testimonials from the config
        $testimonialFolderId = $siteConfigSrv->getSiteConfigByKey('testimonials_folder_id', $this->idPage);
        // Set parameters
        $menuParameters = array(
            'template_path' => 'MelisDemoCms/plugins/home-testimonial-slider',
            'pageId' => $this->idPage,
            'pageIdFolder' => $testimonialFolderId,
            'renderMode' => $this->renderMode,
        );
        // Render plugin
        $homeTestimonials1 = $showListForFolderPlugin->render($menuParameters);
        // Add rendered plugin to the view
        $this->view->addChild($homeTestimonials1, 'homeTestimonials1');

        // Get gdpr banner plugin
        /** @var MelisFrontGdprBannerPlugin $gdprBannerPlugin */
        $gdprBannerPlugin = $this->MelisFrontGdprBannerPlugin();
        $gdprParameters = [
            'template_path' => 'MelisDemoCms/plugins/gdpr-banner'
        ];
        $gdprBanner = $gdprBannerPlugin->render($gdprParameters);
        $this->view->addChild($gdprBanner, 'gdprBanner');

        $this->view->setVariable('idPage', $this->idPage);
        $this->view->setVariable('renderMode', $this->renderMode);

    	return $this->view;
    }
}
