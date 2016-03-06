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
    
    /**
     * Validate input data for storage in database.
     * In this direction (input -> database) the $this->mapping array are not fliped!
     * If data are invalid, the messages key in $this->validateMessages is the key from unplipped $this->mapping.
     * @param \Zend\InputFilter\InputFilter $inputFilter
     * @return boolean
     */
    public function isValid(\Zend\InputFilter\InputFilter $inputFilter) {
        $inputFilter->setData($this->storage);
        $isValid = $inputFilter->isValid();
        if(!$isValid) {
            $messages = $inputFilter->getMessages();
            $flippedMapping = array_flip($this->mapping);
            foreach ($messages as $key => $message) {
                if(isset($flippedMapping[$key])) {
                    $this->validateMessages[$flippedMapping[$key]] = $message;
                }
            }
        }
        return $isValid;
    }

    public function save(\GodataRest\Table\Stock\StockInTable $stockInTable)
    {
        $arrayCopyPure = $this->getArrayCopyPure();
        $arrayCopyPure['entry_time'] = time();
        return $stockInTable->createStockIn($arrayCopyPure);
    }

    public function update(\GodataRest\Table\Stock\StockInTable $stockInTable)
    {
        return $stockInTable->updateStockIn($this->storage['id'], $this->storage);
    }

}
