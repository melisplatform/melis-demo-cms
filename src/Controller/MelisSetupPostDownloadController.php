<?php

/**
 * Melis Technology (http://www.melistechnology.com)
 *
 * @copyright Copyright (c) 2019 Melis Technology (http://www.melistechnology.com)
 *
 */

namespace MelisDemoCms\Controller;

use MelisCore\Controller\MelisAbstractActionController;
use MelisCore\MelisSetupInterface;
use Laminas\View\Model\JsonModel;
use Laminas\View\Model\ViewModel;
use Laminas\Session\Container;
use MelisMarketPlace\Support\MelisMarketPlace as MarketPlace;
use MelisMarketPlace\Support\MelisMarketPlaceCmsTables as Melis;
use MelisMarketPlace\Support\MelisMarketPlaceSiteInstall as Site;

/**
 * @property bool $showOnMarketplacePostSetup
 */
class MelisSetupPostDownloadController extends MelisAbstractActionController implements MelisSetupInterface
{
    /**
     * flag for Marketplace whether to display the setup form or not
     * @var bool $showOnMarketplacePostSetup
     */
    public $showOnMarketplacePostSetup = true;

    protected $formConfigPath = 'MelisDemoCms/' . Site::DOWNLOAD . '/' . MarketPlace::FORM . '/melis_demo_cms_setup_download_form';

    /**
     * @return \Laminas\View\Model\ViewModel
     */
    public function getFormAction()
    {
        $form = $this->getFormSiteDemo();
        $container = new Container('melis_modules_configuration_status');
        $formData = isset($container['formData']) ? (array) $container['formData'] : null;

        if ($formData) {
            $form->setData($formData);
        }

        $view = new ViewModel();
        $view->setVariable('siteDemoCmsForm', $form);

        $view->setTerminal(true);

        return $view;
    }

    /**
     * @return \Laminas\Form\ElementInterface
     */
    private function getFormSiteDemo()
    {
        /** @var \MelisCore\Service\MelisCoreConfigService $config */
        $config = $this->getServiceManager()->get('MelisCoreConfig');
        $appConfigForm = $config->getItem($this->formConfigPath);

        $factory = new \Laminas\Form\Factory();
        $formElements = $this->getServiceManager()->get('FormElementManager');
        $factory->setFormElementManager($formElements);
        $form = $factory->createForm($appConfigForm);

        // default data
        $scheme = 'https';
        $domain = $this->getRequest()->getUri()->getHost();

        $data = [
            'sdom_scheme' => $scheme,
            'sdom_domain' => $domain,
        ];

        $form->setData($data);

        return $form;
    }

    /**
     * @return \Laminas\View\Model\JsonModel
     */
    public function validateFormAction()
    {
        $success = false;
        $message = 'tr_install_setup_message_ko';
        $errors = [];

        $data = $this->getTool()->sanitizeRecursive($this->params()->fromRoute('post', $this->getRequest()->getPost()));

        $form = $this->getFormSiteDemo();
        $form->setData($data);

        if($form->isValid()) {
            // Checking if domain is available/existing
            if (!empty($this->getServiceLocator()->get('MelisEngineSiteDomainService')->getDomainByDomainName($data['domain']))){
                $errors = [
                    'domain' => [
                        'is_exist' => $this->getTool()->getTranslation('tr_site_demo_cms_tool_site_domain_exists'),
                        'label' => $this->getTool()->getTranslation('tr_site_demo_cms_tool_site_domain')
                    ]
                ];
            } else {
                $success = true;
                $message = 'tr_install_setup_message_ok';
            }
        }
        else {
            $errors = $this->formatErrorMessage($form->getMessages());
        }

        $response = [
            'success' => $success,
            'message' => $this->getTool()->getTranslation($message),
            'errors' => $errors,
            'siteDemoCmsForm' => 'melis_installer_demo_cms',
            'domainForm' => 'melis_installer_domain',
        ];

        return new JsonModel($response);
    }

    /**
     * @return \MelisCore\Service\MelisCoreToolService
     */
    private function getTool()
    {
        /** @var \MelisCore\Service\MelisCoreToolService $service */
        $service = $this->getServiceManager()->get('MelisCoreTool');

        return $service;
    }

    /**
     * @param array $errors
     *
     * @return array
     */
    private function formatErrorMessage($errors = [])
    {
        /** @var \MelisCore\Service\MelisCoreConfigService $melisMelisCoreConfig */
        $melisMelisCoreConfig = $this->getServiceManager()->get('MelisCoreConfig');
        $appConfigForm = $melisMelisCoreConfig->getItem($this->formConfigPath);
        $appConfigForm = $appConfigForm['elements'];

        foreach ($errors as $keyError => $valueError) {
            foreach ($appConfigForm as $keyForm => $valueForm) {
                if ($valueForm['spec']['name'] == $keyError &&
                    !empty($valueForm['spec']['options']['label'])) {
                    $errors[$keyError]['label'] = $valueForm['spec']['options']['label'];
                }
            }
        }

        return $errors;
    }

    /**
     * @return \Laminas\View\Model\JsonModel
     */
    public function submitAction()
    {
        $success = true;
        $message = $this->getTool()->getTranslation('tr_install_setup_message_ok');
        $errors = [];

        return new JsonModel(get_defined_vars());
    }
}
