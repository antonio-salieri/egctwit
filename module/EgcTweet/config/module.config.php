<?php
return array(
    'router' => array(
        'routes' => array(
            'home' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route' => '/',
                    'defaults' => array(
                        '__NAMESPACE__' => 'EgcTweet\Controller',
                        'controller' => 'Index',
                        'action' => 'index'
                    )
                )
            ),
            'user' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route' => '/user'
                )
            ),
            'logout' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route' => '/user/logout'
                )
            ),
            'profile' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route' => '/profile'
                )
            ),
//     		'twitter' => array(
//     		    'type' => 'segment',
//     		    'options' => array(
//     		        'route' => '/twitter/:action/:method/:type',
//     		        'constraints' => array(
//     		            'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
//     		            'method' => '[a-zA-Z][a-zA-Z0-9_-]*',
//     		            'type' => 'json'
//     		        ),
//     		        'defaults' => array(
//     		            'module' => 'egc-tweet',
//     		            'controller' => 'Twitter',
//     		            'action' => 'index'
//     		        )
//     		    )
//     		),
            'egc-tweet' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/[:controller[/:action][/:data:.:type]]',
                    'constraints' => array(
                        'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
//                         'data' => '[a-zA-Z][a-zA-Z0-9_- ]*',
                    	'.' => '\.',
                		'type' => '(json)'
                    ),
                    'defaults' => array(
                        'module' => 'egc-tweet',
                        'controller' => 'Index',
                        'action' => 'index'
                    )
                )
            ),
        )

    ),
    'service_manager' => array(
        'abstract_factories' => array(
            'Zend\Cache\Service\StorageCacheAbstractServiceFactory',
            'Zend\Log\LoggerAbstractServiceFactory'
        ),
        'aliases' => array(
            'translator' => 'MvcTranslator'
        )
    ),
    'translator' => array(
        'locale' => 'en_US',
        'translation_file_patterns' => array(
            array(
                'type' => 'gettext',
                'base_dir' => __DIR__ . '/../language',
                'pattern' => '%s.mo'
            )
        )
    ),
    'controllers' => array(
        'invokables' => array(
            'index' => 'EgcTweet\Controller\IndexController',
            'profile' => 'EgcTweet\Controller\ProfileController',
            'twitter' => 'EgcTweet\Controller\TwitterController'
        )
    ),
    'view_manager' => array(
        'display_not_found_reason' => true,
        'display_exceptions' => true,
        'doctype' => 'HTML5',
        'not_found_template' => 'error/404',
        'exception_template' => 'error/index',
        'template_map' => array(
            'layout/layout' => __DIR__ . '/../view/layout/layout.phtml',
            'application/index/index' => __DIR__ . '/../view/egc-tweet/index/index.phtml',
            'error/404' => __DIR__ . '/../view/error/404.phtml',
            'error/index' => __DIR__ . '/../view/error/index.phtml'
        ),
        'template_path_stack' => array(
            __DIR__ . '/../view'
        ),
        'strategies' => array(
            'ViewJsonStrategy'
        )
    ),
    // Placeholder for console routes
    'console' => array(
        'router' => array(
            'routes' => array()
        )
    )
);
