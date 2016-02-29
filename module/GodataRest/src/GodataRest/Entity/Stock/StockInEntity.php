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

    public function save(\GodataRest\Table\Stock\StockInTable $stockInTable)
    {
        return $stockInTable->createStockIn($this->storage);
    }

    public function update(\GodataRest\Table\Stock\StockInTable $stockInTable)
    {
        return $stockInTable->updateStockIn($this->storage['id'], $this->storage);
    }
}
