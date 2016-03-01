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
        'dateCreate' => 'date_create',
        'dateEdit' => 'date_edit',
        'userCreate' => 'user_create',
        'userEdit' => 'user_edit',
        'unit' => 'unit',
        'status' => 'status',
        'defaultStoreId' => 'default_store_id',
        'defaultStorePlace' => 'default_store_place'
    ];
    
    public $escapekeys = [
        'descShort',
        'descLong',
        'descTec',
        'defaultStorePlace'
    ];

    public function save(\GodataRest\Table\Article\ArticleTable $articleTable)
    {
        $this->storage['date_create'] = time();
        return $articleTable->createArticle($this->storage);
    }

    public function update(\GodataRest\Table\Article\ArticleTable $articleTable)
    {
        return $articleTable->updateArticle($this->storage['id'], $this->storage);
    }

}
