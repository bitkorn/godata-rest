<?php

namespace GodataRest\Validator\Article;

/**
 * Validate against article number rules.
 *
 * @author allapow
 */
class CompanySpecialArticleNumber extends \Zend\Validator\AbstractValidator
{

    const ARTICLE_NUMBER_FALSE = 'articleNumberFalse';

    protected $messageTemplates = array(
        self::ARTICLE_NUMBER_FALSE => "'%value%' is not a company-special article-number"
    );

    public function isValid($value)
    {
        $this->setValue($value);
        
        return true;
    }

}
