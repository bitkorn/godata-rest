<?php

return array(
    'router' => array(
        'routes' => array(
            'godatarest_login' => array(
                'type' => 'literal',
                'options' => array(
                    'route' => '/login', // only getList()
                    'defaults' => array(
                        '__NAMESPACE__' => 'GodataRest\Controller\Common',
                        'controller' => 'Login',
                    ),
                ),
            ),
            /*
             * Article
             */
            'godatarest_article' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/article[/:id]',
                    'constraints' => array(
                        'id' => '[0-9]+',
                    ),
                    'defaults' => array(
                        '__NAMESPACE__' => 'GodataRest\Controller\Article',
                        'controller' => 'Article',
                    ),
                ),
            ),
            'godatarest_article_type' => array(
                'type' => 'literal',
                'options' => array(
                    'route' => '/article-type',
                    'defaults' => array(
                        '__NAMESPACE__' => 'GodataRest\Controller\Article',
                        'controller' => 'ArticleType',
                    ),
                ),
            ),
            'godatarest_article_group' => array(
                'type' => 'literal',
                'options' => array(
                    'route' => '/article-group',
                    'defaults' => array(
                        '__NAMESPACE__' => 'GodataRest\Controller\Article',
                        'controller' => 'ArticleGroup',
                    ),
                ),
            ),
            'godatarest_article_class' => array(
                'type' => 'literal',
                'options' => array(
                    'route' => '/article-class',
                    'defaults' => array(
                        '__NAMESPACE__' => 'GodataRest\Controller\Article',
                        'controller' => 'ArticleClass',
                    ),
                ),
            ),
            'godatarest_common_unit' => array(
                'type' => 'literal',
                'options' => array(
                    'route' => '/common-unit',
                    'defaults' => array(
                        '__NAMESPACE__' => 'GodataRest\Controller\Common',
                        'controller' => 'Unit',
                    ),
                ),
            ),
            'godatarest_article_list' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/article-list[/:id]',
                    'constraints' => array(
                        'id' => '[0-9]+',
                    ),
                    'defaults' => array(
                        '__NAMESPACE__' => 'GodataRest\Controller\Article',
                        'controller' => 'ArticleList',
                    ),
                ),
            ),
            /*
             * Stock
             */
            'godatarest_stock_in' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/stockin[/:id]',
                    'constraints' => array(
                        'id' => '[0-9]+',
                    ),
                    'defaults' => array(
                        '__NAMESPACE__' => 'GodataRest\Controller\Stock',
                        'controller' => 'StockIn',
                    ),
                ),
            ),
        ),
    ),
    'controllers' => array(
    ),
    'service_manager' => array(
        'factories' => array(
        ),
        'invokables' => array(
            // Filter
//            'GodataRest\Input\Stock\StockIn' => 'GodataRest\Input\Stock\StockInFilter',
        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            'GodataRest' => __DIR__ . '/../view',
        ),
    ),
    'validators' => array(
        'invokables' => array(
//            'ExistArticleIdValidator' => 'GodataRest\Validator\Article\ExistArticleId'
        )
    )
);
