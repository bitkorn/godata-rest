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
class ArticleEntity extends \Zend\Stdlib\ArrayObject
{

    public $id;
    public $articleNo;
    public $articleType;
    public $articleGroup;
    public $articleClass;
    public $descShort;
    public $descLong;
    public $descTec;

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

    /**
     * Flip if data comes from DB
     */
    public function flipMapping()
    {
        $this->mapping = array_flip($this->mapping);
    }

    public function exchangeArray($data)
    {
        foreach ($data as $key => $value) {
            if (isset($this->mapping[$key])) {
                $this->storage[$this->mapping[$key]] = $this->$key = $value;
            }
        }
    }

    public function save(\GodataRest\Table\Article\ArticleTable $articleTable)
    {
        return $articleTable->createArticle($this->storage);
    }

    public function update(\GodataRest\Table\Article\ArticleTable $articleTable)
    {
        return $articleTable->updateArticle($this->storage['id'], $this->storage);
    }

    public function getArrayCopy()
    {
        return $this->storage;
    }

}
