<?php

namespace GodataRest\Controller\Article;

use Zend\View\Model\JsonModel;

/**
 * ArticleTypeController only for fetch all article types.
 * Edit or insert new article types can only make the admin :)
 *
 * @author allapow
 */
class ArticleTypeController extends \GodataRest\Controller\AbstractGodataController
{

    /**
     *
     * @var \GodataRest\Table\Article\ArticleTypeTable
     */
    private $articleTypeTable;
    
    public function getList()
    {
        $articleTypes = $this->articleTypeTable->getArticleTypes();
        
        return new JsonModel(
                $articleTypes
        );
    }

    /**
     * 
     * @param \GodataRest\Table\Article\ArticleTypeTable $articleTypeTable
     */
    public function setArticleTypeTable(\GodataRest\Table\Article\ArticleTypeTable $articleTypeTable)
    {
        $this->articleTypeTable = $articleTypeTable;
    }


}
