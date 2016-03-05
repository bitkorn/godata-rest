<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace GodataRest\Validator\Common;

/**
 * For example ExistUnitId is used by stock in creation to validate an existing unit id.
 * Only ScriptKiddies will failure this Validator, because this value is no custom value.
 *
 * @author allapow
 */
class ExistUnitId extends \Zend\Validator\AbstractValidator
{

    const UNIT_ID_NOT_EXIST = 'unitNotExist';
    const NOT_INT = 'notInt';

    protected $messageTemplates = array(
        self::UNIT_ID_NOT_EXIST => "Unit ID '%value%' don't exist.",
        self::NOT_INT => 'The input does not appear to be an integer'
    );
    
    /**
     *
     * @var \GodataRest\Table\Common\UnitTable
     */
    private $unitTable;
    
    public function isValid($value)
    {
        $this->value = $value;
        $intValidator = new \Zend\I18n\Validator\IsInt();
        if(!$intValidator->isValid($this->value)) {
            $this->error(self::NOT_INT);
            return false;
        }
        $exist = $this->unitTable->existUnitId($this->value);
        if(!$exist) {
            $this->error(self::UNIT_ID_NOT_EXIST);
            return false;
        }
        return true;
    }
    
    public function setUnitTable(\GodataRest\Table\Common\UnitTable $unitTable)
    {
        $this->unitTable = $unitTable;
    }

}
