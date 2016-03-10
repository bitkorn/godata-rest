<?php

namespace GodataRest\Validator\Article;

/**
 * For example ExistArticleType is used by article creation to validate an existing article type.
 * Only ScriptKiddies will failure this Validator.
 *
 * @author allapow
 */
class ExistArticleType extends \Zend\Validator\AbstractValidator
{

    const ARTICLE_TYPE_NOT_EXIST = 'articleTypeDoesNotExist';
    const NOT_INT = 'notInt';

    protected $messageTemplates = array(
        self::ARTICLE_TYPE_NOT_EXIST => "Article type '%value%' don't exist.",
        self::NOT_INT => 'The input does not appear to be an integer'
    );
    
    /**
     *
     * @var \GodataRest\Table\Article\ArticleTypeTable
     */
    private $articleTypeTable;
    
    public function isValid($value)
    {
        $this->value = $value;
        $intValidator = new \Zend\I18n\Validator\IsInt();
        if(!$intValidator->isValid($this->value)) {
            $this->error(self::NOT_INT);
            return false;
        }
        $exist = $this->articleTypeTable->existArticleType($this->value);
        if(!$exist) {
            $this->error(self::ARTICLE_TYPE_NOT_EXIST);
            return false;
        }
        return true;
    }
    
    public function setArticleTypeTable(\GodataRest\Table\Article\ArticleTypeTable $articleTypeTable)
    {
        $this->articleTypeTable = $articleTypeTable;
    }

}
