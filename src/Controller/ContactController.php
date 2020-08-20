<?php

/**
 * Melis Technology (http://www.melistechnology.com)
 *
 * @copyright Copyright (c) 2015 Melis Technology (http://www.melistechnology.com)
 *
 */

namespace MelisDemoCms\Controller;

use Laminas\View\Model\JsonModel;

class ContactController extends BaseController
{
    public function contactAction()
    {
        // Get site config service
        $siteConfigSrv = $this->getServiceManager()->get('MelisSiteConfigService');

        $prospectForm = $this->MelisCmsProspectsShowFormPlugin();
        $parameter = [
            'template_path' => 'MelisDemoCms/plugins/prospect-form',
            'fields' => 'pros_name,pros_company,pros_country,pros_telephone,pros_email,pros_theme,pros_message',
            'required_fields' => 'pros_name,pros_telephone,pros_email,pros_theme,pros_message',
            'theme' => 1,
            'pros_site_id' => $siteConfigSrv->getSiteConfigByPageId($this->idPage)['siteConfig']['site_id']
        ];

        $result = $prospectForm->render($parameter);

        if ($this->request->isPost()) {
            $pluginVariables = $result->getVariables();

            $response = [
                'success' => $pluginVariables->success,
                'errors' => $pluginVariables->errors,
            ];

            return new JsonModel($response);
        } else {
            $this->view->addChild($result, 'prospectForm');

            $this->layout()->setVariables([
                'pageJs' => [
                    '/MelisDemoCms/js/plugins.js',
                    '/MelisDemoCms/js/jquery.form.js',
                    '/MelisDemoCms/js/jquery.validate.min.js',
                    '/MelisDemoCms/js/contact.js',
                ]
            ]);

            $this->view->setVariable('idPage', $this->idPage);
            $this->view->setVariable('renderMode', $this->renderMode);

            return $this->view;
        }
    }
}