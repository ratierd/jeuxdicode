<?php
return array(
    'controllers' => array(
        'invokables' => array(
            'Jeuxdicode\Controller\Evenement' => 'Jeuxdicode\Controller\EvenementController',
            'Jeuxdicode\Controller\Session' => 'Jeuxdicode\Controller\SessionController',
            'Jeuxdicode\Controller\Proposition' => 'Jeuxdicode\Controller\PropositionController'
        )
    ),
    
    'view_manager' => array(
        'template_path_stack' => array(
            'jeuxdicode' => __DIR__ . '/../view'
        )
    ),
    
    'router' => array(
        'routes' => array(
            'gestevenement' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/gestevenement[/:action][/:id]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id' => '[0-9]+'
                    ),
                    'defaults' => array(
                        'controller' => 'Jeuxdicode\Controller\Evenement',
                        'action' => 'listall'
                    )
                )
            ),
            'gestsession' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/gestsession[/:action][/:id]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id' => '[0-9]+'
                    ),
                    'defaults' => array(
                        'controller' => 'Jeuxdicode\Controller\Session',
                        'action' => 'add'
                    )
                )
            ),
            'gestproposition' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/gestproposition[/:action][/:id]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id' => '[0-9]+'
                    ),
                    'defaults' => array(
                        'controller' => 'Jeuxdicode\Controller\Proposition',
                        'action' => 'listall'
                    )
                )
            )
        )
        
    )
);
?>
