<?php

namespace GodataRest\Controller\Article;

use Zend\View\Model\JsonModel;

/**
 * Description of ArticleListController
 *
 * @author allapow
 */
class ArticleListController extends \GodataRest\Controller\AbstractGodataController
{

    /**
     *
     * @var \GodataRest\Tablex\Article\ArticleListTablex
     */
    private $articleListTablex;

    /**
     *
     * @var \GodataRest\Table\Article\ArticleListTable
     */
    private $articleListTable;

    /**
     * GET gets all sub article from one article.
     * @param int $id
     * @return JsonModel Article or only a message
     */
    public function get($id)
    {
//        $this->getLogger()->debug('ArticleList GET ID: ' . $id);
        $articleListData = $this->articleListTablex->getArticleList(filter_var($id, FILTER_VALIDATE_INT, ['min_range' => 1]));
//        $this->getLogger()->debug(print_r($articleListData, true));
        $articleList = [];
        if (!empty($articleListData)) {
            foreach ($articleListData as $articleListEntryData) {
                $articleListEntity = new \GodataRest\Entity\Article\ArticleListEntryEntity();
                $articleListEntity->flipMapping();
                $articleListEntity->flipMappingArticle();
                $articleListEntity->exchangeArray($articleListEntryData);
                $articleList[] = $articleListEntity->getArrayCopy();
            }
//            $articleList = $articleListData;
        } else {
            $articleList['messages'][] = 'no article list available';
        }
        return new JsonModel(
                $articleList
        );
    }

    /**
     * POST maps to create().
     * The response should typically be an HTTP 201 response
     * with the Location header indicating the URI of the newly created entity
     * and the response body providing the representation.
     * @param json|array $data
     * @return JsonModel property id with last insert id, 0 if error
     */
    public function create($data)
    {
//        $this->getLogger()->debug('create: ' . print_r($data, true));
        $lastInsertId = 0;
        if ($data && is_array($data)) {
            $articleListEntryEntity = new \GodataRest\Entity\Article\ArticleListEntryEntity();
            $articleListEntryEntity->exchangeArray($data);
            $lastInsertId = $articleListEntryEntity->save($this->articleListTable);
//            $this->getLogger()->debug('lastInsertId: ' . $lastInsertId);
        }
        return new JsonModel(
                ['id' => $lastInsertId]
        );
    }

    /**
     * DELETE maps to delete().
     * Return either a 200 or 204 response status.
     * @param int $id
     * @return JsonModel id and result property; result is 1 if success.
     */
    public function delete($id)
    {
        $this->getLogger()->debug('delete: ' . $id);
        $result = $this->articleListTable->deleteArticleListPart($id);
        return new JsonModel(
                ['id' => $id, 'result' => $result]
        );
    }

    public function setArticleListTablex(\GodataRest\Tablex\Article\ArticleListTablex $articleListTablex)
    {
        $this->articleListTablex = $articleListTablex;
    }

    public function setArticleListTable(\GodataRest\Table\Article\ArticleListTable $articleListTable)
    {
        $this->articleListTable = $articleListTable;
    }

}
