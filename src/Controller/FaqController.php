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
        $plugin = $this->MelisFrontShowListFromFolderPlugin();
        $faqListingParameter = array(
            'template_path' => 'MelisDemoCms/plugins/faq-listing',
            'pageId' => $this->idPage,
            'pageIdFolder' => $siteConfigSrv->getSiteConfigByKey('faq_page_id', $this->idPage),
            'renderMode' => $this->renderMode,
        );
        
        $listPlugin = $plugin->render($faqListingParameter);
        // Adds the rendered plugin in the view
        $this->view->addChild($listPlugin, 'faqList');

        $faqValuesParameter = [
            'template_path' => 'MelisDemoCms/plugins/faq-values',
            'pageId' => '',
            'pageIdFolder' => '',
            'renderMode' => $this->renderMode,
        ];

        foreach ($listPlugin->listofpages as $page) {
            // update menu parameter
            $faqValuesParameter['pageId'] = $this->idPage;
            $faqValuesParameter['pageIdFolder'] = $page->page_id;
            // add rendered plugin in the view
            $this->view->addChild($plugin->render($faqValuesParameter), 'faqValues'. $page->page_id);
        }

        // add variables in the view
        $this->view->setVariable('idPage', $this->idPage);
        $this->view->setVariable('renderMode', $this->renderMode);
        $this->view->setVariable('pages', $listPlugin->listofpages);

        return $this->view;
    }

    public function faqDetailsAction()
    {
        $this->view->setVariable('idPage', $this->idPage);
        $this->view->setVariable('renderMode', $this->renderMode);

        return $this->view;
    }
}
