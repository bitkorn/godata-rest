<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace GodataRest\Entity\Article;

/**
 * Description of JoinArticleEntity
 *
 * @author allapow
 */
class JoinArticleEntity extends \GodataRest\Entity\AbstractEntity
{

    const ARTICLE_DATA_KEY = 'articleData';

    protected $mappingArticle = [];
    protected $escapekeysArticle = [];

    public function __construct()
    {
        parent::__construct();
        $articleEntity = new ArticleEntity();
        $this->mappingArticle = $articleEntity->getMapping();
        unset($this->mappingArticle['id']);
        $this->escapekeysArticle = $articleEntity->getEscapekeys();
    }

    /**
     * Flip if data comes from DB
     */
    public function flipMappingArticle()
    {
        $this->mappingArticle = array_flip($this->mappingArticle);
    }

    /**
     * Override to also have the article data.
     * @param array $data
     */
    public function exchangeArray($data)
    {
        parent::exchangeArray($data);

        $storageKeys = array_values($this->mappingArticle);
        foreach ($storageKeys as $storageKey) {
            $this->storage[self::ARTICLE_DATA_KEY][$storageKey] = '';
        }
        foreach ($data as $key => $value) {
            if (isset($this->mappingArticle[$key])) {
                $this->storage[self::ARTICLE_DATA_KEY][$this->mappingArticle[$key]] = $this->$key = $value;
            }
        }
    }

    /**
     * Only get the article list data, without the article data.
     * @return array
     */
    public function getArrayCopyPure()
    {
        $tmpArrayCopy = $this->storage;
        unset($tmpArrayCopy[self::ARTICLE_DATA_KEY]);
        return $tmpArrayCopy;
    }

    /**
     * Override to also escape (call parent::escapeForOutput()) the article data.
     */
    public function escapeForOutput()
    {
        parent::escapeForOutput();

        $escaper = new \Zend\Escaper\Escaper('utf-8');
        foreach ($this->escapekeysArticle as $escapeKey) {
            $this->storage[self::ARTICLE_DATA_KEY][$escapeKey] = $escaper->escapeHtml($this->storage[self::ARTICLE_DATA_KEY][$escapeKey]);
        }
    }

}
