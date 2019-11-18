<?php
return [
    'plugins' => [
        'melisfront' => [
            'plugins' => [
                'MelisFrontMenuPlugin' => [
                    'front' => [
                        'template_path' => [
                            'MelisDemoCms/plugins/menu',
                            'MelisDemoCms/plugins/white-menu',
                            'MelisDemoCms/plugins/footer-menu'
                        ],
                    ],
                ],
                'MelisFrontShowListFromFolderPlugin' => [
                    'front' => [
                        'template_path' => [
                            'MelisDemoCms/plugins/faq-listing',
                            'MelisDemoCms/plugins/faq-values',
                            'MelisDemoCms/plugins/home-testimonial-slider'
                        ],
                        'files' => [
                            'js' => [
                                '',
                            ],
                        ],
                    ],
                ],
                'MelisFrontGdprBannerPlugin' => [
                    'front' => [
                        'template_path' => [
                            'MelisDemoCms/plugins/gdpr-banner'
                        ]
                    ],
                ],
                'MelisFrontSearchResultsPlugin' => [
                    'front' => [
                        'template_path' => [
                            'MelisDemoCms/plugins/search-results'
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
                            'MelisDemoCms/plugins/home-carousel-slider',
                            'MelisDemoCms/plugins/home-slider2',
                            'MelisDemoCms/plugins/team-slider'
                        ],
                        'files' => [
                            'js' => [
                                '',
                            ],
                        ],
                    ],
                ],
            ],
        ],
        'meliscmsnews' => [
            'plugins' => [
                'MelisCmsNewsListNewsPlugin' => [
                    'front' => [
                        'template_path' => [
                            'MelisDemoCms/plugins/news-list'
                        ],
                    ],
                ],
                'MelisCmsNewsShowNewsPlugin' => [
                    'front' => [
                        'template_path' => [
                            'MelisDemoCms/plugins/news-details'
                        ],
                    ],
                ],
                'MelisCmsNewsLatestNewsPlugin' => [
                    'front' => [
                        'template_path' => [
                            'MelisDemoCms/plugins/latest-news-vertical',
                            'MelisDemoCms/plugins/latest-news-horizontal'
                        ],
                    ],
                ],
            ],
        ],
        'meliscmsprospects' => [
            'plugins' => [
                'MelisCmsProspectsShowFormPlugin' => [
                    'front' => [
                        'template_path' => [
                            'MelisDemoCms/plugins/prospect-form'
                        ],
                    ],
                ],
            ],
        ],
    ],
];
