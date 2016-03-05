<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace GodataRest\Validator\Article;

/**
 * Validate against article number rules.
 *
 * @author allapow
 */
class ArticleNumber extends \Zend\Validator\AbstractValidator
{

    const ARTICLE_NUMBER_FALSE = 'articleNumberFalse';

    protected $messageTemplates = array(
        self::ARTICLE_NUMBER_FALSE => "'%value%' ist keine Article-Number like 007 or 1234"
    );

    public function isValid($value)
    {
        $this->setValue($value);
        $intValString = '' . $this->value;
        
        return true;
    }

}
