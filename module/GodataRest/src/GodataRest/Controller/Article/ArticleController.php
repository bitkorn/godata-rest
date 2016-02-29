<?php

namespace GodataRest\Controller\Article;

use Zend\View\Model\JsonModel;

/**
 * Description of Article
 *
 * @author allapow
 */
class ArticleController extends \GodataRest\Controller\AbstractGodataController
{

    /**
     *
     * @var \GodataRest\Table\Article\ArticleTable
     */
    private $articleTable;

    /**
     *
     * @var \GodataRest\Table\Article\ArticleListTable
     */
    private $articleListTable;

    /**
     * GET
     * @param int $id
     * @return JsonModel Article or message
     */
    public function get($id)
    {
//        $this->getLogger()->debug('Article GET ID: ' . $id);
        $articleData = $this->articleTable->getArticle(filter_var($id, FILTER_VALIDATE_INT, ['min_range' => 1]));
//        $this->getLogger()->debug(print_r($articleData, true));
        if (!empty($articleData)) {
            $articleEntity = new \GodataRest\Entity\Article\ArticleEntity();
            $articleEntity->flipMapping();
            $articleEntity->exchangeArray($articleData);
            $articleEntity->escapeForOutput();
            $article = $articleEntity->getArrayCopy();
//            $this->getLogger()->debug('$articleEntity->id: ' . $articleEntity->id);
            $article['articleListCount'] = $this->articleListTable->articleListExist($articleEntity->id);
        } else {
            $article['messages'][] = 'no article available';
        }
        return new JsonModel(
                $article
        );
    }

    /**
     * GET
     * @return JsonModel {"count":0,"size":0,"page":1,"data":[{"id":"0","articleNo":"0","articleType":"0","articleGroup":"1","articleClass":"1","descShort":"empty"},{...}]}
     */
    public function getList()
    {
        $articles['size'] = (int) $this->params()->fromQuery('size', 0);
        $articles['page'] = (int) $this->params()->fromQuery('page', 1);
        $digitsValidator = new \Zend\Validator\Digits();
        $articleNo = trim($this->params()->fromQuery('articleNo', '')); // must be string ...perhaps somebody search for 007
        if(!$digitsValidator->isValid($articleNo)) {
//            $this->getLogger()->debug('no valid');
            $articles['messages'][] = 'articleNo allow only Digits';
        }
        $desc = trim($this->params()->fromQuery('desc', ''));
        $articleType = (int) $this->params()->fromQuery('articleType', '');
//        $this->getLogger()->debug('$articleNo: ' . $articleNo);
        $articeListData = $this->articleTable->getArticleList($articles['size'], $articles['page'], $articleNo, $desc, $articleType);
        if (!empty($articeListData['data'])) {
            $articles['count'] = $articeListData['count'];
            foreach ($articeListData['data'] as $articleData) {
                $articleEntity = new \GodataRest\Entity\Article\ArticleEntity();
                $articleEntity->flipMapping();
                $articleEntity->exchangeArray($articleData);
                $articleEntity->escapeForOutput();
                $articles['data'][] = $articleEntity->getArrayCopy();
            }
        } else {
            $articles['count'] = 0;
            $articles['data'] = [];
        }
        return new JsonModel(
                $articles
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
            $articleEntity = new \GodataRest\Entity\Article\ArticleEntity();
            $articleEntity->exchangeArray($data);
            $lastInsertId = $articleEntity->save($this->articleTable);
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
//        $this->getLogger()->debug('delete: ' . $id);
        $result = $this->articleTable->deleteArticle($id);
        return new JsonModel(
                ['id' => $id, 'result' => $result]
        );
    }

    /**
     * PUT maps to update().
     * Return either a 200 or 202 response status, as well as the representation of the entity.
     * @param int $id Query/URL Parameter
     * @param json|array $data Data in request body
     * @return JsonModel id and result property; result is 1 if success.
     */
    public function update($id, $data)
    {
//        $this->getLogger()->debug('update: ' . $id . '; data: ' . print_r($data, true));
        $result = 0;
        if ($data && is_array($data)) {
//            $this->getLogger()->debug('drin');
            $articleEntity = new \GodataRest\Entity\Article\ArticleEntity();
            $articleEntity->exchangeArray($data);
            $result = $articleEntity->update($this->articleTable);
        }
        return new JsonModel(
                ['id' => $id, 'result' => $result]
        );
    }

    public function setArticleTable(\GodataRest\Table\Article\ArticleTable $articleTable)
    {
        $this->articleTable = $articleTable;
    }
    
    public function setArticleListTable(\GodataRest\Table\Article\ArticleListTable $articleListTable)
    {
        $this->articleListTable = $articleListTable;
    }

}
