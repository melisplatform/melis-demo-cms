<?php

namespace MelisDemoCms;

use MelisMarketPlace\Support\MelisMarketPlace as MarketPlace;
use MelisMarketPlace\Support\MelisMarketPlaceCmsTables as Melis;
use MelisMarketPlace\Support\MelisMarketPlaceSiteInstall as Site;

return [
    'plugins' => [
        __NAMESPACE__ => [
            Site::DOWNLOAD => [
                Site::CONFIG => [
                    'id' => 'id_' . __NAMESPACE__,
                    Melis::CMS_TOTAL_PAGE => 10,
                ],
                MarketPlace::FORM => [
                    'melis_demo_cms_setup_download_form' => [
                        'attributes' => [
                            'name' => 'melis_demo_cms_setup_download_form',
                            'id' => 'melis_demo_cms_setup_download_form',
                            'method' => 'POST',
                            'action' => '',
                        ],
                        'hydrator' => \Zend\Stdlib\Hydrator\ArraySerializable::class,
                        'elements' => [
                            [
                                'spec' => [
                                    'name' => 'scheme',
                                    'type' => \Zend\Form\Element\Select::class,
                                    'options' => [
                                        'label' => 'tr_site_demo_cms_tool_site_scheme',
                                        'tooltip' => 'tr_site_demo_cms_tool_site_scheme tooltip',
                                        'value_options' => [
                                            'http' => 'http://',
                                            'https' => 'https://',
                                        ],
                                    ],
                                    'attributes' => [
                                        'id' => 'scheme',
                                        'value' => '',
                                        'required' => 'required',
                                        'text-required' => '*',
                                        'class' => 'form-control',

                                    ],
                                ],
                            ],
                            [
                                'spec' => [
                                    'name' => 'domain',
                                    'type' => \Zend\Form\Element\Text::class,
                                    'options' => [
                                        'label' => 'tr_site_demo_cms_tool_site_domain',
                                        'tooltip' => 'tr_site_demo_cms_tool_site_domain tooltip',
                                    ],
                                    'attributes' => [
                                        'id' => 'domain',
                                        'value' => $_SERVER['HTTP_HOST'],
                                        'required' => 'required',
                                        'placeholder' => 'www.example.com',
                                        'class' => 'form-control',
                                        'text-required' => '*',
                                    ],
                                ],
                            ],
                            [
                                'spec' => [
                                    'name' => 'name',
                                    'type' => \Zend\Form\Element\Text::class,
                                    'options' => [
                                        'label' => 'tr_site_demo_cms_name',
                                        'tooltip' => 'tr_site_demo_cms_name_tooltip',
                                    ],
                                    'attributes' => [
                                        'id' => 'name',
                                        'value' => 'Melis Demo CMS',
                                        'required' => 'required',
                                        'placeholder' => 'My Site Name',
                                        'class' => 'form-control',
                                        'text-required' => '*',
                                    ],
                                ],
                            ],
                        ], // end elements
                        'input_filter' => [
                            'scheme' => [
                                'name' => 'scheme',
                                'required' => true,
                                'validators' => [
                                    [
                                        'name' => 'InArray',
                                        'options' => [
                                            'haystack' => ['http', 'https'],
                                            'messages' => [
                                                \Zend\Validator\InArray::NOT_IN_ARRAY => 'tr_site_demo_cms_tool_site_scheme_invalid_selection',
                                            ],
                                        ],
                                    ],
                                    [
                                        'name' => 'NotEmpty',
                                        'options' => [
                                            'messages' => [
                                                \Zend\Validator\NotEmpty::IS_EMPTY => 'tr_melis_installer_tool_site_scheme_error_empty',
                                            ],
                                        ],
                                    ],
                                ],
                                'filters' => [
                                ],
                            ],
                            'domain' => [
                                'name' => 'domain',
                                'required' => true,
                                'validators' => [
                                    [
                                        'name' => 'StringLength',
                                        'options' => [
                                            'encoding' => 'UTF-8',
                                            'max' => 50,
                                            'messages' => [
                                                \Zend\Validator\StringLength::TOO_LONG => 'tr_melis_installer_tool_site_domain_error_long',
                                            ],
                                        ],
                                    ],
                                    [
                                        'name' => 'NotEmpty',
                                        'options' => [
                                            'messages' => [
                                                \Zend\Validator\NotEmpty::IS_EMPTY => 'tr_melis_installer_tool_site_domain_error_empty',
                                            ],
                                        ],
                                    ],
                                ],
                                'filters' => [
                                    ['name' => 'StripTags'],
                                    ['name' => 'StringTrim'],
                                ],
                            ],
                            'name' => [
                                'name' => 'name',
                                'required' => true,
                                'validators' => [
                                    [
                                        'name' => 'StringLength',
                                        'options' => [
                                            'encoding' => 'UTF-8',
                                            'max' => 50,
                                            'messages' => [
                                                \Zend\Validator\StringLength::TOO_LONG => 'tr_site_demo_cms_tool_site_name_error_long',
                                            ],
                                        ],
                                    ],
                                    [
                                        'name' => 'NotEmpty',
                                        'options' => [
                                            'messages' => [
                                                \Zend\Validator\NotEmpty::IS_EMPTY => 'tr_melis_installer_tool_site_name_error_empty',
                                            ],
                                        ],
                                    ],
                                ],
                                'filters' => [
                                    ['name' => 'StripTags'],
                                    ['name' => 'StringTrim'],
                                ],
                            ],
                        ], // end input_filter
                    ],
                ],
                Site::DATA => [
                    // this should correspond to the table name
                    // <editor-fold desc="CMS_TEMPLATE">
                    Melis::CMS_TEMPLATE => [
                        [
                            Melis::PRIMARY_KEY => 'tpl_id',
                            'tpl_id' => Melis::CURRENT_TEMPLATE_ID,
                            'tpl_site_id' => Melis::CMS_SITE_ID,
                            'tpl_name' => 'Home',
                            'tpl_type' => 'ZF2',
                            'tpl_zf2_website_folder' => __NAMESPACE__,
                            'tpl_zf2_layout' => 'defaultLayout',
                            'tpl_zf2_controller' => 'Home',
                            'tpl_zf2_action' => 'index',
                            'tpl_creation_date' => date('Y-m-d H:i:s'),
                            Site::THEN => [Site::UPDATE_CURRENT_TEMPLATE_ID],
                        ],
                        [
                            Melis::PRIMARY_KEY => 'tpl_id',
                            'tpl_id' => Melis::CURRENT_TEMPLATE_ID,
                            'tpl_site_id' => Melis::CMS_SITE_ID,
                            'tpl_name' => 'News',
                            'tpl_type' => 'ZF2',
                            'tpl_zf2_website_folder' => __NAMESPACE__,
                            'tpl_zf2_layout' => 'defaultLayout',
                            'tpl_zf2_controller' => 'News',
                            'tpl_zf2_action' => 'news',
                            'tpl_creation_date' => date('Y-m-d H:i:s'),
                            Site::THEN => [Site::UPDATE_CURRENT_TEMPLATE_ID],
                        ],
                        [
                            Melis::PRIMARY_KEY => 'tpl_id',
                            'tpl_id' => Melis::CURRENT_TEMPLATE_ID,
                            'tpl_site_id' => Melis::CMS_SITE_ID,
                            'tpl_name' => 'News Details',
                            'tpl_type' => 'ZF2',
                            'tpl_zf2_website_folder' => __NAMESPACE__,
                            'tpl_zf2_layout' => 'defaultLayout',
                            'tpl_zf2_controller' => 'News',
                            'tpl_zf2_action' => 'newsDetails',
                            'tpl_creation_date' => date('Y-m-d H:i:s'),
                            Site::THEN => [Site::UPDATE_CURRENT_TEMPLATE_ID],
                        ],
                        [
                            Melis::PRIMARY_KEY => 'tpl_id',
                            'tpl_id' => Melis::CURRENT_TEMPLATE_ID,
                            'tpl_site_id' => Melis::CMS_SITE_ID,
                            'tpl_name' => 'Team',
                            'tpl_type' => 'ZF2',
                            'tpl_zf2_website_folder' => __NAMESPACE__,
                            'tpl_zf2_layout' => 'defaultLayout',
                            'tpl_zf2_controller' => 'Team',
                            'tpl_zf2_action' => 'team',
                            'tpl_creation_date' => date('Y-m-d H:i:s'),
                            Site::THEN => [Site::UPDATE_CURRENT_TEMPLATE_ID],
                        ],
                        [
                            Melis::PRIMARY_KEY => 'tpl_id',
                            'tpl_id' => Melis::CURRENT_TEMPLATE_ID,
                            'tpl_site_id' => Melis::CMS_SITE_ID,
                            'tpl_name' => 'Services',
                            'tpl_type' => 'ZF2',
                            'tpl_zf2_website_folder' => __NAMESPACE__,
                            'tpl_zf2_layout' => 'defaultLayout',
                            'tpl_zf2_controller' => 'Services',
                            'tpl_zf2_action' => 'services',
                            'tpl_creation_date' => date('Y-m-d H:i:s'),
                            Site::THEN => [Site::UPDATE_CURRENT_TEMPLATE_ID],
                        ],
                        [
                            Melis::PRIMARY_KEY => 'tpl_id',
                            'tpl_id' => Melis::CURRENT_TEMPLATE_ID,
                            'tpl_site_id' => Melis::CMS_SITE_ID,
                            'tpl_name' => 'Services Details',
                            'tpl_type' => 'ZF2',
                            'tpl_zf2_website_folder' => __NAMESPACE__,
                            'tpl_zf2_layout' => 'defaultLayout',
                            'tpl_zf2_controller' => 'Services',
                            'tpl_zf2_action' => 'servicesDetails',
                            'tpl_creation_date' => date('Y-m-d H:i:s'),
                            Site::THEN => [Site::UPDATE_CURRENT_TEMPLATE_ID],
                        ],
                        [
                            Melis::PRIMARY_KEY => 'tpl_id',
                            'tpl_id' => Melis::CURRENT_TEMPLATE_ID,
                            'tpl_site_id' => Melis::CMS_SITE_ID,
                            'tpl_name' => 'Drag n Drop',
                            'tpl_type' => 'ZF2',
                            'tpl_zf2_website_folder' => __NAMESPACE__,
                            'tpl_zf2_layout' => 'defaultLayout',
                            'tpl_zf2_controller' => 'DragDrop',
                            'tpl_zf2_action' => 'dragdrop',
                            'tpl_creation_date' => date('Y-m-d H:i:s'),
                            Site::THEN => [Site::UPDATE_CURRENT_TEMPLATE_ID],
                        ],
                        [
                            Melis::PRIMARY_KEY => 'tpl_id',
                            'tpl_id' => Melis::CURRENT_TEMPLATE_ID,
                            'tpl_site_id' => Melis::CMS_SITE_ID,
                            'tpl_name' => 'FAQ',
                            'tpl_type' => 'ZF2',
                            'tpl_zf2_website_folder' => __NAMESPACE__,
                            'tpl_zf2_layout' => 'defaultLayout',
                            'tpl_zf2_controller' => 'Faq',
                            'tpl_zf2_action' => 'faq',
                            'tpl_creation_date' => date('Y-m-d H:i:s'),
                            Site::THEN => [Site::UPDATE_CURRENT_TEMPLATE_ID],
                        ],
                        [
                            Melis::PRIMARY_KEY => 'tpl_id',
                            'tpl_id' => Melis::CURRENT_TEMPLATE_ID,
                            'tpl_site_id' => Melis::CMS_SITE_ID,
                            'tpl_name' => 'FAQ Details',
                            'tpl_type' => 'ZF2',
                            'tpl_zf2_website_folder' => __NAMESPACE__,
                            'tpl_zf2_layout' => 'defaultLayout',
                            'tpl_zf2_controller' => 'Faq',
                            'tpl_zf2_action' => 'faqDetails',
                            'tpl_creation_date' => date('Y-m-d H:i:s'),
                            Site::THEN => [Site::UPDATE_CURRENT_TEMPLATE_ID],
                        ],
                        [
                            Melis::PRIMARY_KEY => 'tpl_id',
                            'tpl_id' => Melis::CURRENT_TEMPLATE_ID,
                            'tpl_site_id' => Melis::CMS_SITE_ID,
                            'tpl_name' => 'Contact',
                            'tpl_type' => 'ZF2',
                            'tpl_zf2_website_folder' => __NAMESPACE__,
                            'tpl_zf2_layout' => 'defaultLayout',
                            'tpl_zf2_controller' => 'Contact',
                            'tpl_zf2_action' => 'contact',
                            'tpl_creation_date' => date('Y-m-d H:i:s'),
                            Site::THEN => [Site::UPDATE_CURRENT_TEMPLATE_ID],
                        ],
                        [
                            Melis::PRIMARY_KEY => 'tpl_id',
                            'tpl_id' => Melis::CURRENT_TEMPLATE_ID,
                            'tpl_site_id' => Melis::CMS_SITE_ID,
                            'tpl_name' => 'Search Results',
                            'tpl_type' => 'ZF2',
                            'tpl_zf2_website_folder' => __NAMESPACE__,
                            'tpl_zf2_layout' => 'defaultLayout',
                            'tpl_zf2_controller' => 'Search',
                            'tpl_zf2_action' => 'searchResults',
                            'tpl_creation_date' => date('Y-m-d H:i:s'),
                            Site::THEN => [Site::UPDATE_CURRENT_TEMPLATE_ID],
                        ],
                        [
                            Melis::PRIMARY_KEY => 'tpl_id',
                            'tpl_id' => Melis::CURRENT_TEMPLATE_ID,
                            'tpl_site_id' => Melis::CMS_SITE_ID,
                            'tpl_name' => 'Testimonial',
                            'tpl_type' => 'ZF2',
                            'tpl_zf2_website_folder' => __NAMESPACE__,
                            'tpl_zf2_layout' => 'defaultLayout',
                            'tpl_zf2_controller' => 'Testimonial',
                            'tpl_zf2_action' => 'testimonial',
                            'tpl_creation_date' => date('Y-m-d H:i:s'),
                            Site::THEN => [Site::UPDATE_CURRENT_TEMPLATE_ID],
                        ],
                        [
                            Melis::PRIMARY_KEY => 'tpl_id',
                            'tpl_id' => Melis::CURRENT_TEMPLATE_ID,
                            'tpl_site_id' => Melis::CMS_SITE_ID,
                            'tpl_name' => '404',
                            'tpl_type' => 'ZF2',
                            'tpl_zf2_website_folder' => __NAMESPACE__,
                            'tpl_zf2_layout' => 'defaultLayout',
                            'tpl_zf2_controller' => 'Page404',
                            'tpl_zf2_action' => 'index',
                            'tpl_creation_date' => date('Y-m-d H:i:s'),
                            Site::THEN => [Site::UPDATE_CURRENT_TEMPLATE_ID],
                        ],
                    ],
                    // </editor-fold>

                    // <editor-fold desc="CMS_PAGE_TREE">
                    Melis::CMS_PAGE_TREE => [
                        // <Home>
                        [
                            // Home Page
                            Melis::PRIMARY_KEY => 'tree_page_id',
                            'tree_page_id' => Melis::CMS_SITE_ID,
                            'tree_father_page_id' => Melis::CMS_SITE_DEFAULT_PARENT_ID,
                            'tree_page_order' => 1,
                            Melis::RELATION => [
                                Melis::CMS_PAGE_PUBLISHED => [
                                    [
                                        Melis::PRIMARY_KEY => 'page_id',
                                        'page_id' => Melis::FOREIGN_KEY,
                                        'page_type' => 'SITE',
                                        'page_status' => '1',
                                        'page_menu' => 'LINK',
                                        'page_name' => 'Melis Demo CMS',
                                        'page_tpl_id' => [Site::GET_TEMPLATE_ID => ['template_name' => 'Home']],
                                        'page_content' => '<?xml version="1.0" encoding="UTF-8"?> <document type="MelisCMS" author="MelisTechnology" version="2.0"> <melisTag id="title-fullscreen" plugin_container_id="" type="html"><![CDATA[<section class="erp_service_area sec_pad"> <div class="container"> <div class="hosting_title erp_title text-center"> <h2>Accessible, Convenient &amp; Manageable</h2> <p>The full monty burke posh excuse my French Richard cheeky bobby spiffing crikey<br />Why gormless, pear shaped.!</p> </div> </div> </section>]]></melisTag> <melisTag id="home-html-1" plugin_container_id="" type="html"><![CDATA[<section class="erp_banner_area_two"> <ul class="list-unstyled cloud_animation"> <li><img src="/MelisDemoCms/img/erp-home/cloud_01.png" alt="" /></li> <li><img src="/MelisDemoCms/img/erp-home/cloud_02.png" alt="" /></li> <li><img src="/MelisDemoCms/img/erp-home/cloud_03.png" alt="" /></li> <li><img src="/MelisDemoCms/img/erp-home/cloud_04.png" alt="" /></li> <li><img src="/MelisDemoCms/img/erp-home/cloud_05.png" alt="" /></li> <li><img src="/MelisDemoCms/img/erp-home/cloud_06.png" alt="" /></li> </ul> <div class="erp_shap"></div> <div class="erp_shap_two" style="background: url(\'/MelisDemoCms/img/erp-home/banner_shap.png\') no-repeat scroll top left;"></div> <div class="section_intro"> <div class="section_container"> <div class="intro"> <div class=" intro_content"> <h1>Cloud ERP Software for Small and medium business</h1> <p>A simple and powerful erp software for Manufacturing, Distribution and Services.</p> <a href="#" class="er_btn er_btn_two">Try to Free</a></div> </div> </div> </div> </section>]]></melisTag> <melisTag id="title-subtitle-centered" plugin_container_id="" type="html"><![CDATA[<section class="erp_service_area sec_pad"> <div class="container"> <div class="hosting_title erp_title text-center"> <h2>Accessible, Convenient &amp; Manageable</h2> <p>The full monty burke posh excuse my French Richard cheeky bobby spiffing crikey<br />Why gormless, pear shaped.!</p> </div> </div> </section>]]></melisTag> <melisTag id="home-html-2" plugin_container_id="" type="html"><![CDATA[<section class="erp_service_area sec_pad"> <div class="container"> <div class="hosting_title erp_title text-center"> <h2>Accessible, Convenient &amp; Manageable</h2> <p>The full monty burke posh excuse my French Richard cheeky bobby spiffing crikey<br />Why gormless, pear shaped.!</p> </div> </div> </section>]]></melisTag> <melisTag id="home-html-6" plugin_container_id="" type="html"><![CDATA[<section class="erp_features_area_two sec_pad"> <div class="container"> <div class="row erp_item_features align-items-center"> <div class="col-lg-6"> <div class="erp_features_img_two"> <div class="img_icon red"><span class="pluse_1"></span><span class="pluse_2"></span><i class="icon_lightbulb_alt"></i></div> <img src="/MelisDemoCms/img/erp-home/crm_img2.jpg" alt="" /></div> </div> <div class="col-lg-6"> <div class="erp_content_two"> <div class="hosting_title erp_title"> <h2>Integrated Project Management System</h2> <p>Cack brolly butty grub chancer smashing brilliant vagabond, chimney pot blower such a fibber ummm I\'m telling chinwag he lost his bottle.!</p> </div> <div class="media erp_item"> <div class="icon blue"><i class="icon_menu-square_alt2"></i></div> <div class="media-body"> <h5>Everybody Gets a Dashboard</h5> </div> </div> <div class="media erp_item"> <div class="icon yellow"><i class="icon_ribbon_alt"></i></div> <div class="media-body"> <h5>Complete Leave Management</h5> </div> </div> <a href="#" class="erp_btn_learn">Learn More<i class="arrow_right"></i></a></div> </div> </div> </div> </section>]]></melisTag> <melisTag id="home-html-7" plugin_container_id="" type="html"><![CDATA[<section class="erp_service_area sec_pad"> <div class="container"> <div class="hosting_title erp_title text-center"> <h2>Great companies that <span class="icon_heart"></span> SaasLand ERP</h2> <p>Cack brolly butty grub chancer smashing brilliant vagabond, chimney pot blower such a fibber<br />ummm I\'m telling chinwag he lost his bottle nancy boy.</p> </div> </div> </section>]]></melisTag> <melisTag id="home-textarea-1" plugin_container_id="" type="textarea"><![CDATA[<h2>What our customers<br />say about SaasLand ERP</h2>]]></melisTag> <melisTag id="home-html-3" plugin_container_id="" type="html"><![CDATA[<section class="erp_service_area sec_pad"> <div class="container"> <div class="row"> <div class="col-lg-4 col-sm-6"> <div class="erp_service_item pr_70"><img src="/MelisDemoCms/img/erp-home/erp_icon1.png" alt="" /> <h3 class="h_head">Secured Cloud</h3> <p>Bloke fantastic bubble and squeak do one what a plonker nancy boy burke fanny around.</p> </div> </div> <div class="col-lg-4 col-sm-6"> <div class="erp_service_item pr_70 pl_10"><img src="/MelisDemoCms/img/erp-home/erp_icon2.png" alt="" /> <h3 class="h_head">Single Platform</h3> <p>Bloke fantastic bubble and squeak do one what a plonker nancy boy burke fanny around.</p> </div> </div> <div class="col-lg-4 col-sm-6"> <div class="erp_service_item pl_70"><img src="/MelisDemoCms/img/erp-home/erp_icon3.png" alt="" /> <h3 class="h_head">Implement Yourself</h3> <p>Bloke fantastic bubble and squeak do one what a plonker nancy boy burke fanny around.</p> </div> </div> <div class="col-lg-4 col-sm-6"> <div class="erp_service_item pr_70"><img src="/MelisDemoCms/img/erp-home/erp_icon4.png" alt="" /> <h3 class="h_head">Multi Regional</h3> <p>Bloke fantastic bubble and squeak do one what a plonker nancy boy burke fanny around.</p> </div> </div> <div class="col-lg-4 col-sm-6"> <div class="erp_service_item pl_10"><img src="/MelisDemoCms/img/erp-home/erp_icon5.png" alt="" /> <h3 class="h_head">Quick Navigations</h3> <p>Bloke fantastic bubble and squeak do one what a plonker nancy boy burke fanny around.</p> </div> </div> <div class="col-lg-4 col-sm-6"> <div class="erp_service_item pl_70"><img src="/MelisDemoCms/img/erp-home/erp_icon6.png" alt="" /> <h3 class="h_head">Works in Web</h3> <p>Bloke fantastic bubble and squeak do one what a plonker nancy boy burke fanny around.</p> </div> </div> </div> </div> </section>]]></melisTag> <melisTag id="home-html-4" plugin_container_id="" type="html"><![CDATA[<section class="erp_action_area"> <div class="container"> <div class="row align-items-center"> <div class="col-lg-3 col-md-4"><img src="/MelisDemoCms/img/erp-home/action_img.png" alt="" /></div> <div class="col-lg-9 col-md-8"> <div class="erp_content"> <h2>Trusted by <strong>10,030+ Businesses</strong> over 160 Countries and 24+ Languages</h2> </div> </div> </div> </div> </section>]]></melisTag> <melisTag id="home-html-5" plugin_container_id="" type="html"><![CDATA[<section class="erp_features_area_two sec_pad"> <div class="container"> <div class="row erp_item_features align-items-center flex-row-reverse"> <div class="col-lg-6"> <div class="erp_features_img_two"> <div class="img_icon"><span class="pluse_1"></span><span class="pluse_2"></span><i class="icon_lightbulb_alt"></i></div> <img src="/MelisDemoCms/img/erp-home/crm_img1.jpg" alt="" /></div> </div> <div class="col-lg-6"> <div class="erp_content_two"> <div class="hosting_title erp_title"> <h2>Nurture Your Customers Using Advanced CRM</h2> <p>Cack brolly butty grub chancer smashing brilliant vagabond, chimney pot blower such a fibber ummm I\'m telling chinwag he lost his bottle.!</p> </div> <div class="media erp_item"> <div class="icon"><i class="icon_menu-square_alt2"></i></div> <div class="media-body"> <h5>Everybody Gets a Dashboard</h5> </div> </div> <div class="media erp_item"> <div class="icon green"><i class="icon_ribbon_alt"></i></div> <div class="media-body"> <h5>Complete Leave Management</h5> </div> </div> <a href="#" class="erp_btn_learn">Learn More<i class="arrow_right"></i></a></div> </div> </div> </div> </section>]]></melisTag> </document>',
                                    ],
                                ],
                                Melis::CMS_PAGE_LANG => [
                                    [
                                        'plang_page_id' =>  Melis::FOREIGN_KEY,
                                        'plang_lang_id' => 1,
                                        'plang_page_id_initial' =>  Melis::FOREIGN_KEY
                                    ]
                                ],
                                Melis::CMS_PAGE_SEO => [
                                    [
                                        Melis::PRIMARY_KEY => 'pseo_id',
                                        'pseo_id' => Melis::FOREIGN_KEY,
                                        'pseo_meta_title' => 'Home'
                                    ]
                                ]
                            ],
                            Site::THEN => [Site::UPDATE_CURRENT_PAGE_ID, Site::TRIGGER_EVENT => ['event_name' => 'melis_marketplace_site_intall_test', 'params' => ['page' => 'HomePage']]],

                        ],
                        // </Home>

                        // <News>
                        [
                            // News Page
                            Melis::PRIMARY_KEY => 'tree_page_id',
                            'tree_page_id' => Melis::CURRENT_PAGE_ID,
                            'tree_father_page_id' => Melis::CMS_SITE_ID,
                            'tree_page_order' => 1,
                            Melis::RELATION => [
                                Melis::CMS_PAGE_PUBLISHED => [
                                    [
                                        Melis::PRIMARY_KEY => 'page_id',
                                        'page_id' => Melis::FOREIGN_KEY,
                                        'page_type' => 'PAGE',
                                        'page_status' => '1',
                                        'page_menu' => 'LINK',
                                        'page_name' => 'News',
                                        'page_tpl_id' => [Site::GET_TEMPLATE_ID => ['template_name' => 'News']],
                                        'page_content' => '<?xml version="1.0" encoding="UTF-8"?> <document type="MelisCMS" author="MelisTechnology" version="2.0"> <melisTag id="news-html-1" plugin_container_id="" type="html"><![CDATA[<div class="breadcrumb_content text-center"> <h1 class="f_p f_700 f_size_50 w_color l_height50 mb_20">News</h1> <p class="f_400 w_color f_size_16 l_height26">Why I say old chap that is spiffing off his nut arse pear shaped plastered<br />Jeffrey bodge barney some dodgy.!!</p> </div>]]></melisTag> </document>',
                                    ],
                                ],
                                Melis::CMS_PAGE_LANG => [
                                    [
                                        'plang_page_id' =>  Melis::FOREIGN_KEY,
                                        'plang_lang_id' => 1,
                                        'plang_page_id_initial' =>  Melis::FOREIGN_KEY
                                    ]
                                ],
                                // <NewsDetails>
                                Melis::CMS_PAGE_TREE => [
                                    [
                                        Melis::PRIMARY_KEY => 'tree_page_id',
                                        'tree_page_id' => Melis::CURRENT_PAGE_ID,
                                        'tree_father_page_id' => Melis::FOREIGN_KEY,
                                        'tree_page_order' => 1,
                                        Melis::RELATION => [
                                            Melis::CMS_PAGE_PUBLISHED => [
                                                [
                                                    Melis::PRIMARY_KEY => 'page_id',
                                                    'page_id' => Melis::FOREIGN_KEY,
                                                    'page_type' => 'PAGE',
                                                    'page_status' => '1',
                                                    'page_menu' => 'NONE',
                                                    'page_name' => 'News Details',
                                                    'page_tpl_id' => [Site::GET_TEMPLATE_ID => ['template_name' => 'News Details']],
                                                    'page_content' => '<?xml version="1.0" encoding="UTF-8"?> <document type="MelisCMS" author="MelisTechnology" version="2.0"> <melisTag id="newsd-html-1" plugin_container_id="" type="html"><![CDATA[<div class="breadcrumb_content text-center"> <h1 class="f_p f_700 f_size_50 w_color l_height50 mb_20">News Details</h1> <p class="f_400 w_color f_size_16 l_height26">Why I say old chap that is spiffing off his nut arse pear shaped plastered<br />Jeffrey bodge barney some dodgy.!!</p> </div>]]></melisTag> </document>',

                                                ],
                                            ],
                                            Melis::CMS_PAGE_LANG => [
                                                [
                                                    'plang_page_id' =>  Melis::FOREIGN_KEY,
                                                    'plang_lang_id' => 1,
                                                    'plang_page_id_initial' =>  Melis::FOREIGN_KEY
                                                ]
                                            ],
                                        ],
                                        Site::THEN => [Site::UPDATE_CURRENT_PAGE_ID],
                                    ]
                                ]
                                // </NewsDetails>
                            ],
                            Site::THEN => [Site::UPDATE_CURRENT_PAGE_ID],

                        ],
                        // </News>

                        // <Team>
                        [
                            Melis::PRIMARY_KEY => 'tree_page_id',
                            'tree_page_id' => Melis::CURRENT_PAGE_ID,
                            'tree_father_page_id' => Melis::CMS_SITE_ID,
                            'tree_page_order' => 2,
                            Site::THEN => [Site::UPDATE_CURRENT_PAGE_ID],
                            Melis::RELATION => [
                                Melis::CMS_PAGE_PUBLISHED => [
                                    [
                                        Melis::PRIMARY_KEY => 'page_id',
                                        'page_id' => Melis::FOREIGN_KEY,
                                        'page_type' => 'PAGE',
                                        'page_status' => '1',
                                        'page_menu' => 'LINK',
                                        'page_name' => 'Our designs',
                                        'page_tpl_id' => [Site::GET_TEMPLATE_ID => ['template_name' => 'Team']],
                                        'page_content' => '<?xml version="1.0" encoding="UTF-8"?><document type="MelisCMS" author="MelisTechnology" version="2.0">  <melisTag id="content_subtitle"><![CDATA[Our designs]]></melisTag>  <melisTag id="header_title"><![CDATA[Our Designs]]></melisTag>  <melisTag id="content_text_1"><![CDATA[<div class="show-product row"><div class="col-lg-5 col-md-5 col-sm-6 col-xs-12"><div class="brand-img text-center"><img src="/MelisDemoCms/images/product/01.jpg" alt="" /></div></div><div class="col-lg-7 col-md-7 col-sm-6 col-xs-12"><div class="show-product-description"><h6 class="sp-category">New Fashion</h6><h2 class="uppercase montserrat"><a href="/our-designs/pants/id/5">New style pants</a></h2><p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum</p><p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p></div></div></div>]]></melisTag>    <melisTag id="content_text_2"><![CDATA[<div class="show-product row"><div class="col-lg-7 col-md-7 col-sm-6 col-xs-12"><div class="show-product-description"><h6 class="sp-category">New Fashion</h6><h2 class="uppercase montserrat"><a href="/our-designs/suits/id/12">men\'s fashion suits</a></h2><p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum</p><p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p></div></div><div class="col-lg-5 col-md-5 col-sm-6 col-xs-12"><div class="brand-img text-center"><img src="/MelisDemoCms/images/product/02.jpg" alt="" /></div></div></div>]]></melisTag>   <melisTag id="content_text_3"><![CDATA[<div class="show-product row"><div class="col-lg-5 col-md-5 col-sm-6 col-xs-12"><div class="brand-img text-center"><img src="/MelisDemoCms/images/product/03.jpg" alt="" /></div></div><div class="col-lg-7 col-md-7 col-sm-6 col-xs-12"><div class="show-product-description"><h6 class="sp-category">New Fashion</h6><h2 class="uppercase montserrat"><a href="/our-designs/shoes/id/17">trending shoes</a></h2><p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum</p><p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p></div></div></div>]]></melisTag>    <melisTag id="header_image"><![CDATA[<img src="/MelisDemoCms/images/bg/designs.jpg" caption="false" data-mce-src="/MelisDemoCms/images/bg/designs.jpg" height="29" width="229">]]></melisTag>   <melisTag id="content_text_4"><![CDATA[<div class="show-product row"><div class="col-lg-7 col-md-7 col-sm-6 col-xs-12"><div class="show-product-description"><h6 class="sp-category">New Fashion</h6><h2 class="uppercase montserrat"><a href="/our-designs/sunglasses/id/23">Summer sunglasses</a></h2><p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum</p><p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p></div></div><div class="col-lg-5 col-md-5 col-sm-6 col-xs-12"><div class="brand-img text-center"><img src="/MelisDemoCms/images/product/sunglasses/04/02.jpg" caption="false" height=" " width=" " /></div></div></div>]]></melisTag>    <melisTag id="content_text_5"><![CDATA[&nbsp;]]></melisTag> <melisTag id="content_text_6"><![CDATA[]]></melisTag></document>',

                                    ],
                                ],
                                Melis::CMS_PAGE_LANG => [
                                    [
                                        'plang_page_id' =>  Melis::FOREIGN_KEY,
                                        'plang_lang_id' => 1,
                                        'plang_page_id_initial' =>  Melis::FOREIGN_KEY
                                    ]
                                ],
                            ],
                            Site::THEN => [Site::UPDATE_CURRENT_PAGE_ID],
                        ],
                        // </Team>

                        // <OurServices>
                        [
                            Melis::PRIMARY_KEY => 'tree_page_id',
                            'tree_page_id' => Melis::CURRENT_PAGE_ID,
                            'tree_father_page_id' => Melis::CMS_SITE_ID,
                            'tree_page_order' => 3,
                            Site::THEN => [Site::UPDATE_CURRENT_PAGE_ID, Site::TRIGGER_EVENT => ['event_name' => 'melis_marketplace_site_intall_test', 'params' => ['page' => 'OurServices']]],
                            Melis::RELATION => [
                                Melis::CMS_PAGE_PUBLISHED => [
                                    [
                                        Melis::PRIMARY_KEY => 'page_id',
                                        'page_id' => Melis::FOREIGN_KEY,
                                        'page_type' => 'PAGE',
                                        'page_status' => '1',
                                        'page_menu' => 'LINK',
                                        'page_name' => 'Our Services',
                                        'page_tpl_id' => [Site::GET_TEMPLATE_ID => ['template_name' => 'Services']],
                                        'page_content' => '<?xml version="1.0" encoding="UTF-8"?> <document type="MelisCMS" author="MelisTechnology" version="2.0"> <melisTag id="srv-html-1" plugin_container_id="" type="html"><![CDATA[<div class="hosting_title erp_title text-center"> <h2>How We Work</h2> <p>The full monty burke posh excuse my French Richard cheeky bobby spiffing crikey<br />Why gormless, pear shaped.!</p> </div>]]></melisTag> <melisTag id="3-cols-in-blocks" plugin_container_id="" type="html"><![CDATA[<section class="app_service_area app_service_area_two"> <div class="container"> <div class="row app_service_info"> <div class="col-lg-4 col-sm-6"> <div class="app_service_item"><i class="ti-settings app_icon one"></i> <h5 class="f_p f_size_18 f_600 t_color3 mt_40 mb-30">Premium plugins</h5> <p class="f_400 f_size_15 mb-30">Oxford jolly good cras bugger down the pub blow off well arse tinkety tonk old fruit William bite your arm off haggle, old it\'s all gone to pot daft no biggie bog.!</p> <a href="#" class="learn_btn_two c_violet">Learn More <i class="ti-arrow-right"></i></a></div> </div> <div class="col-lg-4 col-sm-6"> <div class="app_service_item"><i class="ti-heart-broken app_icon two"></i> <h5 class="f_p f_size_18 f_600 t_color3 mt_40 mb-30">Unique elements</h5> <p class="f_400 f_size_15 mb-30">Oxford jolly good cras bugger down the pub blow off well arse tinkety tonk old fruit William bite your arm off haggle, old it\'s all gone to pot daft no biggie bog.!</p> <a href="#" class="learn_btn_two c_violet">Learn More <i class="ti-arrow-right"></i></a></div> </div> <div class="col-lg-4 col-sm-6"> <div class="app_service_item"><i class="ti-target app_icon three"></i> <h5 class="f_p f_size_18 f_600 t_color3 mt_40 mb-30">Live page builder</h5> <p class="f_400 f_size_15 mb-30">Oxford jolly good cras bugger down the pub blow off well arse tinkety tonk old fruit William bite your arm off haggle, old it\'s all gone to pot daft no biggie bog.!</p> <a href="#" class="learn_btn_two c_violet">Learn More <i class="ti-arrow-right"></i></a></div> </div> </div> </div> </section>]]></melisTag> <melisTag id="2-cols-left-text-right-image" plugin_container_id="" type="html"><![CDATA[<section class="erp_features_area_two sec_pad"> <div class="container"> <div class="row erp_item_features align-items-center flex-row-reverse"> <div class="col-lg-6"> <div class="erp_features_img_two"> <div class="img_icon"><span class="pluse_1"></span><span class="pluse_2"></span><i class="icon_lightbulb_alt"></i></div> <img src="/MelisDemoCms/img/erp-home/crm_img1.jpg" alt="" /></div> </div> <div class="col-lg-6"> <div class="erp_content_two"> <div class="hosting_title erp_title"> <h2 class="f_p f_600 f_size_30 t_color3 l_height40 mb-30">Predictive and imperative approach towards software.</h2> <p class="f_400 mb_50">Why I say old chap that is spiffing pukka, bamboozled wind up bugger buggered zonked hanky panky a blinding shot the little rotter, bubble and squeak vagabond cheeky.!</p> <br /> <ul class="list-unstyled mb-30 pl-0 pr_20"> <li><i class="ti-check"></i>&nbsp;Only a quid I dropped a clanger matie boy excuse my French hanky.</li> <li><i class="ti-check"></i>&nbsp;Panky pardon you me old mucker bum bag, bevvy bloke it\'s all gone to pot.</li> <li><i class="ti-check"></i>&nbsp;Ummm I\'m telling bits and bobs mush baking cakes car boot.</li> </ul> </div> </div> </div> </div> </div> </section>]]></melisTag> <melisTag id="2-cols-right-text-left-image" plugin_container_id="" type="html"><![CDATA[<section class="erp_features_area_two sec_pad"> <div class="container"> <div class="row erp_item_features align-items-center"> <div class="col-lg-6"> <div class="erp_features_img_two"> <div class="img_icon red"><span class="pluse_1"></span><span class="pluse_2"></span><i class="icon_lightbulb_alt"></i></div> <img src="/MelisDemoCms/img/erp-home/crm_img2.jpg" alt="" /></div> </div> <div class="col-lg-6"> <div class="erp_content_two"> <div class="hosting_title erp_title"> <h2 class="f_p f_600 f_size_30 t_color3 l_height40 mb-30">Social intranet software<br />that drives employee<br />engagement and<br />productivity.</h2> <p class="f_400 mb_40">Why I say old chap that is spiffing pukka, bamboozled wind up bugger buggered zonked hanky panky a blinding shot the little rotter, bubble and squeak vagabond cheeky.!</p> </div> <a href="#" class="erp_btn_learn">View More About<i class="arrow_right"></i></a></div> </div> </div> </div> </section>]]></melisTag> </document>',
                                    ],
                                ],
                                Melis::CMS_PAGE_LANG => [
                                    [
                                        'plang_page_id' =>  Melis::FOREIGN_KEY,
                                        'plang_lang_id' => 1,
                                        'plang_page_id_initial' =>  Melis::FOREIGN_KEY
                                    ]
                                ],
                                Melis::CMS_PAGE_TREE => [
                                    // <ServiceDetails1>
                                    [
                                        Melis::PRIMARY_KEY => 'tree_page_id',
                                        'tree_page_id' => Melis::CURRENT_PAGE_ID,
                                        'tree_father_page_id' => Melis::FOREIGN_KEY,
                                        'tree_page_order' => 1,
                                        Melis::RELATION => [
                                            Melis::CMS_PAGE_PUBLISHED => [
                                                [
                                                    Melis::PRIMARY_KEY => 'page_id',
                                                    'page_id' => Melis::FOREIGN_KEY,
                                                    'page_type' => 'PAGE',
                                                    'page_status' => '1',
                                                    'page_menu' => 'NONE',
                                                    'page_name' => 'Service Details 1',
                                                    'page_tpl_id' => [Site::GET_TEMPLATE_ID => ['template_name' => 'Services Details']],
                                                    'page_content' => '<?xml version="1.0" encoding="UTF-8"?> <document type="MelisCMS" author="MelisTechnology" version="2.0"> <melisTag id="srvd-html-2" plugin_container_id="" type="html"><![CDATA[<p class="f_400 f_size_15">He lost his bottle a load of old tosh cup of tea brolly bog-standard matie boy blow off the little rotter morish, haggle hotpot skive off cuppa don\'t get shirty with me off his nut the full monty. Starkers morish down the pub such a fibber quaint gosh Harry boot owt to do with me the little rotter, baking cakes Eaton ummm I\'m telling pardon me the bee\'s knees vagabond Oxford chap, A bit of how\'s your father bog-standard hanky panky daft well lavatory bubble and squeak the full monty. That say nice one grub cup of tea so I said barmy only a quid, I it\'s your round gutted mate cup of char golly gosh dropped a clanger my good sir, James Bond happy days brilliant blimey I is. Boot Jeffrey cockup the BBC pardon me victoria sponge Why chip shop what a load of rubbish pukka brolly cuppa tickety-boo bog-standard cheesed off posh, bugger Eaton William smashing knackered bog bonnet bobby bender cobblers only a quid baking cakes the full monty pardon you.</p> <p class="f_400 f_size_15">Twit bonnet Jeffrey hunky-dory gormless chancer bog-standard spiffing good time, young delinquent Charles don\'t get shirty with me the BBC is brown bread off his nut a load of old tosh, chap grub bog skive off pardon me bleeder. Lavatory on your bike mate happy days the little rotter arse over tit no biggie at public school wind up car boot bamboozled well barmy bleeder the wireless bugger, cockup blatant David it\'s all gone to pot morish mush sloshed boot A bit of how\'s your father skive off cheers a load of old tosh. No biggie mush I don\'t want no agro it\'s your round cack boot say, the full monty mufty such a fibber up the duff Why, Eaton pardon me spiffing blower brown bread.</p>]]></melisTag> <melisTag id="servd-html-3" plugin_container_id="" type="html"><![CDATA[<div class="info_item"> <h6>Owner:</h6> <p>Droit Theme</p> </div> <div class="info_item"> <h6>Live Time:</h6> <p>2 Working Days</p> </div> <div class="info_item"> <h6>Service Cost:</h6> <p>$250.00</p> </div> <div class="info_item"> <h6>Quality:</h6> <p>High</p> </div> <div class="info_item"> <h6>Experience</h6> <p>3 Years</p> </div>]]></melisTag> <melisTag id="srvd-textarea1" plugin_container_id="" type="textarea"><![CDATA[Unique Elements]]></melisTag> <melisTag id="srvd-html-1" plugin_container_id="" type="html"><![CDATA[<div class="breadcrumb_content text-center"> <h1 class="f_p f_700 f_size_50 w_color l_height50 mb_20">Services Details</h1> <p class="f_400 w_color f_size_16 l_height26">Why I say old chap that is spiffing off his nut arse pear shaped plastered<br />Jeffrey bodge barney some dodgy.!!</p> </div>]]></melisTag> </document>',

                                                ],
                                            ],
                                            Melis::CMS_PAGE_LANG => [
                                                [
                                                    'plang_page_id' =>  Melis::FOREIGN_KEY,
                                                    'plang_lang_id' => 1,
                                                    'plang_page_id_initial' =>  Melis::FOREIGN_KEY
                                                ]
                                            ],
                                        ],
                                        Site::THEN => [Site::UPDATE_CURRENT_PAGE_ID],
                                    ],
                                    // </ServiceDetails1>
                                    // <ServiceDetails2>
                                    [
                                        Melis::PRIMARY_KEY => 'tree_page_id',
                                        'tree_page_id' => Melis::CURRENT_PAGE_ID,
                                        'tree_father_page_id' => Melis::FOREIGN_KEY,
                                        'tree_page_order' => 2,
                                        Melis::RELATION => [
                                            Melis::CMS_PAGE_PUBLISHED => [
                                                [
                                                    Melis::PRIMARY_KEY => 'page_id',
                                                    'page_id' => Melis::FOREIGN_KEY,
                                                    'page_type' => 'PAGE',
                                                    'page_status' => '1',
                                                    'page_menu' => 'NONE',
                                                    'page_name' => 'Service Details 2',
                                                    'page_tpl_id' => [Site::GET_TEMPLATE_ID => ['template_name' => 'Services Details']],
                                                    'page_content' => '<?xml version="1.0" encoding="UTF-8"?> <document type="MelisCMS" author="MelisTechnology" version="2.0"> <melisTag id="srvd-textarea1" plugin_container_id="" type="textarea"><![CDATA[Unique Elements]]></melisTag> <melisTag id="servd-html-3" plugin_container_id="" type="html"><![CDATA[<div class="info_item"> <h6>Owner:</h6> <p>Droit Theme</p> </div> <div class="info_item"> <h6>Live Time:</h6> <p>2 Working Days</p> </div> <div class="info_item"> <h6>Service Cost:</h6> <p>$250.00</p> </div> <div class="info_item"> <h6>Quality:</h6> <p>High</p> </div> <div class="info_item"> <h6>Experience</h6> <p>3 Years</p> </div>]]></melisTag> <melisTag id="srvd-html-2" plugin_container_id="" type="html"><![CDATA[<p class="f_400 f_size_15">He lost his bottle a load of old tosh cup of tea brolly bog-standard matie boy blow off the little rotter morish, haggle hotpot skive off cuppa don\'t get shirty with me off his nut the full monty. Starkers morish down the pub such a fibber quaint gosh Harry boot owt to do with me the little rotter, baking cakes Eaton ummm I\'m telling pardon me the bee\'s knees vagabond Oxford chap, A bit of how\'s your father bog-standard hanky panky daft well lavatory bubble and squeak the full monty. That say nice one grub cup of tea so I said barmy only a quid, I it\'s your round gutted mate cup of char golly gosh dropped a clanger my good sir, James Bond happy days brilliant blimey I is. Boot Jeffrey cockup the BBC pardon me victoria sponge Why chip shop what a load of rubbish pukka brolly cuppa tickety-boo bog-standard cheesed off posh, bugger Eaton William smashing knackered bog bonnet bobby bender cobblers only a quid baking cakes the full monty pardon you.</p> <p class="f_400 f_size_15">Twit bonnet Jeffrey hunky-dory gormless chancer bog-standard spiffing good time, young delinquent Charles don\'t get shirty with me the BBC is brown bread off his nut a load of old tosh, chap grub bog skive off pardon me bleeder. Lavatory on your bike mate happy days the little rotter arse over tit no biggie at public school wind up car boot bamboozled well barmy bleeder the wireless bugger, cockup blatant David it\'s all gone to pot morish mush sloshed boot A bit of how\'s your father skive off cheers a load of old tosh. No biggie mush I don\'t want no agro it\'s your round cack boot say, the full monty mufty such a fibber up the duff Why, Eaton pardon me spiffing blower brown bread.</p>]]></melisTag> </document>',

                                                ],
                                            ],
                                            Melis::CMS_PAGE_LANG => [
                                                [
                                                    'plang_page_id' =>  Melis::FOREIGN_KEY,
                                                    'plang_lang_id' => 1,
                                                    'plang_page_id_initial' =>  Melis::FOREIGN_KEY
                                                ]
                                            ],
                                        ],
                                    ],
                                    // </ServiceDetails2>
                                    // <ServiceDetails3>
                                    [
                                        Melis::PRIMARY_KEY => 'tree_page_id',
                                        'tree_page_id' => Melis::CURRENT_PAGE_ID,
                                        'tree_father_page_id' => Melis::FOREIGN_KEY,
                                        'tree_page_order' => 3,
                                        Melis::RELATION => [
                                            Melis::CMS_PAGE_PUBLISHED => [
                                                [
                                                    Melis::PRIMARY_KEY => 'page_id',
                                                    'page_id' => Melis::FOREIGN_KEY,
                                                    'page_type' => 'PAGE',
                                                    'page_status' => '1',
                                                    'page_menu' => 'NONE',
                                                    'page_name' => 'Service Details 3',
                                                    'page_tpl_id' => [Site::GET_TEMPLATE_ID => ['template_name' => 'Services Details']],
                                                    'page_content' => '<?xml version="1.0" encoding="UTF-8"?> <document type="MelisCMS" author="MelisTechnology" version="2.0"> <melisTag id="srvd-html-2" plugin_container_id="" type="html"><![CDATA[<p class="f_400 f_size_15">He lost his bottle a load of old tosh cup of tea brolly bog-standard matie boy blow off the little rotter morish, haggle hotpot skive off cuppa don\'t get shirty with me off his nut the full monty. Starkers morish down the pub such a fibber quaint gosh Harry boot owt to do with me the little rotter, baking cakes Eaton ummm I\'m telling pardon me the bee\'s knees vagabond Oxford chap, A bit of how\'s your father bog-standard hanky panky daft well lavatory bubble and squeak the full monty. That say nice one grub cup of tea so I said barmy only a quid, I it\'s your round gutted mate cup of char golly gosh dropped a clanger my good sir, James Bond happy days brilliant blimey I is. Boot Jeffrey cockup the BBC pardon me victoria sponge Why chip shop what a load of rubbish pukka brolly cuppa tickety-boo bog-standard cheesed off posh, bugger Eaton William smashing knackered bog bonnet bobby bender cobblers only a quid baking cakes the full monty pardon you.</p> <p class="f_400 f_size_15">Twit bonnet Jeffrey hunky-dory gormless chancer bog-standard spiffing good time, young delinquent Charles don\'t get shirty with me the BBC is brown bread off his nut a load of old tosh, chap grub bog skive off pardon me bleeder. Lavatory on your bike mate happy days the little rotter arse over tit no biggie at public school wind up car boot bamboozled well barmy bleeder the wireless bugger, cockup blatant David it\'s all gone to pot morish mush sloshed boot A bit of how\'s your father skive off cheers a load of old tosh. No biggie mush I don\'t want no agro it\'s your round cack boot say, the full monty mufty such a fibber up the duff Why, Eaton pardon me spiffing blower brown bread.</p>]]></melisTag> <melisTag id="srvd-textarea1" plugin_container_id="" type="textarea"><![CDATA[Unique Elements]]></melisTag> <melisTag id="servd-html-3" plugin_container_id="" type="html"><![CDATA[<div class="info_item"> <h6>Owner:</h6> <p>Droit Theme</p> </div> <div class="info_item"> <h6>Live Time:</h6> <p>2 Working Days</p> </div> <div class="info_item"> <h6>Service Cost:</h6> <p>$250.00</p> </div> <div class="info_item"> <h6>Quality:</h6> <p>High</p> </div> <div class="info_item"> <h6>Experience</h6> <p>3 Years</p> </div>]]></melisTag> </document>',

                                                ],
                                            ],
                                            Melis::CMS_PAGE_LANG => [
                                                [
                                                    'plang_page_id' =>  Melis::FOREIGN_KEY,
                                                    'plang_lang_id' => 1,
                                                    'plang_page_id_initial' =>  Melis::FOREIGN_KEY
                                                ]
                                            ],
                                        ],
                                    ],
                                    // </ServiceDetails3>
                                ]
                            ]
                        ],
                        // </OurServices>

                        // <OurProcess>
                        [
                            Melis::PRIMARY_KEY => 'tree_page_id',
                            'tree_page_id' => Melis::CURRENT_PAGE_ID,
                            'tree_father_page_id' => Melis::CMS_SITE_ID,
                            'tree_page_order' => 4,
                            Site::THEN => [Site::UPDATE_CURRENT_PAGE_ID],
                            Melis::RELATION => [
                                Melis::CMS_PAGE_PUBLISHED => [
                                    [
                                        Melis::PRIMARY_KEY => 'page_id',
                                        'page_id' => Melis::FOREIGN_KEY,
                                        'page_type' => 'PAGE',
                                        'page_status' => '1',
                                        'page_menu' => 'LINK',
                                        'page_name' => 'Our Process',
                                        'page_tpl_id' => [Site::GET_TEMPLATE_ID => ['template_name' => 'Drag n Drop']],
                                        'page_content' => '<?xml version="1.0" encoding="UTF-8"?> <document type="MelisCMS" author="MelisTechnology" version="2.0"> </document>',

                                    ],
                                ],
                                Melis::CMS_PAGE_LANG => [
                                    [
                                        'plang_page_id' =>  Melis::FOREIGN_KEY,
                                        'plang_lang_id' => 1,
                                        'plang_page_id_initial' =>  Melis::FOREIGN_KEY
                                    ]
                                ],
                                Melis::CMS_PAGE_TREE => [
                                    // <Process1>
                                    [
                                        Melis::PRIMARY_KEY => 'tree_page_id',
                                        'tree_page_id' => Melis::CURRENT_PAGE_ID,
                                        'tree_father_page_id' => Melis::FOREIGN_KEY,
                                        'tree_page_order' => 1,
                                        Melis::RELATION => [
                                            Melis::CMS_PAGE_PUBLISHED => [
                                                [
                                                    Melis::PRIMARY_KEY => 'page_id',
                                                    'page_id' => Melis::FOREIGN_KEY,
                                                    'page_type' => 'PAGE',
                                                    'page_status' => '1',
                                                    'page_menu' => 'NONE',
                                                    'page_name' => 'Process 1',
                                                    'page_tpl_id' => [Site::GET_TEMPLATE_ID => ['template_name' => 'Drag n Drop']],
                                                    'page_content' => '<?xml version="1.0" encoding="UTF-8"?> <document type="MelisCMS" author="MelisTechnology" version="2.0"> </document>',

                                                ],
                                            ],
                                            Melis::CMS_PAGE_LANG => [
                                                [
                                                    'plang_page_id' =>  Melis::FOREIGN_KEY,
                                                    'plang_lang_id' => 1,
                                                    'plang_page_id_initial' =>  Melis::FOREIGN_KEY
                                                ]
                                            ],
                                        ],
                                        Site::THEN => [Site::UPDATE_CURRENT_PAGE_ID],
                                    ],
                                    // </Process1>
                                    // <Process2>
                                    [
                                        Melis::PRIMARY_KEY => 'tree_page_id',
                                        'tree_page_id' => Melis::CURRENT_PAGE_ID,
                                        'tree_father_page_id' => Melis::FOREIGN_KEY,
                                        'tree_page_order' => 2,
                                        Melis::RELATION => [
                                            Melis::CMS_PAGE_PUBLISHED => [
                                                [
                                                    Melis::PRIMARY_KEY => 'page_id',
                                                    'page_id' => Melis::FOREIGN_KEY,
                                                    'page_type' => 'PAGE',
                                                    'page_status' => '1',
                                                    'page_menu' => 'NONE',
                                                    'page_name' => 'Process 2',
                                                    'page_tpl_id' => [Site::GET_TEMPLATE_ID => ['template_name' => 'Drag n Drop']],
                                                    'page_content' => '<?xml version="1.0" encoding="UTF-8"?> <document type="MelisCMS" author="MelisTechnology" version="2.0"> </document>',

                                                ],
                                            ],
                                            Melis::CMS_PAGE_LANG => [
                                                [
                                                    'plang_page_id' =>  Melis::FOREIGN_KEY,
                                                    'plang_lang_id' => 1,
                                                    'plang_page_id_initial' =>  Melis::FOREIGN_KEY
                                                ]
                                            ],
                                        ],
                                    ],
                                    // </Process2>
                                    // <Process3>
                                    [
                                        Melis::PRIMARY_KEY => 'tree_page_id',
                                        'tree_page_id' => Melis::CURRENT_PAGE_ID,
                                        'tree_father_page_id' => Melis::FOREIGN_KEY,
                                        'tree_page_order' => 3,
                                        Melis::RELATION => [
                                            Melis::CMS_PAGE_PUBLISHED => [
                                                [
                                                    Melis::PRIMARY_KEY => 'page_id',
                                                    'page_id' => Melis::FOREIGN_KEY,
                                                    'page_type' => 'PAGE',
                                                    'page_status' => '1',
                                                    'page_menu' => 'NONE',
                                                    'page_name' => 'Process 3',
                                                    'page_tpl_id' => [Site::GET_TEMPLATE_ID => ['template_name' => 'Drag n Drop']],
                                                    'page_content' => '<?xml version="1.0" encoding="UTF-8"?> <document type="MelisCMS" author="MelisTechnology" version="2.0"> </document>',

                                                ],
                                            ],
                                            Melis::CMS_PAGE_LANG => [
                                                [
                                                    'plang_page_id' =>  Melis::FOREIGN_KEY,
                                                    'plang_lang_id' => 1,
                                                    'plang_page_id_initial' =>  Melis::FOREIGN_KEY
                                                ]
                                            ],
                                        ],
                                    ],
                                    // <Process3>
                                ]
                            ]
                        ],
                        // </OurProcess>

                        // <FAQ>
                        [
                            Melis::PRIMARY_KEY => 'tree_page_id',
                            'tree_page_id' => Melis::CURRENT_PAGE_ID,
                            'tree_father_page_id' => Melis::CMS_SITE_ID,
                            'tree_page_order' => 5,
                            Site::THEN => [Site::UPDATE_CURRENT_PAGE_ID],
                            Melis::RELATION => [
                                Melis::CMS_PAGE_PUBLISHED => [
                                    [
                                        Melis::PRIMARY_KEY => 'page_id',
                                        'page_id' => Melis::FOREIGN_KEY,
                                        'page_type' => 'PAGE',
                                        'page_status' => '1',
                                        'page_menu' => 'LINK',
                                        'page_name' => 'Our Process',
                                        'page_tpl_id' => [Site::GET_TEMPLATE_ID => ['template_name' => 'FAQ']],
                                        'page_content' => '<?xml version="1.0" encoding="UTF-8"?> <document type="MelisCMS" author="MelisTechnology" version="2.0"> <melisTag id="title-subtitle-centered" plugin_container_id="" type="html"><![CDATA[<section class="erp_service_area sec_pad"> <div class="container"> <div class="hosting_title erp_title text-center"> <h2>How We Work</h2> <p>Bender cobblers chap grub sloshed up the duff I fantastic<br />owt to do with me at public school.!</p> </div> </div> </section>]]></melisTag> <melisTag id="faq-html-1" plugin_container_id="" type="html"><![CDATA[<div class="breadcrumb_content text-center"> <h1 class="f_p f_700 f_size_50 w_color l_height50 mb_20">FAQ</h1> <p class="f_400 w_color f_size_16 l_height26">Why I say old chap that is spiffing off his nut arse pear shaped plastered<br />Jeffrey bodge barney some dodgy.!!</p> </div>]]></melisTag> </document>',

                                    ],
                                ],
                                Melis::CMS_PAGE_LANG => [
                                    [
                                        'plang_page_id' =>  Melis::FOREIGN_KEY,
                                        'plang_lang_id' => 1,
                                        'plang_page_id_initial' =>  Melis::FOREIGN_KEY
                                    ]
                                ],
                                Melis::CMS_PAGE_TREE => [
                                    // <FAQCat1>
                                    [
                                        Melis::PRIMARY_KEY => 'tree_page_id',
                                        'tree_page_id' => Melis::CURRENT_PAGE_ID,
                                        'tree_father_page_id' => Melis::FOREIGN_KEY,
                                        'tree_page_order' => 1,
                                        Melis::RELATION => [
                                            Melis::CMS_PAGE_PUBLISHED => [
                                                [
                                                    Melis::PRIMARY_KEY => 'page_id',
                                                    'page_id' => Melis::FOREIGN_KEY,
                                                    'page_type' => 'FOLDER',
                                                    'page_status' => '1',
                                                    'page_menu' => 'NONE',
                                                    'page_name' => 'FAQ Cat 1',
                                                    'page_tpl_id' => -1,
                                                    'page_content' => '<?xml version="1.0" encoding="UTF-8"?> <document type="MelisCMS" author="MelisTechnology" version="2.0"> </document>',
                                                ],
                                            ],
                                            Melis::CMS_PAGE_LANG => [
                                                [
                                                    'plang_page_id' =>  Melis::FOREIGN_KEY,
                                                    'plang_lang_id' => 1,
                                                    'plang_page_id_initial' =>  Melis::FOREIGN_KEY
                                                ]
                                            ],
                                            Melis::CMS_PAGE_TREE => [
                                                // <FAQQ/A1>
                                                [
                                                    Melis::PRIMARY_KEY => 'tree_page_id',
                                                    'tree_page_id' => Melis::CURRENT_PAGE_ID,
                                                    'tree_father_page_id' => Melis::FOREIGN_KEY,
                                                    'tree_page_order' => 1,
                                                    Melis::RELATION => [
                                                        Melis::CMS_PAGE_PUBLISHED => [
                                                            [
                                                                Melis::PRIMARY_KEY => 'page_id',
                                                                'page_id' => Melis::FOREIGN_KEY,
                                                                'page_type' => 'PAGE',
                                                                'page_status' => '1',
                                                                'page_menu' => 'NONE',
                                                                'page_name' => 'FAQ Q/A 1',
                                                                'page_tpl_id' => [Site::GET_TEMPLATE_ID => ['template_name' => 'FAQ Details']],
                                                                'page_content' => '<?xml version="1.0" encoding="UTF-8"?> <document type="MelisCMS" author="MelisTechnology" version="2.0"> <melisTag id="faq-html-1" plugin_container_id="" type="html"><![CDATA[<div class="card-body">Why I say old chap that is spiffing pukka, bamboozled wind up bugger buggered zonked hanky panky a blinding shot the little rotter, bubble and squeak vagabond cheeky bugger at public school pardon you bloke the BBC. Tickety-boo Elizabeth plastered matie.!</div>]]></melisTag> <melisTag id="faq-textarea-1" plugin_container_id="" type="textarea"><![CDATA[How do I repair an item?]]></melisTag> </document>',
                                                            ],
                                                        ],
                                                        Melis::CMS_PAGE_LANG => [
                                                            [
                                                                'plang_page_id' =>  Melis::FOREIGN_KEY,
                                                                'plang_lang_id' => 1,
                                                                'plang_page_id_initial' =>  Melis::FOREIGN_KEY
                                                            ]
                                                        ],

                                                    ],
                                                    Site::THEN => [Site::UPDATE_CURRENT_PAGE_ID],
                                                ],
                                                // </FAQQ/A1>
                                                // <FAQQ/A2>
                                                [
                                                    Melis::PRIMARY_KEY => 'tree_page_id',
                                                    'tree_page_id' => Melis::CURRENT_PAGE_ID,
                                                    'tree_father_page_id' => Melis::FOREIGN_KEY,
                                                    'tree_page_order' => 2,
                                                    Melis::RELATION => [
                                                        Melis::CMS_PAGE_PUBLISHED => [
                                                            [
                                                                Melis::PRIMARY_KEY => 'page_id',
                                                                'page_id' => Melis::FOREIGN_KEY,
                                                                'page_type' => 'PAGE',
                                                                'page_status' => '1',
                                                                'page_menu' => 'NONE',
                                                                'page_name' => 'FAQ Q/A 2',
                                                                'page_tpl_id' => [Site::GET_TEMPLATE_ID => ['template_name' => 'FAQ Details']],
                                                                'page_content' => '<?xml version="1.0" encoding="UTF-8"?> <document type="MelisCMS" author="MelisTechnology" version="2.0"> <melisTag id="faq-textarea-1" plugin_container_id="" type="textarea"><![CDATA[How do I repair an item?]]></melisTag> <melisTag id="faq-html-1" plugin_container_id="" type="html"><![CDATA[<div class="card-body">Why I say old chap that is spiffing pukka, bamboozled wind up bugger buggered zonked hanky panky a blinding shot the little rotter, bubble and squeak vagabond cheeky bugger at public school pardon you bloke the BBC. Tickety-boo Elizabeth plastered matie.!</div>]]></melisTag> </document>',

                                                            ],
                                                        ],
                                                        Melis::CMS_PAGE_LANG => [
                                                            [
                                                                'plang_page_id' =>  Melis::FOREIGN_KEY,
                                                                'plang_lang_id' => 1,
                                                                'plang_page_id_initial' =>  Melis::FOREIGN_KEY
                                                            ]
                                                        ],
                                                    ],
                                                ],
                                                // </FAQQ/A2>
                                                // <FAQQ/A3>
                                                [
                                                    Melis::PRIMARY_KEY => 'tree_page_id',
                                                    'tree_page_id' => Melis::CURRENT_PAGE_ID,
                                                    'tree_father_page_id' => Melis::FOREIGN_KEY,
                                                    'tree_page_order' => 3,
                                                    Melis::RELATION => [
                                                        Melis::CMS_PAGE_PUBLISHED => [
                                                            [
                                                                Melis::PRIMARY_KEY => 'page_id',
                                                                'page_id' => Melis::FOREIGN_KEY,
                                                                'page_type' => 'PAGE',
                                                                'page_status' => '1',
                                                                'page_menu' => 'NONE',
                                                                'page_name' => 'FAQ Q/A 3',
                                                                'page_tpl_id' => [Site::GET_TEMPLATE_ID => ['template_name' => 'FAQ Details']],
                                                                'page_content' => '<?xml version="1.0" encoding="UTF-8"?> <document type="MelisCMS" author="MelisTechnology" version="2.0"> <melisTag id="faq-textarea-1" plugin_container_id="" type="textarea"><![CDATA[How do I repair an item?]]></melisTag> <melisTag id="faq-html-1" plugin_container_id="" type="html"><![CDATA[<div class="card-body">Why I say old chap that is spiffing pukka, bamboozled wind up bugger buggered zonked hanky panky a blinding shot the little rotter, bubble and squeak vagabond cheeky bugger at public school pardon you bloke the BBC. Tickety-boo Elizabeth plastered matie.!</div>]]></melisTag> </document>',

                                                            ],
                                                        ],
                                                        Melis::CMS_PAGE_LANG => [
                                                            [
                                                                'plang_page_id' =>  Melis::FOREIGN_KEY,
                                                                'plang_lang_id' => 1,
                                                                'plang_page_id_initial' =>  Melis::FOREIGN_KEY
                                                            ]
                                                        ],
                                                    ],
                                                ],
                                                // <FAQQ/A3>
                                            ]
                                        ],
                                        Site::THEN => [Site::UPDATE_CURRENT_PAGE_ID],
                                    ],
                                    // </FAQCat1>
                                    // <FAQCat2>
                                    [
                                        Melis::PRIMARY_KEY => 'tree_page_id',
                                        'tree_page_id' => Melis::CURRENT_PAGE_ID,
                                        'tree_father_page_id' => Melis::FOREIGN_KEY,
                                        'tree_page_order' => 2,
                                        Melis::RELATION => [
                                            Melis::CMS_PAGE_PUBLISHED => [
                                                [
                                                    Melis::PRIMARY_KEY => 'page_id',
                                                    'page_id' => Melis::FOREIGN_KEY,
                                                    'page_type' => 'FOLDER',
                                                    'page_status' => '1',
                                                    'page_menu' => 'NONE',
                                                    'page_name' => 'FAQ Cat 2',
                                                    'page_tpl_id' => [Site::GET_TEMPLATE_ID => ['template_name' => 'Drag n Drop']],
                                                    'page_content' => '<?xml version="1.0" encoding="UTF-8"?> <document type="MelisCMS" author="MelisTechnology" version="2.0"> </document>',

                                                ],
                                            ],
                                            Melis::CMS_PAGE_LANG => [
                                                [
                                                    'plang_page_id' =>  Melis::FOREIGN_KEY,
                                                    'plang_lang_id' => 1,
                                                    'plang_page_id_initial' =>  Melis::FOREIGN_KEY
                                                ]
                                            ],
                                        ],
                                    ],
                                    // </FAQCat2>
                                    // <FAQCat3>
                                    [
                                        Melis::PRIMARY_KEY => 'tree_page_id',
                                        'tree_page_id' => Melis::CURRENT_PAGE_ID,
                                        'tree_father_page_id' => Melis::FOREIGN_KEY,
                                        'tree_page_order' => 3,
                                        Melis::RELATION => [
                                            Melis::CMS_PAGE_PUBLISHED => [
                                                [
                                                    Melis::PRIMARY_KEY => 'page_id',
                                                    'page_id' => Melis::FOREIGN_KEY,
                                                    'page_type' => 'PAGE',
                                                    'page_status' => '1',
                                                    'page_menu' => 'NONE',
                                                    'page_name' => 'Process 3',
                                                    'page_tpl_id' => [Site::GET_TEMPLATE_ID => ['template_name' => 'Drag n Drop']],
                                                    'page_content' => '<?xml version="1.0" encoding="UTF-8"?> <document type="MelisCMS" author="MelisTechnology" version="2.0"> </document>',

                                                ],
                                            ],
                                            Melis::CMS_PAGE_LANG => [
                                                [
                                                    'plang_page_id' =>  Melis::FOREIGN_KEY,
                                                    'plang_lang_id' => 1,
                                                    'plang_page_id_initial' =>  Melis::FOREIGN_KEY
                                                ]
                                            ],
                                        ],
                                    ],
                                    // <FAQCat3>
                                ]
                            ]
                        ],
                        // <//FAQ>

                        // <Contact>
                        [
                            Melis::PRIMARY_KEY => 'tree_page_id',
                            'tree_page_id' => Melis::CURRENT_PAGE_ID,
                            'tree_father_page_id' => Melis::CMS_SITE_ID,
                            'tree_page_order' => 6,
                            Site::THEN => [Site::UPDATE_CURRENT_PAGE_ID],
                            Melis::RELATION => [
                                Melis::CMS_PAGE_PUBLISHED => [
                                    [
                                        Melis::PRIMARY_KEY => 'page_id',
                                        'page_id' => Melis::FOREIGN_KEY,
                                        'page_type' => 'PAGE',
                                        'page_status' => '1',
                                        'page_menu' => 'LINK',
                                        'page_name' => 'Contact',
                                        'page_tpl_id' => [Site::GET_TEMPLATE_ID => ['template_name' => 'Contact']],
                                        'page_content' => '<?xml version="1.0" encoding="UTF-8"?> <document type="MelisCMS" author="MelisTechnology" version="2.0"> <melisTag id="contact-html-1" plugin_container_id="" type="html"><![CDATA[<div class="breadcrumb_content text-center"> <h1 class="f_p f_700 f_size_50 w_color l_height50 mb_20">Contact Us</h1> <p class="f_400 w_color f_size_16 l_height26">Why I say old chap that is spiffing off his nut arse pear shaped plastered<br />Jeffrey bodge barney some dodgy.!!</p> </div>]]></melisTag> <melisTag id="contact-html-2" plugin_container_id="" type="html"><![CDATA[<div class="info_item"> <h3>Office Address</h3> <p>4, rue du Dahomey&nbsp;75011 Paris, France</p> </div> <div class="info_item"> <h3>Contact Info</h3> <p>Phone: (+33) 972 386 280<br />Email: contact@melistechnology.com&nbsp;</p> </div>]]></melisTag> <melisTag id="contact_gmap_lat" plugin_container_id="" type="textarea"><![CDATA[48.850973]]></melisTag> <melisTag id="contact_gmap_long" plugin_container_id="" type="textarea"><![CDATA[2.382171]]></melisTag> </document>',
                                    ],
                                ],
                                Melis::CMS_PAGE_LANG => [
                                    [
                                        'plang_page_id' =>  Melis::FOREIGN_KEY,
                                        'plang_lang_id' => 1,
                                        'plang_page_id_initial' =>  Melis::FOREIGN_KEY
                                    ]
                                ],
                            ],
                            Site::THEN => [Site::UPDATE_CURRENT_PAGE_ID],
                        ],
                        // </Contact>

                        // <TraversalPages>
                        [
                            Melis::PRIMARY_KEY => 'tree_page_id',
                            'tree_page_id' => Melis::CURRENT_PAGE_ID,
                            'tree_father_page_id' => Melis::CMS_SITE_ID,
                            'tree_page_order' => 7,
                            Site::THEN => [Site::UPDATE_CURRENT_PAGE_ID],
                            Melis::RELATION => [
                                Melis::CMS_PAGE_PUBLISHED => [
                                    [
                                        Melis::PRIMARY_KEY => 'page_id',
                                        'page_id' => Melis::FOREIGN_KEY,
                                        'page_type' => 'FOLDER',
                                        'page_status' => '1',
                                        'page_menu' => 'NONE',
                                        'page_name' => 'Transversal',
                                        'page_tpl_id' => -1,
                                        'page_content' => '<?xml version="1.0" encoding="UTF-8"?><document type="MelisCMS" author="MelisTechnology" version="2.0"></document>',

                                    ],
                                ],
                                Melis::CMS_PAGE_LANG => [
                                    [
                                        'plang_page_id' =>  Melis::FOREIGN_KEY,
                                        'plang_lang_id' => 1,
                                        'plang_page_id_initial' =>  Melis::FOREIGN_KEY
                                    ]
                                ],
                                Melis::CMS_PAGE_TREE => [
                                    // <Testimonials>
                                    [
                                        Melis::PRIMARY_KEY => 'tree_page_id',
                                        'tree_page_id' => Melis::CURRENT_PAGE_ID,
                                        'tree_father_page_id' => Melis::FOREIGN_KEY,
                                        'tree_page_order' => 1,
                                        Site::THEN => [Site::UPDATE_CURRENT_PAGE_ID],
                                        Melis::RELATION => [
                                            Melis::CMS_PAGE_PUBLISHED => [
                                                [
                                                    Melis::PRIMARY_KEY => 'page_id',
                                                    'page_id' => Melis::FOREIGN_KEY,
                                                    'page_type' => 'PAGE',
                                                    'page_status' => '1',
                                                    'page_menu' => 'NONE',
                                                    'page_name' => 'Testimonials',
                                                    'page_tpl_id' => -1,
                                                    'page_content' => '<?xml version="1.0" encoding="UTF-8"?><document type="MelisCMS" author="MelisTechnology" version="2.0"></document>',
                                                ],
                                            ],
                                            Melis::CMS_PAGE_LANG => [
                                                [
                                                    'plang_page_id' =>  Melis::FOREIGN_KEY,
                                                    'plang_lang_id' => 1,
                                                    'plang_page_id_initial' =>  Melis::FOREIGN_KEY
                                                ]
                                            ],
                                            Melis::CMS_PAGE_TREE => [
                                                // <Testimonials1>
                                                [
                                                    Melis::PRIMARY_KEY => 'tree_page_id',
                                                    'tree_page_id' => Melis::CURRENT_PAGE_ID,
                                                    'tree_father_page_id' => Melis::FOREIGN_KEY,
                                                    'tree_page_order' => 1,
                                                    Site::THEN => [Site::UPDATE_CURRENT_PAGE_ID],
                                                    Melis::RELATION => [
                                                        Melis::CMS_PAGE_PUBLISHED => [
                                                            [
                                                                Melis::PRIMARY_KEY => 'page_id',
                                                                'page_id' => Melis::FOREIGN_KEY,
                                                                'page_type' => 'PAGE',
                                                                'page_status' => '1',
                                                                'page_menu' => 'LINK',
                                                                'page_name' => 'Testimonial 1',
                                                                'page_tpl_id' => [Site::GET_TEMPLATE_ID => ['template_name' => 'Testimonial']],
                                                                'page_content' => '<?xml version="1.0" encoding="UTF-8"?> <document type="MelisCMS" author="MelisTechnology" version="2.0"> <melisTag id="testi-html-1" plugin_container_id="" type="html"><![CDATA[Loo car boot bodge smashing I up the duff horse play give us a bell, William bugger all mate happy days mush at public school tosser victoria sponge, say lurgy hunky-dory twit hotpot gutted mate.]]></melisTag> <melisTag id="testi-textarea-1" plugin_container_id="" type="html"><![CDATA[Lance Bogrol]]></melisTag> <melisTag id="testi-textarea-2" plugin_container_id="" type="html"><![CDATA[Officer at Samumed]]></melisTag> </document>',

                                                            ],
                                                        ],
                                                        Melis::CMS_PAGE_LANG => [
                                                            [
                                                                'plang_page_id' =>  Melis::FOREIGN_KEY,
                                                                'plang_lang_id' => 1,
                                                                'plang_page_id_initial' =>  Melis::FOREIGN_KEY
                                                            ]
                                                        ],
                                                    ]
                                                ],
                                                // </Testimonials1>
                                                // <Testimonials2>
                                                [
                                                    Melis::PRIMARY_KEY => 'tree_page_id',
                                                    'tree_page_id' => Melis::CURRENT_PAGE_ID,
                                                    'tree_father_page_id' => Melis::FOREIGN_KEY,
                                                    'tree_page_order' => 2,
                                                    Site::THEN => [Site::UPDATE_CURRENT_PAGE_ID],
                                                    Melis::RELATION => [
                                                        Melis::CMS_PAGE_PUBLISHED => [
                                                            [
                                                                Melis::PRIMARY_KEY => 'page_id',
                                                                'page_id' => Melis::FOREIGN_KEY,
                                                                'page_type' => 'PAGE',
                                                                'page_status' => '1',
                                                                'page_menu' => 'LINK',
                                                                'page_name' => 'Testimonial 2',
                                                                'page_tpl_id' => [Site::GET_TEMPLATE_ID => ['template_name' => 'Testimonial']],
                                                                'page_content' => '<?xml version="1.0" encoding="UTF-8"?> <document type="MelisCMS" author="MelisTechnology" version="2.0"> <melisTag id="testi-html-1" plugin_container_id="" type="html"><![CDATA[Loo car boot bodge smashing I up the duff horse play give us a bell, William bugger all mate happy days mush at public school tosser victoria sponge, say lurgy hunky-dory twit hotpot gutted mate.]]></melisTag> <melisTag id="testi-textarea-1" plugin_container_id="" type="html"><![CDATA[Lance Bogrol]]></melisTag> <melisTag id="testi-textarea-2" plugin_container_id="" type="html"><![CDATA[Officer at Samumed]]></melisTag> </document>',

                                                            ],
                                                        ],
                                                        Melis::CMS_PAGE_LANG => [
                                                            [
                                                                'plang_page_id' =>  Melis::FOREIGN_KEY,
                                                                'plang_lang_id' => 1,
                                                                'plang_page_id_initial' =>  Melis::FOREIGN_KEY
                                                            ]
                                                        ],
                                                    ]
                                                ],
                                                // </Testimonials2>
                                            ]
                                            // </Testimonials>
                                        ]
                                    ],
                                    // </TraversalPages>
                                    // <SearchResults>
                                    [
                                        Melis::PRIMARY_KEY => 'tree_page_id',
                                        'tree_page_id' => Melis::CURRENT_PAGE_ID,
                                        'tree_father_page_id' => Melis::FOREIGN_KEY,
                                        'tree_page_order' => 2,
                                        Site::THEN => [Site::UPDATE_CURRENT_PAGE_ID],
                                        Melis::RELATION => [
                                            Melis::CMS_PAGE_PUBLISHED => [
                                                [
                                                    Melis::PRIMARY_KEY => 'page_id',
                                                    'page_id' => Melis::FOREIGN_KEY,
                                                    'page_type' => 'PAGE',
                                                    'page_status' => '1',
                                                    'page_menu' => 'LINK',
                                                    'page_name' => 'Search Result',
                                                    'page_tpl_id' => [Site::GET_TEMPLATE_ID => ['template_name' => 'Search Result']],
                                                    'page_content' => '<?xml version="1.0" encoding="UTF-8"?> <document type="MelisCMS" author="MelisTechnology" version="2.0"> </document>',
                                                ],
                                            ],
                                            Melis::CMS_PAGE_LANG => [
                                                [
                                                    'plang_page_id' => Melis::FOREIGN_KEY,
                                                    'plang_lang_id' => 1,
                                                    'plang_page_id_initial' => Melis::FOREIGN_KEY
                                                ]
                                            ],
                                        ]
                                    ],
                                    // </SearchResults>
                                    // <Page404>
                                    [
                                        Melis::PRIMARY_KEY => 'tree_page_id',
                                        'tree_page_id' => Melis::CURRENT_PAGE_ID,
                                        'tree_father_page_id' => Melis::CMS_SITE_ID,
                                        'tree_page_order' => 3,
                                        Site::THEN => [Site::UPDATE_CURRENT_PAGE_ID],
                                        Melis::RELATION => [
                                            Melis::CMS_PAGE_PUBLISHED => [
                                                [
                                                    Melis::PRIMARY_KEY => 'page_id',
                                                    'page_id' => Melis::FOREIGN_KEY,
                                                    'page_type' => 'PAGE',
                                                    'page_status' => '1',
                                                    'page_menu' => 'NONE',
                                                    'page_name' => '404',
                                                    'page_tpl_id' => [Site::GET_TEMPLATE_ID => ['template_name' => '404']],
                                                    'page_content' => '<?xml version="1.0" encoding="UTF-8"?> <document type="MelisCMS" author="MelisTechnology" version="2.0"> <melisTag id="contact-html-1" plugin_container_id="" type="html"><![CDATA[<h2>Error. We can&rsquo;t find the page you&rsquo;re looking for.</h2> <p>Sorry for the inconvenience. Go to our homepage or check out our latest collections for Fashion, Chair, Decoration...</p> <a href="#" class="about_btn btn_hover">Back to Home Page <i class="arrow_right"></i></a>]]></melisTag> </document>',
                                                ],
                                            ],
                                            Melis::CMS_PAGE_LANG => [
                                                [
                                                    'plang_page_id' =>  Melis::FOREIGN_KEY,
                                                    'plang_lang_id' => 1,
                                                    'plang_page_id_initial' =>  Melis::FOREIGN_KEY
                                                ]
                                            ],
                                            Melis::CMS_SITE_404 => [
                                                [
                                                    's404_site_id' => Melis::CMS_SITE_ID,
                                                    's404_page_id' =>  Melis::FOREIGN_KEY
                                                ]
                                            ],
                                        ]
                                    ],
                                    // </Page404>
                                ]
                            ]
                        ],
                        // </TraversalPages>
                    ],
                    // </editor-fold>

                    // <editor-fold desc="CMS_NEWS">
                    Melis::CMS_NEWS => [
                        [
                            'cnews_status' => '1',
                            'cnews_image1' => '/' . __NAMESPACE__ . '/images/news/N01.jpg',
                            'cnews_site_id' => Melis::CMS_SITE_ID,
                            'cnews_publish_date' => date('Y-m-d h:i:s',strtotime('2018-11-27')),
                            Melis::RELATION => [
                                Melis::CMS_NEWS_TEXTS => [
                                    [
                                        'cnews_title' => 'Fashion show Obscuria in PARIS this spring 2017!',
                                        'cnews_paragraph1' => 'Paragraph 1, Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
                                        'cnews_paragraph2' => 'Paragraph 2, Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
                                        'cnews_paragraph3' => 'Paragraph 3, Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
                                        'cnews_paragraph4' => 'Paragraph 4, Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
                                        'cnews_lang_id' => '1',
                                        'cnews_id' => Melis::FOREIGN_KEY,
                                    ],
                                ],
                            ]
                        ],
                        [
                            'cnews_status' => '1',
                            'cnews_image1' => '/' . __NAMESPACE__ . '/images/news/N02.jpg',
                            'cnews_site_id' => Melis::CMS_SITE_ID,
                            'cnews_publish_date' =>  date('Y-m-d h:i:s',strtotime('2018-11-27')),
                            Melis::RELATION => [
                                Melis::CMS_NEWS_TEXTS => [
                                    [
                                        'cnews_title' => 'Latest youth trends',
                                        'cnews_paragraph1' => 'Paragraph 1, Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
                                        'cnews_paragraph2' => 'Paragraph 2, Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
                                        'cnews_paragraph3' => 'Paragraph 3, Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
                                        'cnews_paragraph4' => 'Paragraph 4, Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
                                        'cnews_lang_id' => '1',
                                        'cnews_id' => Melis::FOREIGN_KEY,
                                    ]
                                ],
                            ]
                        ],
                        [
                            'cnews_status' => '1',
                            'cnews_image1' => '/' . __NAMESPACE__ . '/images/news/N03.jpg',
                            'cnews_site_id' => Melis::CMS_SITE_ID,
                            'cnews_publish_date' =>  date('Y-m-d h:i:s',strtotime('2018-11-27')),
                            Melis::RELATION => [
                                Melis::CMS_NEWS_TEXTS => [
                                    [
                                        'cnews_title' => '8 ways to revive old fashion shoes',
                                        'cnews_paragraph1' => 'Paragraph 1, Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
                                        'cnews_paragraph2' => 'Paragraph 2, Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
                                        'cnews_paragraph3' => 'Paragraph 3, Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
                                        'cnews_paragraph4' => 'Paragraph 4, Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
                                        'cnews_lang_id' => '1',
                                        'cnews_id' => Melis::FOREIGN_KEY,
                                    ]
                                ],
                            ]
                        ],
                        [
                            'cnews_status' => '1',
                            'cnews_image1' => '/' . __NAMESPACE__ . '/images/news/N04.jpg',
                            'cnews_site_id' => Melis::CMS_SITE_ID,
                            'cnews_publish_date' =>  date('Y-m-d h:i:s',strtotime('2018-11-27')),
                            Melis::RELATION => [
                                Melis::CMS_NEWS_TEXTS => [
                                    [
                                        'cnews_title' => 'Quizzz : how much do you know about fashion?',
                                        'cnews_paragraph1' => 'Paragraph 1, Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
                                        'cnews_paragraph2' => 'Paragraph 2, Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
                                        'cnews_paragraph3' => 'Paragraph 3, Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
                                        'cnews_paragraph4' => 'Paragraph 4, Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
                                        'cnews_lang_id' => '1',
                                        'cnews_id' => Melis::FOREIGN_KEY,
                                    ]
                                ],
                            ]
                        ],
                        [
                            'cnews_status' => '1',
                            'cnews_image1' => '/' . __NAMESPACE__ . '/images/news/N05.jpg',
                            'cnews_site_id' => Melis::CMS_SITE_ID,
                            'cnews_publish_date' =>  date('Y-m-d h:i:s',strtotime('2018-10-27')),
                            Melis::RELATION => [
                                Melis::CMS_NEWS_TEXTS => [
                                    [
                                        'cnews_title' => 'What type of model are you?',
                                        'cnews_paragraph1' => 'Paragraph 1, Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
                                        'cnews_paragraph2' => 'Paragraph 2, Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
                                        'cnews_paragraph3' => 'Paragraph 3, Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
                                        'cnews_paragraph4' => 'Paragraph 4, Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
                                        'cnews_lang_id' => '1',
                                        'cnews_id' => Melis::FOREIGN_KEY,
                                    ]
                                ],
                            ]
                        ],
                        [
                            'cnews_status' => '1',
                            'cnews_image1' => '/' . __NAMESPACE__ . '/images/news/N06.jpg',
                            'cnews_site_id' => Melis::CMS_SITE_ID,
                            'cnews_publish_date' => date('Y-m-d h:i:s',strtotime('2018-10-27')),
                            Melis::RELATION => [
                                Melis::CMS_NEWS_TEXTS => [
                                    [
                                        'cnews_title' => 'Under the spotlight!',
                                        'cnews_paragraph1' => 'Paragraph 1, Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
                                        'cnews_paragraph2' => 'Paragraph 2, Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
                                        'cnews_paragraph3' => 'Paragraph 3, Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
                                        'cnews_paragraph4' => 'Paragraph 4, Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
                                        'cnews_lang_id' => '1',
                                        'cnews_id' => Melis::FOREIGN_KEY,
                                    ]
                                ],
                            ]
                        ],
                        [
                            'cnews_status' => '1',
                            'cnews_image1' => '/' . __NAMESPACE__ . '/images/news/N07.jpg',
                            'cnews_site_id' => Melis::CMS_SITE_ID,
                            'cnews_publish_date' => date('Y-m-d h:i:s',strtotime('2018-10-27')),
                            Melis::RELATION => [
                                Melis::CMS_NEWS_TEXTS => [
                                    [
                                        'cnews_title' => 'How to get the utmost of your makeup',
                                        'cnews_paragraph1' => 'Paragraph 1, Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
                                        'cnews_paragraph2' => 'Paragraph 2, Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
                                        'cnews_paragraph3' => 'Paragraph 3, Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
                                        'cnews_paragraph4' => 'Paragraph 4, Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
                                        'cnews_lang_id' => '1',
                                        'cnews_id' => Melis::FOREIGN_KEY,
                                    ]
                                ],
                            ]
                        ],
                        [
                            'cnews_status' => '1',
                            'cnews_image1' => '/' . __NAMESPACE__ . '/images/news/N08.jpg',
                            'cnews_site_id' => Melis::CMS_SITE_ID,
                            'cnews_publish_date' => date('Y-m-d h:i:s',strtotime('2018-10-27')),
                            Melis::RELATION => [
                                Melis::CMS_NEWS_TEXTS => [
                                    [
                                        'cnews_title' => 'Discover the most handsome star of the month!',
                                        'cnews_paragraph1' => 'Paragraph 1, Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
                                        'cnews_paragraph2' => 'Paragraph 2, Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
                                        'cnews_paragraph3' => 'Paragraph 3, Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
                                        'cnews_paragraph4' => 'Paragraph 4, Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
                                        'cnews_lang_id' => '1',
                                        'cnews_id' => Melis::FOREIGN_KEY,
                                    ]
                                ],
                            ]
                        ],
                        [
                            'cnews_status' => '1',
                            'cnews_image1' => '/' . __NAMESPACE__ . '/images/news/N09.jpg',
                            'cnews_site_id' => Melis::CMS_SITE_ID,
                            'cnews_publish_date' => date('Y-m-d h:i:s',strtotime('2018-09-27')),
                            Melis::RELATION => [
                                Melis::CMS_NEWS_TEXTS => [
                                    [
                                        'cnews_title' => 'Dark curtains project revealed!',
                                        'cnews_paragraph1' => 'Paragraph 1, Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
                                        'cnews_paragraph2' => 'Paragraph 2, Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
                                        'cnews_paragraph3' => 'Paragraph 3, Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
                                        'cnews_paragraph4' => 'Paragraph 4, Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
                                        'cnews_lang_id' => '1',
                                        'cnews_id' => Melis::FOREIGN_KEY,
                                    ]
                                ],
                            ]
                        ],
                        [
                            'cnews_status' => '1',
                            'cnews_image1' => '/' . __NAMESPACE__ . '/images/news/N10.jpg',
                            'cnews_site_id' => Melis::CMS_SITE_ID,
                            'cnews_publish_date' => date('Y-m-d h:i:s',strtotime('2018-10-27')),
                            Melis::RELATION => [
                                Melis::CMS_NEWS_TEXTS => [
                                    [
                                        'cnews_title' => 'Immerse yourself into fashion with this new event!',
                                        'cnews_paragraph1' => 'Paragraph 1, Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
                                        'cnews_paragraph2' => 'Paragraph 2, Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
                                        'cnews_paragraph3' => 'Paragraph 3, Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
                                        'cnews_paragraph4' => 'Paragraph 4, Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
                                        'cnews_lang_id' => '1',
                                        'cnews_id' => Melis::FOREIGN_KEY,
                                    ]
                                ],
                            ]
                        ],
                        [
                            'cnews_status' => '1',
                            'cnews_image1' => '/' . __NAMESPACE__ . '/images/news/N11.jpg',
                            'cnews_site_id' => Melis::CMS_SITE_ID,
                            'cnews_publish_date' => date('Y-m-d h:i:s',strtotime('2018-09-27')),
                            Melis::RELATION => [
                                Melis::CMS_NEWS_TEXTS => [
                                    [
                                        'cnews_title' => 'Why is Paris the capital city of Fashion?',
                                        'cnews_paragraph1' => 'Paragraph 1, Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
                                        'cnews_paragraph2' => 'Paragraph 2, Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
                                        'cnews_paragraph3' => 'Paragraph 3, Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
                                        'cnews_paragraph4' => 'Paragraph 4, Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
                                        'cnews_lang_id' => '1',
                                        'cnews_id' => Melis::FOREIGN_KEY,
                                    ]
                                ],
                            ]
                        ],
                        [
                            'cnews_status' => '1',
                            'cnews_image1' => '/' . __NAMESPACE__ . '/images/news/N12.jpg',
                            'cnews_site_id' => Melis::CMS_SITE_ID,
                            'cnews_publish_date' => date('Y-m-d h:i:s',strtotime('2018-09-27')),
                            Melis::RELATION => [
                                Melis::CMS_NEWS_TEXTS => [
                                    [
                                        'cnews_title' => 'Gentlemen, time to put on your suits!',
                                        'cnews_paragraph1' => 'Paragraph 1, Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
                                        'cnews_paragraph2' => 'Paragraph 2, Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
                                        'cnews_paragraph3' => 'Paragraph 3, Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
                                        'cnews_paragraph4' => 'Paragraph 4, Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
                                        'cnews_lang_id' => '1',
                                        'cnews_id' => Melis::FOREIGN_KEY,
                                    ]
                                ],
                            ]
                        ],
                        [
                            'cnews_status' => '1',
                            'cnews_image1' => '/' . __NAMESPACE__ . '/images/news/N13.jpg',
                            'cnews_site_id' => Melis::CMS_SITE_ID,
                            'cnews_publish_date' => date('Y-m-d h:i:s',strtotime('2018-08-27')),
                            Melis::RELATION => [
                                Melis::CMS_NEWS_TEXTS => [
                                    [
                                        'cnews_title' => 'Upcoming trends this year',
                                        'cnews_paragraph1' => 'Paragraph 1, Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
                                        'cnews_paragraph2' => 'Paragraph 2, Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
                                        'cnews_paragraph3' => 'Paragraph 3, Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
                                        'cnews_paragraph4' => 'Paragraph 4, Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
                                        'cnews_lang_id' => '1',
                                        'cnews_id' => Melis::FOREIGN_KEY,
                                    ]
                                ],
                            ]
                        ],
                        [
                            'cnews_status' => '1',
                            'cnews_image1' => '/' . __NAMESPACE__ . '/images/news/N14.jpg',
                            'cnews_site_id' => Melis::CMS_SITE_ID,
                            'cnews_publish_date' => date('Y-m-d h:i:s',strtotime('2018-08-27')),
                            Melis::RELATION => [
                                Melis::CMS_NEWS_TEXTS => [
                                    [
                                        'cnews_title' => 'Discover Angela the new fashion model of Melis',
                                        'cnews_paragraph1' => 'Paragraph 1, Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
                                        'cnews_paragraph2' => 'Paragraph 2, Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
                                        'cnews_paragraph3' => 'Paragraph 3, Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
                                        'cnews_paragraph4' => 'Paragraph 4, Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
                                        'cnews_lang_id' => '1',
                                        'cnews_id' => Melis::FOREIGN_KEY,
                                    ]
                                ],
                            ]
                        ],
                        [
                            'cnews_status' => '1',
                            'cnews_image1' => '/' . __NAMESPACE__ . '/images/news/N15.jpg',
                            'cnews_site_id' => Melis::CMS_SITE_ID,
                            'cnews_publish_date' => date('Y-m-d h:i:s',strtotime('2018-07-27')),
                            Melis::RELATION => [
                                Melis::CMS_NEWS_TEXTS => [
                                    [
                                        'cnews_title' => 'Latest designs unveiled',
                                        'cnews_paragraph1' => 'Paragraph 1, Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
                                        'cnews_paragraph2' => 'Paragraph 2, Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
                                        'cnews_paragraph3' => 'Paragraph 3, Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
                                        'cnews_paragraph4' => 'Paragraph 4, Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
                                        'cnews_lang_id' => '1',
                                        'cnews_id' => Melis::FOREIGN_KEY,
                                    ]
                                ],
                            ]
                        ],
                        [
                            'cnews_status' => '1',
                            'cnews_image1' => '/' . __NAMESPACE__ . '/images/news/N16.jpg',
                            'cnews_site_id' => Melis::CMS_SITE_ID,
                            'cnews_publish_date' => date('Y-m-d h:i:s',strtotime('2018-07-27')),
                            Melis::RELATION => [
                                Melis::CMS_NEWS_TEXTS => [
                                    [
                                        'cnews_title' => 'Revelations of the most renowned fashion artist!',
                                        'cnews_paragraph1' => 'Paragraph 1, Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
                                        'cnews_paragraph2' => 'Paragraph 2, Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
                                        'cnews_paragraph3' => 'Paragraph 3, Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
                                        'cnews_paragraph4' => 'Paragraph 4, Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
                                        'cnews_lang_id' => '1',
                                        'cnews_id' => Melis::FOREIGN_KEY,
                                    ]
                                ],
                            ]
                        ],
                        [
                            'cnews_status' => '1',
                            'cnews_image1' => '/' . __NAMESPACE__ . '/images/news/N17.jpg',
                            'cnews_site_id' => Melis::CMS_SITE_ID,
                            'cnews_publish_date' => date('Y-m-d h:i:s',strtotime('2018-06-27')),
                            Melis::RELATION => [
                                Melis::CMS_NEWS_TEXTS => [
                                    [
                                        'cnews_title' => 'XYZ is now hiring models',
                                        'cnews_paragraph1' => 'Paragraph 1, Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
                                        'cnews_paragraph2' => 'Paragraph 2, Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
                                        'cnews_paragraph3' => 'Paragraph 3, Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
                                        'cnews_paragraph4' => 'Paragraph 4, Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
                                        'cnews_lang_id' => '1',
                                        'cnews_id' => Melis::FOREIGN_KEY,
                                    ]
                                ],
                            ]
                        ],
                        [
                            'cnews_status' => '1',
                            'cnews_image1' => '/' . __NAMESPACE__ . '/images/news/N18.jpg',
                            'cnews_site_id' => Melis::CMS_SITE_ID,
                            'cnews_publish_date' => date('Y-m-d h:i:s',strtotime('2018-06-27')),
                            Melis::RELATION => [
                                Melis::CMS_NEWS_TEXTS => [
                                    [
                                        'cnews_title' => 'Fashion and seduction : an art in itself',
                                        'cnews_paragraph1' => 'Paragraph 1, Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
                                        'cnews_paragraph2' => 'Paragraph 2, Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
                                        'cnews_paragraph3' => 'Paragraph 3, Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
                                        'cnews_paragraph4' => 'Paragraph 4, Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
                                        'cnews_lang_id' => '1',
                                        'cnews_id' => Melis::FOREIGN_KEY,
                                    ]
                                ],
                            ]
                        ],
                    ],
                    // </editor-fold>

                    // <editor-fold desc="CMS_PROSPECTS_THEMES">
                    Melis::CMS_PROSPECTS_THEMES => [
                        [
                            'pros_theme_name' => 'Melis Demo CMS Contact',
                            'pros_theme_code' => 'MELIS_DEMO_CMS_CONTACT',
                            Melis::RELATION => [
                                Melis::CMS_PROSPECTS_THEMES_ITEMS => [
                                    [

                                        'pros_theme_id' => 1,
                                        Melis::RELATION => [
                                            Melis::CMS_PROSPECTS_THEMES_ITEMS_TRANSLATIONS => [
                                                [
                                                    'item_trans_text' => 'About a product',
                                                    'item_trans_lang_id' => 1,
                                                    'item_trans_theme_item_id' => 1,
                                                ],
                                                [
                                                    'item_trans_text' => 'About the company',
                                                    'item_trans_lang_id' => 1,
                                                    'item_trans_theme_item_id' => 2,
                                                ],
                                                [
                                                    'item_trans_text' => 'Press related',
                                                    'item_trans_lang_id' => 1,
                                                    'item_trans_theme_item_id' => 3,
                                                ],
                                                [
                                                    'item_trans_text' => 'Apply for a position',
                                                    'item_trans_lang_id' => 1,
                                                    'item_trans_theme_item_id' => 4,
                                                ],
                                                [
                                                    'item_trans_text' => 'Other',
                                                    'item_trans_lang_id' => 1,
                                                    'item_trans_theme_item_id' => 5,
                                                ],
                                            ],
                                        ],
                                    ],
                                    ['pros_theme_id' => 1],
                                    ['pros_theme_id' => 1],
                                    ['pros_theme_id' => 1],
                                    ['pros_theme_id' => 1]
                                ],
                            ],
                        ],
//                        [
//                            'pros_theme_name' => 'Melis Demo CMS Contact 1',
//                            'pros_theme_code' => 'MELIS_DEMO_CMS_CONTACT 1',
//                            Melis::RELATION => [
//                                Melis::CMS_PROSPECTS_THEMES_ITEMS => [
//                                    [
//                                        'pros_theme_id' => Melis::FOREIGN_KEY,
//                                        Melis::RELATION => [
//                                            Melis::CMS_PROSPECTS_THEMES_ITEMS_TRANSLATIONS => [
//                                                [
//                                                    'item_trans_text' => 'Just observe',
//                                                    'item_trans_lang_id' => 1,
//                                                    'item_trans_theme_item_id' => Melis::ROOT_FOREIGN_KEY,
//                                                ],
//                                                [
//                                                    'item_trans_text' => 'must keep trying',
//                                                    'item_trans_lang_id' => 1,
//                                                    'item_trans_theme_item_id' => Melis::ROOT_FOREIGN_KEY,
//                                                ],
//                                            ],
//                                        ],
//                                    ],
//                                ],
//                            ],
//                        ],
                    ],
                    // </editor-fold>

                    // <editor-fold desc="CMS_SLIDER">
                    Melis::CMS_SLIDER => [
                        [
                            'mcslide_name' => 'Homepage Header Slider',
                            'mcslide_page_id' => Melis::CMS_SITE_ID,
                            'mcslide_date' => date('Y-m-d H:i:s'),
                            Melis::RELATION => [
                                Melis::CMS_SLIDER_DETAILS => [
                                    [
                                        'mcsdetail_mcslider_id' => Melis::FOREIGN_KEY,
                                        'mcsdetail_status' => 1,
                                        'mcsdetail_title' => 'New Fashion Event 2017!',
                                        'mcsdetail_sub1' => 'Best Collection',
                                        'mcsdetail_sub2' => 'Discover it!',
                                        'mcsdetail_sub3' => '',
                                        'mcsdetail_link' => '/news/news-details/id/3?newsid=9',
                                        'mcsdetail_img' => '/' . __NAMESPACE__ . '/images/slider/slider01.jpg',
                                        'mcsdetail_order' => 1,
                                    ],
                                    [
                                        'mcsdetail_mcslider_id' => Melis::FOREIGN_KEY,
                                        'mcsdetail_status' => 1,
                                        'mcsdetail_title' => 'Best Suit Collection',
                                        'mcsdetail_sub1' => 'Exclusive Fashion 2017',
                                        'mcsdetail_sub2' => 'Check it out!',
                                        'mcsdetail_sub3' => '',
                                        'mcsdetail_link' => '/our-designs/suits/id/11',
                                        'mcsdetail_img' => '/' . __NAMESPACE__ . '/images/slider/slider02.jpg',
                                        'mcsdetail_order' => 2,
                                    ],
                                    [
                                        'mcsdetail_mcslider_id' => Melis::FOREIGN_KEY,
                                        'mcsdetail_status' => 1,
                                        'mcsdetail_title' => 'What type of model are you?',
                                        'mcsdetail_sub1' => 'Exclusive Quiz!',
                                        'mcsdetail_sub2' => 'Take the test',
                                        'mcsdetail_sub3' => '',
                                        'mcsdetail_link' => '/news/news-details/id/3?newsid=5',
                                        'mcsdetail_img' => '/' . __NAMESPACE__ . '/images/slider/slider03.jpg',
                                        'mcsdetail_order' => 3,
                                    ],
                                ]
                            ]
                        ],

                        [
                            'mcslide_name' => 'About us - Our Team',
                            'mcslide_page_id' =>  [Site::GET_PAGE_ID => ['page_name' => 'About us']],
                            'mcslide_date' => date('Y-m-d H:i:s'),
                            Melis::RELATION => [
                                Melis::CMS_SLIDER_DETAILS => [
                                    [
                                        'mcsdetail_mcslider_id' => Melis::FOREIGN_KEY,
                                        'mcsdetail_status' => 1,
                                        'mcsdetail_title' => 'Wendy Silver',
                                        'mcsdetail_sub1' => 'Stylist',
                                        'mcsdetail_img' => '/' . __NAMESPACE__ . '/images/team/01.jpg',
                                        'mcsdetail_order' => 1,
                                    ],
                                    [
                                        'mcsdetail_mcslider_id' => Melis::FOREIGN_KEY,
                                        'mcsdetail_status' => 1,
                                        'mcsdetail_title' => 'Robert Stian',
                                        'mcsdetail_sub1' => 'Designer',
                                        'mcsdetail_img' => '/' . __NAMESPACE__ . '/images/team/02.jpg',
                                        'mcsdetail_order' => 2,
                                    ],
                                    [
                                        'mcsdetail_mcslider_id' => Melis::FOREIGN_KEY,
                                        'mcsdetail_status' => 1,
                                        'mcsdetail_title' => 'Edward Liton',
                                        'mcsdetail_sub1' => 'Event Expert',
                                        'mcsdetail_img' => '/' . __NAMESPACE__ . '/images/team/03.jpg',
                                        'mcsdetail_order' => 3,
                                    ],
                                    [
                                        'mcsdetail_mcslider_id' => Melis::FOREIGN_KEY,
                                        'mcsdetail_status' => 1,
                                        'mcsdetail_title' => 'Beth Gentle',
                                        'mcsdetail_sub1' => 'Model',
                                        'mcsdetail_img' => '/' . __NAMESPACE__ . '/images/team/04.jpg',
                                        'mcsdetail_order' => 4,
                                    ],
                                    [
                                        'mcsdetail_mcslider_id' => Melis::FOREIGN_KEY,
                                        'mcsdetail_status' => 1,
                                        'mcsdetail_title' => 'Greg Dylan',
                                        'mcsdetail_sub1' => 'Fashion Expert',
                                        'mcsdetail_img' => '/' . __NAMESPACE__ . '/images/team/05.jpg',
                                        'mcsdetail_order' => 5,
                                    ],
                                    [
                                        'mcsdetail_mcslider_id' => Melis::FOREIGN_KEY,
                                        'mcsdetail_status' => 1,
                                        'mcsdetail_title' => 'Christine Bolian',
                                        'mcsdetail_sub1' => 'Press officer',
                                        'mcsdetail_img' => '/' . __NAMESPACE__ . '/images/team/06.jpg',
                                        'mcsdetail_order' => 6,
                                    ],
                                    [
                                        'mcsdetail_mcslider_id' => Melis::FOREIGN_KEY,
                                        'mcsdetail_status' => 1,
                                        'mcsdetail_title' => 'Michael Stans',
                                        'mcsdetail_sub1' => 'Model',
                                        'mcsdetail_img' => '/' . __NAMESPACE__ . '/images/team/07.jpg',
                                        'mcsdetail_order' => 7,
                                    ],
                                ]
                            ]
                        ],
                    ],
                    // </editor-fold>

                    // <editor-fold desc="CMS_GDPR_TEXTS">
                    Melis::CMS_GDPR_TEXTS => [
                        [
                            'mcgdpr_text_site_id' => 1,
                            'mcgdpr_text_lang_id' => 1,
                            'mcgdpr_text_value' => 'Our site uses cookies. By continuing to use our site you are agreeing to our Cookie Policy.',
                        ],
                        [
                            'mcgdpr_text_site_id' => 1,
                            'mcgdpr_text_lang_id' => 2,
                            'mcgdpr_text_value' => 'Notre site utilise des cookies. En poursuivant votre navigation sur notre site vous acceptez notre politique de cookies.',
                        ],
                    ],
                    // </editor-fold>
                ],
            ],
        ],
    ],
];
