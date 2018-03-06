<?php

return array(
    'site' => array(
        'MelisDemoCms' => array(
            'conf' => array(
                'id' => 'id_MelisDemoCms',
                'home_page' => '[:homePageId]'
            ),
            'datas' => array(
                // Site id
                'site_id' => '[:siteId]',
                // Submenu limit
                'sub_menu_limit' => null,
                // News Page Id
                'news_menu_page_id' => '[:newsPageId]',
                // News Details Page Id
                'news_details_page_id' => '[:newsDetailsPageId]',
                // Testimonial parent id
                'testimonial_id' => '[:testimonialPageId]',
                // Homepage header slider
                'homepage_header_slider' => '[:homepageHeaderSlider]',
                // Aboutus slider
                'aboutus_slider' => '[:aboutusSlider]',
                // Search results page
                'search_result_page_id' => '[:searchResultsPageId]',
                /**
                 * Required Modules for installation,
                 * to trigger services that needed to install the MelisDemoCms
                 * and to avoid deselect from selecting modules during installations.
                 */
                'required_modules' => array(
                    'MelisCmsNews',
                    'MelisCmsSlider',
                    'MelisCmsProspects',
                )
            )   
        )
    ),
    'plugins' => array(
        'melisfront' => array(
            'plugins' => array(
                'MelisFrontMenuPlugin' => array(
                    'front' => array(
                        'template_path' => array('MelisDemoCms/plugin/menu'),
                    ),
                ),
                'MelisFrontBreadcrumbPlugin' => array(
                    'front' => array(
                        'template_path' => array('MelisDemoCms/plugin/breadcrumb'),
                    ),
                ),
                'MelisFrontShowListFromFolderPlugin' => array(
                    'front' => array(
                        'template_path' => array('MelisDemoCms/plugin/testimonial-slider'),
                        'files' => array(
                            'js' => array(
                                '/MelisDemoCms/js/MelisPlugins/MelisDemoCms.MelisFrontShowListFromFolderPlugin.init.js'
                            ),
                        ),
                    ),
                ),
                'MelisFrontSearchResultsPlugin' => array(
                    'front' => array(
                        'template_path' => array('MelisDemoCms/plugin/search-results'),
                    ),
                ),
            ),
        ),
        'meliscmsnews' => array(
            'plugins' => array(
                'MelisCmsNewsListNewsPlugin' => array(
                    'front' => array(
                        'template_path' => array('MelisDemoCms/plugin/news-list'),
                    ),
                ),
                'MelisCmsNewsShowNewsPlugin' => array(
                    'front' => array(
                        'template_path' => array('MelisDemoCms/plugin/news-details'),
                    ),
                ),
                'MelisCmsNewsLatestNewsPlugin' => array(
                    'front' => array(
                        'template_path' => array('MelisDemoCms/plugin/latest-news'),
                        'files' => array(
                            'js' => array(
                                '/MelisDemoCms/js/MelisPlugins/MelisDemoCms.MelisCmsNewsLatestNewsPlugin.init.js'
                            ),
                        ),
                    ),
                ),
            ),
        ),
        'meliscmsslider' => array(
            'plugins' => array(
                'MelisCmsSliderShowSliderPlugin' => array(
                    'front' => array(
                        'template_path' => array(
                            'MelisDemoCms/plugin/homepage-slider',
                            'MelisDemoCms/plugin/aboutus-slider',
                        ),
                        'files' => array(
                            'js' => array(
                                '/MelisDemoCms/js/MelisPlugins/MelisDemoCms.MelisCmsSliderShowSliderPlugin.init.js'
                            ),
                        ),
                    ),
                ),
            ),
        ),
        'meliscmsprospects' => array(
            'plugins' => array(
                'MelisCmsProspectsShowFormPlugin' => array(
                    'front' => array(
                        'template_path' => array('MelisDemoCms/plugin/contactus'),
                    ),
                ),
            ),
        ),
    ),
);
