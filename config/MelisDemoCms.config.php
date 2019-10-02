<?php

return [
    'site' => [
        'MelisDemoCms' => [
            '%site_id%' => array(
                'en_EN' => array(
                    'homePageId' => '%site_id%',
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
                ),
            ),
            'allSites' => array(
                // General cross site config
                // No page ids here
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
            ),
        ],
    ],
];