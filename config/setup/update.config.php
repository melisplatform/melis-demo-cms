<?php

namespace MelisDemoCms;

use MelisMarketPlace\Support\MelisMarketPlaceSiteInstall as Site;
use MelisMarketPlace\Support\MelisMarketPlaceCmsTables as Melis;
use MelisMarketPlace\Support\MelisMarketPlace as MarketPlace;

return [
    'plugins' => [
        __NAMESPACE__ => [
            'setup' => [
                Site::CONFIG => [
                    'id' => 'id_' . __NAMESPACE__
                ],
                MarketPlace::FORM => [
                ],
                Site::DATA => [

                ]
            ]
        ]
    ],

];
