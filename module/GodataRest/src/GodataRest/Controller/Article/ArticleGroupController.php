<?php

namespace GodataRest\Controller\Article;

use Zend\View\Model\JsonModel;

/**
 * ArticleGroupController only for fetch all article groups.
 * Edit or insert new article groups can only make the admin :)
 *
 * @author allapow
 */
class ArticleGroupController extends \GodataRest\Controller\AbstractGodataController
{

    /**
     *
     * @var \GodataRest\Table\Article\ArticleGroupTable
     */
    private $articleGroupTable;
    
    public function getList()
    {
        $articleGroups = $this->articleGroupTable->getArticleGroups();
        
        return new JsonModel(
                $articleGroups
        );
    }
    
    public function setArticleGroupTable(\GodataRest\Table\Article\ArticleGroupTable $articleGroupTable)
    {
        $this->articleGroupTable = $articleGroupTable;
    }

}
