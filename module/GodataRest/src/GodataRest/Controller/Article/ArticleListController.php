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
        $articleListData = $this->articleListTablex->getArticleList(filter_var($id, FILTER_VALIDATE_INT, ['min_range' => 1]));
        if (!empty($articleListData)) {
            foreach ($articleListData as $articleListEntryData) {
                $articleListEntity = new \GodataRest\Entity\Article\ArticleListEntryEntity();
                $articleListEntity->flipMapping();
                $articleListEntity->flipMappingArticle();
                $articleListEntity->exchangeArray($articleListEntryData);
                $articleListEntity->escapeForOutput();
                $this->responseArr['data'][] = $articleListEntity->getArrayCopy();
            }
        } else {
            $this->responseArr['messages'][] = 'no article list available';
        }
        return new JsonModel($this->responseArr);
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
        if ($data && is_array($data)) {
            $articleListEntryEntity = new \GodataRest\Entity\Article\ArticleListEntryEntity();
            $articleListEntryEntity->exchangeArray($data);
            $this->responseArr['id'] = $articleListEntryEntity->save($this->articleListTable);
            if ($this->responseArr['id'] > 0) {
                $this->getResponse()->setStatusCode(\Zend\Http\PhpEnvironment\Response::STATUS_CODE_201);
            } else {
                $this->getResponse()->setStatusCode(\Zend\Http\PhpEnvironment\Response::STATUS_CODE_400);
            }
        } else {
            $this->getResponse()->setStatusCode(\Zend\Http\PhpEnvironment\Response::STATUS_CODE_400);
        }
        return new JsonModel($this->responseArr);
    }

    /**
     * DELETE maps to delete().
     * Return either a 200 or 204 response status.
     * @param int $id
     * @return JsonModel id and result property; result is 1 if success.
     */
    public function delete($id)
    {
        $idFiltered = filter_var($id, FILTER_VALIDATE_INT, ['options' => ['min_range' => 1]]);
        if(!$idFiltered) {
            $this->getResponse()->setStatusCode(\Zend\Http\PhpEnvironment\Response::STATUS_CODE_400);
            $this->responseArr['messages'][] = 'id must be an integer';
        }
        $this->responseArr = ['id' => $idFiltered];
        $this->responseArr['result'] = $this->articleListTable->deleteArticleListPart($idFiltered);
        return new JsonModel($this->responseArr);
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
