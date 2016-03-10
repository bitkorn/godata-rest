<?php

namespace GodataRest\Validator\Article;

/**
 * For example ExistArticleGroup is used by article creation to validate an existing article group.
 * Only ScriptKiddies will failure this Validator.
 *
 * @author allapow
 */
class ExistArticleGroup extends \Zend\Validator\AbstractValidator
{

    const ARTICLE_GROUP_NOT_EXIST = 'articleGroupDoesNotExist';
    const NOT_INT = 'notInt';

    protected $messageTemplates = array(
        self::ARTICLE_GROUP_NOT_EXIST => "Article group '%value%' don't exist.",
        self::NOT_INT => 'The input does not appear to be an integer'
    );
    
    /**
     *
     * @var \GodataRest\Table\Article\ArticleGroupTable
     */
    private $articleGroupTable;
    
    public function isValid($value)
    {
        $this->value = $value;
        $intValidator = new \Zend\I18n\Validator\IsInt();
        if(!$intValidator->isValid($this->value)) {
            $this->error(self::NOT_INT);
            return false;
        }
        $exist = $this->articleGroupTable->existArticleGroup($this->value);
        if(!$exist) {
            $this->error(self::ARTICLE_GROUP_NOT_EXIST);
            return false;
        }
        return true;
    }
    
    public function setArticleGroupTable(\GodataRest\Table\Article\ArticleGroupTable $articleGroupTable)
    {
        $this->articleGroupTable = $articleGroupTable;
    }

}
