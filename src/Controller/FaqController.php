<?php

/**
 * Melis Technology (http://www.melistechnology.com)
 *
 * @copyright Copyright (c) 2015 Melis Technology (http://www.melistechnology.com)
 *
 */

namespace MelisDemoCms\Controller;

class FaqController extends BaseController
{
    public function faqAction()
    {
        // Adds the faq category list
        $faqListPlugin = $this->MelisFrontShowListFromFolderPlugin();
        $menuParameters = array(
            'template_path' => 'MelisDemoCms/plugins/faq-listing',
            'pageId' => $this->idPage,
            'pageIdFolder' => 14,
            'renderMode' => $this->renderMode,
        );
        $this->view->addChild($faqListPlugin->render($menuParameters), 'faqList');

        // Adds the faq question and answers
        $menuParameters = array(
            'template_path' => 'MelisDemoCms/plugins/faq-values',
            'pageId' => $this->idPage,
            'pageIdFolder' => 15,
            'renderMode' => $this->renderMode,
        );
        $this->view->faqValues1PageId = 15;
        $this->view->addChild($faqListPlugin->render($menuParameters), 'faqValues1');

        // Adds the faq question and answers
        $menuParameters = array(
            'template_path' => 'MelisDemoCms/plugins/faq-values',
            'pageId' => $this->idPage,
            'pageIdFolder' => 19,
            'renderMode' => $this->renderMode,
        );
        $this->view->faqValues2PageId = 19;
        $this->view->addChild($faqListPlugin->render($menuParameters), 'faqValues2');

        // Adds the faq question and answers
        $menuParameters = array(
            'template_path' => 'MelisDemoCms/plugins/faq-values',
            'pageId' => $this->idPage,
            'pageIdFolder' => 20,
            'renderMode' => $this->renderMode,
        );
        $this->view->faqValues3PageId = 20;
        $this->view->addChild($faqListPlugin->render($menuParameters), 'faqValues3');

        $this->view->setVariable('idPage', $this->idPage);
        $this->view->setVariable('renderMode', $this->renderMode);

        return $this->view;
    }

    public function faqDetailsAction()
    {
        $this->view->setVariable('idPage', $this->idPage);
        $this->view->setVariable('renderMode', $this->renderMode);

        return $this->view;
    }
}
