<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace GodataRest\Validator\Article;

/**
 * For example ExistArticleId is used by stock in creation to validate an existing article id.
 * Only ScriptKiddies will failure this Validator.
 *
 * @author allapow
 */
class ExistArticleId extends \Zend\Validator\AbstractValidator
{

    const ARTICLE_ID_NOT_EXIST = 'articleIdDoesNotExist';
    const NOT_INT = 'notInt';

    protected $messageTemplates = array(
        self::ARTICLE_ID_NOT_EXIST => "Article ID '%value%' don't exist.",
        self::NOT_INT => 'The input does not appear to be an integer'
    );
    
    /**
     *
     * @var \GodataRest\Table\Article\ArticleTable
     */
    private $articleTable;
    
    public function isValid($value)
    {
        $this->value = $value;
        $intValidator = new \Zend\I18n\Validator\IsInt();
        if(!$intValidator->isValid($this->value)) {
            $this->error(self::NOT_INT);
            return false;
        }
        $exist = $this->articleTable->existArticleId($this->value);
        if(!$exist) {
            $this->error(self::ARTICLE_ID_NOT_EXIST);
            return false;
        }
        return true;
    }
    
    public function setArticleTable(\GodataRest\Table\Article\ArticleTable $articleTable)
    {
        $this->articleTable = $articleTable;
    }

}
