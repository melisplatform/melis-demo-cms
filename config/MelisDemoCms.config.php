<?php

return [
    'site' => [
        'MelisDemoCms' => [
            'conf' => [
                'id' => 'id_MelisDemoCms',
                'home_page' => 1,
            ],
            'datas' => [
                // Site id
                'site_id' => 1,
                // Submenu limit
                'sub_menu_limit' => null,
                // News Page Id
                'news_menu_page_id' => 2,
                // News Details Page Id
                'news_details_page_id' => 3,
                // Testimonial parent id
                'testimonial_id' => 33,
                // Homepage header slider
                'homepage_header_slider' => 1,
                // Aboutus slider
                'aboutus_slider' => 2,
                // Search results page
                'search_result_page_id' => 32,
                /**
                 * Required Modules for installation,
                 * to trigger services that needed to install the MelisDemoCms
                 * and to avoid deselect from selecting modules during installations.
                 */
                'required_modules' => [
                    'MelisCmsNews',
                    'MelisCmsSlider',
                    'MelisCmsProspects',
                ],
            ],
        ],
    ],
    'plugins' => [
        'melisfront' => [
            'plugins' => [
                'MelisFrontMenuPlugin' => [
                    'front' => [
                        'template_path' => ['MelisDemoCms/plugin/menu'],
                    ],
                ],
                'MelisFrontBreadcrumbPlugin' => [
                    'front' => [
                        'template_path' => ['MelisDemoCms/plugin/breadcrumb'],
                    ],
                ],
                'MelisFrontShowListFromFolderPlugin' => [
                    'front' => [
                        'template_path' => ['MelisDemoCms/plugin/testimonial-slider'],
                        'files' => [
                            'js' => [
                                '/MelisDemoCms/js/MelisPlugins/MelisDemoCms.MelisFrontShowListFromFolderPlugin.init.js',
                            ],
                        ],
                    ],
                ],
                'MelisFrontSearchResultsPlugin' => [
                    'front' => [
                        'template_path' => ['MelisDemoCms/plugin/search-results'],
                    ],
                ],
            ],
        ],
        'meliscmsnews' => [
            'plugins' => [
                'MelisCmsNewsListNewsPlugin' => [
                    'front' => [
                        'template_path' => ['MelisDemoCms/plugin/news-list'],
                    ],
                ],
                'MelisCmsNewsShowNewsPlugin' => [
                    'front' => [
                        'template_path' => ['MelisDemoCms/plugin/news-details'],
                    ],
                ],
                'MelisCmsNewsLatestNewsPlugin' => [
                    'front' => [
                        'template_path' => ['MelisDemoCms/plugin/latest-news'],
                        'files' => [
                            'js' => [
                                '/MelisDemoCms/js/MelisPlugins/MelisDemoCms.MelisCmsNewsLatestNewsPlugin.init.js',
                            ],
                        ],
                    ],
                ],
            ],
        ],
        'meliscmsslider' => [
            'plugins' => [
                'MelisCmsSliderShowSliderPlugin' => [
                    'front' => [
                        'template_path' => [
                            'MelisDemoCms/plugin/homepage-slider',
                            'MelisDemoCms/plugin/aboutus-slider',
                        ],
                        'files' => [
                            'js' => [
                                '/MelisDemoCms/js/MelisPlugins/MelisDemoCms.MelisCmsSliderShowSliderPlugin.init.js',
                            ],
                        ],
                    ],
                ],
            ],
        ],
        'meliscmsprospects' => [
            'plugins' => [
                'MelisCmsProspectsShowFormPlugin' => [
                    'front' => [
                        'template_path' => ['MelisDemoCms/plugin/contactus'],
                    ],
                ],
            ],
        ],
    ],
];
