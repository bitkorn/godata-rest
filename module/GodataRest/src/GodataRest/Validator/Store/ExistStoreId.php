<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace GodataRest\Validator\Store;

/**
 * For example ExistStoreId is used by stock in creation to validate an existing store id.
 * Only ScriptKiddies will failure this Validator.
 *
 * @author allapow
 */
class ExistStoreId extends \Zend\Validator\AbstractValidator
{

    const STORE_ID_NOT_EXIST = 'storeIdDoesNotExist';
    const NOT_INT = 'notInt';

    protected $messageTemplates = array(
        self::STORE_ID_NOT_EXIST => "Store ID '%value%' don't exist.",
        self::NOT_INT => 'The input does not appear to be an integer'
    );
    
    /**
     *
     * @var \GodataRest\Table\Store\StoreTable
     */
    private $storeTable;
    
    public function isValid($value)
    {
        $this->value = $value;
        $intValidator = new \Zend\I18n\Validator\IsInt();
        if(!$intValidator->isValid($this->value)) {
            $this->error(self::NOT_INT);
            return false;
        }
        $exist = $this->storeTable->existStoreId($this->value);
        if(!$exist) {
            $this->error(self::STORE_ID_NOT_EXIST);
            return false;
        }
        return true;
    }
    
    public function setStoreTable(\GodataRest\Table\Store\StoreTable $storeTable)
    {
        $this->storeTable = $storeTable;
    }

}
