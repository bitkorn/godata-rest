<?php

namespace GodataRest\Entity\Article;

/**
 * ArticleListEntryEntity manage the data for article list and in each article list entry the article data.
 *
 * @author allapow
 */
class ArticleListEntryEntity extends \GodataRest\Entity\AbstractEntity
{

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
    
    public $escapekeys = [
        'desc'
    ];
    
    const ARTICLE_DATA_KEY = 'articleData';
    
    private $mappingArticle = [];
    
    private $escapekeysArticle = [];

    public function __construct()
    {
        parent::__construct();
        $articleEntity = new ArticleEntity();
        $this->mappingArticle = $articleEntity->mapping;
        unset($this->mappingArticle['id']);
        $this->escapekeysArticle = $articleEntity->escapekeys;
    }

    /**
     * Flip if data comes from DB
     */
    public function flipMappingArticle()
    {
        $this->mappingArticle = array_flip($this->mappingArticle);
    }

    /**
     * Override which includes the article data.
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
                /**
                 * @todo Mapping
                 */
                $this->storage[self::ARTICLE_DATA_KEY][$this->mappingArticle[$key]] = $this->$key = $value;
            }
        }
    }

    public function save(\GodataRest\Table\Article\ArticleListTable $articleListTable)
    {
        $arrayCopyPure = $this->getArrayCopyPure();
        unset($arrayCopyPure['count_sub_articles']);
        return $articleListTable->createArticleListPart($arrayCopyPure);
    }

    public function update(\GodataRest\Table\Article\ArticleListTable $articleListTable)
    {
        return $articleListTable->updateArticleListPart($this->storage['id'], $this->getArrayCopyPure());
    }

    /**
     * Get only the article list data, without the article data.
     * @return array
     */
    public function getArrayCopyPure()
    {
        $tmpArrayCopy = $this->storage;
        unset($tmpArrayCopy['articleData']);
        return $tmpArrayCopy;
    }
    
    /**
     * Override to escape also (call parent::escapeForOutput()) the article data.
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
