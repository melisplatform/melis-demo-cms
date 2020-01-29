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
        // Initialize slider plugin
        /** @var MelisCmsSliderShowSliderPlugin $sliderPlugin */
        $sliderPlugin = $this->MelisCmsSliderShowSliderPlugin();
        // Set parameters
        $slider1Parameters = [
            'template_path' => 'MelisDemoCms/plugins/home-carousel-slider',
            'id' => 'homeSlider1',
            'pageId' => $this->idPage,
            'sliderId' => 1
        ];
        // Render plugin
        $homeSlider1 = $sliderPlugin->render($slider1Parameters);

        // Add rendered plugin to the view
        $this->view->addChild($homeSlider1, 'staticSlider');

        $this->view->setVariable('idPage', $this->idPage);
        $this->view->setVariable('renderMode', $this->renderMode);

        return $this->view;
    }
}