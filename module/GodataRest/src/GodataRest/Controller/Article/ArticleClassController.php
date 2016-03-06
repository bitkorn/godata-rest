<?php

namespace GodataRest\Controller\Article;

use Zend\View\Model\JsonModel;

/**
 * ArticleClassController only for fetch all article classes.
 * Edit or insert new article classes can only make the admin :)
 *
 * @author allapow
 */
class ArticleClassController extends \GodataRest\Controller\AbstractGodataController
{

    /**
     *
     * @var \GodataRest\Table\Article\ArticleClassTable
     */
    private $articleClassTable;
    
    public function getList()
    {
        $articleClasses = $this->articleClassTable->getArticleClasses();
        
        return new JsonModel(
                $articleClasses
        );
    }
    
    public function setArticleClassTable(\GodataRest\Table\Article\ArticleClassTable $articleClassTable)
    {
        $this->articleClassTable = $articleClassTable;
    }

}
