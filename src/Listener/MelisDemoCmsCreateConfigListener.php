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
use Zend\Session\Container;

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
                $path = $moduleService->getModulePath('MelisDemoCms');

                $siteId = (int) $e->getParams()['site_id'];

                $melisDemoConfig = file_get_contents($path . '/config/MelisDemoCms.config.stub');
                $melisDemoConfig = str_replace([
                    '\'%site_id%\'',
                    '\'%home_page_id%\'',
                    '\'%news_page_id%\'',
                    '\'%news_details_page_id%\'',
                    '\'%team_page_id%\'',
                    '\'%our_services_page_id%\'',
                    '\'%premium_plugins_page_id%\'',
                    '\'%unique_elements_page_id%\'',
                    '\'%live_page_builder_page_id%\'',
                    '\'%our_process_page_id%\'',
                    '\'%identification_of_needs_page_id%\'',
                    '\'%tailored_solution_page_id%\'',
                    '\'%implementation_page_id%\'',
                    '\'%faq_page_id%\'',
                    '\'%delivery_folder_id%\'',
                    '\'%product_folder_id%\'',
                    '\'%payment_folder_id%\'',
                    '\'%contact_page_id%\'',
                    '\'%testimonials_folder_id%\'',
                    '\'%search_result_page_id%\'',
                    '\'%404_page_id%\''
                ],[
                    $siteId,
                    $siteId,
                    $pages['News'],
                    $pages['News Details'],
                    $pages['Team'],
                    $pages['Our Services'],
                    $pages['Premium plugins'],
                    $pages['Unique elements'],
                    $pages['Live page builder'],
                    $pages['Our Process'],
                    $pages['Identification of Needs'],
                    $pages['Tailored Solution'],
                    $pages['Implementation'],
                    $pages['FAQ'],
                    $pages['Delivery'],
                    $pages['Product'],
                    $pages['Payment'],
                    $pages['Contact'],
                    $pages['Testimonials'],
                    $pages['Search Results'],
                    $pages['404']
                ],
                    $melisDemoConfig
                );

                unlink($path . '/config/MelisDemoCms.config.php');
                file_put_contents($path . '/config/MelisDemoCms.config.php', $melisDemoConfig);

                /**
                 * Activating Melis modules dependencies on BO
                 * Demo Site Memlis modules dependency
                 */
                $demoSiteDepModules = [
                    'MelisCmsNews',
                    'MelisCmsSlider',
                    'MelisCmsProspects',
                ];

//                $sm->get('MelisAssetManagerModulesService')->activateModule($demoSiteDepModules);

                /**
                 * Required modules removing from Terporary activated modules
                 * to remain activated from BO
                 */
                $reqModSessTemp = new Container('melismarketplace');
                $reqModSessTemp['temp_mod_actvt'] = array_filter($reqModSessTemp['temp_mod_actvt'], function($module) use ($demoSiteDepModules) {
                    if (!in_array($module, $demoSiteDepModules)) return $module;
                });
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

                        if (strpos($param['sql'], 'Home Slider 1'))
                            $melisDemoConfig = str_replace('\'%home_page_slider_1_id%\'', $param['id'], $melisDemoConfig);

                        if (strpos($param['sql'], 'Home Slider 2'))
                            $melisDemoConfig = str_replace('\'%home_page_slider_2_id%\'', $param['id'], $melisDemoConfig);

                        if (strpos($param['sql'], 'Team Slider 1'))
                            $melisDemoConfig = str_replace('\'%team_page_slider_1_id%\'', $param['id'], $melisDemoConfig);

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
