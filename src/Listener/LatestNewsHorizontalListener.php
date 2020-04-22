<?php

/**
 * Melis Technology (http://www.melistechnology.com)
 *
 * @copyright Copyright (c) 2016 Melis Technology (http://www.melistechnology.com)
 *
 */

namespace MelisDemoCms\Listener;

use MelisFront\Service\MelisSiteConfigService;
use Laminas\EventManager\EventManagerInterface;
use Laminas\EventManager\ListenerAggregateInterface;

class LatestNewsHorizontalListener implements ListenerAggregateInterface
{
    private $serviceManager;

    public function attach(EventManagerInterface $events, $priority = 1)
    {
        $sharedEvents      = $events->getSharedManager();

        $callBackHandler = $sharedEvents->attach(
            '*',
            'MelisCmsNewsLatestNewsPlugin_melistemplating_final_plugin_config',
            function($e){
                // Getting the Service Locator from param target
                $this->serviceManager = $e->getTarget()->getServiceManager();

                // Getting the Datas from the Event Parameters
                $params = $e->getParams();

                // update limit depending on template for newly dragged plugin
                if (! empty($params['generatedPluginId'])) {
                    if (
                        $params['finalConfig']['template_path']
                        == 'MelisDemoCms/plugins/latest-news-horizontal'
                    ) {
                        $params['finalConfig']['filter']['limit'] = 3;
                    }
                }
            },
            100);

        $this->listeners[] = $callBackHandler;
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