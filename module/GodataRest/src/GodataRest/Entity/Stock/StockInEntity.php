<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace GodataRest\Entity\Stock;

/**
 * Description of ArticleEntity
 *
 * @author allapow
 * @todo regard joined article data
 */
class StockInEntity extends \GodataRest\Entity\AbstractEntity
{

    /**
     *
     * @var array Array with Key=property; value=db column
     */
    public $mapping = [
        'id' => 'id',
//        'articleNo' => 'article_no', // no db equivalent
        'articleId' => 'article_id',
        'storeId' => 'store_id',
        'storePlace' => 'store_place',
        'charge' => 'charge',
        'quantity' => 'quantity',
        'unit' => 'unit',
        'entryTime' => 'entry_time'
    ];
    
    public $escapekeys = [
        'storePlace',
        'charge'
    ];
    
    const ARTICLE_DATA_KEY = 'articleData';
    
    private $mappingArticle = [];
    
    private $escapekeysArticle = [];

    public function __construct()
    {
        parent::__construct();
        $articleEntity = new \GodataRest\Entity\Article\ArticleEntity();
        $this->mappingArticle = $articleEntity->mapping;
        unset($this->mappingArticle['id']);
        $this->escapekeysArticle = $articleEntity->escapekeys;
    }

    public function save(\GodataRest\Table\Stock\StockInTable $stockInTable)
    {
        return $stockInTable->createStockIn($this->storage);
    }

    public function update(\GodataRest\Table\Stock\StockInTable $stockInTable)
    {
        return $stockInTable->updateStockIn($this->storage['id'], $this->storage);
    }
}
