<?php
return [
    'site' => [
        'MelisDemoCms' => [
            '1' => [
                'en_EN' => [
                    // pages
                    'home_page_id' => 1,
                    'news_page_id' => 2,
                    'news_details_page_id' => 3,
                    'team_page_id' => 4,
                    'our_services_page_id' => 5,
                    'premium_plugins_page_id' => 6,
                    'unique_elements_page_id' => 7,
                    'live_page_builder_page_id' => 8,
                    'our_process_page_id' => 9,
                    'identification_of_needs_page_id' => 10,
                    'tailored_solution_page_id' => 11,
                    'implementation_page_id' => 12,
                    'faq_page_id' => 13,
                    'delivery_folder_id' => 14,
                    'product_folder_id' => 18,
                    'payment_folder_id' => 21,
                    'contact_page_id' => 25,
                    'testimonials_folder_id' => 27,
//                    'search_result_page_id' => '%search_result_page_id%',
                    '404_page_id' => 30,
                    // sliders
                    'home_page_slider_1_id' => 1,
                    'home_page_slider_2_id' => 2,
                    'team_page_slider_1_id' => 3
                ],
            ],

            // General cross site config
            // No page ids here
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
                    'MelisCmsPageScriptEditor'
                ],
            ),
        ]
    ]
];
