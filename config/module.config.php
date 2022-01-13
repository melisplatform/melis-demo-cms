<?php
/**
 * Laminas Framework (http://framework.Laminas.com/)
 *
 * @link      http://github.com/Laminasframework/LaminasSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Laminas Technologies USA Inc. (http://www.Laminas.com)
 * @license   http://framework.Laminas.com/license/new-bsd New BSD License
 */

return [
    'router' => [
        'routes' => [
            'MelisDemoCms-home' => [
                'type'    => 'regex',
                'options' => [
                    'regex'    => '.*/MelisDemoCms/.*/id/(?<idpage>[0-9]+)',
                    'defaults' => [
                        'controller' => 'MelisDemoCms\Controller\Index',
                        'action'     => 'indexsite',
                    ],
                    'spec' => '%idpage'
                ]
            ],
            'MelisDemoCms-homepage' => [
                'type'    => 'Literal',
                'options' => [
                    'route'    => '/',
                    'defaults' => [
                        'controller'     => 'MelisFront\Controller\Index',
                        'action'         => 'index',
                        'renderType'     => 'melis_zf2_mvc',
                        'renderMode'     => 'front',
                        'preview'        => false,
                        'idpage'         => '%site_home_page_id%',
                    ]
                ],
            ],
            // The following is a route to simplify getting started creating
            // new controllers and actions without needing to create a new
            // module. Simply drop new controllers in, and you can access them
            // using the path /application/:controller/:action
            'applicationMelisDemoCms' => [
                'type'    => 'Literal',
                'options' => [
                    'route'    => '/MelisDemoCms',
                    'defaults' => [
                        '__NAMESPACE__' => 'MelisDemoCms\Controller',
                        'controller'    => 'Index',
                        'action'        => 'indexsite',
                    ],
                ],
                'may_terminate' => true,
                'child_routes' => [
                    'default' => [
                        'type'    => 'Segment',
                        'options' => [
                            'route'    => '/[:controller[/:action]]',
                            'constraints' => [
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                            ],
                            'defaults' => [
                            ],
                        ],
                    ],
                    'setup' => [
                        'type' => 'Segment',
                        'options' => [
                            'route' => '/setup',
                            'defaults' => [
                                'controller' => 'MelisDemoCms\Controller\MelisSetup',
                                'action' => 'setupForm',
                            ],
                        ],
                    ],
                ],
            ],
            'melis-backoffice' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/melis[/]',
                ],
                'child_routes' => [
                    'application-MelisDemoCms' => [
                        'type' => 'Literal',
                        'options' => [
                            'route' => 'MelisDemoCms',
                            'defaults' => [
                                '__NAMESPACE__' => 'MelisDemoCms\Controller',
                            ],
                        ],
                        'may_terminate' => true,
                        'child_routes' => [
                            'default' => [
                                'type' => 'Segment',
                                'options' => [
                                    'route' => '/[:controller[/:action]]',
                                    'constraints' => [
                                        'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                    ],
                                    'defaults' => [
                                        '__NAMESPACE__' => 'MelisDemoCms\Controller',
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
            ],
        ],
    ],
    'service_manager' => [
        'aliases' => [
            // Table
            'MelisPlatformTable' => \MelisDemoCms\Model\Tables\MelisPlatformTable::class,
            // Service
            'DemoCmsService' => \MelisDemoCms\Service\DemoCmsService::class,
        ],
    ],
    'translator' => [],
    'controllers' => [
        'invokables' => [
            'MelisDemoCms\Controller\Home' => MelisDemoCms\Controller\HomeController::class,
            'MelisDemoCms\Controller\Page404' => MelisDemoCms\Controller\Page404Controller::class,
            'MelisDemoCms\Controller\News' => MelisDemoCms\Controller\NewsController::class,
            'MelisDemoCms\Controller\Team' => MelisDemoCms\Controller\TeamController::class,
            'MelisDemoCms\Controller\Services' => MelisDemoCms\Controller\ServicesController::class,
            'MelisDemoCms\Controller\DragDrop' => MelisDemoCms\Controller\DragDropController::class,
            'MelisDemoCms\Controller\Faq' => MelisDemoCms\Controller\FaqController::class,
            'MelisDemoCms\Controller\Contact' => MelisDemoCms\Controller\ContactController::class,
            // @TODO change to elastic search
//            'MelisDemoCms\Controller\Search' => MelisDemoCms\Controller\SearchController::class,
            'MelisDemoCms\Controller\Testimonial' => MelisDemoCms\Controller\TestimonialController::class,
            'MelisDemoCms\Controller\Template' => MelisDemoCms\Controller\TemplateController::class,
            'MelisDemoCms\Controller\MelisSetupPostDownload' => \MelisDemoCms\Controller\MelisSetupPostDownloadController::class,
            'MelisDemoCms\Controller\MelisSetupPostUpdate' => \MelisDemoCms\Controller\MelisSetupPostUpdateController::class,
        ],
    ],
    'view_manager' => [
        'doctype' => 'HTML5',
        'not_found_template' => 'error/404',
        'exception_template' => 'error/index',
        'controller_map' => [
            'MelisDemoCms' => true,
        ],
        'template_map' => [
            'MelisDemoCms/defaultLayout' => __DIR__ . '/../view/layout/defaultLayout.phtml',
            'layout/errorLayout' => __DIR__ . '/../view/error/404.phtml',
            'MelisDemoCms/plugins/menu' => __DIR__ . '/../view/plugins/menu.phtml',
            'MelisDemoCms/plugins/white-menu' => __DIR__ . '/../view/plugins/white-menu.phtml',
            'MelisDemoCms/plugins/footer-menu' => __DIR__ . '/../view/plugins/footer-menu.phtml',
            'MelisDemoCms/plugins/home-carousel-slider' => __DIR__ . '/../view/plugins/home-carousel-slider.phtml',
            'MelisDemoCms/plugins/home-slider2' => __DIR__ . '/../view/plugins/home-slider2.phtml',
            'MelisDemoCms/plugins/home-testimonial-slider' => __DIR__ . '/../view/plugins/home-testimonial-slider.phtml',
            'MelisDemoCms/plugins/news-list' => __DIR__ . '/../view/plugins/news-list.phtml',
            'MelisDemoCms/plugins/news-details' => __DIR__ . '/../view/plugins/news-details.phtml',
            'MelisDemoCms/plugins/latest-news-vertical' => __DIR__ . '/../view/plugins/latest-news-vertical.phtml',
            'MelisDemoCms/plugins/latest-news-horizontal' => __DIR__ . '/../view/plugins/latest-news-horizontal.phtml',
            'MelisDemoCms/plugins/list-paginator' => __DIR__ . '/../view/plugins/list-paginator.phtml',
            'MelisDemoCms/plugins/team-slider' => __DIR__ . '/../view/plugins/team-slider.phtml',
            'MelisDemoCms/plugins/faq-listing' => __DIR__ . '/../view/plugins/faq-listing.phtml',
            'MelisDemoCms/plugins/faq-values' => __DIR__ . '/../view/plugins/faq-values.phtml',
            'MelisDemoCms/plugins/prospect-form' => __DIR__ . '/../view/plugins/prospect-form.phtml',
            'MelisDemoCms/plugins/search-results' => __DIR__ . '/../view/plugins/search-results.phtml',
            'MelisDemoCms/plugins/gdpr-banner' => __DIR__ . '/../view/plugins/gdpr-banner.phtml',
            'MelisDemoCms/plugins/breadcrumb' => __DIR__ . '/../view/plugins/breadcrumb.phtml',

            // Errors layout
            'error/404' => __DIR__ . '/../view/error/404.phtml',
            'error/index' => __DIR__ . '/../view/error/index.phtml',
        ],
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
    ],
];