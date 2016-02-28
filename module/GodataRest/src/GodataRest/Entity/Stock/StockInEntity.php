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
class StockInEntity extends \Zend\Stdlib\ArrayObject
{

    /**
     *
     * @var array Array with Key=property; value=db column
     */
    private $mapping = [
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
    private $arrayCopy = [];

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
                $this->arrayCopy[$this->mapping[$key]] = $value;
            }
        }
    }

    public function save(\GodataRest\Table\Stock\StockInTable $stockInTable)
    {
        
        return $stockInTable->createStockIn($this->arrayCopy);
    }

    public function update(\GodataRest\Table\Stock\StockInTable $stockInTable)
    {
        return $stockInTable->updateStockIn($this->arrayCopy['id'], $this->arrayCopy);
    }

    public function getArrayCopy()
    {
        return $this->arrayCopy;
    }

}
