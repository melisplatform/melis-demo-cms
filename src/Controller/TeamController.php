<?php

/**
 * Melis Technology (http://www.melistechnology.com)
 *
 * @copyright Copyright (c) 2015 Melis Technology (http://www.melistechnology.com)
 *
 */

namespace MelisDemoCms\Controller;

use MelisCmsSlider\Controller\Plugin\MelisCmsSliderShowSliderPlugin;

class TeamController extends BaseController
{
    public function teamAction()
    {
        // Get slider plugin
        /** @var MelisCmsSliderShowSliderPlugin $teamSlider */
        $teamSlider = $this->MelisCmsSliderShowSliderPlugin();
        // Set parameters
        $teamSliderParameters = [
            'template_path' => 'MelisDemoCms/plugins/team-slider',
            'id' => 'teamSlider1',
            'pageId' => $this->idPage,
            'sliderId' => 3
        ];
        // Render slider plugin
        $teamSlider = $teamSlider->render($teamSliderParameters);
        // Add rendered slider to the view
        $this->view->addChild($teamSlider, 'teamSlider');

        $this->view->setVariable('idPage', $this->idPage);
        $this->view->setVariable('renderMode', $this->renderMode);

        return $this->view;
    }
}