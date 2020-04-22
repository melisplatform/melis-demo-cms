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
                        'hydrator' => \Laminas\Hydrator\ArraySerializable::class,
                        'elements' => [
                            [
                                'spec' => [
                                    'name' => 'scheme',
                                    'type' => \Laminas\Form\Element\Select::class,
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
                                    'type' => \Laminas\Form\Element\Text::class,
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
                                    'type' => \Laminas\Form\Element\Text::class,
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
                                                \Laminas\Validator\InArray::NOT_IN_ARRAY => 'tr_site_demo_cms_tool_site_scheme_invalid_selection',
                                            ],
                                        ],
                                    ],
                                    [
                                        'name' => 'NotEmpty',
                                        'options' => [
                                            'messages' => [
                                                \Laminas\Validator\NotEmpty::IS_EMPTY => 'tr_melis_installer_tool_site_scheme_error_empty',
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
                                                \Laminas\Validator\StringLength::TOO_LONG => 'tr_melis_installer_tool_site_domain_error_long',
                                            ],
                                        ],
                                    ],
                                    [
                                        'name' => 'NotEmpty',
                                        'options' => [
                                            'messages' => [
                                                \Laminas\Validator\NotEmpty::IS_EMPTY => 'tr_melis_installer_tool_site_domain_error_empty',
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
                                                \Laminas\Validator\StringLength::TOO_LONG => 'tr_site_demo_cms_tool_site_name_error_long',
                                            ],
                                        ],
                                    ],
                                    [
                                        'name' => 'NotEmpty',
                                        'options' => [
                                            'messages' => [
                                                \Laminas\Validator\NotEmpty::IS_EMPTY => 'tr_melis_installer_tool_site_name_error_empty',
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
                            'tpl_zf2_action' => 'serviceDetails',
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
                            'tpl_name' => 'Mixed Template',
                            'tpl_type' => 'ZF2',
                            'tpl_zf2_website_folder' => __NAMESPACE__,
                            'tpl_zf2_layout' => 'defaultLayout',
                            'tpl_zf2_controller' => 'Template',
                            'tpl_zf2_action' => 'mixedTemplate',
                            'tpl_creation_date' => date('Y-m-d H:i:s'),
                            Site::THEN => [Site::UPDATE_CURRENT_TEMPLATE_ID],
                        ],
                        [
                            Melis::PRIMARY_KEY => 'tpl_id',
                            'tpl_id' => Melis::CURRENT_TEMPLATE_ID,
                            'tpl_site_id' => Melis::CMS_SITE_ID,
                            'tpl_name' => 'Static Template',
                            'tpl_type' => 'ZF2',
                            'tpl_zf2_website_folder' => __NAMESPACE__,
                            'tpl_zf2_layout' => 'defaultLayout',
                            'tpl_zf2_controller' => 'Template',
                            'tpl_zf2_action' => 'staticTemplate',
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
                            'tpl_zf2_controller' => 'Template',
                            'tpl_zf2_action' => 'dragdrop',
                            'tpl_creation_date' => date('Y-m-d H:i:s'),
                            Site::THEN => [Site::UPDATE_CURRENT_TEMPLATE_ID],
                        ],
                        [
                            Melis::PRIMARY_KEY => 'tpl_id',
                            'tpl_id' => Melis::CURRENT_TEMPLATE_ID,
                            'tpl_site_id' => Melis::CMS_SITE_ID,
                            'tpl_name' => 'Drag n Drop 2 Zones',
                            'tpl_type' => 'ZF2',
                            'tpl_zf2_website_folder' => __NAMESPACE__,
                            'tpl_zf2_layout' => 'defaultLayout',
                            'tpl_zf2_controller' => 'Template',
                            'tpl_zf2_action' => 'dragdrop2zones',
                            'tpl_creation_date' => date('Y-m-d H:i:s'),
                            Site::THEN => [Site::UPDATE_CURRENT_TEMPLATE_ID],
                        ],
                        [
                            Melis::PRIMARY_KEY => 'tpl_id',
                            'tpl_id' => Melis::CURRENT_TEMPLATE_ID,
                            'tpl_site_id' => Melis::CMS_SITE_ID,
                            'tpl_name' => 'Centered Drag n Drop',
                            'tpl_type' => 'ZF2',
                            'tpl_zf2_website_folder' => __NAMESPACE__,
                            'tpl_zf2_layout' => 'defaultLayout',
                            'tpl_zf2_controller' => 'Template',
                            'tpl_zf2_action' => 'centeredDragdrop',
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
                            Site::THEN => [Site::UPDATE_CURRENT_PAGE_ID, Site::TRIGGER_EVENT => ['event_name' => 'melis_marketplace_site_intall_test', 'params' => ['page' => 'HomePage']]],
                            Melis::RELATION => [
                                Melis::CMS_PAGE_PUBLISHED => [
                                    [
                                        Melis::PRIMARY_KEY => 'page_id',
                                        'page_id' => Melis::FOREIGN_KEY,
                                        'page_type' => 'SITE',
                                        'page_status' => '1',
                                        'page_menu' => 'LINK',
                                        'page_name' => 'Melis Demo CMS',
                                        'page_tpl_id' => [Site::GET_TEMPLATE_ID => ['template_name' => 'Drag n Drop']],
                                        'page_content' => '<?xml version="1.0" encoding="UTF-8"?><document type="MelisCMS" author="MelisTechnology" version="2.0"><melisTag id="home-html-1" plugin_container_id="" type="html"><![CDATA[<section class="erp_banner_area_two"><ul class="list-unstyled cloud_animation"><li><img src="/MelisDemoCms/img/erp-home/cloud_01.png" alt="" /></li><li><img src="/MelisDemoCms/img/erp-home/cloud_02.png" alt="" /></li><li><img src="/MelisDemoCms/img/erp-home/cloud_03.png" alt="" /></li><li><img src="/MelisDemoCms/img/erp-home/cloud_04.png" alt="" /></li><li><img src="/MelisDemoCms/img/erp-home/cloud_05.png" alt="" /></li><li><img src="/MelisDemoCms/img/erp-home/cloud_06.png" alt="" /></li></ul><div class="erp_shap"></div><div class="erp_shap_two" style="background: url(\'/MelisDemoCms/img/erp-home/banner_shap.png\') no-repeat scroll top left;"></div><div class="section_intro"><div class="section_container"><div class="intro"><div class=" intro_content"><h1>Cloud ERP Software for Small and medium business</h1><p>A simple and powerful erp software for Manufacturing, Distribution and Services.</p><a href="#" class="er_btn er_btn_two">Try to Free</a></div></div></div></div><div class="animation_img wow fadeInUp" style="padding-top: 100px; visibility: visible; animation-delay: 0.3s; animation-name: fadeInUp;" data-wow-delay="0.3s"><div class="container"><img src="/MelisDemoCms/img/erp-home/erp_dashboard.jpg" alt="" /></div></div></section>]]></melisTag><melisTag id="home-html-2" plugin_container_id="" type="html"><![CDATA[<section class="erp_service_area sec_pad"><div class="container"><div class="hosting_title erp_title text-center"><h2>Accessible, Convenient &amp; Manageable</h2><p>The full monty burke posh excuse my French Richard cheeky bobby spiffing crikey<br />Why gormless, pear shaped.!</p></div></div></section>]]></melisTag><melisTag id="home-html-3" plugin_container_id="" type="html"><![CDATA[<section class="erp_service_area sec_pad"><div class="container"><div class="row"><div class="col-lg-4 col-sm-6 col-xs-12"><div class="erp_service_item pr_70"><img src="/MelisDemoCms/img/erp-home/erp_icon1.png" alt="" /><h3 class="h_head">Secured Cloud</h3><p>Bloke fantastic bubble and squeak do one what a plonker nancy boy burke fanny around.</p></div></div><div class="col-lg-4 col-sm-6"><div class="erp_service_item pr_70 pl_10"><img src="/MelisDemoCms/img/erp-home/erp_icon2.png" alt="" /><h3 class="h_head">Single Platform</h3><p>Bloke fantastic bubble and squeak do one what a plonker nancy boy burke fanny around.</p></div></div><div class="col-lg-4 col-sm-6"><div class="erp_service_item pl_70"><img src="/MelisDemoCms/img/erp-home/erp_icon3.png" alt="" /><h3 class="h_head">Implement Yourself</h3><p>Bloke fantastic bubble and squeak do one what a plonker nancy boy burke fanny around.</p></div></div><div class="col-lg-4 col-sm-6"><div class="erp_service_item pr_70"><img src="/MelisDemoCms/img/erp-home/erp_icon4.png" alt="" /><h3 class="h_head">Multi Regional</h3><p>Bloke fantastic bubble and squeak do one what a plonker nancy boy burke fanny around.</p></div></div><div class="col-lg-4 col-sm-6"><div class="erp_service_item pl_10"><img src="/MelisDemoCms/img/erp-home/erp_icon5.png" alt="" /><h3 class="h_head">Quick Navigations</h3><p>Bloke fantastic bubble and squeak do one what a plonker nancy boy burke fanny around.</p></div></div><div class="col-lg-4 col-sm-6"><div class="erp_service_item pl_70"><img src="/MelisDemoCms/img/erp-home/erp_icon6.png" alt="" /><h3 class="h_head">Works in Web</h3><p>Bloke fantastic bubble and squeak do one what a plonker nancy boy burke fanny around.</p></div></div></div></div></section>]]></melisTag><melisTag id="home-html-4" plugin_container_id="" type="html"><![CDATA[<section class="erp_action_area"><div class="container"><div class="row align-items-center"><div class="col-lg-3 col-md-4"><img src="/MelisDemoCms/img/erp-home/action_img.png" alt="" /></div><div class="col-lg-9 col-md-8"><div class="erp_content"><h2>Trusted by <strong>10,030+ Businesses</strong> over 160 Countries and 24+ Languages</h2></div></div></div></div></section>]]></melisTag><melisTag id="home-html-5" plugin_container_id="" type="html"><![CDATA[<section class="erp_features_area_two sec_pad"><div class="container"><div class="row erp_item_features align-items-center flex-row-reverse"><div class="col-lg-6"><div class="erp_features_img_two"><div class="img_icon"><span class="pluse_1"></span><span class="pluse_2"></span><i class="icon_lightbulb_alt"></i></div><img src="/MelisDemoCms/img/erp-home/crm_img1.jpg" alt="" /></div></div><div class="col-lg-6"><div class="erp_content_two"><div class="hosting_title erp_title"><h2>Nurture Your Customers Using Advanced CRM</h2><p>Cack brolly butty grub chancer smashing brilliant vagabond, chimney pot blower such a fibber ummm I\'m telling chinwag he lost his bottle.!</p></div><div class="media erp_item"><div class="icon"><i class="icon_menu-square_alt2"></i></div><div class="media-body"><h5>Everybody Gets a Dashboard</h5></div></div><div class="media erp_item"><div class="icon green"><i class="icon_ribbon_alt"></i></div><div class="media-body"><h5>Complete Leave Management</h5></div></div><a href="#" class="erp_btn_learn">Learn More<i class="arrow_right"></i></a></div></div></div></div></section>]]></melisTag><melisTag id="home-html-6" plugin_container_id="" type="html"><![CDATA[<section class="erp_features_area_two sec_pad"><div class="container"><div class="row erp_item_features align-items-center"><div class="col-lg-6"><div class="erp_features_img_two"><div class="img_icon red"><span class="pluse_1"></span><span class="pluse_2"></span><i class="icon_lightbulb_alt"></i></div><img src="/MelisDemoCms/img/erp-home/crm_img2.jpg" alt="" /></div></div><div class="col-lg-6"><div class="erp_content_two"><div class="hosting_title erp_title"><h2>Integrated Project Management System</h2><p>Cack brolly butty grub chancer smashing brilliant vagabond, chimney pot blower such a fibber ummm I\'m telling chinwag he lost his bottle.!</p></div><div class="media erp_item"><div class="icon blue"><i class="icon_menu-square_alt2"></i></div><div class="media-body"><h5>Everybody Gets a Dashboard</h5></div></div><div class="media erp_item"><div class="icon yellow"><i class="icon_ribbon_alt"></i></div><div class="media-body"><h5>Complete Leave Management</h5></div></div><a href="#" class="erp_btn_learn">Learn More<i class="arrow_right"></i></a></div></div></div></div></section>]]></melisTag><melisTag id="home-html-7" plugin_container_id="" type="html"><![CDATA[<section class="erp_service_area sec_pad"><div class="container"><div class="hosting_title erp_title text-center"><h2>Great companies that <span class="icon_heart"></span> SaasLand ERP</h2><p>Cack brolly butty grub chancer smashing brilliant vagabond, chimney pot blower such a fibber<br />ummm I\'m telling chinwag he lost his bottle nancy boy.</p></div></div></section>]]></melisTag><melisTag id="home-textarea-1" plugin_container_id="" type="textarea"><![CDATA[<h2>What our customers</h2><h2>say about SaasLand ERP</h2>]]></melisTag><melisTag id="tag-miniTpl_1579680085" plugin_container_id="" type="html"><![CDATA[<section class="erp_service_area sec_pad"><div class="container"><div class="hosting_title erp_title text-center"><h2>Accessible, Convenient &amp; Manageable</h2><p>The full monty burke posh excuse my French Richard cheeky bobby spiffing crikey<br />Why gormless, pear shaped.!</p></div></div></section>]]></melisTag><melisTag id="tag-miniTpl_1580207980" plugin_container_id="" type="html"><![CDATA[<section class="erp_service_area"><div class="container"><div class="hosting_title erp_title text-center"><h2>Accessible, Convenient &amp; Manageable</h2><p>The full monty burke posh excuse my French Richard cheeky bobby spiffing crikey<br />Why gormless, pear shaped.!</p></div></div></section>]]></melisTag><melisTag id="tag-miniTpl_1580282468" plugin_container_id="" type="html" width_desktop="99.57" width_tablet="0" width_mobile="0"><![CDATA[<section><div class="container"><div class="hosting_title erp_title text-center"><h2>Accessible, Convenient &amp; Manageable</h2><p>The full monty burke posh excuse my French Richard cheeky bobby spiffing crikey<br />Why gormless, pear shaped.!</p></div></div></section>]]></melisTag><melisTag id="tag-miniTpl_1579680097" plugin_container_id="" type="html"><![CDATA[<section class="erp_service_area sec_pad"><div class="container"><div class="row"><div class="col-lg-4 col-sm-6"><div class="erp_service_item pr_70"><img src="/MelisDemoCms/img/erp-home/erp_icon1.png" alt="" /><h3 class="h_head">Secured Cloud</h3><p>Bloke fantastic bubble and squeak do one what a plonker nancy boy burke fanny around.</p></div></div><div class="col-lg-4 col-sm-6"><div class="erp_service_item pr_70 pl_10"><img src="/MelisDemoCms/img/erp-home/erp_icon2.png" alt="" /><h3 class="h_head">Single Platform</h3><p>Bloke fantastic bubble and squeak do one what a plonker nancy boy burke fanny around.</p></div></div><div class="col-lg-4 col-sm-6"><div class="erp_service_item pl_70"><img src="/MelisDemoCms/img/erp-home/erp_icon3.png" alt="" /><h3 class="h_head">Implement Yourself</h3><p>Bloke fantastic bubble and squeak do one what a plonker nancy boy burke fanny around.</p></div></div><div class="col-lg-4 col-sm-6"><div class="erp_service_item pr_70"><img src="/MelisDemoCms/img/erp-home/erp_icon4.png" alt="" /><h3 class="h_head">Multi Regional</h3><p>Bloke fantastic bubble and squeak do one what a plonker nancy boy burke fanny around.</p></div></div><div class="col-lg-4 col-sm-6"><div class="erp_service_item pl_10"><img src="/MelisDemoCms/img/erp-home/erp_icon5.png" alt="" /><h3 class="h_head">Quick Navigations</h3><p>Bloke fantastic bubble and squeak do one what a plonker nancy boy burke fanny around.</p></div></div><div class="col-lg-4 col-sm-6"><div class="erp_service_item pl_70"><img src="/MelisDemoCms/img/erp-home/erp_icon6.png" alt="" /><h3 class="h_head">Works in Web</h3><p>Bloke fantastic bubble and squeak do one what a plonker nancy boy burke fanny around.</p></div></div></div></div></section>]]></melisTag><melisTag id="tag-miniTpl_1580282483" plugin_container_id="" type="html" width_desktop="100" width_tablet="100" width_mobile="100"><![CDATA[<section class="erp_service_area sec_pad" style="padding-top: 0px;"><div class="container"><div class="row"><div class="col-lg-4 col-sm-6"><div class="erp_service_item pr_70"><img src="/MelisDemoCms/img/erp-home/erp_icon1.png" alt="" /><h3 class="h_head">Secured Cloud</h3><p>Bloke fantastic bubble and squeak do one what a plonker nancy boy burke fanny around.</p></div></div><div class="col-lg-4 col-sm-6"><div class="erp_service_item pr_70 pl_10"><img src="/MelisDemoCms/img/erp-home/erp_icon2.png" alt="" /><h3 class="h_head">Single Platform</h3><p>Bloke fantastic bubble and squeak do one what a plonker nancy boy burke fanny around.</p></div></div><div class="col-lg-4 col-sm-6"><div class="erp_service_item pl_70"><img src="/MelisDemoCms/img/erp-home/erp_icon3.png" alt="" /><h3 class="h_head">Implement Yourself</h3><p>Bloke fantastic bubble and squeak do one what a plonker nancy boy burke fanny around.</p></div></div><div class="col-lg-4 col-sm-6"><div class="erp_service_item pr_70"><img src="/MelisDemoCms/img/erp-home/erp_icon4.png" alt="" /><h3 class="h_head">Multi Regional</h3><p>Bloke fantastic bubble and squeak do one what a plonker nancy boy burke fanny around.</p></div></div><div class="col-lg-4 col-sm-6"><div class="erp_service_item pl_10"><img src="/MelisDemoCms/img/erp-home/erp_icon5.png" alt="" /><h3 class="h_head">Quick Navigations</h3><p>Bloke fantastic bubble and squeak do one what a plonker nancy boy burke fanny around.</p></div></div><div class="col-lg-4 col-sm-6"><div class="erp_service_item pl_70"><img src="/MelisDemoCms/img/erp-home/erp_icon6.png" alt="" /><h3 class="h_head">Works in Web</h3><p>Bloke fantastic bubble and squeak do one what a plonker nancy boy burke fanny around.</p></div></div></div></div></section>]]></melisTag><melisTag id="tag-miniTpl_1580285470" plugin_container_id="" type="html" width_desktop="100" width_tablet="100" width_mobile="100"><![CDATA[<section><div class="container"><div class="hosting_title erp_title text-center"><h2>Great companies that <span class="icon_heart"></span> SaasLand ERP</h2><p>Cack brolly butty grub chancer smashing brilliant vagabond, chimney pot blower such a fibber<br />ummm I\'m telling chinwag he lost his bottle nancy boy.</p></div></div></section>]]></melisTag><melisTag id="tag-miniTpl_1580285493" plugin_container_id="" type="html" width_desktop="100" width_tablet="100" width_mobile="100"><![CDATA[<section><div class="container"><div class="hosting_title erp_title text-center"><h2>What our customers</h2><h2>say about SaasLand ERP</h2></div></div></section>]]></melisTag><melisTag id="tag-miniTpl_1580286188" plugin_container_id="" type="html"><![CDATA[<section class="erp_banner_area_two"><ul class="list-unstyled cloud_animation"><li><img src="/MelisDemoCms/img/erp-home/cloud_01.png" alt="" /></li><li><img src="/MelisDemoCms/img/erp-home/cloud_02.png" alt="" /></li><li><img src="/MelisDemoCms/img/erp-home/cloud_03.png" alt="" /></li><li><img src="/MelisDemoCms/img/erp-home/cloud_04.png" alt="" /></li><li><img src="/MelisDemoCms/img/erp-home/cloud_05.png" alt="" /></li><li><img src="/MelisDemoCms/img/erp-home/cloud_06.png" alt="" /></li></ul><div class="erp_shap"></div><div class="erp_shap_two" style="background: url(\'/MelisDemoCms/img/erp-home/banner_shap.png\') no-repeat scroll top left;"></div><div class="section_intro"><div class="section_container"><div class="intro"><div class=" intro_content"><h1>Melis Demo Cms</h1><p>A demo site to show you the possibilities of Melis Platform and a case study for developers to enter the ecosystem.</p><a href="#" class="er_btn er_btn_two">Try to Free</a></div></div></div></div><div class="animation_img wow fadeInUp" style="padding-top: 20px; visibility: visible; animation-delay: 0.3s; animation-name: fadeInUp;" data-wow-delay="0.3s"><div class="container"><img src="/MelisDemoCms/img/erp-home/erp_dashboard.jpg" alt="" /></div></div></section>]]></melisTag><melisTag id="tag-miniTpl_1582172633" plugin_container_id="" type="html" width_desktop="100" width_tablet="100" width_mobile="100"><![CDATA[<section class="erp_action_area"><div class="container"><div class="row align-items-center"><div class="col-lg-3 col-md-4"><img src="/MelisDemoCms/img/erp-home/action_img.png" alt="" /></div><div class="col-lg-9 col-md-8"><div class="erp_content"><h2>Trusted by <strong>10,030+ Businesses</strong> over 160 Countries and 24+ Languages</h2></div></div></div></div></section>]]></melisTag><melisTag id="tag-miniTpl_1582172666" plugin_container_id="" type="html" width_desktop="100" width_tablet="100" width_mobile="100"><![CDATA[<section class="erp_features_area_two sec_pad"><div class="container"><div class="row erp_item_features align-items-center flex-row-reverse"><div class="col-lg-6"><div class="erp_features_img_two"><div class="img_icon"><span class="pluse_1"></span><span class="pluse_2"></span><i class="icon_lightbulb_alt"></i></div><img src="/MelisDemoCms/img/erp-home/crm_img1.jpg" alt="" /></div></div><div class="col-lg-6"><div class="erp_content_two"><div class="hosting_title erp_title"><h2>Nurture Your Customers Using Advanced CRM</h2><p>Cack brolly butty grub chancer smashing brilliant vagabond, chimney pot blower such a fibber ummm I\'m telling chinwag he lost his bottle.!</p></div><div class="media erp_item"><div class="icon"><i class="icon_menu-square_alt2"></i></div><div class="media-body"><h5>Everybody Gets a Dashboard</h5></div></div><div class="media erp_item"><div class="icon green"><i class="icon_ribbon_alt"></i></div><div class="media-body"><h5>Complete Leave Management</h5></div></div><a href="#" class="erp_btn_learn">Learn More<i class="arrow_right"></i></a></div></div></div></div></section>]]></melisTag><melisTag id="tag-miniTpl_1582172703" plugin_container_id="" type="html" width_desktop="100" width_tablet="100" width_mobile="100"><![CDATA[<section class="erp_features_area_two sec_pad"><div class="container"><div class="row erp_item_features align-items-center"><div class="col-lg-6"><div class="erp_features_img_two"><div class="img_icon red"><span class="pluse_1"></span><span class="pluse_2"></span><i class="icon_lightbulb_alt"></i></div><img src="/MelisDemoCms/img/erp-home/crm_img2.jpg" alt="" /></div></div><div class="col-lg-6"><div class="erp_content_two"><div class="hosting_title erp_title"><h2>Integrated Project Management System</h2><p>Cack brolly butty grub chancer smashing brilliant vagabond, chimney pot blower such a fibber ummm I\'m telling chinwag he lost his bottle.!</p></div><div class="media erp_item"><div class="icon blue"><i class="icon_menu-square_alt2"></i></div><div class="media-body"><h5>Everybody Gets a Dashboard</h5></div></div><div class="media erp_item"><div class="icon yellow"><i class="icon_ribbon_alt"></i></div><div class="media-body"><h5>Complete Leave Management</h5></div></div><a href="#" class="erp_btn_learn">Learn More<i class="arrow_right"></i></a></div></div></div></div></section>]]></melisTag><melisDragDropZone id="dragdropzone_home_1" plugin_container_id="" width_desktop="100" width_tablet="100" width_mobile="100"><plugin module="MelisMiniTemplate" name="MiniTemplatePlugin_title-fullscreen_melisdemocms" id="tag-miniTpl_1580286188"/><plugin module="meliscmsslider" name="MelisCmsSliderShowSliderPlugin" id="showslider_1579680060"/><plugin module="MelisMiniTemplate" name="MiniTemplatePlugin_title-subtitle-centered_melisdemocms" id="tag-miniTpl_1580282468"/><plugin module="MelisMiniTemplate" name="MiniTemplatePlugin_3-cols-2-lines_melisdemocms" id="tag-miniTpl_1580282483"/><plugin module="MelisMiniTemplate" name="MiniTemplatePlugin_blue-banner-text_melisdemocms" id="tag-miniTpl_1582172633"/><plugin module="MelisMiniTemplate" name="MiniTemplatePlugin_2-cols-left-text-right-image_melisdemocms" id="tag-miniTpl_1582172666"/><plugin module="MelisMiniTemplate" name="MiniTemplatePlugin_2-cols-right-text-left-image_melisdemocms" id="tag-miniTpl_1582172703"/><plugin module="MelisMiniTemplate" name="MiniTemplatePlugin_title-subtitle-centered_melisdemocms" id="tag-miniTpl_1580285470"/><plugin module="meliscmsslider" name="MelisCmsSliderShowSliderPlugin" id="showslider_1579680197"/><plugin module="MelisMiniTemplate" name="MiniTemplatePlugin_title-subtitle-centered_melisdemocms" id="tag-miniTpl_1580285493"/><plugin module="melisfront" name="MelisFrontShowListFromFolderPlugin" id="show-list-from-folder_1579680281"/><plugin module="melisfront" name="MelisFrontGdprBannerPlugin" id="MelisFrontGdprBanner_1579680320"/></melisDragDropZone><melisCmsSlider id="showslider_1579680060" plugin_container_id="" width_desktop="100" width_tablet="100" width_mobile="100"><template_path><![CDATA[MelisDemoCms/plugins/home-carousel-slider]]></template_path><sliderId><![CDATA[1]]></sliderId></melisCmsSlider><melisCmsSlider id="showslider_1579680197" plugin_container_id="" width_desktop="100" width_tablet="100" width_mobile="100"><template_path><![CDATA[MelisDemoCms/plugins/home-slider2]]></template_path><sliderId><![CDATA[2]]></sliderId></melisCmsSlider><MelisFrontShowListFromFolderPlugin id="show-list-from-folder_1579680281" plugin_container_id="" width_desktop="100" width_tablet="100" width_mobile="100"><template_path><![CDATA[MelisDemoCms/plugins/home-testimonial-slider]]></template_path><pageIdFolder><![CDATA[27]]></pageIdFolder></MelisFrontShowListFromFolderPlugin><MelisFrontGdprBanner id="MelisFrontGdprBanner_1579680320" plugin_container_id="" width_desktop="100" width_tablet="100" width_mobile="100"/></document>',
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
                        ],
                        // </Home>

                        // <News>
                        [
                            // News Page
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
                                        'page_name' => 'News',
                                        'page_tpl_id' => [Site::GET_TEMPLATE_ID => ['template_name' => 'News']],
                                        'page_content' => '<?xml version="1.0" encoding="UTF-8"?><document type="MelisCMS" author="MelisTechnology" version="2.0"><melisTag id="news-html-1" plugin_container_id="" type="html"><![CDATA[<div class="breadcrumb_content text-center"><h1 class="f_p f_700 f_size_50 w_color l_height50 mb_20">News</h1><p class="f_400 w_color f_size_16 l_height26">Why I say old chap that is spiffing off his nut arse pear shaped plastered<br />Jeffrey bodge barney some dodgy hehe.!!</p></div>]]></melisTag><melisTag id="tag-miniTpl_1580199681" plugin_container_id="" type="html"><![CDATA[<section class="breadcrumb_area" style="z-index: unset !important;"><div class="container"><div class="breadcrumb_content text-center"><h1 class="f_p f_700 f_size_50 w_color l_height50 mb_20">News list: using the tool and plugin</h1><p class="f_400 w_color f_size_16 l_height26">This page shows the news plugin, working together with the News Tool accessible from the left menu of the platform.<br />It is voluntarily static so that developpers can look in the template how to call the plugin manually, how to configure it and make defaults values.</p></div></div></section>]]></melisTag><melisDragDropZone id="dragdropzone_news_1" plugin_container_id="" width_desktop="100" width_tablet="100" width_mobile="100"><plugin module="MelisMiniTemplate" name="MiniTemplatePlugin_title-subtitle-centered-with-background-purple_melisdemocms" id="tag-miniTpl_1580199681"/></melisDragDropZone></document>',
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
                                        Site::THEN => [Site::UPDATE_CURRENT_PAGE_ID],
                                        Melis::RELATION => [
                                            Melis::CMS_PAGE_PUBLISHED => [
                                                [
                                                    Melis::PRIMARY_KEY => 'page_id',
                                                    'page_id' => Melis::FOREIGN_KEY,
                                                    'page_type' => 'NEWS_DETAIL',
                                                    'page_status' => '1',
                                                    'page_menu' => 'NONE',
                                                    'page_name' => 'News Details',
                                                    'page_tpl_id' => [Site::GET_TEMPLATE_ID => ['template_name' => 'News Details']],
                                                    'page_content' => '<?xml version="1.0" encoding="UTF-8"?><document type="MelisCMS" author="MelisTechnology" version="2.0"><melisTag id="newsd-html-1" plugin_container_id="" type="html"><![CDATA[<div class="breadcrumb_content text-center"><h1 class="f_p f_700 f_size_50 w_color l_height50 mb_20">News Details</h1><p class="f_400 w_color f_size_16 l_height26">Why I say old chap that is spiffing off his nut arse pear shaped plastered<br />Jeffrey bodge barney some dodgy.!!</p></div>]]></melisTag><melisTag id="tag-miniTpl_1580199720" plugin_container_id="" type="html"><![CDATA[<section class="breadcrumb_area" style="z-index: unset !important;"><div class="container"><div class="breadcrumb_content text-center"><h1 class="f_p f_700 f_size_50 w_color l_height50 mb_20">News details: using the tool and plugin</h1><p class="f_400 w_color f_size_16 l_height26">This page shows the news details plugin, working together with the News Tool accessible from the left menu of the platform.<br />It is voluntarily static so that developpers can look in the template how to call the plugin manually, how to configure it and make defaults values.</p></div></div></section>]]></melisTag><melisDragDropZone id="dragdropzone_news_details_1" plugin_container_id="" width_desktop="100" width_tablet="100" width_mobile="100"><plugin module="MelisMiniTemplate" name="MiniTemplatePlugin_title-subtitle-centered-with-background-purple_melisdemocms" id="tag-miniTpl_1580199720"/></melisDragDropZone></document>',

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
                                    ]
                                ]
                                // </NewsDetails>
                            ],
                        ],
                        // </News>

                        // <Team>
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
                                        'page_menu' => 'LINK',
                                        'page_name' => 'Team',
                                        'page_tpl_id' => [Site::GET_TEMPLATE_ID => ['template_name' => 'Team']],
                                        'page_content' => '<?xml version="1.0" encoding="UTF-8"?><document type="MelisCMS" author="MelisTechnology" version="2.0"><melisTag id="team-html-1" plugin_container_id="" type="html"><![CDATA[<div class="hosting_title erp_title text-center"><h1 class="f_p f_700 f_size_50 w_color l_height50 mb_20">Meet The Team</h1><p class="f_400 w_color f_size_16 l_height26">Why I say old chap that is spiffing off his nut arse pear shaped plastered<br />Jeffrey bodge barney some dodgy.!!</p></div>]]></melisTag><melisTag id="team-html-2" plugin_container_id="" type="html"><![CDATA[<div class="hosting_title erp_title text-center"><h2>The Experts Team</h2><p>Why I say old chap that is spiffing barney, nancy boy bleeder chimney<br />pot richard cheers the little rotter.!</p></div>]]></melisTag><melisTag id="tag-miniTpl_1580199754" plugin_container_id="" type="html"><![CDATA[<section class="breadcrumb_area" style="z-index: unset !important;"><div class="container"><div class="breadcrumb_content text-center"><h1 class="f_p f_700 f_size_50 w_color l_height50 mb_20">Meet The Team</h1><p class="f_400 w_color f_size_16 l_height26">This page shows an example of the Slider Plugin, going along the Slider Tool accessible in the left manu of the platform.<br />It is voluntarily static so that developpers can look in the template how to call the plugin manually, how to configure it and make defaults values.<br /><br />A drag\'n\'drop zone is present at the bottom, so that users can still add more contents into the page after the slider.<br /><br /></p></div></div></section>]]></melisTag><melisDragDropZone id="dragdropzone_team_1" plugin_container_id="" width_desktop="100" width_tablet="100" width_mobile="100"><plugin module="MelisMiniTemplate" name="MiniTemplatePlugin_title-subtitle-centered-with-background-purple_melisdemocms" id="tag-miniTpl_1580199754"/></melisDragDropZone></document>',

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
                        // </Team>

                        // <OurServices>
                        [
                            Melis::PRIMARY_KEY => 'tree_page_id',
                            'tree_page_id' => Melis::CURRENT_PAGE_ID,
                            'tree_father_page_id' => Melis::CMS_SITE_ID,
                            'tree_page_order' => 4,
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
                                        'page_tpl_id' => [Site::GET_TEMPLATE_ID => ['template_name' => 'Drag n Drop']],
                                        'page_content' => '<?xml version="1.0" encoding="UTF-8"?><document type="MelisCMS" author="MelisTechnology" version="2.0"><melisTag id="srv-html-1" plugin_container_id="" type="html"><![CDATA[<div class="hosting_title erp_title text-center"><h2>How We Work</h2><p>The full monty burke posh excuse my French Richard cheeky bobby spiffing crikey<br />Why gormless, pear shaped.!</p></div>]]></melisTag><melisTag id="3-cols-in-blocks" plugin_container_id="" type="html"><![CDATA[<section class="app_service_area app_service_area_two"><div class="container"><div class="row app_service_info"><div class="col-lg-4 col-sm-6"><div class="app_service_item"><i class="ti-settings app_icon one"></i><h5 class="f_p f_size_18 f_600 t_color3 mt_40 mb-30">Premium plugins</h5><p class="f_400 f_size_15 mb-30">Oxford jolly good cras bugger down the pub blow off well arse tinkety tonk old fruit William bite your arm off haggle, old it\'s all gone to pot daft no biggie bog.!</p><a href="/our-services/premium-plugins/id/7" class="learn_btn_two c_violet">Learn More <i class="ti-arrow-right"></i></a></div></div><div class="col-lg-4 col-sm-6"><div class="app_service_item"><i class="ti-heart-broken app_icon two"></i><h5 class="f_p f_size_18 f_600 t_color3 mt_40 mb-30">Unique elements</h5><p class="f_400 f_size_15 mb-30">Oxford jolly good cras bugger down the pub blow off well arse tinkety tonk old fruit William bite your arm off haggle, old it\'s all gone to pot daft no biggie bog.!</p><a href="/our-services/unique-elements/id/8" class="learn_btn_two c_violet">Learn More <i class="ti-arrow-right"></i></a></div></div><div class="col-lg-4 col-sm-6"><div class="app_service_item"><i class="ti-target app_icon three"></i><h5 class="f_p f_size_18 f_600 t_color3 mt_40 mb-30">Live page builder</h5><p class="f_400 f_size_15 mb-30">Oxford jolly good cras bugger down the pub blow off well arse tinkety tonk old fruit William bite your arm off haggle, old it\'s all gone to pot daft no biggie bog.!</p><a href="/our-services/live-page-builder/id/9" class="learn_btn_two c_violet">Learn More <i class="ti-arrow-right"></i></a></div></div></div></div></section>]]></melisTag><melisTag id="2-cols-left-text-right-image" plugin_container_id="" type="html"><![CDATA[<section class="erp_features_area_two sec_pad"><div class="container"><div class="row erp_item_features align-items-center flex-row-reverse"><div class="col-lg-6"><div class="erp_features_img_two"><div class="img_icon"><span class="pluse_1"></span><span class="pluse_2"></span><i class="icon_lightbulb_alt"></i></div><img src="/MelisDemoCms/img/erp-home/crm_img1.jpg" alt="" /></div></div><div class="col-lg-6"><div class="erp_content_two"><div class="hosting_title erp_title"><h2 class="f_p f_600 f_size_30 t_color3 l_height40 mb-30">Predictive and imperative approach towards software.</h2><p class="f_400 mb_50">Why I say old chap that is spiffing pukka, bamboozled wind up bugger buggered zonked hanky panky a blinding shot the little rotter, bubble and squeak vagabond cheeky.!</p><br /><ul class="list-unstyled mb-30 pl-0 pr_20"><li><i class="ti-check"></i>&nbsp;Only a quid I dropped a clanger matie boy excuse my French hanky.</li><li><i class="ti-check"></i>&nbsp;Panky pardon you me old mucker bum bag, bevvy bloke it\'s all gone to pot.</li><li><i class="ti-check"></i>&nbsp;Ummm I\'m telling bits and bobs mush baking cakes car boot.</li></ul></div></div></div></div></div></section>]]></melisTag><melisTag id="2-cols-right-text-left-image" plugin_container_id="" type="html"><![CDATA[<section class="erp_features_area_two sec_pad"><div class="container"><div class="row erp_item_features align-items-center"><div class="col-lg-6"><div class="erp_features_img_two"><div class="img_icon red"><span class="pluse_1"></span><span class="pluse_2"></span><i class="icon_lightbulb_alt"></i></div><img src="/MelisDemoCms/img/erp-home/crm_img2.jpg" alt="" /></div></div><div class="col-lg-6"><div class="erp_content_two"><div class="hosting_title erp_title"><h2 class="f_p f_600 f_size_30 t_color3 l_height40 mb-30">Social intranet software<br />that drives employee<br />engagement and<br />productivity.</h2><p class="f_400 mb_40">Why I say old chap that is spiffing pukka, bamboozled wind up bugger buggered zonked hanky panky a blinding shot the little rotter, bubble and squeak vagabond cheeky.!</p></div><a href="#" class="erp_btn_learn">View More About<i class="arrow_right"></i></a></div></div></div></div></section>]]></melisTag><melisTag id="tag-miniTpl_1580368784" plugin_container_id="" type="html"><![CDATA[<section class="app_service_area app_service_area_two"><div class="container"><div class="row app_service_info"><div class="col-lg-4 col-sm-6"><div class="app_service_item"><i class="ti-settings app_icon one"></i><h5 class="f_p f_size_18 f_600 t_color3 mt_40 mb-30">Premium plugins</h5><p class="f_400 f_size_15 mb-30">Oxford jolly good cras bugger down the pub blow off well arse tinkety tonk old fruit William bite your arm off haggle, old it\'s all gone to pot daft no biggie bog.!</p><a href="/our-services/premium-plugins/id/6" class="learn_btn_two c_violet">Learn More <i class="ti-arrow-right"></i></a></div></div><div class="col-lg-4 col-sm-6"><div class="app_service_item"><i class="ti-heart-broken app_icon two"></i><h5 class="f_p f_size_18 f_600 t_color3 mt_40 mb-30">Unique elements</h5><p class="f_400 f_size_15 mb-30">Oxford jolly good cras bugger down the pub blow off well arse tinkety tonk old fruit William bite your arm off haggle, old it\'s all gone to pot daft no biggie bog.!</p><a href="/our-services/unique-elements/id/7" class="learn_btn_two c_violet">Learn More <i class="ti-arrow-right"></i></a></div></div><div class="col-lg-4 col-sm-6"><div class="app_service_item"><i class="ti-target app_icon three"></i><h5 class="f_p f_size_18 f_600 t_color3 mt_40 mb-30">Live page builder</h5><p class="f_400 f_size_15 mb-30">Oxford jolly good cras bugger down the pub blow off well arse tinkety tonk old fruit William bite your arm off haggle, old it\'s all gone to pot daft no biggie bog.!</p><a href="/our-services/live-page-builder/id/8" class="learn_btn_two c_violet">Learn More <i class="ti-arrow-right"></i></a></div></div></div></div></section>]]></melisTag><melisTag id="tag-miniTpl_1580368794" plugin_container_id="" type="html" width_desktop="99.57" width_tablet="0" width_mobile="0"><![CDATA[<section class="erp_features_area_two sec_pad"><div class="container"><div class="row erp_item_features align-items-center flex-row-reverse"><div class="col-lg-6"><div class="erp_features_img_two"><div class="img_icon"><span class="pluse_1"></span><span class="pluse_2"></span><i class="icon_lightbulb_alt"></i></div><img src="/MelisDemoCms/img/erp-home/crm_img1.jpg" alt="" /></div></div><div class="col-lg-6"><div class="erp_content_two"><div class="hosting_title erp_title"><h2>Nurture Your Customers Using Advanced CRM</h2><p>Cack brolly butty grub chancer smashing brilliant vagabond, chimney pot blower such a fibber ummm I\'m telling chinwag he lost his bottle.!</p></div><div class="media erp_item"><div class="icon"><i class="icon_menu-square_alt2"></i></div><div class="media-body"><h5>Everybody Gets a Dashboard</h5></div></div><div class="media erp_item"><div class="icon green"><i class="icon_ribbon_alt"></i></div><div class="media-body"><h5>Complete Leave Management</h5></div></div><a href="#" class="erp_btn_learn">Learn More<i class="arrow_right"></i></a></div></div></div></div></section>]]></melisTag><melisTag id="tag-miniTpl_1580368803" plugin_container_id="" type="html" width_desktop="99.57" width_tablet="0" width_mobile="0"><![CDATA[<section class="erp_features_area_two sec_pad"><div class="container"><div class="row erp_item_features align-items-center"><div class="col-lg-6"><div class="erp_features_img_two"><div class="img_icon red"><span class="pluse_1"></span><span class="pluse_2"></span><i class="icon_lightbulb_alt"></i></div><img src="/MelisDemoCms/img/erp-home/crm_img2.jpg" alt="" /></div></div><div class="col-lg-6"><div class="erp_content_two"><div class="hosting_title erp_title"><h2>Integrated Project Management System</h2><p>Cack brolly butty grub chancer smashing brilliant vagabond, chimney pot blower such a fibber ummm I\'m telling chinwag he lost his bottle.!</p></div><div class="media erp_item"><div class="icon blue"><i class="icon_menu-square_alt2"></i></div><div class="media-body"><h5>Everybody Gets a Dashboard</h5></div></div><div class="media erp_item"><div class="icon yellow"><i class="icon_ribbon_alt"></i></div><div class="media-body"><h5>Complete Leave Management</h5></div></div><a href="#" class="erp_btn_learn">Learn More<i class="arrow_right"></i></a></div></div></div></div></section>]]></melisTag><melisTag id="tag-miniTpl_1580725348" plugin_container_id="" type="html"><![CDATA[<section class="breadcrumb_area" style="z-index: unset !important;"><div class="container"><div class="breadcrumb_content text-center"><h1 class="f_p f_700 f_size_50 w_color l_height50 mb_20">Our services: templating plugins implementation</h1><p class="f_400 w_color f_size_16 l_height26">This page\'s goal is to show up how users can beneficiate from implementing mini-templates plugins that they can drag\'n\'drop.<br />Mini-templates are essentials to make users autonomous and help them not having to take care of HTML.</p></div></div></section>]]></melisTag><melisDragDropZone id="dragdropzone_home_1" plugin_container_id="" width_desktop="100" width_tablet="100" width_mobile="100"><plugin module="MelisMiniTemplate" name="MiniTemplatePlugin_title-subtitle-centered-with-background-purple_melisdemocms" id="tag-miniTpl_1580725348"/><plugin module="MelisMiniTemplate" name="MiniTemplatePlugin_3-cols-in-blocks_melisdemocms" id="tag-miniTpl_1580368784"/><plugin module="MelisMiniTemplate" name="MiniTemplatePlugin_2-cols-left-text-right-image_melisdemocms" id="tag-miniTpl_1580368794"/><plugin module="MelisMiniTemplate" name="MiniTemplatePlugin_2-cols-right-text-left-image_melisdemocms" id="tag-miniTpl_1580368803"/></melisDragDropZone></document>',
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
                                        Site::THEN => [Site::UPDATE_CURRENT_PAGE_ID],
                                        Melis::RELATION => [
                                            Melis::CMS_PAGE_PUBLISHED => [
                                                [
                                                    Melis::PRIMARY_KEY => 'page_id',
                                                    'page_id' => Melis::FOREIGN_KEY,
                                                    'page_type' => 'PAGE',
                                                    'page_status' => '1',
                                                    'page_menu' => 'LINK',
                                                    'page_name' => 'Premium plugins',
                                                    'page_tpl_id' => [Site::GET_TEMPLATE_ID => ['template_name' => 'Centered Drag n Drop']],
                                                    'page_content' => '<?xml version="1.0" encoding="UTF-8"?><document type="MelisCMS" author="MelisTechnology" version="2.0"><melisTag id="srvd-html-2" plugin_container_id="" type="html"><![CDATA[<p class="f_400 f_size_15">He lost his bottle a load of old tosh cup of tea brolly bog-standard matie boy blow off the little rotter morish, haggle hotpot skive off cuppa don\'t get shirty with me off his nut the full monty. Starkers morish down the pub such a fibber quaint gosh Harry boot owt to do with me the little rotter, baking cakes Eaton ummm I\'m telling pardon me the bee\'s knees vagabond Oxford chap, A bit of how\'s your father bog-standard hanky panky daft well lavatory bubble and squeak the full monty. That say nice one grub cup of tea so I said barmy only a quid, I it\'s your round gutted mate cup of char golly gosh dropped a clanger my good sir, James Bond happy days brilliant blimey I is. Boot Jeffrey cockup the BBC pardon me victoria sponge Why chip shop what a load of rubbish pukka brolly cuppa tickety-boo bog-standard cheesed off posh, bugger Eaton William smashing knackered bog bonnet bobby bender cobblers only a quid baking cakes the full monty pardon you.</p><p class="f_400 f_size_15">Twit bonnet Jeffrey hunky-dory gormless chancer bog-standard spiffing good time, young delinquent Charles don\'t get shirty with me the BBC is brown bread off his nut a load of old tosh, chap grub bog skive off pardon me bleeder. Lavatory on your bike mate happy days the little rotter arse over tit no biggie at public school wind up car boot bamboozled well barmy bleeder the wireless bugger, cockup blatant David it\'s all gone to pot morish mush sloshed boot A bit of how\'s your father skive off cheers a load of old tosh. No biggie mush I don\'t want no agro it\'s your round cack boot say, the full monty mufty such a fibber up the duff Why, Eaton pardon me spiffing blower brown bread.</p>]]></melisTag><melisTag id="servd-html-3" plugin_container_id="" type="html"><![CDATA[<div class="info_item"><h6>Owner:</h6><p>Droit Theme</p></div><div class="info_item"><h6>Live Time:</h6><p>2 Working Days</p></div><div class="info_item"><h6>Service Cost:</h6><p>$250.00</p></div><div class="info_item"><h6>Quality:</h6><p>High</p></div><div class="info_item"><h6>Experience</h6><p>3 Years</p></div>]]></melisTag><melisTag id="srvd-textarea1" plugin_container_id="" type="textarea"><![CDATA[Unique Elements]]></melisTag><melisTag id="srvd-html-1" plugin_container_id="" type="html"><![CDATA[<div class="breadcrumb_content text-center"><h1 class="f_p f_700 f_size_50 w_color l_height50 mb_20">Services Details</h1><p class="f_400 w_color f_size_16 l_height26">Why I say old chap that is spiffing off his nut arse pear shaped plastered<br />Jeffrey bodge barney some dodgy.!!</p></div>]]></melisTag><melisTag id="tag-miniTpl_1580368961" plugin_container_id="" type="html"><![CDATA[<section class="breadcrumb_area" style="z-index: unset !important;"><div class="container"><div class="breadcrumb_content text-center"><h1 class="f_p f_700 f_size_50 w_color l_height50 mb_20">Premium services: templating plugins implementation</h1><p class="f_400 w_color f_size_16 l_height26">This page\'s goal is to show up how users can beneficiate from implementing mini-templates plugins that they can drag\'n\'drop.<br />Mini-templates are essentials to make users autonomous and help them not having to take care of HTML.</p></div></div></section>]]></melisTag><melisTag id="tag-miniTpl_1580368984" plugin_container_id="" type="html" width_desktop="44.31" width_tablet="0" width_mobile="0"><![CDATA[<div class="pr_70"><div class="job_info"><div class="info_head"><i class="ti-receipt"></i><h6 class="f_p f_600 f_size_18 t_color3">Unique Elements</h6></div><div class="info_item"><h6>Owner:</h6><p>Droit Theme</p></div><div class="info_item"><h6>Live Time:</h6><p>2 Working Days</p></div><div class="info_item"><h6>Service Cost:</h6><p>$250.00</p></div><div class="info_item"><h6>Quality:</h6><p>High</p></div><div class="info_item"><h6>Experience</h6><p>3 Years</p></div></div></div>]]></melisTag><melisTag id="tag01_1580369023" plugin_container_id="" type="html" width_desktop="54.79" width_tablet="0" width_mobile="0"><![CDATA[<p>He lost his bottle a load of old tosh cup of tea brolly bog-standard matie boy blow off the little rotter morish, haggle hotpot skive off cuppa don\'t get shirty with me off his nut the full monty. Starkers morish down the pub such a fibber quaint gosh Harry boot owt to do with me the little rotter, baking cakes Eaton ummm I\'m telling pardon me the bee\'s knees vagabond Oxford chap, A bit of how\'s your father bog-standard hanky panky daft well lavatory bubble and squeak the full monty. That say nice one grub cup of tea so I said barmy only a quid, I it\'s your round gutted mate cup of char golly gosh dropped a clanger my good sir, James Bond happy days brilliant blimey I is. Boot Jeffrey cockup the BBC pardon me victoria sponge Why chip shop what a load of rubbish pukka brolly cuppa tickety-boo bog-standard cheesed off posh, bugger Eaton William smashing knackered bog bonnet bobby bender cobblers only a quid baking cakes the full monty pardon you.</p><p>Twit bonnet Jeffrey hunky-dory gormless chancer bog-standard spiffing good time, young delinquent Charles don\'t get shirty with me the BBC is brown bread off his nut a load of old tosh, chap grub bog skive off pardon me bleeder. Lavatory on your bike mate happy days the little rotter arse over tit no biggie at public school wind up car boot bamboozled well barmy bleeder the wireless bugger, cockup blatant David it\'s all gone to pot morish mush sloshed boot A bit of how\'s your father skive off cheers a load of old tosh. No biggie mush I don\'t want no agro it\'s your round cack boot say, the full monty mufty such a fibber up the duff Why, Eaton pardon me spiffing blower brown bread.</p><p><span>&nbsp;</span></p>]]></melisTag><melisDragDropZone id="centered_dragdrop_html_1" plugin_container_id="" width_desktop="100" width_tablet="100" width_mobile="100"><plugin module="MelisMiniTemplate" name="MiniTemplatePlugin_title-subtitle-centered-with-background-purple_melisdemocms" id="tag-miniTpl_1580368961"/><plugin module="melisfront" name="MelisFrontBlockSectionPlugin" id="1580369011"/></melisDragDropZone><melisDragDropZone id="centered_dragdrop_html_2" plugin_container_id="" width_desktop="100" width_tablet="100" width_mobile="100"><plugin module="MelisMiniTemplate" name="MiniTemplatePlugin_1-col-service-detail_melisdemocms" id="tag-miniTpl_1580368984"/><plugin module="melisfront" name="MelisFrontTagHtmlPlugin" id="tag01_1580369023"/></melisDragDropZone><melisFrontBlockSectionPlugin id="1580369011" plugin_container_id="" width_desktop="100" width_tablet="100" width_mobile="100"></melisFrontBlockSectionPlugin></document>',

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
                                    // </ServiceDetails1>
                                    // <ServiceDetails2>
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
                                                    'page_name' => 'Unique elements',
                                                    'page_tpl_id' => [Site::GET_TEMPLATE_ID => ['template_name' => 'Centered Drag n Drop']],
                                                    'page_content' => '<?xml version="1.0" encoding="UTF-8"?><document type="MelisCMS" author="MelisTechnology" version="2.0"><melisTag id="srvd-textarea1" plugin_container_id="" type="textarea"><![CDATA[Unique Elements]]></melisTag><melisTag id="servd-html-3" plugin_container_id="" type="html"><![CDATA[<div class="info_item"><h6>Owner:</h6><p>Droit Theme</p></div><div class="info_item"><h6>Live Time:</h6><p>2 Working Days</p></div><div class="info_item"><h6>Service Cost:</h6><p>$250.00</p></div><div class="info_item"><h6>Quality:</h6><p>High</p></div><div class="info_item"><h6>Experience</h6><p>3 Years</p></div>]]></melisTag><melisTag id="srvd-html-2" plugin_container_id="" type="html"><![CDATA[<p class="f_400 f_size_15">He lost his bottle a load of old tosh cup of tea brolly bog-standard matie boy blow off the little rotter morish, haggle hotpot skive off cuppa don\'t get shirty with me off his nut the full monty. Starkers morish down the pub such a fibber quaint gosh Harry boot owt to do with me the little rotter, baking cakes Eaton ummm I\'m telling pardon me the bee\'s knees vagabond Oxford chap, A bit of how\'s your father bog-standard hanky panky daft well lavatory bubble and squeak the full monty. That say nice one grub cup of tea so I said barmy only a quid, I it\'s your round gutted mate cup of char golly gosh dropped a clanger my good sir, James Bond happy days brilliant blimey I is. Boot Jeffrey cockup the BBC pardon me victoria sponge Why chip shop what a load of rubbish pukka brolly cuppa tickety-boo bog-standard cheesed off posh, bugger Eaton William smashing knackered bog bonnet bobby bender cobblers only a quid baking cakes the full monty pardon you.</p><p class="f_400 f_size_15">Twit bonnet Jeffrey hunky-dory gormless chancer bog-standard spiffing good time, young delinquent Charles don\'t get shirty with me the BBC is brown bread off his nut a load of old tosh, chap grub bog skive off pardon me bleeder. Lavatory on your bike mate happy days the little rotter arse over tit no biggie at public school wind up car boot bamboozled well barmy bleeder the wireless bugger, cockup blatant David it\'s all gone to pot morish mush sloshed boot A bit of how\'s your father skive off cheers a load of old tosh. No biggie mush I don\'t want no agro it\'s your round cack boot say, the full monty mufty such a fibber up the duff Why, Eaton pardon me spiffing blower brown bread.</p>]]></melisTag><melisTag id="srvd-html-1" plugin_container_id="" type="html"><![CDATA[<div class="breadcrumb_content text-center"><h1 class="f_p f_700 f_size_50 w_color l_height50 mb_20">Services Details</h1><p class="f_400 w_color f_size_16 l_height26">Why I say old chap that is spiffing off his nut arse pear shaped plastered<br />Jeffrey bodge barney some dodgy.!!</p></div>]]></melisTag><melisTag id="tag-miniTpl_1580369157" plugin_container_id="" type="html"><![CDATA[<section class="breadcrumb_area" style="z-index: unset !important;"><div class="container"><div class="breadcrumb_content text-center"><h1 class="f_p f_700 f_size_50 w_color l_height50 mb_20">Unique elements: templating plugins implementation</h1><p class="f_400 w_color f_size_16 l_height26">This page\'s goal is to show up how users can beneficiate from implementing mini-templates plugins that they can drag\'n\'drop.<br />Mini-templates are essentials to make users autonomous and help them not having to take care of HTML.</p></div></div></section>]]></melisTag><melisTag id="tag-miniTpl_1580369178" plugin_container_id="" type="html" width_desktop="43.15" width_tablet="0" width_mobile="0"><![CDATA[<div class="pr_70"><div class="job_info"><div class="info_head"><i class="ti-receipt"></i><h6 class="f_p f_600 f_size_18 t_color3">Unique Elements</h6></div><div class="info_item"><h6>Owner:</h6><p>Droit Theme</p></div><div class="info_item"><h6>Live Time:</h6><p>2 Working Days</p></div><div class="info_item"><h6>Service Cost:</h6><p>$250.00</p></div><div class="info_item"><h6>Quality:</h6><p>High</p></div><div class="info_item"><h6>Experience</h6><p>3 Years</p></div></div></div>]]></melisTag><melisTag id="tag01_1580369198" plugin_container_id="" type="html" width_desktop="55.98" width_tablet="0" width_mobile="0"><![CDATA[<p>He lost his bottle a load of old tosh cup of tea brolly bog-standard matie boy blow off the little rotter morish, haggle hotpot skive off cuppa don\'t get shirty with me off his nut the full monty. Starkers morish down the pub such a fibber quaint gosh Harry boot owt to do with me the little rotter, baking cakes Eaton ummm I\'m telling pardon me the bee\'s knees vagabond Oxford chap, A bit of how\'s your father bog-standard hanky panky daft well lavatory bubble and squeak the full monty. That say nice one grub cup of tea so I said barmy only a quid, I it\'s your round gutted mate cup of char golly gosh dropped a clanger my good sir, James Bond happy days brilliant blimey I is. Boot Jeffrey cockup the BBC pardon me victoria sponge Why chip shop what a load of rubbish pukka brolly cuppa tickety-boo bog-standard cheesed off posh, bugger Eaton William smashing knackered bog bonnet bobby bender cobblers only a quid baking cakes the full monty pardon you.</p><p>Twit bonnet Jeffrey hunky-dory gormless chancer bog-standard spiffing good time, young delinquent Charles don\'t get shirty with me the BBC is brown bread off his nut a load of old tosh, chap grub bog skive off pardon me bleeder. Lavatory on your bike mate happy days the little rotter arse over tit no biggie at public school wind up car boot bamboozled well barmy bleeder the wireless bugger, cockup blatant David it\'s all gone to pot morish mush sloshed boot A bit of how\'s your father skive off cheers a load of old tosh. No biggie mush I don\'t want no agro it\'s your round cack boot say, the full monty mufty such a fibber up the duff Why, Eaton pardon me spiffing blower brown bread.</p>]]></melisTag><melisDragDropZone id="centered_dragdrop_html_1" plugin_container_id="" width_desktop="100" width_tablet="100" width_mobile="100"><plugin module="MelisMiniTemplate" name="MiniTemplatePlugin_title-subtitle-centered-with-background-purple_melisdemocms" id="tag-miniTpl_1580369157"/><plugin module="melisfront" name="MelisFrontBlockSectionPlugin" id="1580369187"/></melisDragDropZone><melisDragDropZone id="centered_dragdrop_html_2" plugin_container_id="" width_desktop="100" width_tablet="100" width_mobile="100"><plugin module="MelisMiniTemplate" name="MiniTemplatePlugin_1-col-service-detail_melisdemocms" id="tag-miniTpl_1580369178"/><plugin module="melisfront" name="MelisFrontTagHtmlPlugin" id="tag01_1580369198"/></melisDragDropZone><melisFrontBlockSectionPlugin id="1580369187" plugin_container_id="" width_desktop="100" width_tablet="100" width_mobile="100"></melisFrontBlockSectionPlugin></document>',

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
                                        Site::THEN => [Site::UPDATE_CURRENT_PAGE_ID],
                                        Melis::RELATION => [
                                            Melis::CMS_PAGE_PUBLISHED => [
                                                [
                                                    Melis::PRIMARY_KEY => 'page_id',
                                                    'page_id' => Melis::FOREIGN_KEY,
                                                    'page_type' => 'PAGE',
                                                    'page_status' => '1',
                                                    'page_menu' => 'LINK',
                                                    'page_name' => 'Live page builder',
                                                    'page_tpl_id' => [Site::GET_TEMPLATE_ID => ['template_name' => 'Centered Drag n Drop']],
                                                    'page_content' => '<?xml version="1.0" encoding="UTF-8"?><document type="MelisCMS" author="MelisTechnology" version="2.0"><melisTag id="srvd-html-2" plugin_container_id="" type="html"><![CDATA[<p class="f_400 f_size_15">He lost his bottle a load of old tosh cup of tea brolly bog-standard matie boy blow off the little rotter morish, haggle hotpot skive off cuppa don\'t get shirty with me off his nut the full monty. Starkers morish down the pub such a fibber quaint gosh Harry boot owt to do with me the little rotter, baking cakes Eaton ummm I\'m telling pardon me the bee\'s knees vagabond Oxford chap, A bit of how\'s your father bog-standard hanky panky daft well lavatory bubble and squeak the full monty. That say nice one grub cup of tea so I said barmy only a quid, I it\'s your round gutted mate cup of char golly gosh dropped a clanger my good sir, James Bond happy days brilliant blimey I is. Boot Jeffrey cockup the BBC pardon me victoria sponge Why chip shop what a load of rubbish pukka brolly cuppa tickety-boo bog-standard cheesed off posh, bugger Eaton William smashing knackered bog bonnet bobby bender cobblers only a quid baking cakes the full monty pardon you.</p><p class="f_400 f_size_15">Twit bonnet Jeffrey hunky-dory gormless chancer bog-standard spiffing good time, young delinquent Charles don\'t get shirty with me the BBC is brown bread off his nut a load of old tosh, chap grub bog skive off pardon me bleeder. Lavatory on your bike mate happy days the little rotter arse over tit no biggie at public school wind up car boot bamboozled well barmy bleeder the wireless bugger, cockup blatant David it\'s all gone to pot morish mush sloshed boot A bit of how\'s your father skive off cheers a load of old tosh. No biggie mush I don\'t want no agro it\'s your round cack boot say, the full monty mufty such a fibber up the duff Why, Eaton pardon me spiffing blower brown bread.</p>]]></melisTag><melisTag id="srvd-textarea1" plugin_container_id="" type="textarea"><![CDATA[Unique Elements]]></melisTag><melisTag id="servd-html-3" plugin_container_id="" type="html"><![CDATA[<div class="info_item"><h6>Owner:</h6><p>Droit Theme</p></div><div class="info_item"><h6>Live Time:</h6><p>2 Working Days</p></div><div class="info_item"><h6>Service Cost:</h6><p>$250.00</p></div><div class="info_item"><h6>Quality:</h6><p>High</p></div><div class="info_item"><h6>Experience</h6><p>3 Years</p></div>]]></melisTag><melisTag id="srvd-html-1" plugin_container_id="" type="html"><![CDATA[<div class="breadcrumb_content text-center"><h1 class="f_p f_700 f_size_50 w_color l_height50 mb_20">Services Details</h1><p class="f_400 w_color f_size_16 l_height26">Why I say old chap that is spiffing off his nut arse pear shaped plastered<br />Jeffrey bodge barney some dodgy.!!</p></div>]]></melisTag><melisTag id="tag-miniTpl_1580369389" plugin_container_id="" type="html"><![CDATA[<section class="breadcrumb_area" style="z-index: unset !important;"><div class="container"><div class="breadcrumb_content text-center"><h1 class="f_p f_700 f_size_50 w_color l_height50 mb_20">Live page: templating plugins implementation</h1><p class="f_400 w_color f_size_16 l_height26">This page\'s goal is to show up how users can beneficiate from implementing mini-templates plugins that they can drag\'n\'drop.<br />Mini-templates are essentials to make users autonomous and help them not having to take care of HTML.</p></div></div></section>]]></melisTag><melisTag id="tag-miniTpl_1580369399" plugin_container_id="" type="html" width_desktop="43.31" width_tablet="0" width_mobile="0"><![CDATA[<div class="pr_70"><div class="job_info"><div class="info_head"><i class="ti-receipt"></i><h6 class="f_p f_600 f_size_18 t_color3">Unique Elements</h6></div><div class="info_item"><h6>Owner:</h6><p>Droit Theme</p></div><div class="info_item"><h6>Live Time:</h6><p>2 Working Days</p></div><div class="info_item"><h6>Service Cost:</h6><p>$250.00</p></div><div class="info_item"><h6>Quality:</h6><p>High</p></div><div class="info_item"><h6>Experience</h6><p>3 Years</p></div></div></div>]]></melisTag><melisTag id="tag01_1580369434" plugin_container_id="" type="html" width_desktop="55.81" width_tablet="0" width_mobile="0"><![CDATA[<p>He lost his bottle a load of old tosh cup of tea brolly bog-standard matie boy blow off the little rotter morish, haggle hotpot skive off cuppa don\'t get shirty with me off his nut the full monty. Starkers morish down the pub such a fibber quaint gosh Harry boot owt to do with me the little rotter, baking cakes Eaton ummm I\'m telling pardon me the bee\'s knees vagabond Oxford chap, A bit of how\'s your father bog-standard hanky panky daft well lavatory bubble and squeak the full monty. That say nice one grub cup of tea so I said barmy only a quid, I it\'s your round gutted mate cup of char golly gosh dropped a clanger my good sir, James Bond happy days brilliant blimey I is. Boot Jeffrey cockup the BBC pardon me victoria sponge Why chip shop what a load of rubbish pukka brolly cuppa tickety-boo bog-standard cheesed off posh, bugger Eaton William smashing knackered bog bonnet bobby bender cobblers only a quid baking cakes the full monty pardon you.</p><p>Twit bonnet Jeffrey hunky-dory gormless chancer bog-standard spiffing good time, young delinquent Charles don\'t get shirty with me the BBC is brown bread off his nut a load of old tosh, chap grub bog skive off pardon me bleeder. Lavatory on your bike mate happy days the little rotter arse over tit no biggie at public school wind up car boot bamboozled well barmy bleeder the wireless bugger, cockup blatant David it\'s all gone to pot morish mush sloshed boot A bit of how\'s your father skive off cheers a load of old tosh. No biggie mush I don\'t want no agro it\'s your round cack boot say, the full monty mufty such a fibber up the duff Why, Eaton pardon me spiffing blower brown bread.</p>]]></melisTag><melisDragDropZone id="centered_dragdrop_html_1" plugin_container_id="" width_desktop="100" width_tablet="100" width_mobile="100"><plugin module="MelisMiniTemplate" name="MiniTemplatePlugin_title-subtitle-centered-with-background-purple_melisdemocms" id="tag-miniTpl_1580369389"/><plugin module="melisfront" name="MelisFrontBlockSectionPlugin" id="1580369407"/></melisDragDropZone><melisDragDropZone id="centered_dragdrop_html_2" plugin_container_id="" width_desktop="100" width_tablet="100" width_mobile="100"><plugin module="MelisMiniTemplate" name="MiniTemplatePlugin_1-col-service-detail_melisdemocms" id="tag-miniTpl_1580369399"/><plugin module="melisfront" name="MelisFrontTagHtmlPlugin" id="tag01_1580369434"/></melisDragDropZone><melisFrontBlockSectionPlugin id="1580369407" plugin_container_id="" width_desktop="100" width_tablet="100" width_mobile="100"></melisFrontBlockSectionPlugin></document>',

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
                                        'page_tpl_id' => [Site::GET_TEMPLATE_ID => ['template_name' => 'Drag n Drop']],
                                        'page_content' => '<?xml version="1.0" encoding="UTF-8"?><document type="MelisCMS" author="MelisTechnology" version="2.0"><melisDragDropZone id="dragdropzone_home_1" plugin_container_id="" width_desktop="100" width_tablet="100" width_mobile="100"><plugin module="MelisMiniTemplate" name="MiniTemplatePlugin_title-subtitle-centered-with-background-purple_melisdemocms" id="tag-miniTpl_1580727491"/><plugin module="MelisMiniTemplate" name="MiniTemplatePlugin_3-cols-in-blocks_melisdemocms" id="tag-miniTpl_1579164625"/><plugin module="MelisMiniTemplate" name="MiniTemplatePlugin_3-cols-2-lines_melisdemocms" id="tag-miniTpl_1575631632"/></melisDragDropZone><melisTag id="tag-miniTpl_1575631632" plugin_container_id="" type="html" width_desktop="99.57" width_tablet="0" width_mobile="0"><![CDATA[<section class="erp_service_area sec_pad"><div class="container"><div class="row"><div class="col-lg-4 col-sm-6"><div class="erp_service_item pr_70"><img src="/MelisDemoCms/img/erp-home/erp_icon1.png" alt="" /><h3 class="h_head">Secured Cloud</h3><p>Bloke fantastic bubble and squeak do one what a plonker nancy boy burke fanny around.</p></div></div><div class="col-lg-4 col-sm-6"><div class="erp_service_item pr_70 pl_10"><img src="/MelisDemoCms/img/erp-home/erp_icon2.png" alt="" /><h3 class="h_head">Single Platform</h3><p>Bloke fantastic bubble and squeak do one what a plonker nancy boy burke fanny around.</p></div></div><div class="col-lg-4 col-sm-6"><div class="erp_service_item pl_70"><img src="/MelisDemoCms/img/erp-home/erp_icon3.png" alt="" /><h3 class="h_head">Implement Yourself</h3><p>Bloke fantastic bubble and squeak do one what a plonker nancy boy burke fanny around.</p></div></div><div class="col-lg-4 col-sm-6"><div class="erp_service_item pr_70"><img src="/MelisDemoCms/img/erp-home/erp_icon4.png" alt="" /><h3 class="h_head">Multi Regional</h3><p>Bloke fantastic bubble and squeak do one what a plonker nancy boy burke fanny around.</p></div></div><div class="col-lg-4 col-sm-6"><div class="erp_service_item pl_10"><img src="/MelisDemoCms/img/erp-home/erp_icon5.png" alt="" /><h3 class="h_head">Quick Navigations</h3><p>Bloke fantastic bubble and squeak do one what a plonker nancy boy burke fanny around.</p></div></div><div class="col-lg-4 col-sm-6"><div class="erp_service_item pl_70"><img src="/MelisDemoCms/img/erp-home/erp_icon6.png" alt="" /><h3 class="h_head">Works in Web</h3><p>Bloke fantastic bubble and squeak do one what a plonker nancy boy burke fanny around.</p></div></div></div></div></section>]]></melisTag><melisTag id="tag-miniTpl_1579164625" plugin_container_id="" type="html" width_desktop="99.57" width_tablet="0" width_mobile="0"><![CDATA[<section class="app_service_area app_service_area_two"><div class="container"><div class="row app_service_info"><div class="col-lg-4 col-sm-6"><div class="app_service_item"><i class="ti-settings app_icon one"></i><h5 class="f_p f_size_18 f_600 t_color3 mt_40 mb-30">Identification of Needs</h5><p class="f_400 f_size_15 mb-30">Oxford jolly good cras bugger down the pub blow off well arse tinkety tonk old fruit William bite your arm off haggle, old it\'s all gone to pot daft no biggie bog.!</p><a href="/our-process/identification-of-needs/id/10" class="learn_btn_two c_violet">Learn More <i class="ti-arrow-right"></i></a></div></div><div class="col-lg-4 col-sm-6"><div class="app_service_item"><i class="ti-heart-broken app_icon two"></i><h5 class="f_p f_size_18 f_600 t_color3 mt_40 mb-30">Tailored Solution</h5><p class="f_400 f_size_15 mb-30">Oxford jolly good cras bugger down the pub blow off well arse tinkety tonk old fruit William bite your arm off haggle, old it\'s all gone to pot daft no biggie bog.!</p><a href="/our-process/tailored-solution/id/11" class="learn_btn_two c_violet">Learn More <i class="ti-arrow-right"></i></a></div></div><div class="col-lg-4 col-sm-6"><div class="app_service_item"><i class="ti-target app_icon three"></i><h5 class="f_p f_size_18 f_600 t_color3 mt_40 mb-30">Implementation</h5><p class="f_400 f_size_15 mb-30">Oxford jolly good cras bugger down the pub blow off well arse tinkety tonk old fruit William bite your arm off haggle, old it\'s all gone to pot daft no biggie bog.!</p><a href="/our-process/implementation/id/12" class="learn_btn_two c_violet">Learn More <i class="ti-arrow-right"></i></a></div></div></div></div></section>]]></melisTag><melisTag id="tag-miniTpl_1580727491" plugin_container_id="" type="html" width_desktop="100" width_tablet="100" width_mobile="100"><![CDATA[<section class="breadcrumb_area" style="z-index: unset !important;"><div class="container"><div class="breadcrumb_content text-center"><h1 class="f_p f_700 f_size_50 w_color l_height50 mb_20">Our Process: templating plugins implementation</h1><p class="f_400 w_color f_size_16 l_height26">This page\'s goal is to show up how users can beneficiate from implementing mini-templates plugins that they can drag\'n\'drop.<br />Mini-templates are essentials to make users autonomous and help them not having to take care of HTML.</p></div></div></section>]]></melisTag></document>',

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
                                        Site::THEN => [Site::UPDATE_CURRENT_PAGE_ID],
                                        Melis::RELATION => [
                                            Melis::CMS_PAGE_PUBLISHED => [
                                                [
                                                    Melis::PRIMARY_KEY => 'page_id',
                                                    'page_id' => Melis::FOREIGN_KEY,
                                                    'page_type' => 'PAGE',
                                                    'page_status' => '1',
                                                    'page_menu' => 'LINK',
                                                    'page_name' => 'Identification of Needs',
                                                    'page_tpl_id' => [Site::GET_TEMPLATE_ID => ['template_name' => 'Drag n Drop']],
                                                    'page_content' => '<?xml version="1.0" encoding="UTF-8"?><document type="MelisCMS" author="MelisTechnology" version="2.0"><melisDragDropZone id="dragdropzone_home_1" plugin_container_id="" width_desktop="100" width_tablet="100" width_mobile="100"><plugin module="MelisMiniTemplate" name="MiniTemplatePlugin_title-subtitle-centered-with-background-purple_melisdemocms" id="tag-miniTpl_1580201445"/><plugin module="MelisMiniTemplate" name="MiniTemplatePlugin_2-cols-left-text-right-image_melisdemocms" id="tag-miniTpl_1579171213"/><plugin module="MelisMiniTemplate" name="MiniTemplatePlugin_2-cols-right-text-left-image_melisdemocms" id="tag-miniTpl_1579171224"/><plugin module="MelisMiniTemplate" name="MiniTemplatePlugin_blue-banner-text_melisdemocms" id="tag-miniTpl_1579171237"/></melisDragDropZone><melisTag id="tag-miniTpl_1579165737" plugin_container_id="" type="html" width_desktop="100" width_tablet="100" width_mobile="100"><![CDATA[<section class="erp_service_area sec_pad"><div class="container"><div class="row"><div class="col-lg-4 col-sm-6"><div class="erp_service_item pr_70"><img src="/MelisDemoCms/img/erp-home/erp_icon1.png" alt="" /><h3 class="h_head">Secured Cloud</h3><p>Bloke fantastic bubble and squeak do one what a plonker nancy boy burke fanny around.</p></div></div><div class="col-lg-4 col-sm-6"><div class="erp_service_item pr_70 pl_10"><img src="/MelisDemoCms/img/erp-home/erp_icon2.png" alt="" /><h3 class="h_head">Single Platform</h3><p>Bloke fantastic bubble and squeak do one what a plonker nancy boy burke fanny around.</p></div></div><div class="col-lg-4 col-sm-6"><div class="erp_service_item pl_70"><img src="/MelisDemoCms/img/erp-home/erp_icon3.png" alt="" /><h3 class="h_head">Implement Yourself</h3><p>Bloke fantastic bubble and squeak do one what a plonker nancy boy burke fanny around.</p></div></div><div class="col-lg-4 col-sm-6"><div class="erp_service_item pr_70"><img src="/MelisDemoCms/img/erp-home/erp_icon4.png" alt="" /><h3 class="h_head">Multi Regional</h3><p>Bloke fantastic bubble and squeak do one what a plonker nancy boy burke fanny around.</p></div></div><div class="col-lg-4 col-sm-6"><div class="erp_service_item pl_10"><img src="/MelisDemoCms/img/erp-home/erp_icon5.png" alt="" /><h3 class="h_head">Quick Navigations</h3><p>Bloke fantastic bubble and squeak do one what a plonker nancy boy burke fanny around.</p></div></div><div class="col-lg-4 col-sm-6"><div class="erp_service_item pl_70"><img src="/MelisDemoCms/img/erp-home/erp_icon6.png" alt="" /><h3 class="h_head">Works in Web</h3><p>Bloke fantastic bubble and squeak do one what a plonker nancy boy burke fanny around.</p></div></div></div></div></section>]]></melisTag><melisTag id="tag-miniTpl_1579171163" plugin_container_id="" type="html" width_desktop="100" width_tablet="100" width_mobile="100"><![CDATA[<section class="breadcrumb_area" style="z-index: unset !important;"><div class="container"><div class="breadcrumb_content text-center"><h1 class="f_p f_700 f_size_50 w_color l_height50 mb_20">Identification of Needs</h1><p class="f_400 w_color f_size_16 l_height26">The full monty burke posh excuse my French Richard cheeky bobby spiffing crikey<br />Why gormless, pear shaped.!</p></div></div></section>]]></melisTag><melisTag id="tag-miniTpl_1579171213" plugin_container_id="" type="html" width_desktop="100" width_tablet="100" width_mobile="100"><![CDATA[<section class="erp_features_area_two sec_pad"><div class="container"><div class="row erp_item_features align-items-center flex-row-reverse"><div class="col-lg-6"><div class="erp_features_img_two"><div class="img_icon"><span class="pluse_1"></span><span class="pluse_2"></span><i class="icon_lightbulb_alt"></i></div><img src="/MelisDemoCms/img/erp-home/crm_img1.jpg" alt="" /></div></div><div class="col-lg-6"><div class="erp_content_two"><div class="hosting_title erp_title"><h2>Nurture Your Customers Using Advanced CRM</h2><p>Cack brolly butty grub chancer smashing brilliant vagabond, chimney pot blower such a fibber ummm I\'m telling chinwag he lost his bottle.!</p></div><div class="media erp_item"><div class="icon"><i class="icon_menu-square_alt2"></i></div><div class="media-body"><h5>Everybody Gets a Dashboard</h5></div></div><div class="media erp_item"><div class="icon green"><i class="icon_ribbon_alt"></i></div><div class="media-body"><h5>Complete Leave Management</h5></div></div><a href="#" class="erp_btn_learn">Learn More<i class="arrow_right"></i></a></div></div></div></div></section>]]></melisTag><melisTag id="tag-miniTpl_1579171224" plugin_container_id="" type="html" width_desktop="100" width_tablet="100" width_mobile="100"><![CDATA[<section class="erp_features_area_two sec_pad"><div class="container"><div class="row erp_item_features align-items-center"><div class="col-lg-6"><div class="erp_features_img_two"><div class="img_icon red"><span class="pluse_1"></span><span class="pluse_2"></span><i class="icon_lightbulb_alt"></i></div><img src="/MelisDemoCms/img/erp-home/crm_img2.jpg" alt="" /></div></div><div class="col-lg-6"><div class="erp_content_two"><div class="hosting_title erp_title"><h2>Integrated Project Management System</h2><p>Cack brolly butty grub chancer smashing brilliant vagabond, chimney pot blower such a fibber ummm I\'m telling chinwag he lost his bottle.!</p></div><div class="media erp_item"><div class="icon blue"><i class="icon_menu-square_alt2"></i></div><div class="media-body"><h5>Everybody Gets a Dashboard</h5></div></div><div class="media erp_item"><div class="icon yellow"><i class="icon_ribbon_alt"></i></div><div class="media-body"><h5>Complete Leave Management</h5></div></div><a href="#" class="erp_btn_learn">Learn More<i class="arrow_right"></i></a></div></div></div></div></section>]]></melisTag><melisTag id="tag-miniTpl_1579171237" plugin_container_id="" type="html" width_desktop="100" width_tablet="100" width_mobile="100"><![CDATA[<section class="erp_action_area"><div class="container"><div class="row align-items-center"><div class="col-lg-3 col-md-4"><img src="/MelisDemoCms/img/erp-home/action_img.png" alt="" /></div><div class="col-lg-9 col-md-8"><div class="erp_content"><h2>Trusted by <strong>10,030+ Businesses</strong> over 160 Countries and 24+ Languages</h2></div></div></div></div></section>]]></melisTag><melisTag id="tag-miniTpl_1580201445" plugin_container_id="" type="html"><![CDATA[<section class="breadcrumb_area" style="z-index: unset !important;"><div class="container"><div class="breadcrumb_content text-center"><h1 class="f_p f_700 f_size_50 w_color l_height50 mb_20">Identification of Needs: templating plugins implementation</h1><p class="f_400 w_color f_size_16 l_height26">This page\'s goal is to show up how users can beneficiate from implementing mini-templates plugins that they can drag\'n\'drop.<br />Mini-templates are essentials to make users autonomous and help them not having to take care of HTML.</p></div></div></section>]]></melisTag></document>',

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
                                    // </Process1>
                                    // <Process2>
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
                                                    'page_name' => 'Tailored Solution',
                                                    'page_tpl_id' => [Site::GET_TEMPLATE_ID => ['template_name' => 'Drag n Drop']],
                                                    'page_content' => '<?xml version="1.0" encoding="UTF-8"?><document type="MelisCMS" author="MelisTechnology" version="2.0"><melisDragDropZone id="dragdropzone_home_1" plugin_container_id="" width_desktop="100" width_tablet="100" width_mobile="100"><plugin module="MelisMiniTemplate" name="MiniTemplatePlugin_title-subtitle-centered-with-background-purple_melisdemocms" id="tag-miniTpl_1580201334"/><plugin module="MelisMiniTemplate" name="MiniTemplatePlugin_2-cols-left-text-right-image_melisdemocms" id="tag-miniTpl_1579171326"/><plugin module="MelisMiniTemplate" name="MiniTemplatePlugin_2-cols-right-text-left-image_melisdemocms" id="tag-miniTpl_1579171335"/><plugin module="MelisMiniTemplate" name="MiniTemplatePlugin_blue-banner-text_melisdemocms" id="tag-miniTpl_1579171360"/></melisDragDropZone><melisTag id="tag-miniTpl_1579171316" plugin_container_id="" type="html"><![CDATA[<section class="breadcrumb_area" style="z-index: unset !important;"><div class="container"><div class="breadcrumb_content text-center"><h1 class="f_p f_700 f_size_50 w_color l_height50 mb_20">Tailored Solution</h1><p class="f_400 w_color f_size_16 l_height26">The full monty burke posh excuse my French Richard cheeky bobby spiffing crikey<br />Why gormless, pear shaped.!</p></div></div></section>]]></melisTag><melisTag id="tag-miniTpl_1579171326" plugin_container_id="" type="html" width_desktop="100" width_tablet="100" width_mobile="100"><![CDATA[<section class="erp_features_area_two sec_pad"><div class="container"><div class="row erp_item_features align-items-center flex-row-reverse"><div class="col-lg-6"><div class="erp_features_img_two"><div class="img_icon"><span class="pluse_1"></span><span class="pluse_2"></span><i class="icon_lightbulb_alt"></i></div><img src="/MelisDemoCms/img/erp-home/crm_img1.jpg" alt="" /></div></div><div class="col-lg-6"><div class="erp_content_two"><div class="hosting_title erp_title"><h2>Nurture Your Customers Using Advanced CRM</h2><p>Cack brolly butty grub chancer smashing brilliant vagabond, chimney pot blower such a fibber ummm I\'m telling chinwag he lost his bottle.!</p></div><div class="media erp_item"><div class="icon"><i class="icon_menu-square_alt2"></i></div><div class="media-body"><h5>Everybody Gets a Dashboard</h5></div></div><div class="media erp_item"><div class="icon green"><i class="icon_ribbon_alt"></i></div><div class="media-body"><h5>Complete Leave Management</h5></div></div><a href="#" class="erp_btn_learn">Learn More<i class="arrow_right"></i></a></div></div></div></div></section>]]></melisTag><melisTag id="tag-miniTpl_1579171335" plugin_container_id="" type="html" width_desktop="100" width_tablet="100" width_mobile="100"><![CDATA[<section class="erp_features_area_two sec_pad"><div class="container"><div class="row erp_item_features align-items-center"><div class="col-lg-6"><div class="erp_features_img_two"><div class="img_icon red"><span class="pluse_1"></span><span class="pluse_2"></span><i class="icon_lightbulb_alt"></i></div><img src="/MelisDemoCms/img/erp-home/crm_img2.jpg" alt="" /></div></div><div class="col-lg-6"><div class="erp_content_two"><div class="hosting_title erp_title"><h2>Integrated Project Management System</h2><p>Cack brolly butty grub chancer smashing brilliant vagabond, chimney pot blower such a fibber ummm I\'m telling chinwag he lost his bottle.!</p></div><div class="media erp_item"><div class="icon blue"><i class="icon_menu-square_alt2"></i></div><div class="media-body"><h5>Everybody Gets a Dashboard</h5></div></div><div class="media erp_item"><div class="icon yellow"><i class="icon_ribbon_alt"></i></div><div class="media-body"><h5>Complete Leave Management</h5></div></div><a href="#" class="erp_btn_learn">Learn More<i class="arrow_right"></i></a></div></div></div></div></section>]]></melisTag><melisTag id="tag-miniTpl_1579171360" plugin_container_id="" type="html" width_desktop="100" width_tablet="100" width_mobile="100"><![CDATA[<section class="erp_action_area"><div class="container"><div class="row align-items-center"><div class="col-lg-3 col-md-4"><img src="/MelisDemoCms/img/erp-home/action_img.png" alt="" /></div><div class="col-lg-9 col-md-8"><div class="erp_content"><h2>Trusted by <strong>10,030+ Businesses</strong> over 160 Countries and 24+ Languages</h2></div></div></div></div></section>]]></melisTag><melisTag id="tag-miniTpl_1580201334" plugin_container_id="" type="html"><![CDATA[<section class="breadcrumb_area" style="z-index: unset !important;"><div class="container"><div class="breadcrumb_content text-center"><h1 class="f_p f_700 f_size_50 w_color l_height50 mb_20">Tailored Solution: templating plugins implementation</h1><p class="f_400 w_color f_size_16 l_height26">This page\'s goal is to show up how users can beneficiate from implementing mini-templates plugins that they can drag\'n\'drop.<br />Mini-templates are essentials to make users autonomous and help them not having to take care of HTML.</p></div></div></section>]]></melisTag></document>',

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
                                        Site::THEN => [Site::UPDATE_CURRENT_PAGE_ID],
                                        Melis::RELATION => [
                                            Melis::CMS_PAGE_PUBLISHED => [
                                                [
                                                    Melis::PRIMARY_KEY => 'page_id',
                                                    'page_id' => Melis::FOREIGN_KEY,
                                                    'page_type' => 'PAGE',
                                                    'page_status' => '1',
                                                    'page_menu' => 'LINK',
                                                    'page_name' => 'Implementation',
                                                    'page_tpl_id' => [Site::GET_TEMPLATE_ID => ['template_name' => 'Drag n Drop']],
                                                    'page_content' => '<?xml version="1.0" encoding="UTF-8"?><document type="MelisCMS" author="MelisTechnology" version="2.0"><melisTag id="tag-miniTpl_1574325068" plugin_container_id="" type="html"><![CDATA[<section class="pricing_area_two sec_pad"><div class="container custom_container p0"><div class="tab-content price_content price_content_two"><div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab"><div class="row"><div class="col-lg-4 col-sm-6"><div class="price_item"><img src="/MelisDemoCms/img/price/one.png" alt="" /><h5 class="f_p f_size_20 f_600 t_color2 mt_30">Education</h5><p>Create your first online course</p><div class="price f_700 f_size_40 t_color2">$25.00<sub class="f_size_16 f_400">/ mo</sub></div><ul class="list-unstyled p_list"><li><i class="ti-check"></i>Only 2 Operators</li><li><i class="ti-check"></i>Abandoned Cart</li><li><i class="ti-check"></i>Facebook &amp; Instagram Ads</li><li><i class="ti-close"></i>Order Notifications</li><li><i class="ti-close"></i>Landing Pages</li></ul><a href="#" class="price_btn btn_hover">Start Today</a></div></div><div class="col-lg-4 col-sm-6"><div class="price_item"><div class="tag"><span>Popular</span></div><img src="/MelisDemoCms/img/price/two.png" alt="" /><h5 class="f_p f_size_20 f_600 t_color2 mt_30">Professional</h5><p>Our most popular plan</p><div class="price f_700 f_size_40 t_color2">$25.00<sub class="f_size_16 f_400">/ mo</sub></div><ul class="list-unstyled p_list"><li><i class="ti-check"></i>Only 2 Operators</li><li><i class="ti-check"></i>Abandoned Cart</li><li><i class="ti-check"></i>Facebook &amp; Instagram Ads</li><li><i class="ti-close"></i>Order Notifications</li><li><i class="ti-close"></i>Landing Pages</li></ul><a href="#" class="price_btn btn_hover">Start Today</a></div></div><div class="col-lg-4 col-sm-6"><div class="price_item"><img src="/MelisDemoCms/img/price/three.png" alt="" /><h5 class="f_p f_size_20 f_600 t_color2 mt_30">Business</h5><p>Experience thebest of lorem</p><div class="price f_700 f_size_40 t_color2">$99.00<sub class="f_size_16 f_400">/ mo</sub></div><ul class="list-unstyled p_list"><li><i class="ti-check"></i>Only 2 Operators</li><li><i class="ti-check"></i>Abandoned Cart</li><li><i class="ti-check"></i>Facebook &amp; Instagram Ads</li><li><i class="ti-close"></i>Order Notifications</li><li><i class="ti-close"></i>Landing Pages</li></ul><a href="#" class="price_btn btn_hover">Start Today</a></div></div></div></div><div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab"><div class="row"><div class="col-lg-4 col-sm-6"><div class="price_item"><div class="tag"><span>Popular</span></div><img src="/MelisDemoCms/img/home2/price-3.png" alt="" /><h5 class="f_p f_size_20 f_600 t_color2 mt_30">Professional</h5><p>Create your first online course</p><div class="price f_700 f_size_40 t_color2">$25.00<sub class="f_size_16 f_400">/ mo</sub></div><ul class="list-unstyled p_list"><li><i class="ti-check"></i>Only 2 Operators</li><li><i class="ti-check"></i>Abandoned Cart</li><li><i class="ti-check"></i>Facebook &amp; Instagram Ads</li><li><i class="ti-close"></i>Order Notifications</li><li><i class="ti-close"></i>Landing Pages</li></ul><a href="#" class="price_btn btn_hover">Start Today</a></div></div><div class="col-lg-4 col-sm-6"><div class="price_item"><img src="/MelisDemoCms/img/home2/price-2.png" alt="" /><h5 class="f_p f_size_20 f_600 t_color2 mt_30">Education</h5><p>Create your first online course</p><div class="price f_700 f_size_40 t_color2">$25.00<sub class="f_size_16 f_400">/ mo</sub></div><ul class="list-unstyled p_list"><li><i class="ti-check"></i>Only 2 Operators</li><li><i class="ti-check"></i>Abandoned Cart</li><li><i class="ti-check"></i>Facebook &amp; Instagram Ads</li><li><i class="ti-close"></i>Order Notifications</li><li><i class="ti-close"></i>Landing Pages</li></ul><a href="#" class="price_btn btn_hover">Start Today</a></div></div><div class="col-lg-4 col-sm-6"><div class="price_item"><img src="/MelisDemoCms/img/home2/price-1.png" alt="" /><h5 class="f_p f_size_20 f_600 t_color2 mt_30">Business</h5><p>Create your first online course</p><div class="price f_700 f_size_40 t_color2">$25.00<sub class="f_size_16 f_400">/ mo</sub></div><ul class="list-unstyled p_list"><li><i class="ti-check"></i>Only 2 Operators</li><li><i class="ti-check"></i>Abandoned Cart</li><li><i class="ti-check"></i>Facebook &amp; Instagram Ads</li><li><i class="ti-close"></i>Order Notifications</li><li><i class="ti-close"></i>Landing Pages</li></ul><a href="#" class="price_btn btn_hover">Start Today</a></div></div></div></div></div></div></section>]]></melisTag><melisTag id="tag-miniTpl_1574913679" plugin_container_id="" type="html"><![CDATA[<section class="erp_banner_area_two"><ul class="list-unstyled cloud_animation"><li><img src="/MelisDemoCms/img/erp-home/cloud_01.png" alt="" /></li><li><img src="/MelisDemoCms/img/erp-home/cloud_02.png" alt="" /></li><li><img src="/MelisDemoCms/img/erp-home/cloud_03.png" alt="" /></li><li><img src="/MelisDemoCms/img/erp-home/cloud_04.png" alt="" /></li><li><img src="/MelisDemoCms/img/erp-home/cloud_05.png" alt="" /></li><li><img src="/MelisDemoCms/img/erp-home/cloud_06.png" alt="" /></li></ul><div class="erp_shap"></div><div class="erp_shap_two" style="background: url(\'/MelisDemoCms/img/erp-home/banner_shap.png\') no-repeat scroll top left;"></div><div class="section_intro"><div class="section_container"><div class="intro"><div class=" intro_content"><h1>Cloud ERP Software for Small and medium business</h1><p>A simple and powerful erp software for Manufacturing, Distribution and Services.</p><a href="#" class="er_btn er_btn_two">Try to Free</a></div></div></div></div></section>]]></melisTag><melisTag id="tag-miniTpl_1579171513" plugin_container_id="" type="html" width_desktop="100" width_tablet="100" width_mobile="100"><![CDATA[<section class="erp_features_area_two sec_pad"><div class="container"><div class="row erp_item_features align-items-center flex-row-reverse"><div class="col-lg-6"><div class="erp_features_img_two"><div class="img_icon"><span class="pluse_1"></span><span class="pluse_2"></span><i class="icon_lightbulb_alt"></i></div><img src="/MelisDemoCms/img/erp-home/crm_img1.jpg" alt="" /></div></div><div class="col-lg-6"><div class="erp_content_two"><div class="hosting_title erp_title"><h2>Nurture Your Customers Using Advanced CRM</h2><p>Cack brolly butty grub chancer smashing brilliant vagabond, chimney pot blower such a fibber ummm I\'m telling chinwag he lost his bottle.!</p></div><div class="media erp_item"><div class="icon"><i class="icon_menu-square_alt2"></i></div><div class="media-body"><h5>Everybody Gets a Dashboard</h5></div></div><div class="media erp_item"><div class="icon green"><i class="icon_ribbon_alt"></i></div><div class="media-body"><h5>Complete Leave Management</h5></div></div><a href="#" class="erp_btn_learn">Learn More<i class="arrow_right"></i></a></div></div></div></div></section>]]></melisTag><melisTag id="tag-miniTpl_1579171526" plugin_container_id="" type="html" width_desktop="100" width_tablet="100" width_mobile="100"><![CDATA[<section class="erp_features_area_two sec_pad"><div class="container"><div class="row erp_item_features align-items-center"><div class="col-lg-6"><div class="erp_features_img_two"><div class="img_icon red"><span class="pluse_1"></span><span class="pluse_2"></span><i class="icon_lightbulb_alt"></i></div><img src="/MelisDemoCms/img/erp-home/crm_img2.jpg" alt="" /></div></div><div class="col-lg-6"><div class="erp_content_two"><div class="hosting_title erp_title"><h2>Integrated Project Management System</h2><p>Cack brolly butty grub chancer smashing brilliant vagabond, chimney pot blower such a fibber ummm I\'m telling chinwag he lost his bottle.!</p></div><div class="media erp_item"><div class="icon blue"><i class="icon_menu-square_alt2"></i></div><div class="media-body"><h5>Everybody Gets a Dashboard</h5></div></div><div class="media erp_item"><div class="icon yellow"><i class="icon_ribbon_alt"></i></div><div class="media-body"><h5>Complete Leave Management</h5></div></div><a href="#" class="erp_btn_learn">Learn More<i class="arrow_right"></i></a></div></div></div></div></section>]]></melisTag><melisTag id="tag-miniTpl_1579171535" plugin_container_id="" type="html" width_desktop="100" width_tablet="100" width_mobile="100"><![CDATA[<section class="erp_action_area"><div class="container"><div class="row align-items-center"><div class="col-lg-3 col-md-4"><img src="/MelisDemoCms/img/erp-home/action_img.png" alt="" /></div><div class="col-lg-9 col-md-8"><div class="erp_content"><h2>Trusted by <strong>10,030+ Businesses</strong> over 160 Countries and 24+ Languages</h2></div></div></div></div></section>]]></melisTag><melisTag id="tag-miniTpl_1580201231" plugin_container_id="" type="html"><![CDATA[<section class="breadcrumb_area" style="z-index: unset !important;"><div class="container"><div class="breadcrumb_content text-center"><h1 class="f_p f_700 f_size_50 w_color l_height50 mb_20">Implementation: templating plugins implementation</h1><p class="f_400 w_color f_size_16 l_height26">This page\'s goal is to show up how users can beneficiate from implementing mini-templates plugins that they can drag\'n\'drop.<br />Mini-templates are essentials to make users autonomous and help them not having to take care of HTML.</p></div></div></section>]]></melisTag><melisDragDropZone id="dragdropzone_home_1" plugin_container_id="" width_desktop="100" width_tablet="100" width_mobile="100"><plugin module="MelisMiniTemplate" name="MiniTemplatePlugin_title-subtitle-centered-with-background-purple_melisdemocms" id="tag-miniTpl_1580201231"/><plugin module="MelisMiniTemplate" name="MiniTemplatePlugin_2-cols-left-text-right-image_melisdemocms" id="tag-miniTpl_1579171513"/><plugin module="MelisMiniTemplate" name="MiniTemplatePlugin_2-cols-right-text-left-image_melisdemocms" id="tag-miniTpl_1579171526"/><plugin module="MelisMiniTemplate" name="MiniTemplatePlugin_blue-banner-text_melisdemocms" id="tag-miniTpl_1579171535"/></melisDragDropZone><melisDragDropZone id="dragdropzone_full_2" plugin_container_id="" width_desktop="100" width_tablet="100" width_mobile="100"><plugin module="MelisMiniTemplate" name="MiniTemplatePlugin_title-fullscreen_melisdemocms" id="tag-miniTpl_1574913679"/></melisDragDropZone></document>',

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
                                        'page_name' => 'FAQ',
                                        'page_tpl_id' => [Site::GET_TEMPLATE_ID => ['template_name' => 'FAQ']],
                                        'page_content' => '<?xml version="1.0" encoding="UTF-8"?><document type="MelisCMS" author="MelisTechnology" version="2.0"><melisTag id="title-subtitle-centered" plugin_container_id="" type="html"><![CDATA[<section class="erp_service_area sec_pad"><div class="container"><div class="hosting_title erp_title text-center"><h2>How We Work</h2><p>Bender cobblers chap grub sloshed up the duff I fantastic<br />owt to do with me at public school.!</p></div></div></section>]]></melisTag><melisTag id="faq-html-1" plugin_container_id="" type="html"><![CDATA[<div class="breadcrumb_content text-center"><h1 class="f_p f_700 f_size_50 w_color l_height50 mb_20">FAQ</h1><p class="f_400 w_color f_size_16 l_height26">Below are the list of questions and answers from the FAQ.<br />These questions and answers can be edited from the Back-Office through the subpages (or children pages) in the treeview.<br />A subfolder (or child folder) will add an item in the "Quick Navigation".<br />A subpage (or child page) will add a question/answer under the corresponding folder.</p></div>]]></melisTag><melisTag id="faq-listing-text-1" plugin_container_id="" type="textarea"><![CDATA[Quick Navigation]]></melisTag><melisTag id="faq-values-title-1" plugin_container_id="" type="textarea"><![CDATA[Find here all most asked questions]]></melisTag><melisTag id="faq-values-title-2" plugin_container_id="" type="textarea"><![CDATA[Question about the product]]></melisTag><melisTag id="faq-values-title-3" plugin_container_id="" type="textarea"><![CDATA[Questions about payment]]></melisTag><melisTag id="tag-miniTpl_1580200149" plugin_container_id="" type="html"><![CDATA[<section class="breadcrumb_area" style="z-index: unset !important;"><div class="container"><div class="breadcrumb_content text-center"><h1 class="f_p f_700 f_size_50 w_color l_height50 mb_20">FAQ: folder listing implementation</h1><p class="f_400 w_color f_size_16 l_height26">This page has for goal to show how contents from other pages can be brought this page.<br />One page per FAQ has been created bellow in the treeview, and its contents are dynamically shown on this page, also using the folder\'s name in between as a category.<br /><br />By looking inside the plugin\'s code, you will find some interesting code about the services of Melis regarding pages.</p></div></div></section>]]></melisTag><melisDragDropZone id="dragdropzone_faq_1" plugin_container_id="" width_desktop="100" width_tablet="100" width_mobile="100"><plugin module="MelisMiniTemplate" name="MiniTemplatePlugin_title-subtitle-centered-with-background-purple_melisdemocms" id="tag-miniTpl_1580200149"/></melisDragDropZone></document>',

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
                                        Site::THEN => [Site::UPDATE_CURRENT_PAGE_ID],
                                        Melis::RELATION => [
                                            Melis::CMS_PAGE_PUBLISHED => [
                                                [
                                                    Melis::PRIMARY_KEY => 'page_id',
                                                    'page_id' => Melis::FOREIGN_KEY,
                                                    'page_type' => 'FOLDER',
                                                    'page_status' => '1',
                                                    'page_menu' => 'NONE',
                                                    'page_name' => 'Delivery',
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
                                                // <FAQQ/A1>
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
                                                                'page_name' => 'How long is the delivery?',
                                                                'page_tpl_id' => [Site::GET_TEMPLATE_ID => ['template_name' => 'FAQ Details']],
                                                                'page_content' => '<?xml version="1.0" encoding="UTF-8"?><document type="MelisCMS" author="MelisTechnology" version="2.0"><melisTag id="faq-html-1" plugin_container_id="" type="html"><![CDATA[<div class="card-body"><p>Why I say old chap that is spiffing pukka, bamboozled wind up bugger buggered zonked hanky panky a blinding shot the little rotter, bubble and squeak vagabond cheeky bugger at public school pardon you bloke the BBC. Tickety-boo Elizabeth plastered matie.!</p></div>]]></melisTag><melisTag id="faq-textarea-1" plugin_container_id="" type="textarea"><![CDATA[How long is the delivery?]]></melisTag><melisTag id="tag-miniTpl_1580729439" plugin_container_id="" type="html" width_desktop="100" width_tablet="100" width_mobile="100"><![CDATA[<section class="breadcrumb_area" style="z-index: unset !important;"><div class="container"><div class="breadcrumb_content text-center"><h1 class="f_p f_700 f_size_50 w_color l_height50 mb_20">FAQ details: question &amp; answer</h1><p class="f_400 w_color f_size_16 l_height26">This page is used as a hidden page to create content shown on the real FAQ page.<br />It has no other purpose but to save content and organize it through the treeview.</p></div></div></section>]]></melisTag><melisDragDropZone id="dragdropzone_faq_details_1" plugin_container_id="" width_desktop="100" width_tablet="100" width_mobile="100"><plugin module="MelisMiniTemplate" name="MiniTemplatePlugin_title-subtitle-centered-with-background-purple_melisdemocms" id="tag-miniTpl_1580729439"/></melisDragDropZone></document>',
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
                                                // </FAQQ/A1>
                                                // <FAQQ/A2>
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
                                                                'page_menu' => 'NONE',
                                                                'page_name' => 'Do we get a tracking number?',
                                                                'page_tpl_id' => [Site::GET_TEMPLATE_ID => ['template_name' => 'FAQ Details']],
                                                                'page_content' => '<?xml version="1.0" encoding="UTF-8"?><document type="MelisCMS" author="MelisTechnology" version="2.0"><melisTag id="faq-textarea-1" plugin_container_id="" type="textarea"><![CDATA[Do we get a tracking number?]]></melisTag><melisTag id="faq-html-1" plugin_container_id="" type="html"><![CDATA[<div class="card-body"><p>Why I say old chap that is spiffing pukka, bamboozled wind up bugger buggered zonked hanky panky a blinding shot the little rotter, bubble and squeak vagabond cheeky bugger at public school pardon you bloke the BBC. Tickety-boo Elizabeth plastered matie.!</p></div>]]></melisTag><melisTag id="tag-miniTpl_1580729756" plugin_container_id="" type="html" width_desktop="100" width_tablet="100" width_mobile="100"><![CDATA[<section class="breadcrumb_area" style="z-index: unset !important;"><div class="container"><div class="breadcrumb_content text-center"><h1 class="f_p f_700 f_size_50 w_color l_height50 mb_20">FAQ details: question &amp; answer</h1><p class="f_400 w_color f_size_16 l_height26">This page is used as a hidden page to create content shown on the real FAQ page.<br />It has no other purpose but to save content and organize it through the treeview.</p></div></div></section>]]></melisTag><melisDragDropZone id="dragdropzone_faq_details_1" plugin_container_id="" width_desktop="100" width_tablet="100" width_mobile="100"><plugin module="MelisMiniTemplate" name="MiniTemplatePlugin_title-subtitle-centered-with-background-purple_melisdemocms" id="tag-miniTpl_1580729756"/></melisDragDropZone></document>',

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
                                                    Site::THEN => [Site::UPDATE_CURRENT_PAGE_ID],
                                                    Melis::RELATION => [
                                                        Melis::CMS_PAGE_PUBLISHED => [
                                                            [
                                                                Melis::PRIMARY_KEY => 'page_id',
                                                                'page_id' => Melis::FOREIGN_KEY,
                                                                'page_type' => 'PAGE',
                                                                'page_status' => '1',
                                                                'page_menu' => 'NONE',
                                                                'page_name' => 'How can I send back an item?',
                                                                'page_tpl_id' => [Site::GET_TEMPLATE_ID => ['template_name' => 'FAQ Details']],
                                                                'page_content' => '<?xml version="1.0" encoding="UTF-8"?><document type="MelisCMS" author="MelisTechnology" version="2.0"><melisTag id="faq-textarea-1" plugin_container_id="" type="textarea"><![CDATA[How can I send back an item?]]></melisTag><melisTag id="faq-html-1" plugin_container_id="" type="html"><![CDATA[<div class="card-body">Why I say old chap that is spiffing pukka, bamboozled wind up bugger buggered zonked hanky panky a blinding shot the little rotter, bubble and squeak vagabond cheeky bugger at public school pardon you bloke the BBC. Tickety-boo Elizabeth plastered matie.!</div>]]></melisTag><melisTag id="tag-miniTpl_1580730196" plugin_container_id="" type="html" width_desktop="100" width_tablet="100" width_mobile="100"><![CDATA[<section class="breadcrumb_area" style="z-index: unset !important;"><div class="container"><div class="breadcrumb_content text-center"><h1 class="f_p f_700 f_size_50 w_color l_height50 mb_20">FAQ details: question &amp; answer</h1><p class="f_400 w_color f_size_16 l_height26">This page is used as a hidden page to create content shown on the real FAQ page.<br />It has no other purpose but to save content and organize it through the treeview.</p></div></div></section>]]></melisTag><melisDragDropZone id="dragdropzone_faq_details_1" plugin_container_id="" width_desktop="100" width_tablet="100" width_mobile="100"><plugin module="MelisMiniTemplate" name="MiniTemplatePlugin_title-subtitle-centered-with-background-purple_melisdemocms" id="tag-miniTpl_1580730196"/></melisDragDropZone></document>',

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
                                    ],
                                    // </FAQCat1>
                                    // <FAQCat2>
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
                                                    'page_type' => 'FOLDER',
                                                    'page_status' => '1',
                                                    'page_menu' => 'NONE',
                                                    'page_name' => 'Product',
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
                                                // <FAQQ/A1>
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
                                                                'page_name' => 'Is there a warranty on my item?',
                                                                'page_tpl_id' => [Site::GET_TEMPLATE_ID => ['template_name' => 'FAQ Details']],
                                                                'page_content' => '<?xml version="1.0" encoding="UTF-8"?><document type="MelisCMS" author="MelisTechnology" version="2.0"><melisTag id="faq-textarea-1" plugin_container_id="" type="textarea"><![CDATA[Is there a warranty on my item?]]></melisTag><melisTag id="faq-html-1" plugin_container_id="" type="html"><![CDATA[<div class="card-body"><p>Why I say old chap that is spiffing pukka, bamboozled wind up bugger buggered zonked hanky panky a blinding shot the little rotter, bubble and squeak vagabond cheeky bugger at public school pardon you bloke the BBC. Tickety-boo Elizabeth plastered matie.!</p></div>]]></melisTag><melisTag id="tag-miniTpl_1580730239" plugin_container_id="" type="html" width_desktop="100" width_tablet="100" width_mobile="100"><![CDATA[<section class="breadcrumb_area" style="z-index: unset !important;"><div class="container"><div class="breadcrumb_content text-center"><h1 class="f_p f_700 f_size_50 w_color l_height50 mb_20">FAQ details: question &amp; answer</h1><p class="f_400 w_color f_size_16 l_height26">This page is used as a hidden page to create content shown on the real FAQ page.<br />It has no other purpose but to save content and organize it through the treeview.</p></div></div></section>]]></melisTag><melisDragDropZone id="dragdropzone_faq_details_1" plugin_container_id="" width_desktop="100" width_tablet="100" width_mobile="100"><plugin module="MelisMiniTemplate" name="MiniTemplatePlugin_title-subtitle-centered-with-background-purple_melisdemocms" id="tag-miniTpl_1580730239"/></melisDragDropZone></document>',
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
                                                // </FAQQ/A1>
                                                // <FAQQ/A2>
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
                                                                'page_menu' => 'NONE',
                                                                'page_name' => 'Is the product open source?',
                                                                'page_tpl_id' => [Site::GET_TEMPLATE_ID => ['template_name' => 'FAQ Details']],
                                                                'page_content' => '<?xml version="1.0" encoding="UTF-8"?><document type="MelisCMS" author="MelisTechnology" version="2.0"><melisTag id="faq-textarea-1" plugin_container_id="" type="textarea"><![CDATA[Is the product open source?]]></melisTag><melisTag id="faq-html-1" plugin_container_id="" type="html"><![CDATA[<div class="card-body"><p>Why I say old chap that is spiffing pukka, bamboozled wind up bugger buggered zonked hanky panky a blinding shot the little rotter, bubble and squeak vagabond cheeky bugger at public school pardon you bloke the BBC. Tickety-boo Elizabeth plastered matie.!</p></div>]]></melisTag><melisTag id="tag-miniTpl_1580730284" plugin_container_id="" type="html" width_desktop="100" width_tablet="100" width_mobile="100"><![CDATA[<section class="breadcrumb_area" style="z-index: unset !important;"><div class="container"><div class="breadcrumb_content text-center"><h1 class="f_p f_700 f_size_50 w_color l_height50 mb_20">FAQ details: question &amp; answer</h1><p class="f_400 w_color f_size_16 l_height26">This page is used as a hidden page to create content shown on the real FAQ page.<br />It has no other purpose but to save content and organize it through the treeview.</p></div></div></section>]]></melisTag><melisDragDropZone id="dragdropzone_faq_details_1" plugin_container_id="" width_desktop="100" width_tablet="100" width_mobile="100"><plugin module="MelisMiniTemplate" name="MiniTemplatePlugin_title-subtitle-centered-with-background-purple_melisdemocms" id="tag-miniTpl_1580730284"/></melisDragDropZone></document>',

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
                                        Site::THEN => [Site::UPDATE_CURRENT_PAGE_ID],
                                        Melis::RELATION => [
                                            Melis::CMS_PAGE_PUBLISHED => [
                                                [
                                                    Melis::PRIMARY_KEY => 'page_id',
                                                    'page_id' => Melis::FOREIGN_KEY,
                                                    'page_type' => 'FOLDER',
                                                    'page_status' => '1',
                                                    'page_menu' => 'NONE',
                                                    'page_name' => 'Payment',
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
                                                // <FAQQ/A1>
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
                                                                'page_name' => 'Can we cancel the subscription anytime?',
                                                                'page_tpl_id' => [Site::GET_TEMPLATE_ID => ['template_name' => 'FAQ Details']],
                                                                'page_content' => '<?xml version="1.0" encoding="UTF-8"?><document type="MelisCMS" author="MelisTechnology" version="2.0"><melisTag id="faq-textarea-1" plugin_container_id="" type="textarea"><![CDATA[Can we cancel the subscription anytime?]]></melisTag><melisTag id="tag-miniTpl_1580730330" plugin_container_id="" type="html" width_desktop="100" width_tablet="100" width_mobile="100"><![CDATA[<section class="breadcrumb_area" style="z-index: unset !important;"><div class="container"><div class="breadcrumb_content text-center"><h1 class="f_p f_700 f_size_50 w_color l_height50 mb_20">FAQ details: question &amp; answer</h1><p class="f_400 w_color f_size_16 l_height26">This page is used as a hidden page to create content shown on the real FAQ page.<br />It has no other purpose but to save content and organize it through the treeview.</p></div></div></section>]]></melisTag><melisTag id="faq-html-1" plugin_container_id="" type="html"><![CDATA[<div class="card-body"><p>Why I say old chap that is spiffing pukka, bamboozled wind up bugger buggered zonked hanky panky a blinding shot the little rotter, bubble and squeak vagabond cheeky bugger at public school pardon you bloke the BBC. Tickety-boo Elizabeth plastered matie.!</p></div>]]></melisTag><melisDragDropZone id="dragdropzone_faq_details_1" plugin_container_id="" width_desktop="100" width_tablet="100" width_mobile="100"><plugin module="MelisMiniTemplate" name="MiniTemplatePlugin_title-subtitle-centered-with-background-purple_melisdemocms" id="tag-miniTpl_1580730330"/></melisDragDropZone></document>',
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
                                                // </FAQQ/A1>
                                                // <FAQQ/A2>
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
                                                                'page_menu' => 'NONE',
                                                                'page_name' => 'Can we pay with Bitcoin?',
                                                                'page_tpl_id' => [Site::GET_TEMPLATE_ID => ['template_name' => 'FAQ Details']],
                                                                'page_content' => '<?xml version="1.0" encoding="UTF-8"?><document type="MelisCMS" author="MelisTechnology" version="2.0"><melisTag id="faq-textarea-1" plugin_container_id="" type="textarea"><![CDATA[Can we pay with Bitcoin?]]></melisTag><melisTag id="tag-miniTpl_1580730377" plugin_container_id="" type="html" width_desktop="100" width_tablet="100" width_mobile="100"><![CDATA[<section class="breadcrumb_area" style="z-index: unset !important;"><div class="container"><div class="breadcrumb_content text-center"><h1 class="f_p f_700 f_size_50 w_color l_height50 mb_20">FAQ details: question &amp; answer</h1><p class="f_400 w_color f_size_16 l_height26">This page is used as a hidden page to create content shown on the real FAQ page.<br />It has no other purpose but to save content and organize it through the treeview.</p></div></div></section>]]></melisTag><melisTag id="faq-html-1" plugin_container_id="" type="html"><![CDATA[<div class="card-body"><p>Why I say old chap that is spiffing pukka, bamboozled wind up bugger buggered zonked hanky panky a blinding shot the little rotter, bubble and squeak vagabond cheeky bugger at public school pardon you bloke the BBC. Tickety-boo Elizabeth plastered matie.!</p></div>]]></melisTag><melisDragDropZone id="dragdropzone_faq_details_1" plugin_container_id="" width_desktop="100" width_tablet="100" width_mobile="100"><plugin module="MelisMiniTemplate" name="MiniTemplatePlugin_title-subtitle-centered-with-background-purple_melisdemocms" id="tag-miniTpl_1580730377"/></melisDragDropZone></document>',

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
                                                    Site::THEN => [Site::UPDATE_CURRENT_PAGE_ID],
                                                    Melis::RELATION => [
                                                        Melis::CMS_PAGE_PUBLISHED => [
                                                            [
                                                                Melis::PRIMARY_KEY => 'page_id',
                                                                'page_id' => Melis::FOREIGN_KEY,
                                                                'page_type' => 'PAGE',
                                                                'page_status' => '1',
                                                                'page_menu' => 'NONE',
                                                                'page_name' => 'Is there a yearly subscription?',
                                                                'page_tpl_id' => [Site::GET_TEMPLATE_ID => ['template_name' => 'FAQ Details']],
                                                                'page_content' => '<?xml version="1.0" encoding="UTF-8"?><document type="MelisCMS" author="MelisTechnology" version="2.0"><melisTag id="faq-textarea-1" plugin_container_id="" type="textarea"><![CDATA[Is there a yearly subscription?]]></melisTag><melisTag id="tag-miniTpl_1580730425" plugin_container_id="" type="html" width_desktop="100" width_tablet="100" width_mobile="100"><![CDATA[<section class="breadcrumb_area" style="z-index: unset !important;"><div class="container"><div class="breadcrumb_content text-center"><h1 class="f_p f_700 f_size_50 w_color l_height50 mb_20">FAQ details: question &amp; answer</h1><p class="f_400 w_color f_size_16 l_height26">This page is used as a hidden page to create content shown on the real FAQ page.<br />It has no other purpose but to save content and organize it through the treeview.</p></div></div></section>]]></melisTag><melisTag id="faq-html-1" plugin_container_id="" type="html"><![CDATA[<div class="card-body"><p>Why I say old chap that is spiffing pukka, bamboozled wind up bugger buggered zonked hanky panky a blinding shot the little rotter, bubble and squeak vagabond cheeky bugger at public school pardon you bloke the BBC. Tickety-boo Elizabeth plastered matie.!</p></div>]]></melisTag><melisDragDropZone id="dragdropzone_faq_details_1" plugin_container_id="" width_desktop="100" width_tablet="100" width_mobile="100"><plugin module="MelisMiniTemplate" name="MiniTemplatePlugin_title-subtitle-centered-with-background-purple_melisdemocms" id="tag-miniTpl_1580730425"/></melisDragDropZone></document>',

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
                                    ],
                                    // <FAQCat3>
                                ],
                            ],
                        ],
                        // <//FAQ>

                        // <Contact>
                        [
                            Melis::PRIMARY_KEY => 'tree_page_id',
                            'tree_page_id' => Melis::CURRENT_PAGE_ID,
                            'tree_father_page_id' => Melis::CMS_SITE_ID,
                            'tree_page_order' => 8,
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
                                        'page_content' => '<?xml version="1.0" encoding="UTF-8"?><document type="MelisCMS" author="MelisTechnology" version="2.0"><melisTag id="contact-html-1" plugin_container_id="" type="html"><![CDATA[<div class="breadcrumb_content text-center"><h1 class="f_p f_700 f_size_50 w_color l_height50 mb_20">Contact Us</h1><p class="f_400 w_color f_size_16 l_height26">Why I say old chap that is spiffing off his nut arse pear shaped plastered<br />Jeffrey bodge barney some dodgy.!!</p></div>]]></melisTag><melisTag id="contact-html-2" plugin_container_id="" type="html"><![CDATA[<div class="info_item"><h3>Office Address</h3><p>4, rue du Dahomey&nbsp;75011 Paris, France</p></div><div class="info_item"><h3>Contact Info</h3><p>Phone: (+33) 972 386 280<br />Email: contact@melistechnology.com&nbsp;</p></div>]]></melisTag><melisTag id="contact_gmap_lat" plugin_container_id="" type="textarea"><![CDATA[48.850973]]></melisTag><melisTag id="contact_gmap_long" plugin_container_id="" type="textarea"><![CDATA[2.382171]]></melisTag><melisTag id="tag-miniTpl_1580200207" plugin_container_id="" type="html"><![CDATA[<section class="breadcrumb_area" style="z-index: unset !important;"><div class="container"><div class="breadcrumb_content text-center"><h1 class="f_p f_700 f_size_50 w_color l_height50 mb_20">Contact Us: prospect plugin implementation</h1><p class="f_400 w_color f_size_16 l_height26">This page\'s goal is to show how to use the prospects plugin to developpers. <br />It is voluntarily static in the template so that developpers can look how to configure it and use it.&nbsp;<br />Theplugin works together with the Prospect Tool, accessible in the left menu of the platform.&nbsp;</p></div></div></section>]]></melisTag><melisCmsProspects id="showform" plugin_container_id="" width_desktop="100" width_tablet="100" width_mobile="100"><template_path><![CDATA[MelisDemoCms/plugins/prospect-form]]></template_path><pros_site_id><![CDATA[1]]></pros_site_id><fields><![CDATA[pros_name,pros_company,pros_email,pros_telephone,pros_country,pros_theme,pros_message]]></fields><required_fields><![CDATA[pros_name,pros_message]]></required_fields><theme><![CDATA[1]]></theme></melisCmsProspects><melisDragDropZone id="dragdropzone_contact_1" plugin_container_id="" width_desktop="100" width_tablet="100" width_mobile="100"><plugin module="MelisMiniTemplate" name="MiniTemplatePlugin_title-subtitle-centered-with-background-purple_melisdemocms" id="tag-miniTpl_1580200207"/></melisDragDropZone></document>',
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
                                        'page_status' => '0',
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
                                                    'page_status' => '0',
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
                                                                'page_content' => '<?xml version="1.0" encoding="UTF-8"?><document type="MelisCMS" author="MelisTechnology" version="2.0"><melisTag id="testi-html-1" plugin_container_id="" type="html"><![CDATA[Loo car boot bodge smashing I up the duff horse play give us a bell, William bugger all mate happy days mush at public school tosser victoria sponge, say lurgy hunky-dory twit hotpot gutted mate.]]></melisTag><melisTag id="testi-textarea-1" plugin_container_id="" type="html"><![CDATA[Lance Bogrol]]></melisTag><melisTag id="testi-textarea-2" plugin_container_id="" type="html"><![CDATA[Officer at Samumed]]></melisTag><melisTag id="testi-img-1" plugin_container_id="" type="html"><![CDATA[<img src="/MelisDemoCms/img/erp-home/testimonial_img.jpg" alt="" />]]></melisTag><melisTag id="tag-miniTpl_1580730707" plugin_container_id="" type="html" width_desktop="100" width_tablet="100" width_mobile="100"><![CDATA[<section class="breadcrumb_area" style="z-index: unset !important;"><div class="container"><div class="breadcrumb_content text-center"><h1 class="f_p f_700 f_size_50 w_color l_height50 mb_20">Testimonial details: example</h1><p class="f_400 w_color f_size_16 l_height26">This page has only one goal: to input the contents of one testimonial, that is then shown on the homepage.<br />This page has no purpose other than that, it\'s not supposed to be shown on the site. It is just about having content, brought somewhere else, and organazing the contents using the treeview.</p></div></div></section>]]></melisTag><melisDragDropZone id="testimonial_html_1" plugin_container_id="" width_desktop="100" width_tablet="100" width_mobile="100"><plugin module="MelisMiniTemplate" name="MiniTemplatePlugin_title-subtitle-centered-with-background-purple_melisdemocms" id="tag-miniTpl_1580730707"/></melisDragDropZone></document>',

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
                                                                'page_content' => '<?xml version="1.0" encoding="UTF-8"?><document type="MelisCMS" author="MelisTechnology" version="2.0"><melisTag id="testi-html-1" plugin_container_id="" type="html"><![CDATA[Loo car boot bodge smashing I up the duff horse play give us a bell, William bugger all mate happy days mush at public school tosser victoria sponge, say lurgy hunky-dory twit hotpot gutted mate.]]></melisTag><melisTag id="testi-textarea-1" plugin_container_id="" type="html"><![CDATA[Lance Bogrol]]></melisTag><melisTag id="testi-textarea-2" plugin_container_id="" type="html"><![CDATA[Officer at Samumed]]></melisTag><melisTag id="testi-img-1" plugin_container_id="" type="html"><![CDATA[<img src="/MelisDemoCms/img/erp-home/testimonial_img2.jpg" width="60" height="60" alt="" />]]></melisTag><melisTag id="tag-miniTpl_1580730856" plugin_container_id="" type="html" width_desktop="100" width_tablet="100" width_mobile="100"><![CDATA[<section class="breadcrumb_area" style="z-index: unset !important;"><div class="container"><div class="breadcrumb_content text-center"><h1 class="f_p f_700 f_size_50 w_color l_height50 mb_20">Testimonial details: example</h1><p class="f_400 w_color f_size_16 l_height26">This page has only one goal: to input the contents of one testimonial, that is then shown on the homepage.<br />This page has no purpose other than that, it\'s not supposed to be shown on the site. It is just about having content, brought somewhere else, and organazing the contents using the treeview.</p></div></div></section>]]></melisTag><melisDragDropZone id="testimonial_html_1" plugin_container_id="" width_desktop="100" width_tablet="100" width_mobile="100"><plugin module="MelisMiniTemplate" name="MiniTemplatePlugin_title-subtitle-centered-with-background-purple_melisdemocms" id="tag-miniTpl_1580730856"/></melisDragDropZone></document>',

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
                                                // </Testimonials2>
                                            ]
                                            // </Testimonials>
                                        ],
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
                                                    'page_name' => 'Search Results',
                                                    'page_tpl_id' => [Site::GET_TEMPLATE_ID => ['template_name' => 'Search Results']],
                                                    'page_content' => '<?xml version="1.0" encoding="UTF-8"?><document type="MelisCMS" author="MelisTechnology" version="2.0"><melisTag id="tag-miniTpl_1580200267" plugin_container_id="" type="html"><![CDATA[<section class="breadcrumb_area" style="z-index: unset !important;"><div class="container"><div class="breadcrumb_content text-center"><h1 class="f_p f_700 f_size_50 w_color l_height50 mb_20">Search Results: plugin implementation</h1><p class="f_400 w_color f_size_16 l_height26">This page\'s goal is to show developpers how to use and configure the search plugin for Melis Platform\'s pages.<br />It is voluntarily static so that developpers can look atthe configuration in the template.</p></div></div></section>]]></melisTag><melisDragDropZone id="dragdropzone_search_result_1" plugin_container_id="" width_desktop="100" width_tablet="100" width_mobile="100"><plugin module="MelisMiniTemplate" name="MiniTemplatePlugin_title-subtitle-centered-with-background-purple_melisdemocms" id="tag-miniTpl_1580200267"/></melisDragDropZone></document>',
                                                ],
                                            ],
                                            Melis::CMS_PAGE_LANG => [
                                                [
                                                    'plang_page_id' => Melis::FOREIGN_KEY,
                                                    'plang_lang_id' => 1,
                                                    'plang_page_id_initial' => Melis::FOREIGN_KEY
                                                ]
                                            ],
                                        ],
                                    ],
                                    // </SearchResults>
                                    // <Page404>
                                    [
                                        Melis::PRIMARY_KEY => 'tree_page_id',
                                        'tree_page_id' => Melis::CURRENT_PAGE_ID,
                                        'tree_father_page_id' => Melis::FOREIGN_KEY,
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
                                                    'page_tpl_id' => [Site::GET_TEMPLATE_ID => ['template_name' => 'Drag n Drop']],
                                                    'page_content' => '<?xml version="1.0" encoding="UTF-8"?><document type="MelisCMS" author="MelisTechnology" version="2.0"><melisTag id="contact-html-1" plugin_container_id="" type="html"><![CDATA[<h2>Error. We can&rsquo;t find the page you&rsquo;re looking for.</h2><p>Sorry for the inconvenience. Go to our homepage or check out our latest collections for Fashion, Chair, Decoration...</p><a href="/" class="about_btn btn_hover">Back to Home Page <i class="arrow_right"></i></a>]]></melisTag><melisTag id="404-html-1" plugin_container_id="" type="html"><![CDATA[<h2 style="text-align: center;">Error. We<strong> can&rsquo;t</strong> find the <span style="text-decoration: underline;">page</span> you&rsquo;re looking for.</h2><p style="text-align: center;">Sorry for the inconvenience. Go to our homepage or check out our latest collections for Fashion, Chair, Decoration...</p><a href="/melis-demo-cms-full-dd/id/35" class="about_btn btn_hover">Back to Home Page <i class="arrow_right"></i></a>]]></melisTag><melisTag id="tag-miniTpl_1579844876" plugin_container_id="" type="html"><![CDATA[<section class="error_two_area"><div class="container"><div class="error_content_two text-center"><img src="/MelisDemoCms/img/new/error.png" alt="" /><h2>Error. We can&rsquo;t find the page you&rsquo;re looking for.<br />Define this page in your site\'s config (Site Tool)!</h2><p>Sorry for the inconvenience. Go to our homepage or check out our latest collections for Fashion, Chair, Decoration...</p><a href="/" class="about_btn btn_hover">Back to Home Page <i class="arrow_right"></i></a></div></div></section>]]></melisTag><melisDragDropZone id="dragdropzone_home_1" plugin_container_id="" width_desktop="100" width_tablet="100" width_mobile="100"><plugin module="MelisMiniTemplate" name="MiniTemplatePlugin_404_melisdemocms" id="tag-miniTpl_1579844876"/></melisDragDropZone></document>',
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
                                        ],
                                    ],
                                    // </Page404>
                                ]
                            ]
                        ],
                        // </TraversalPages>

                        // <Examples>
                        [
                            Melis::PRIMARY_KEY => 'tree_page_id',
                            'tree_page_id' => Melis::CURRENT_PAGE_ID,
                            'tree_father_page_id' => Melis::CMS_SITE_ID,
                            'tree_page_order' => 1,
                            Site::THEN => [Site::UPDATE_CURRENT_PAGE_ID],
                            Melis::RELATION => [
                                Melis::CMS_PAGE_PUBLISHED => [
                                    [
                                        Melis::PRIMARY_KEY => 'page_id',
                                        'page_id' => Melis::FOREIGN_KEY,
                                        'page_type' => 'FOLDER',
                                        'page_status' => '0',
                                        'page_menu' => 'NONE',
                                        'page_name' => 'Examples Templates',
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
                                                    'page_name' => 'Drag & Drop',
                                                    'page_tpl_id' => [Site::GET_TEMPLATE_ID => ['template_name' => 'Centered Drag n Drop']],
                                                    'page_content' => '<?xml version="1.0" encoding="UTF-8"?><document type="MelisCMS" author="MelisTechnology" version="2.0"><melisTag id="tag-miniTpl_1580886992" plugin_container_id="" type="html" width_desktop="100" width_tablet="100" width_mobile="100"><![CDATA[<section class="breadcrumb_area" style="z-index: unset !important;"><div class="container"><div class="breadcrumb_content text-center"><h1 class="f_p f_700 f_size_50 w_color l_height50 mb_20">A full page built drag\'n\'drop style</h1><p class="f_400 w_color f_size_16 l_height26">The 3 pages in this folder are all the same. They are built differently though.<br />This one is completely made of drag\'n\'drop plugins, allowing users to be really autonomous. This is the prefered way to build a page but sometimes, other methods can be preffered depending on the needs of the project.<br /><br />Building with drag\'n\'drop plugins is the easiest way for the users as it will help them having blocks with easily maintained HTML zones.<br /><br />The following examples in this page are here to help developpers understand how plugins are built and inserted in a template. It is highly educational on the technical side of Melis Platform.</p></div></div></section>]]></melisTag><melisTag id="tag01_1580887199" plugin_container_id="" type="html" width_desktop="100" width_tablet="100" width_mobile="100"><![CDATA[<h5><strong>Lorem ipsum dolor</strong></h5>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. <br /><br /><h5><strong>Lorem ipsum dolor</strong></h5>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. <br /><br />Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.]]></melisTag><melisTag id="tag01_1580887205" plugin_container_id="" type="textarea" width_desktop="100" width_tablet="100" width_mobile="100"><![CDATA[<span style="color: #2880b9;">Lorem ipsum dolor</span><br />Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.]]></melisTag><melisTag id="tag01_1580887210" plugin_container_id="" type="media" width_desktop="100" width_tablet="0" width_mobile="0"><![CDATA[<center><img src="/MelisDemoCms/img/erp-home/erp_dashboard.jpg" width="1070" height="669" alt="" /></center>]]></melisTag><melisDragDropZone id="centered_dragdrop_html_1" plugin_container_id="" width_desktop="100" width_tablet="100" width_mobile="100"><plugin module="MelisMiniTemplate" name="MiniTemplatePlugin_title-subtitle-centered-with-background-purple_melisdemocms" id="tag-miniTpl_1580886992"/></melisDragDropZone><melisDragDropZone id="centered_dragdrop_html_2" plugin_container_id="" width_desktop="100" width_tablet="100" width_mobile="100"><plugin module="melisfront" name="MelisFrontTagHtmlPlugin" id="tag01_1580887199"/><plugin module="melisfront" name="MelisFrontTagTextareaPlugin" id="tag01_1580887205"/><plugin module="melisfront" name="MelisFrontTagMediaPlugin" id="tag01_1580887210"/><plugin module="meliscmsslider" name="MelisCmsSliderShowSliderPlugin" id="showslider_1580894020"/></melisDragDropZone><melisCmsSlider id="showslider_1580894020" plugin_container_id="" width_desktop="100" width_tablet="100" width_mobile="100"><template_path><![CDATA[MelisDemoCms/plugins/home-carousel-slider]]></template_path><sliderId><![CDATA[1]]></sliderId></melisCmsSlider></document>',

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
                                                    'page_menu' => 'NONE',
                                                    'page_name' => 'Mixed',
                                                    'page_tpl_id' => [Site::GET_TEMPLATE_ID => ['template_name' => 'Mixed Template']],
                                                    'page_content' => '<?xml version="1.0" encoding="UTF-8"?><document type="MelisCMS" author="MelisTechnology" version="2.0"><melisTag id="mixed-html-1" plugin_container_id="" type="html"><![CDATA[<div><h5><strong>Lorem ipsum dolor</strong></h5>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. <br /><br /><h5><strong>Lorem ipsum dolor</strong></h5>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. <br /><br />Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</div>]]></melisTag><melisTag id="mixed-textarea-1" plugin_container_id="" type="textarea"><![CDATA[<span style="color: #2880b9;">Lorem ipsum dolor</span><br />Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.]]></melisTag><melisTag id="mixed-media-1" plugin_container_id="" type="media"><![CDATA[<center><img src="/MelisDemoCms/img/erp-home/erp_dashboard.jpg" alt="" /></center>]]></melisTag><melisTag id="tag-miniTpl_1580276369" plugin_container_id="" type="html"><![CDATA[<section class="breadcrumb_area" style="z-index: unset !important;"><div class="container"><div class="breadcrumb_content text-center"><h1 class="f_p f_700 f_size_50 w_color l_height50 mb_20">A full page built with mixed methods: drag\'n\'drop and static plugins.</h1><p class="f_400 w_color f_size_16 l_height26">The 3 pages in this folder are all the same. They are built differently though.<br />This one is&nbsp; made of drag\'n\'drop plugins and static plugins, allowing users to be autonomous but at the same time, defining zones where the plugins can\'t be moved or deleted, avoiding the users to make predictable mistake. On the opposite, in dra\'n\'drop zone, they\'re free to do what they want.<br /><br />The following examples in this page are here to help developpers understand how plugins and drag\'n\'drop zones are built and inserted in a template. It is highly educational on the technical side of Melis Platform.</p></div></div></section>]]></melisTag><melisDragDropZone id="dragdropzone_mixed_template_1" plugin_container_id="" width_desktop="100" width_tablet="100" width_mobile="100"><plugin module="MelisMiniTemplate" name="MiniTemplatePlugin_title-subtitle-centered-with-background-purple_melisdemocms" id="tag-miniTpl_1580276369"/></melisDragDropZone><melisDragDropZone id="dragdropzone_mixed_template_2" plugin_container_id="" width_desktop="100" width_tablet="100" width_mobile="100"><plugin module="meliscmsslider" name="MelisCmsSliderShowSliderPlugin" id="showslider_1580894138"/></melisDragDropZone><melisCmsSlider id="showslider_1580894138" plugin_container_id="" width_desktop="100" width_tablet="100" width_mobile="100"><template_path><![CDATA[MelisDemoCms/plugins/home-carousel-slider]]></template_path><sliderId><![CDATA[1]]></sliderId></melisCmsSlider></document>',

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
                                    [
                                        Melis::PRIMARY_KEY => 'tree_page_id',
                                        'tree_page_id' => Melis::CURRENT_PAGE_ID,
                                        'tree_father_page_id' => Melis::FOREIGN_KEY,
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
                                                    'page_name' => 'Static',
                                                    'page_tpl_id' => [Site::GET_TEMPLATE_ID => ['template_name' => 'Static Template']],
                                                    'page_content' => '<?xml version="1.0" encoding="UTF-8"?><document type="MelisCMS" author="MelisTechnology" version="2.0"><melisTag id="static-html-1" plugin_container_id="" type="html"><![CDATA[<section class="breadcrumb_area" style="z-index: unset !important;"><div class="container"><div class="breadcrumb_content text-center"><h1 class="f_p f_700 f_size_50 w_color l_height50 mb_20">A full page built with static plugins.</h1><p class="f_400 w_color f_size_16 l_height26">The 3 pages in this folder are all the same. They are built differently though.<br />This one is completely made of static plugins, not allowing users to move or remove the plugins, but only to configure them.&nbsp;<br /><br />Building with static plugins is not the best way to make users happy and confortable but it is sometimes necessary when wanting to avoid problems, giving too much power to users or preventing them from destroying a global page\'s design.<br /><br />The following examples in this page are here to help developpers understand how plugins are built and inserted in a template. It is highly educational on the technical side of Melis Platform.</p></div></div></section>]]></melisTag><melisTag id="mixed-html-1" plugin_container_id="" type="html"><![CDATA[<div><h5><strong>Lorem ipsum dolor</strong></h5>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. <br /><br /><h5><strong>Lorem ipsum dolor</strong></h5>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. <br /><br />Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</div>]]></melisTag><melisTag id="mixed-textarea-1" plugin_container_id="" type="textarea"><![CDATA[<span style="color: #2880b9;">Lorem ipsum dolor</span><br />Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.]]></melisTag><melisTag id="mixed-media-1" plugin_container_id="" type="media"><![CDATA[<center><img src="/MelisDemoCms/img/erp-home/erp_dashboard.jpg" alt="" /></center>]]></melisTag></document>',

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
                                ]
                                // </Drag & Drop>
                            ],
                        ],
                        // </Examples>
                    ],
                    // </editor-fold>

                    // <editor-fold desc="CMS_NEWS">
                    Melis::CMS_NEWS => [
                        [
                            'cnews_status' => '1',
                            'cnews_image1' => '/' . __NAMESPACE__ . '/img/news/blog-grid1.jpg',
                            'cnews_site_id' => Melis::CMS_SITE_ID,
                            'cnews_publish_date' => date('Y-m-d h:i:s',strtotime('2018-05-03')),
                            Melis::RELATION => [
                                Melis::CMS_NEWS_TEXTS => [
                                    [
                                        'cnews_title' => 'Why I say old chap that is.',
                                        'cnews_subtitle' => 'Cras chinwag brown bread Eaton cracking goal so I said a load of old tosh baking cakes.!',
                                        'cnews_paragraph1' => 'Why I say old chap that is, spiffing jolly good a load of old tosh spend a penny tosser arse over tit, excuse my French owt to do with me up the kyver matie boy at public school. Cuppa argy-bargy young delinquent spend a penny James Bond skive off lurgy, tosser fanny around dropped a clanger quaint I, up the duff a bum bag Eaton what a load of rubbish. Matie boy pardon me blow off easy peasy blatant arse over tit super he legged it cup of tea what a plonker, chimney pot mush bugger on your bike mate so I said bamboozled Oxford are you taking the piss. Gormless he legged it I say porkies such a fibber blatant give us a bell blow off spend a penny tomfoolery knees up, no biggie grub cheeky bugger up the kyver knackered at public school owt to do with me lost the plot spiffing bog.',
                                        'cnews_paragraph2' => 'Cras mush pardon you knees up he lost his bottle it\'s all gone to pot faff about porkies arse, barney argy-bargy cracking goal loo cheers spend a penny bugger all mate in my flat, hunky-dory well get stuffed mate David morish bender lavatory. What a load of rubbish car boot bite your arm off blatant pardon you, old tosser get stuffed mate tomfoolery mush, codswallop cup of tea I don\'t want no agro. Off his nut show off show off pick your nose and blow.!',
                                        'cnews_paragraph3' => 'Bloke cracking goal the full monty get stuffed mate posh wellies fantastic knackered tickety-boo Harry porkies, mush excuse my French bender down the pub Oxford bum bag gutted mate car boot pukka loo it\'s your round, cor blimey guvnor is on your bike mate cup of char some dodgy chav blag happy days nancy boy hotpot.',
                                        'cnews_paragraph4' => 'Cras chinwag brown bread Eaton cracking goal so I said a load of old tosh baking cakes, geeza arse it\'s your round grub sloshed burke, my good sir chancer he legged it he lost his bottle pear shaped bugger all mate. Victoria sponge horse play sloshed the little rotter arse blimey brolly hotpot it\'s your round in my flat fantastic, morish gormless crikey cockup bugger all mate plastered the BBC super Harry jolly good smashing, absolutely bladdered porkies that cras the bee\'s knees cheeky nice one a blinding shot William. Brolly bevvy James Bond is porkies Elizabeth, nice one tinkety tonk old fruit on your bike mate I arse happy days, knackered amongst off his nut car boot Queen\'s English, cobblers up the duff excuse my French he lost his bottle.',
                                        'cnews_lang_id' => '1',
                                        'cnews_id' => Melis::FOREIGN_KEY,
                                    ],
                                ],
                            ]
                        ],
                        [
                            'cnews_status' => '1',
                            'cnews_image1' => '/' . __NAMESPACE__ . '/img/news/blog-grid2_1.jpg',
                            'cnews_site_id' => Melis::CMS_SITE_ID,
                            'cnews_publish_date' =>  date('Y-m-d h:i:s',strtotime('2018-07-03')),
                            Melis::RELATION => [
                                Melis::CMS_NEWS_TEXTS => [
                                    [
                                        'cnews_title' => 'Bloke cracking goal the full.',
                                        'cnews_subtitle' => 'Cras chinwag brown bread Eaton cracking goal so I said a load of old tosh baking cakes.!',
                                        'cnews_paragraph1' => 'Why I say old chap that is, spiffing jolly good a load of old tosh spend a penny tosser arse over tit, excuse my French owt to do with me up the kyver matie boy at public school. Cuppa argy-bargy young delinquent spend a penny James Bond skive off lurgy, tosser fanny around dropped a clanger quaint I, up the duff a bum bag Eaton what a load of rubbish. Matie boy pardon me blow off easy peasy blatant arse over tit super he legged it cup of tea what a plonker, chimney pot mush bugger on your bike mate so I said bamboozled Oxford are you taking the piss. Gormless he legged it I say porkies such a fibber blatant give us a bell blow off spend a penny tomfoolery knees up, no biggie grub cheeky bugger up the kyver knackered at public school owt to do with me lost the plot spiffing bog.',
                                        'cnews_paragraph2' => 'Cras mush pardon you knees up he lost his bottle it\'s all gone to pot faff about porkies arse, barney argy-bargy cracking goal loo cheers spend a penny bugger all mate in my flat, hunky-dory well get stuffed mate David morish bender lavatory. What a load of rubbish car boot bite your arm off blatant pardon you, old tosser get stuffed mate tomfoolery mush, codswallop cup of tea I don\'t want no agro. Off his nut show off show off pick your nose and blow.!',
                                        'cnews_paragraph3' => 'Bloke cracking goal the full monty get stuffed mate posh wellies fantastic knackered tickety-boo Harry porkies, mush excuse my French bender down the pub Oxford bum bag gutted mate car boot pukka loo it\'s your round, cor blimey guvnor is on your bike mate cup of char some dodgy chav blag happy days nancy boy hotpot.',
                                        'cnews_paragraph4' => 'Cras chinwag brown bread Eaton cracking goal so I said a load of old tosh baking cakes, geeza arse it\'s your round grub sloshed burke, my good sir chancer he legged it he lost his bottle pear shaped bugger all mate. Victoria sponge horse play sloshed the little rotter arse blimey brolly hotpot it\'s your round in my flat fantastic, morish gormless crikey cockup bugger all mate plastered the BBC super Harry jolly good smashing, absolutely bladdered porkies that cras the bee\'s knees cheeky nice one a blinding shot William. Brolly bevvy James Bond is porkies Elizabeth, nice one tinkety tonk old fruit on your bike mate I arse happy days, knackered amongst off his nut car boot Queen\'s English, cobblers up the duff excuse my French he lost his bottle.',
                                        'cnews_lang_id' => '1',
                                        'cnews_id' => Melis::FOREIGN_KEY,
                                    ]
                                ],
                            ]
                        ],
                        [
                            'cnews_status' => '1',
                            'cnews_image1' => '/' . __NAMESPACE__ . '/img/news/blog-grid3_1.jpg',
                            'cnews_site_id' => Melis::CMS_SITE_ID,
                            'cnews_publish_date' =>  date('Y-m-d h:i:s',strtotime('2018-09-03')),
                            Melis::RELATION => [
                                Melis::CMS_NEWS_TEXTS => [
                                    [
                                        'cnews_title' => 'Oxford bum bag gutted.',
                                        'cnews_subtitle' => 'Cras chinwag brown bread Eaton cracking goal so I said a load of old tosh baking cakes.!',
                                        'cnews_paragraph1' => 'Why I say old chap that is, spiffing jolly good a load of old tosh spend a penny tosser arse over tit, excuse my French owt to do with me up the kyver matie boy at public school. Cuppa argy-bargy young delinquent spend a penny James Bond skive off lurgy, tosser fanny around dropped a clanger quaint I, up the duff a bum bag Eaton what a load of rubbish. Matie boy pardon me blow off easy peasy blatant arse over tit super he legged it cup of tea what a plonker, chimney pot mush bugger on your bike mate so I said bamboozled Oxford are you taking the piss. Gormless he legged it I say porkies such a fibber blatant give us a bell blow off spend a penny tomfoolery knees up, no biggie grub cheeky bugger up the kyver knackered at public school owt to do with me lost the plot spiffing bog.',
                                        'cnews_paragraph2' => 'Cras mush pardon you knees up he lost his bottle it\'s all gone to pot faff about porkies arse, barney argy-bargy cracking goal loo cheers spend a penny bugger all mate in my flat, hunky-dory well get stuffed mate David morish bender lavatory. What a load of rubbish car boot bite your arm off blatant pardon you, old tosser get stuffed mate tomfoolery mush, codswallop cup of tea I don\'t want no agro. Off his nut show off show off pick your nose and blow.!',
                                        'cnews_paragraph3' => 'Bloke cracking goal the full monty get stuffed mate posh wellies fantastic knackered tickety-boo Harry porkies, mush excuse my French bender down the pub Oxford bum bag gutted mate car boot pukka loo it\'s your round, cor blimey guvnor is on your bike mate cup of char some dodgy chav blag happy days nancy boy hotpot.',
                                        'cnews_paragraph4' => 'Cras chinwag brown bread Eaton cracking goal so I said a load of old tosh baking cakes, geeza arse it\'s your round grub sloshed burke, my good sir chancer he legged it he lost his bottle pear shaped bugger all mate. Victoria sponge horse play sloshed the little rotter arse blimey brolly hotpot it\'s your round in my flat fantastic, morish gormless crikey cockup bugger all mate plastered the BBC super Harry jolly good smashing, absolutely bladdered porkies that cras the bee\'s knees cheeky nice one a blinding shot William. Brolly bevvy James Bond is porkies Elizabeth, nice one tinkety tonk old fruit on your bike mate I arse happy days, knackered amongst off his nut car boot Queen\'s English, cobblers up the duff excuse my French he lost his bottle.',
                                        'cnews_lang_id' => '1',
                                        'cnews_id' => Melis::FOREIGN_KEY,
                                    ]
                                ],
                            ]
                        ],
                        [
                            'cnews_status' => '1',
                            'cnews_image1' => '/' . __NAMESPACE__ . '/img/news/blog-grid4_1.jpg',
                            'cnews_site_id' => Melis::CMS_SITE_ID,
                            'cnews_publish_date' =>  date('Y-m-d h:i:s',strtotime('2019-10-03')),
                            Melis::RELATION => [
                                Melis::CMS_NEWS_TEXTS => [
                                    [
                                        'cnews_title' => 'Victoria sponge horse play.',
                                        'cnews_subtitle' => 'Cras chinwag brown bread Eaton cracking goal so I said a load of old tosh baking cakes.!',
                                        'cnews_paragraph1' => 'Why I say old chap that is, spiffing jolly good a load of old tosh spend a penny tosser arse over tit, excuse my French owt to do with me up the kyver matie boy at public school. Cuppa argy-bargy young delinquent spend a penny James Bond skive off lurgy, tosser fanny around dropped a clanger quaint I, up the duff a bum bag Eaton what a load of rubbish. Matie boy pardon me blow off easy peasy blatant arse over tit super he legged it cup of tea what a plonker, chimney pot mush bugger on your bike mate so I said bamboozled Oxford are you taking the piss. Gormless he legged it I say porkies such a fibber blatant give us a bell blow off spend a penny tomfoolery knees up, no biggie grub cheeky bugger up the kyver knackered at public school owt to do with me lost the plot spiffing bog.',
                                        'cnews_paragraph2' => 'Cras mush pardon you knees up he lost his bottle it\'s all gone to pot faff about porkies arse, barney argy-bargy cracking goal loo cheers spend a penny bugger all mate in my flat, hunky-dory well get stuffed mate David morish bender lavatory. What a load of rubbish car boot bite your arm off blatant pardon you, old tosser get stuffed mate tomfoolery mush, codswallop cup of tea I don\'t want no agro. Off his nut show off show off pick your nose and blow.!',
                                        'cnews_paragraph3' => 'Bloke cracking goal the full monty get stuffed mate posh wellies fantastic knackered tickety-boo Harry porkies, mush excuse my French bender down the pub Oxford bum bag gutted mate car boot pukka loo it\'s your round, cor blimey guvnor is on your bike mate cup of char some dodgy chav blag happy days nancy boy hotpot.',
                                        'cnews_paragraph4' => 'Cras chinwag brown bread Eaton cracking goal so I said a load of old tosh baking cakes, geeza arse it\'s your round grub sloshed burke, my good sir chancer he legged it he lost his bottle pear shaped bugger all mate. Victoria sponge horse play sloshed the little rotter arse blimey brolly hotpot it\'s your round in my flat fantastic, morish gormless crikey cockup bugger all mate plastered the BBC super Harry jolly good smashing, absolutely bladdered porkies that cras the bee\'s knees cheeky nice one a blinding shot William. Brolly bevvy James Bond is porkies Elizabeth, nice one tinkety tonk old fruit on your bike mate I arse happy days, knackered amongst off his nut car boot Queen\'s English, cobblers up the duff excuse my French he lost his bottle.',
                                        'cnews_lang_id' => '1',
                                        'cnews_id' => Melis::FOREIGN_KEY,
                                    ]
                                ],
                            ]
                        ],
                        [
                            'cnews_status' => '1',
                            'cnews_image1' => '/' . __NAMESPACE__ . '/img/news/blog-grid5_1.jpg',
                            'cnews_site_id' => Melis::CMS_SITE_ID,
                            'cnews_publish_date' =>  date('Y-m-d h:i:s',strtotime('2019-12-03')),
                            Melis::RELATION => [
                                Melis::CMS_NEWS_TEXTS => [
                                    [
                                        'cnews_title' => 'Why I say old chap that is.',
                                        'cnews_subtitle' => 'Cras chinwag brown bread Eaton cracking goal so I said a load of old tosh baking cakes.!',
                                        'cnews_paragraph1' => 'Why I say old chap that is, spiffing jolly good a load of old tosh spend a penny tosser arse over tit, excuse my French owt to do with me up the kyver matie boy at public school. Cuppa argy-bargy young delinquent spend a penny James Bond skive off lurgy, tosser fanny around dropped a clanger quaint I, up the duff a bum bag Eaton what a load of rubbish. Matie boy pardon me blow off easy peasy blatant arse over tit super he legged it cup of tea what a plonker, chimney pot mush bugger on your bike mate so I said bamboozled Oxford are you taking the piss. Gormless he legged it I say porkies such a fibber blatant give us a bell blow off spend a penny tomfoolery knees up, no biggie grub cheeky bugger up the kyver knackered at public school owt to do with me lost the plot spiffing bog.',
                                        'cnews_paragraph2' => 'Cras mush pardon you knees up he lost his bottle it\'s all gone to pot faff about porkies arse, barney argy-bargy cracking goal loo cheers spend a penny bugger all mate in my flat, hunky-dory well get stuffed mate David morish bender lavatory. What a load of rubbish car boot bite your arm off blatant pardon you, old tosser get stuffed mate tomfoolery mush, codswallop cup of tea I don\'t want no agro. Off his nut show off show off pick your nose and blow.!',
                                        'cnews_paragraph3' => 'Bloke cracking goal the full monty get stuffed mate posh wellies fantastic knackered tickety-boo Harry porkies, mush excuse my French bender down the pub Oxford bum bag gutted mate car boot pukka loo it\'s your round, cor blimey guvnor is on your bike mate cup of char some dodgy chav blag happy days nancy boy hotpot.',
                                        'cnews_paragraph4' => 'Cras chinwag brown bread Eaton cracking goal so I said a load of old tosh baking cakes, geeza arse it\'s your round grub sloshed burke, my good sir chancer he legged it he lost his bottle pear shaped bugger all mate. Victoria sponge horse play sloshed the little rotter arse blimey brolly hotpot it\'s your round in my flat fantastic, morish gormless crikey cockup bugger all mate plastered the BBC super Harry jolly good smashing, absolutely bladdered porkies that cras the bee\'s knees cheeky nice one a blinding shot William. Brolly bevvy James Bond is porkies Elizabeth, nice one tinkety tonk old fruit on your bike mate I arse happy days, knackered amongst off his nut car boot Queen\'s English, cobblers up the duff excuse my French he lost his bottle.',
                                        'cnews_lang_id' => '1',
                                        'cnews_id' => Melis::FOREIGN_KEY,
                                    ]
                                ],
                            ]
                        ],
                        [
                            'cnews_status' => '1',
                            'cnews_image1' => '/' . __NAMESPACE__ . '/img/news/blog-grid6.jpg',
                            'cnews_site_id' => Melis::CMS_SITE_ID,
                            'cnews_publish_date' => date('Y-m-d h:i:s',strtotime('2019-12-25')),
                            Melis::RELATION => [
                                Melis::CMS_NEWS_TEXTS => [
                                    [
                                        'cnews_title' => 'Bloke cracking goal the full.',
                                        'cnews_subtitle' => 'Cras chinwag brown bread Eaton cracking goal so I said a load of old tosh baking cakes.!',
                                        'cnews_paragraph1' => 'Why I say old chap that is, spiffing jolly good a load of old tosh spend a penny tosser arse over tit, excuse my French owt to do with me up the kyver matie boy at public school. Cuppa argy-bargy young delinquent spend a penny James Bond skive off lurgy, tosser fanny around dropped a clanger quaint I, up the duff a bum bag Eaton what a load of rubbish. Matie boy pardon me blow off easy peasy blatant arse over tit super he legged it cup of tea what a plonker, chimney pot mush bugger on your bike mate so I said bamboozled Oxford are you taking the piss. Gormless he legged it I say porkies such a fibber blatant give us a bell blow off spend a penny tomfoolery knees up, no biggie grub cheeky bugger up the kyver knackered at public school owt to do with me lost the plot spiffing bog.',
                                        'cnews_paragraph2' => 'Cras mush pardon you knees up he lost his bottle it\'s all gone to pot faff about porkies arse, barney argy-bargy cracking goal loo cheers spend a penny bugger all mate in my flat, hunky-dory well get stuffed mate David morish bender lavatory. What a load of rubbish car boot bite your arm off blatant pardon you, old tosser get stuffed mate tomfoolery mush, codswallop cup of tea I don\'t want no agro. Off his nut show off show off pick your nose and blow.!',
                                        'cnews_paragraph3' => 'Bloke cracking goal the full monty get stuffed mate posh wellies fantastic knackered tickety-boo Harry porkies, mush excuse my French bender down the pub Oxford bum bag gutted mate car boot pukka loo it\'s your round, cor blimey guvnor is on your bike mate cup of char some dodgy chav blag happy days nancy boy hotpot.',
                                        'cnews_paragraph4' => 'Cras chinwag brown bread Eaton cracking goal so I said a load of old tosh baking cakes, geeza arse it\'s your round grub sloshed burke, my good sir chancer he legged it he lost his bottle pear shaped bugger all mate. Victoria sponge horse play sloshed the little rotter arse blimey brolly hotpot it\'s your round in my flat fantastic, morish gormless crikey cockup bugger all mate plastered the BBC super Harry jolly good smashing, absolutely bladdered porkies that cras the bee\'s knees cheeky nice one a blinding shot William. Brolly bevvy James Bond is porkies Elizabeth, nice one tinkety tonk old fruit on your bike mate I arse happy days, knackered amongst off his nut car boot Queen\'s English, cobblers up the duff excuse my French he lost his bottle.',
                                        'cnews_lang_id' => '1',
                                        'cnews_id' => Melis::FOREIGN_KEY,
                                    ]
                                ],
                            ]
                        ],
                        [
                            'cnews_status' => '1',
                            'cnews_image1' => '/' . __NAMESPACE__ . '/img/news/blog-grid7.jpg',
                            'cnews_site_id' => Melis::CMS_SITE_ID,
                            'cnews_publish_date' => date('Y-m-d h:i:s',strtotime('2019-12-27')),
                            Melis::RELATION => [
                                Melis::CMS_NEWS_TEXTS => [
                                    [
                                        'cnews_title' => 'Oxford bum bag gutted.',
                                        'cnews_subtitle' => 'Cras chinwag brown bread Eaton cracking goal so I said a load of old tosh baking cakes.!',
                                        'cnews_paragraph1' => 'Why I say old chap that is, spiffing jolly good a load of old tosh spend a penny tosser arse over tit, excuse my French owt to do with me up the kyver matie boy at public school. Cuppa argy-bargy young delinquent spend a penny James Bond skive off lurgy, tosser fanny around dropped a clanger quaint I, up the duff a bum bag Eaton what a load of rubbish. Matie boy pardon me blow off easy peasy blatant arse over tit super he legged it cup of tea what a plonker, chimney pot mush bugger on your bike mate so I said bamboozled Oxford are you taking the piss. Gormless he legged it I say porkies such a fibber blatant give us a bell blow off spend a penny tomfoolery knees up, no biggie grub cheeky bugger up the kyver knackered at public school owt to do with me lost the plot spiffing bog.',
                                        'cnews_paragraph2' => 'Cras mush pardon you knees up he lost his bottle it\'s all gone to pot faff about porkies arse, barney argy-bargy cracking goal loo cheers spend a penny bugger all mate in my flat, hunky-dory well get stuffed mate David morish bender lavatory. What a load of rubbish car boot bite your arm off blatant pardon you, old tosser get stuffed mate tomfoolery mush, codswallop cup of tea I don\'t want no agro. Off his nut show off show off pick your nose and blow.!',
                                        'cnews_paragraph3' => 'Bloke cracking goal the full monty get stuffed mate posh wellies fantastic knackered tickety-boo Harry porkies, mush excuse my French bender down the pub Oxford bum bag gutted mate car boot pukka loo it\'s your round, cor blimey guvnor is on your bike mate cup of char some dodgy chav blag happy days nancy boy hotpot.',
                                        'cnews_paragraph4' => 'Cras chinwag brown bread Eaton cracking goal so I said a load of old tosh baking cakes, geeza arse it\'s your round grub sloshed burke, my good sir chancer he legged it he lost his bottle pear shaped bugger all mate. Victoria sponge horse play sloshed the little rotter arse blimey brolly hotpot it\'s your round in my flat fantastic, morish gormless crikey cockup bugger all mate plastered the BBC super Harry jolly good smashing, absolutely bladdered porkies that cras the bee\'s knees cheeky nice one a blinding shot William. Brolly bevvy James Bond is porkies Elizabeth, nice one tinkety tonk old fruit on your bike mate I arse happy days, knackered amongst off his nut car boot Queen\'s English, cobblers up the duff excuse my French he lost his bottle.',
                                        'cnews_lang_id' => '1',
                                        'cnews_id' => Melis::FOREIGN_KEY,
                                    ]
                                ],
                            ]
                        ],
                        [
                            'cnews_status' => '1',
                            'cnews_image1' => '/' . __NAMESPACE__ . '/img/news/blog-grid8_1.jpg',
                            'cnews_site_id' => Melis::CMS_SITE_ID,
                            'cnews_publish_date' => date('Y-m-d h:i:s',strtotime('2020-01-12')),
                            Melis::RELATION => [
                                Melis::CMS_NEWS_TEXTS => [
                                    [
                                        'cnews_title' => 'Victoria sponge horse play.',
                                        'cnews_subtitle' => 'Cras chinwag brown bread Eaton cracking goal so I said a load of old tosh baking cakes.!',
                                        'cnews_paragraph1' => 'Why I say old chap that is, spiffing jolly good a load of old tosh spend a penny tosser arse over tit, excuse my French owt to do with me up the kyver matie boy at public school. Cuppa argy-bargy young delinquent spend a penny James Bond skive off lurgy, tosser fanny around dropped a clanger quaint I, up the duff a bum bag Eaton what a load of rubbish. Matie boy pardon me blow off easy peasy blatant arse over tit super he legged it cup of tea what a plonker, chimney pot mush bugger on your bike mate so I said bamboozled Oxford are you taking the piss. Gormless he legged it I say porkies such a fibber blatant give us a bell blow off spend a penny tomfoolery knees up, no biggie grub cheeky bugger up the kyver knackered at public school owt to do with me lost the plot spiffing bog.',
                                        'cnews_paragraph2' => 'Cras mush pardon you knees up he lost his bottle it\'s all gone to pot faff about porkies arse, barney argy-bargy cracking goal loo cheers spend a penny bugger all mate in my flat, hunky-dory well get stuffed mate David morish bender lavatory. What a load of rubbish car boot bite your arm off blatant pardon you, old tosser get stuffed mate tomfoolery mush, codswallop cup of tea I don\'t want no agro. Off his nut show off show off pick your nose and blow.!',
                                        'cnews_paragraph3' => 'Bloke cracking goal the full monty get stuffed mate posh wellies fantastic knackered tickety-boo Harry porkies, mush excuse my French bender down the pub Oxford bum bag gutted mate car boot pukka loo it\'s your round, cor blimey guvnor is on your bike mate cup of char some dodgy chav blag happy days nancy boy hotpot.',
                                        'cnews_paragraph4' => 'Cras chinwag brown bread Eaton cracking goal so I said a load of old tosh baking cakes, geeza arse it\'s your round grub sloshed burke, my good sir chancer he legged it he lost his bottle pear shaped bugger all mate. Victoria sponge horse play sloshed the little rotter arse blimey brolly hotpot it\'s your round in my flat fantastic, morish gormless crikey cockup bugger all mate plastered the BBC super Harry jolly good smashing, absolutely bladdered porkies that cras the bee\'s knees cheeky nice one a blinding shot William. Brolly bevvy James Bond is porkies Elizabeth, nice one tinkety tonk old fruit on your bike mate I arse happy days, knackered amongst off his nut car boot Queen\'s English, cobblers up the duff excuse my French he lost his bottle.',
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
                            'mcslide_name' => 'Home Slider 1',
                            'mcslide_page_id' => Melis::CMS_SITE_ID,
                            'mcslide_date' => date('Y-m-d H:i:s'),
                            Melis::RELATION => [
                                Melis::CMS_SLIDER_DETAILS => [
                                    [
                                        'mcsdetail_mcslider_id' => Melis::FOREIGN_KEY,
                                        'mcsdetail_status' => 1,
                                        'mcsdetail_img' => '/' . __NAMESPACE__ . '/img/sliders/1/slider-home-2_2.jpg',
                                        'mcsdetail_order' => 1,
                                    ],
                                    [
                                        'mcsdetail_mcslider_id' => Melis::FOREIGN_KEY,
                                        'mcsdetail_status' => 1,
                                        'mcsdetail_img' => '/' . __NAMESPACE__ . '/img/sliders/1/slider-home-3_2.jpg',
                                        'mcsdetail_order' => 2,
                                    ],
                                    [
                                        'mcsdetail_mcslider_id' => Melis::FOREIGN_KEY,
                                        'mcsdetail_status' => 1,
                                        'mcsdetail_img' => '/' . __NAMESPACE__ . '/img/sliders/1/slider-home-4_2.jpg',
                                        'mcsdetail_order' => 3,
                                    ],
                                    [
                                        'mcsdetail_mcslider_id' => Melis::FOREIGN_KEY,
                                        'mcsdetail_status' => 1,
                                        'mcsdetail_img' => '/' . __NAMESPACE__ . '/img/sliders/1/slider-home-2_2.jpg',
                                        'mcsdetail_order' => 4,
                                    ],
                                    [
                                        'mcsdetail_mcslider_id' => Melis::FOREIGN_KEY,
                                        'mcsdetail_status' => 1,
                                        'mcsdetail_img' => '/' . __NAMESPACE__ . '/img/sliders/1/slider-home-3_2.jpg',
                                        'mcsdetail_order' => 5,
                                    ],
                                    [
                                        'mcsdetail_mcslider_id' => Melis::FOREIGN_KEY,
                                        'mcsdetail_status' => 1,
                                        'mcsdetail_img' => '/' . __NAMESPACE__ . '/img/sliders/1/slider-home-4_2.jpg',
                                        'mcsdetail_order' => 6,
                                    ],
                                ],
                            ],
                        ],
                        [
                            'mcslide_name' => 'Home Slider 2',
                            'mcslide_page_id' =>  1,
                            'mcslide_date' => date('Y-m-d H:i:s'),
                            Melis::RELATION => [
                                Melis::CMS_SLIDER_DETAILS => [
                                    [
                                        'mcsdetail_mcslider_id' => Melis::FOREIGN_KEY,
                                        'mcsdetail_status' => 1,
                                        'mcsdetail_img' => '/' . __NAMESPACE__ . '/img/sliders/2/01.png',
                                        'mcsdetail_order' => 1,
                                    ],
                                    [
                                        'mcsdetail_mcslider_id' => Melis::FOREIGN_KEY,
                                        'mcsdetail_status' => 1,
                                        'mcsdetail_img' => '/' . __NAMESPACE__ . '/img/sliders/2/02.png',
                                        'mcsdetail_order' => 2,
                                    ],
                                    [
                                        'mcsdetail_mcslider_id' => Melis::FOREIGN_KEY,
                                        'mcsdetail_status' => 1,
                                        'mcsdetail_img' => '/' . __NAMESPACE__ . '/img/sliders/2/03.png',
                                        'mcsdetail_order' => 3,
                                    ],
                                    [
                                        'mcsdetail_mcslider_id' => Melis::FOREIGN_KEY,
                                        'mcsdetail_status' => 1,
                                        'mcsdetail_img' => '/' . __NAMESPACE__ . '/img/sliders/2/04.png',
                                        'mcsdetail_order' => 4,
                                    ],
                                    [
                                        'mcsdetail_mcslider_id' => Melis::FOREIGN_KEY,
                                        'mcsdetail_status' => 1,
                                        'mcsdetail_img' => '/' . __NAMESPACE__ . '/img/sliders/2/05.png',
                                        'mcsdetail_order' => 5,
                                    ],
                                    [
                                        'mcsdetail_mcslider_id' => Melis::FOREIGN_KEY,
                                        'mcsdetail_status' => 1,
                                        'mcsdetail_img' => '/' . __NAMESPACE__ . '/img/sliders/2/06.png',
                                        'mcsdetail_order' => 6,
                                    ],
                                    [
                                        'mcsdetail_mcslider_id' => Melis::FOREIGN_KEY,
                                        'mcsdetail_status' => 1,
                                        'mcsdetail_img' => '/' . __NAMESPACE__ . '/img/sliders/2/07.png',
                                        'mcsdetail_order' => 7,
                                    ],
                                    [
                                        'mcsdetail_mcslider_id' => Melis::FOREIGN_KEY,
                                        'mcsdetail_status' => 1,
                                        'mcsdetail_img' => '/' . __NAMESPACE__ . '/img/sliders/2/08.png',
                                        'mcsdetail_order' => 8,
                                    ],
                                    [
                                        'mcsdetail_mcslider_id' => Melis::FOREIGN_KEY,
                                        'mcsdetail_status' => 1,
                                        'mcsdetail_img' => '/' . __NAMESPACE__ . '/img/sliders/2/09.png',
                                        'mcsdetail_order' => 9,
                                    ],
                                    [
                                        'mcsdetail_mcslider_id' => Melis::FOREIGN_KEY,
                                        'mcsdetail_status' => 1,
                                        'mcsdetail_img' => '/' . __NAMESPACE__ . '/img/sliders/2/10.png',
                                        'mcsdetail_order' => 10,
                                    ],
                                    [
                                        'mcsdetail_mcslider_id' => Melis::FOREIGN_KEY,
                                        'mcsdetail_status' => 1,
                                        'mcsdetail_img' => '/' . __NAMESPACE__ . '/img/sliders/2/11.png',
                                        'mcsdetail_order' => 11,
                                    ],
                                    [
                                        'mcsdetail_mcslider_id' => Melis::FOREIGN_KEY,
                                        'mcsdetail_status' => 1,
                                        'mcsdetail_img' => '/' . __NAMESPACE__ . '/img/sliders/2/12.png',
                                        'mcsdetail_order' => 12,
                                    ],
                                    [
                                        'mcsdetail_mcslider_id' => Melis::FOREIGN_KEY,
                                        'mcsdetail_status' => 1,
                                        'mcsdetail_img' => '/' . __NAMESPACE__ . '/img/sliders/2/13.png',
                                        'mcsdetail_order' => 13,
                                    ],
                                    [
                                        'mcsdetail_mcslider_id' => Melis::FOREIGN_KEY,
                                        'mcsdetail_status' => 1,
                                        'mcsdetail_img' => '/' . __NAMESPACE__ . '/img/sliders/2/14.png',
                                        'mcsdetail_order' => 14,
                                    ],
                                    [
                                        'mcsdetail_mcslider_id' => Melis::FOREIGN_KEY,
                                        'mcsdetail_status' => 1,
                                        'mcsdetail_img' => '/' . __NAMESPACE__ . '/img/sliders/2/15.png',
                                        'mcsdetail_order' => 15,
                                    ],
                                    [
                                        'mcsdetail_mcslider_id' => Melis::FOREIGN_KEY,
                                        'mcsdetail_status' => 1,
                                        'mcsdetail_img' => '/' . __NAMESPACE__ . '/img/sliders/2/16.png',
                                        'mcsdetail_order' => 16,
                                    ],
                                    [
                                        'mcsdetail_mcslider_id' => Melis::FOREIGN_KEY,
                                        'mcsdetail_status' => 1,
                                        'mcsdetail_img' => '/' . __NAMESPACE__ . '/img/sliders/2/17.png',
                                        'mcsdetail_order' => 17,
                                    ],
                                    [
                                        'mcsdetail_mcslider_id' => Melis::FOREIGN_KEY,
                                        'mcsdetail_status' => 1,
                                        'mcsdetail_img' => '/' . __NAMESPACE__ . '/img/sliders/2/18.png',
                                        'mcsdetail_order' => 18,
                                    ],
                                    [
                                        'mcsdetail_mcslider_id' => Melis::FOREIGN_KEY,
                                        'mcsdetail_status' => 1,
                                        'mcsdetail_img' => '/' . __NAMESPACE__ . '/img/sliders/2/19.png',
                                        'mcsdetail_order' => 19,
                                    ],
                                    [
                                        'mcsdetail_mcslider_id' => Melis::FOREIGN_KEY,
                                        'mcsdetail_status' => 1,
                                        'mcsdetail_img' => '/' . __NAMESPACE__ . '/img/sliders/2/20.png',
                                        'mcsdetail_order' => 20,
                                    ],
                                ],
                            ],
                        ],
                        [
                            'mcslide_name' => 'Team Slider 1',
                            'mcslide_page_id' => Melis::CMS_SITE_ID,
                            'mcslide_date' => date('Y-m-d H:i:s'),
                            Melis::RELATION => [
                                Melis::CMS_SLIDER_DETAILS => [
                                    [
                                        'mcsdetail_mcslider_id' => Melis::FOREIGN_KEY,
                                        'mcsdetail_status' => 1,
                                        'mcsdetail_title' => 'Phillip Anthropy',
                                        'mcsdetail_sub1' => 'Web designer',
                                        'mcsdetail_img' => '/' . __NAMESPACE__ . '/img/sliders/3/team_01_12.jpg',
                                        'mcsdetail_order' => 1,
                                    ],
                                    [
                                        'mcsdetail_mcslider_id' => Melis::FOREIGN_KEY,
                                        'mcsdetail_status' => 1,
                                        'mcsdetail_title' => 'Gordon Norman',
                                        'mcsdetail_sub1' => 'UI/UX designer',
                                        'mcsdetail_img' => '/' . __NAMESPACE__ . '/img/sliders/3/team_02.jpg',
                                        'mcsdetail_order' => 2,
                                    ],
                                    [
                                        'mcsdetail_mcslider_id' => Melis::FOREIGN_KEY,
                                        'mcsdetail_status' => 1,
                                        'mcsdetail_title' => 'Dylan Merinque',
                                        'mcsdetail_sub1' => 'Web designer',
                                        'mcsdetail_img' => '/' . __NAMESPACE__ . '/img/sliders/3/team_03.jpg',
                                        'mcsdetail_order' => 3,
                                    ],
                                    [
                                        'mcsdetail_mcslider_id' => Melis::FOREIGN_KEY,
                                        'mcsdetail_status' => 1,
                                        'mcsdetail_title' => 'Bailey Wonger',
                                        'mcsdetail_sub1' => 'Marketer',
                                        'mcsdetail_img' => '/' . __NAMESPACE__ . '/img/sliders/3/team_04.jpg',
                                        'mcsdetail_order' => 4,
                                    ],
                                    [
                                        'mcsdetail_mcslider_id' => Melis::FOREIGN_KEY,
                                        'mcsdetail_status' => 1,
                                        'mcsdetail_title' => 'Bailey Wonger',
                                        'mcsdetail_sub1' => 'Sumo founder',
                                        'mcsdetail_img' => '/' . __NAMESPACE__ . '/img/sliders/3/team_04-2.jpg',
                                        'mcsdetail_order' => 5,
                                    ],
                                    [
                                        'mcsdetail_mcslider_id' => Melis::FOREIGN_KEY,
                                        'mcsdetail_status' => 1,
                                        'mcsdetail_title' => 'Giles Posture',
                                        'mcsdetail_sub1' => 'App designer',
                                        'mcsdetail_img' => '/' . __NAMESPACE__ . '/img/sliders/3/team_5.jpg',
                                        'mcsdetail_order' => 6,
                                    ],
                                    [
                                        'mcsdetail_mcslider_id' => Melis::FOREIGN_KEY,
                                        'mcsdetail_status' => 1,
                                        'mcsdetail_title' => 'Rodney Artichoke',
                                        'mcsdetail_sub1' => 'UI/UX designer',
                                        'mcsdetail_img' => '/' . __NAMESPACE__ . '/img/sliders/3/team_6.jpg',
                                        'mcsdetail_order' => 7,
                                    ],
                                    [
                                        'mcsdetail_mcslider_id' => Melis::FOREIGN_KEY,
                                        'mcsdetail_status' => 1,
                                        'mcsdetail_title' => 'Jackson Pot',
                                        'mcsdetail_sub1' => 'Marketer',
                                        'mcsdetail_img' => '/' . __NAMESPACE__ . '/img/sliders/3/team_7.jpg',
                                        'mcsdetail_order' => 8,
                                    ],
                                    [
                                        'mcsdetail_mcslider_id' => Melis::FOREIGN_KEY,
                                        'mcsdetail_status' => 1,
                                        'mcsdetail_title' => 'Max Conversion',
                                        'mcsdetail_sub1' => 'Social marketer',
                                        'mcsdetail_img' => '/' . __NAMESPACE__ . '/img/sliders/3/team_8.jpg',
                                        'mcsdetail_order' => 9,
                                    ],
                                    [
                                        'mcsdetail_mcslider_id' => Melis::FOREIGN_KEY,
                                        'mcsdetail_status' => 1,
                                        'mcsdetail_title' => 'Jake Weary',
                                        'mcsdetail_sub1' => 'Web designer',
                                        'mcsdetail_img' => '/' . __NAMESPACE__ . '/img/sliders/3/team_10.jpg',
                                        'mcsdetail_order' => 10,
                                    ],
                                    [
                                        'mcsdetail_mcslider_id' => Melis::FOREIGN_KEY,
                                        'mcsdetail_status' => 1,
                                        'mcsdetail_title' => 'Justin Case',
                                        'mcsdetail_sub1' => 'UX designer',
                                        'mcsdetail_img' => '/' . __NAMESPACE__ . '/img/sliders/3/team_12.jpg',
                                        'mcsdetail_order' => 11,
                                    ],
                                    [
                                        'mcsdetail_mcslider_id' => Melis::FOREIGN_KEY,
                                        'mcsdetail_status' => 1,
                                        'mcsdetail_title' => 'Norman Gordon',
                                        'mcsdetail_sub1' => 'Web developer',
                                        'mcsdetail_img' => '/' . __NAMESPACE__ . '/img/sliders/3/team_13.jpg',
                                        'mcsdetail_order' => 12,
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
                            'mcgdpr_text_value' => 'The text of this banner is administrable from the Back Office in Melis Core > Administration > GDPR > Banners.',
                        ],
                    ],
                    // </editor-fold>
                ],
            ],
        ],
    ],
];