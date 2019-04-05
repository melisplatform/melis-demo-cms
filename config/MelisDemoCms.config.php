<?php

return [
    'site' => [
        'MelisDemoCms' => [
            'conf' => [
                'id' => 'id_MelisDemoCms',
                'home_page' => '%site_id%',
            ],
            'datas' => [
                // Site id
                'site_id' => '%site_id%',
                // Submenu limit
                'sub_menu_limit' => null,
                // News Page Id
                'news_menu_page_id' => '%news_page_id%',
                // News Details Page Id
                'news_details_page_id' => '%news_details_id%',
                // Testimonial parent id
                'testimonial_id' => '%testimonial%',
                // Homepage header slider
                'homepage_header_slider' => '%homepage_slider_id%',
                // Aboutus slider
                'aboutus_slider' => '%about_us_slider%',
                // Search results page
                'search_result_page_id' => '%search_results_page_id%',
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
                'MelisFrontGdprBannerPlugin' => [
                    'front' => [
                        'template_path' => ['MelisDemoCms/plugin/gdpr-banner'],
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
