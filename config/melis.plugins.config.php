<?php
return [
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
