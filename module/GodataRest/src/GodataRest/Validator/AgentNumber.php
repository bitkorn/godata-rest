<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace GodataRest\Validator;

/**
 * Description of AgentNumber
 *
 * @author allapow
 */
class AgentNumber extends \Zend\Validator\AbstractValidator
{

    const AGENT_NUMBER_FALSE = '';

    protected $messageTemplates = array(
        self::AGENT_NUMBER_FALSE => "'%value%' ist keine Agent-Number like 007 or 1234"
    );

    public function isValid($value)
    {
        $this->setValue($value);
        $intValString = '' . $this->value;
//        if (!is_int($intVal) || $intValString != $value) {
//            $this->error(self::INT_FALSE);
//            return false;
//        }
        return true;
    }

}
