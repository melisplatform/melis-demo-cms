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
        // Get site config service
        $siteConfigSrv = $this->getServiceManager()->get('MelisSiteConfigService');

        // Adds the faq category list
        $faqListPlugin = $this->MelisFrontShowListFromFolderPlugin();
        $menuParameters = array(
            'template_path' => 'MelisDemoCms/plugins/faq-listing',
            'pageId' => $this->idPage,
            'pageIdFolder' => $siteConfigSrv->getSiteConfigByKey('faq_page_id', $this->idPage),
            'renderMode' => $this->renderMode,
        );
        $this->view->addChild($faqListPlugin->render($menuParameters), 'faqList');

        // Adds the faq question and answers
        $delivery_folder_id = $siteConfigSrv->getSiteConfigByKey('delivery_folder_id', $this->idPage);
        $menuParameters = array(
            'template_path' => 'MelisDemoCms/plugins/faq-values',
            'pageId' => $this->idPage,
            'pageIdFolder' => $delivery_folder_id,
            'renderMode' => $this->renderMode,
        );
        $this->view->faqValues1PageId = $delivery_folder_id;
        $this->view->addChild($faqListPlugin->render($menuParameters), 'faqValues1');

        // Adds the faq question and answers
        $product_folder_id = $siteConfigSrv->getSiteConfigByKey('product_folder_id', $this->idPage);
        $menuParameters = array(
            'template_path' => 'MelisDemoCms/plugins/faq-values',
            'pageId' => $this->idPage,
            'pageIdFolder' => $product_folder_id,
            'renderMode' => $this->renderMode,
        );
        $this->view->faqValues2PageId = $product_folder_id;
        $this->view->addChild($faqListPlugin->render($menuParameters), 'faqValues2');

        // Adds the faq question and answers
        $payment_folder_id = $siteConfigSrv->getSiteConfigByKey('payment_folder_id', $this->idPage);
        $menuParameters = array(
            'template_path' => 'MelisDemoCms/plugins/faq-values',
            'pageId' => $this->idPage,
            'pageIdFolder' => $payment_folder_id,
            'renderMode' => $this->renderMode,
        );
        $this->view->faqValues3PageId = $payment_folder_id;
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
