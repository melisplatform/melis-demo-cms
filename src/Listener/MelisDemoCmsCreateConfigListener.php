<?php

/**
 * Melis Technology (http://www.melistechnology.com)
 *
 * @copyright Copyright (c) 2015 Melis Technology (http://www.melistechnology.com)
 *
 */

namespace MelisDemoCms\Listener;

use Zend\EventManager\EventManagerInterface;
use Zend\EventManager\ListenerAggregateInterface;

class MelisDemoCmsCreateConfigListener implements ListenerAggregateInterface
{
    protected $map = [];

    public function attach(EventManagerInterface $events)
    {
        $sharedEvents = $events->getSharedManager();

        $callBackHandler = $sharedEvents->attach(
            '*', 'melis_marketplace_site_install_results',
            function ($e) {
                $sm = $e->getTarget()->getServiceLocator();

                $pages = $this->createMap((array) $e->getParams()['pages']);
                /** @var \MelisAssetManager\Service\MelisModulesService $moduleService */
                $moduleService = $sm->get('MelisAssetManagerModulesService');
                /** @var \MelisMarketPlace\Service\MelisMarketPlaceSiteService $melisMarketPlaceSiteSvc */
                $melisMarketPlaceSiteSvc = $sm->get('MelisMarketPlaceSiteService');
                $path = $moduleService->getModulePath('MelisDemoCms');

                $siteId = (int) $e->getParams()['site_id'];

                $aboutUsPageId = (int) $pages['About us'];
                $homePageid = $siteId;

                $melisDemoConfig = file_get_contents($path . '/config/MelisDemoCms.config.stub');
                $melisDemoConfig = str_replace([
                    '\'%site_id%\'', 
                    '\'%news_page_id%\'', 
                    '\'%news_details_id%\'', 
                    '\'%testimonial%\'', 
                    '\'%search_results_page_id%\''
                ],[
                    $siteId, 
                    $pages['News'], 
                    $pages['News Details'], 
                    $pages['Testimonials'], 
                    $pages['Search results']], 
                    $melisDemoConfig
                );

                unlink($path . '/config/MelisDemoCms.config.php');
                file_put_contents($path . '/config/MelisDemoCms.config.php', $melisDemoConfig);

            },
            -10000);

        $this->listeners[] = $callBackHandler;

        $callBackHandler = $sharedEvents->attach(
            '*', 'melis_marketplace_site_install_inserted_id',
            function ($e) {


                $param = $e->getParams();

                if (!empty($param['table_name'])) {
                    if ($param['table_name'] == 'melis_cms_slider') {

                        $sm = $e->getTarget()->getServiceLocator();
                        $moduleService = $sm->get('MelisAssetManagerModulesService');
                        $path = $moduleService->getModulePath('MelisDemoCms');

                        $melisDemoConfig = file_get_contents($path . '/config/MelisDemoCms.config.stub');

                        if (strpos($param['sql'], 'Homepage Header Slider')) {
                            $melisDemoConfig = str_replace('\'%homepage_slider_id%\'', $param['id'], $melisDemoConfig);
                        }

                        if (strpos($param['sql'], 'About us - Our Team')) {
                            $melisDemoConfig = str_replace('\'%about_us_slider%\'', $param['id'], $melisDemoConfig);
                        }

                        file_put_contents($path . '/config/MelisDemoCms.config.stub', $melisDemoConfig);
                    }
                }
            });

        $this->listeners[] = $callBackHandler;
    }

    protected function createMap(array $array)
    {
        if (isset($array['children'])) {
            $this->createMap($array['children']);
        } else {
            foreach ($array as $idx => $data) {
                if ($data['page_name']) {
                    $this->map[$data['page_name']] = $data['page_id'];
                    if (isset($data['children'])) {
                        $this->createMap($data['children']);
                    }
                }
            }
        }

        return $this->map;
    }

    public function detach(EventManagerInterface $events)
    {
        foreach ($this->listeners as $index => $listener) {
            if ($events->detach($listener)) {
                unset($this->listeners[$index]);
            }
        }
    }
}
