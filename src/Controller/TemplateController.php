<?php

/**
 * Melis Technology (http://www.melistechnology.com)
 *
 * @copyright Copyright (c) 2015 Melis Technology (http://www.melistechnology.com)
 *
 */

namespace MelisDemoCms\Controller;

class TemplateController extends BaseController
{
    public function dragdropAction()
    {
        $this->view->setVariable('idPage', $this->idPage);
        $this->view->setVariable('renderMode', $this->renderMode);

        return $this->view;
    }

    public function dragdrop2zonesAction()
    {
        $this->view->setVariable('idPage', $this->idPage);
        $this->view->setVariable('renderMode', $this->renderMode);

        return $this->view;
    }

    public function mixedTemplateAction()
    {
        $this->view->setVariable('idPage', $this->idPage);
        $this->view->setVariable('renderMode', $this->renderMode);

        return $this->view;
    }

    public function staticTemplateAction()
    {
        // Get site config service
        $siteConfigSrv = $this->getServiceLocator()->get('MelisSiteConfigService');

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
        $this->view->addChild($homeSlider1, 'staticSlider');

        $this->view->setVariable('idPage', $this->idPage);
        $this->view->setVariable('renderMode', $this->renderMode);

        return $this->view;
    }

    public function centeredDragdropAction()
    {
        $this->view->setVariable('idPage', $this->idPage);
        $this->view->setVariable('renderMode', $this->renderMode);

        return $this->view;
    }
}