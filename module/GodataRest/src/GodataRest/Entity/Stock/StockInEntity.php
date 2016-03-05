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
 * @todo use the StockInFilter
 */
class StockInEntity extends \GodataRest\Entity\Article\JoinArticleEntity
{

    /**
     *
     * @var array Array with Key=property; value=db column
     */
    protected $mapping = [
        'id' => 'id',
        'articleId' => 'article_id',
        'storeId' => 'store_id',
        'storePlace' => 'store_place',
        'charge' => 'charge',
        'quantity' => 'quantity',
        'unit' => 'unit',
        'entryTime' => 'entry_time'
    ];
    
    protected $escapekeys = [
        'storePlace',
        'charge'
    ];

    public function __construct()
    {
        parent::__construct();
        unset($this->mappingArticle['unit']);
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
