<?php

return array(
    'router' => array(
        'routes' => array(
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
