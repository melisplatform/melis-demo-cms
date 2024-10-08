<?php

/**
 * Melis Technology (http://www.melistechnology.com)
 *
 * @copyright Copyright (c) 2015 Melis Technology (http://www.melistechnology.com)
 *
 */

namespace MelisDemoCms;

use MelisDemoCms\Listener\MelisDemoCmsCreateConfigListener;
use MelisDemoCms\Listener\SetupDemoCmsListener;
use MelisDemoCms\Listener\SiteMenuCustomizationListener;
use MelisDemoCms\Listener\LatestNewsHorizontalListener;
use Laminas\Mvc\ModuleRouteListener;
use Laminas\Mvc\MvcEvent;
use Laminas\Session\Container;
use Laminas\Stdlib\ArrayUtils;

class Module
{
    public function onBootstrap(MvcEvent $e)
    {
        $eventManager = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);

        $eventManager->attach(MvcEvent::EVENT_DISPATCH_ERROR, function ($e) {
            $viewModel = $e->getViewModel();
            $viewModel->setTemplate('layout/errorLayout');
        });
        $eventManager->attach(MvcEvent::EVENT_RENDER_ERROR, function ($e) {
            $viewModel = $e->getViewModel();
            $viewModel->setTemplate('layout/errorLayout');
        });

        // Adding Event listener to customize the Site menu from Plugin
        (new SiteMenuCustomizationListener())->attach($eventManager);
        // Event listener to Setup MelisDemoCms pre-defined datas
        (new SetupDemoCmsListener())->attach($eventManager);

        (new MelisDemoCmsCreateConfigListener())->attach($eventManager);
        (new LatestNewsHorizontalListener())->attach($eventManager);

        $this->createTranslations($e);
    }

    public function createTranslations($e)
    {
        $sm = $e->getApplication()->getServiceManager();
        $translator = $sm->get('translator');

        $container = new Container('meliscore');
        $locale = $container['melis-lang-locale'];

        if (!empty($locale)) {

            $translationType = [
                'interface',
            ];

            if (!empty($_SERVER['REQUEST_URI'])) {

                $result = preg_match("#^\/melis(.*)$#i", $_SERVER['REQUEST_URI']);
                if ($result) {
                    // adding BO translations
                    $translationType[] = 'setup';
                }
            }

            $translationList = [];
            if (file_exists($_SERVER['DOCUMENT_ROOT'] . '/../module/MelisModuleConfig/config/translation.list.php')) {
                $translationList = include 'module/MelisModuleConfig/config/translation.list.php';
            }

            foreach ($translationType as $type) {

                $transPath = '';
                $moduleTrans = __NAMESPACE__ . "/$locale.$type.php";

                if ($type == 'setup') 
                    $moduleTrans = __NAMESPACE__ . "/".$type."/".$locale.".php";

                if (in_array($moduleTrans, $translationList)) {
                    $transPath = "module/MelisModuleConfig/languages/" . $moduleTrans;
                }


                if (empty($transPath)) {

                    $defaultLocale = 'en_EN';

                    if ($type == 'setup') {
                        $langFile = $type.'/'.$locale.'.php';
                        $langLocale = (file_exists(__DIR__ . "/../language/".$langFile)) ? $locale : $defaultLocale;
                        $langPath = $type.'/'.$langLocale.'.php';

                    } else {

                        $langFile = $locale.$type.'.php';
                        // if translation is not found, use melis default translations
                        $langLocale = (file_exists(__DIR__ . "/../languags/".$langFile)) ? $locale : $defaultLocale;
                        $langPath = $langLocale.'.'.$type.'.php';
                    }

                    
                    $transPath = __DIR__ . "/../language/".$langPath;
                }

                if ($transPath)
                    $translator->addTranslationFile('phparray', $transPath);
            }
        }
    }

    public function getConfig()
    {
        $config = [];
        $configFiles = [
            include __DIR__ . '/../config/module.config.php',
            include __DIR__ . '/../config/setup/download.config.php',
            include __DIR__ . '/../config/setup/update.config.php',
            include __DIR__ . '/../config/melis.plugins.config.php',
            include __DIR__ . '/../config/MelisDemoCms.config.php',
        ];

        foreach ($configFiles as $file) {
            $config = ArrayUtils::merge($config, $file);
        }

        return $config;
    }

    public function getAutoloaderConfig()
    {
        return [
            'Laminas\Loader\StandardAutoloader' => [
                'namespaces' => [
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ],
            ],
        ];
    }
}
