<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace GodataRest\Entity\Article;

/**
 * Description of ArticleEntity
 *
 * @author allapow
 */
class ArticleEntity extends \GodataRest\Entity\AbstractEntity
{

    /**
     *
     * @var array Array with Key=property; value=db column
     */
    public $mapping = [
        'id' => 'id',
        'articleNo' => 'article_no',
        'articleType' => 'article_type',
        'articleGroup' => 'article_group',
        'articleClass' => 'article_class',
        'descShort' => 'desc_short',
        'descLong' => 'desc_long',
        'descTec' => 'desc_tec',
        'date_create' => 'dateCreate',
        'date_edit' => 'dateEdit',
        'user_create' => 'userCreate',
        'user_edit' => 'userEdit',
        'unit' => 'unit',
        'status' => 'status',
        'default_store_id' => 'defaultStoreId',
        'default_store_place' => 'defaultStorePlace'
    ];
    
    public $escapekeys = [
        'descShort',
        'descLong',
        'descTec',
        'default_store_place'
    ];

    public function save(\GodataRest\Table\Article\ArticleTable $articleTable)
    {
        return $articleTable->createArticle($this->storage);
    }

    public function update(\GodataRest\Table\Article\ArticleTable $articleTable)
    {
        return $articleTable->updateArticle($this->storage['id'], $this->storage);
    }

}
