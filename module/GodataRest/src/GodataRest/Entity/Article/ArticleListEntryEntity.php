<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace GodataRest\Entity\Article;

/**
 * Description of ArticleListEntity
 *
 * @author allapow
 */
class ArticleListEntryEntity extends \Zend\Stdlib\ArrayObject
{

    public $id;
    public $articleIdParent;
    public $articleId;
    public $quantity;
    public $desc;
    public static $articleDbColums = ['article_no', 'article_type', 'article_group', 'article_class', 'desc_short', 'desc_long', 'desc_tec',
        'date_create', 'date_edit', 'user_create', 'user_edit', 'unit', 'status',
        'default_store_id', 'default_store_place'];

    /**
     *
     * @var array Array with Key=property; value=db column
     */
    public $mapping = [
        'id' => 'id',
        'articleIdParent' => 'article_id_parent',
        'articleId' => 'article_id',
        'quantity' => 'quantity',
        'desc' => 'desc',
        'countSubArticles' => 'count_sub_articles' // no db field
    ];
    public $mappingArticle = [];
//    pr $storage = [];

    public function __construct()
    {
        parent::__construct();
        $this->mappingArticle = (new ArticleEntity())->mapping;
        unset($this->mappingArticle['id']);
    }

    /**
     * Flip if data comes from DB
     */
    public function flipMapping()
    {
        $this->mapping = array_flip($this->mapping);
    }

    /**
     * Flip if data comes from DB
     */
    public function flipMappingArticle()
    {
        $this->mappingArticle = array_flip($this->mappingArticle);
    }

    public function exchangeArray($data)
    {
        foreach ($data as $key => $value) {
            if (isset($this->mapping[$key])) {
                $this->storage[$this->mapping[$key]] = $this->$key = $value;
            } elseif (isset($this->mappingArticle[$key])) {
                /**
                 * @todo Mapping
                 */
                $this->storage['articleData'][$this->mappingArticle[$key]] = $value;
            }
        }
    }

    public function save(\GodataRest\Table\Article\ArticleListTable $articleListTable)
    {
        return $articleListTable->createArticleListPart($this->getArrayCopyPure());
    }

    public function update(\GodataRest\Table\Article\ArticleListTable $articleListTable)
    {
        return $articleListTable->updateArticleListPart($this->storage['id'], $this->getArrayCopyPure());
    }

    public function getArrayCopy()
    {
        return $this->storage;
    }

    public function getArrayCopyPure()
    {
        $tmpArrayCopy = $this->storage;
        unset($tmpArrayCopy['articleData']);
        return $tmpArrayCopy;
    }

}
