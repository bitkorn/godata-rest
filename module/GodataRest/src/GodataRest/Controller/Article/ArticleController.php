<?php

namespace GodataRest\Controller\Article;

use Zend\View\Model\JsonModel;
use Zend\Http\PhpEnvironment\Response;
use GodataRest\Entity\AbstractEntity;

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
     *
     * @var \GodataRest\Input\Article\ArticleNewFilter
     */
    private $articleNewFilter;

    /**
     * GET
     * @param int $id
     * @return JsonModel Article or message
     */
    public function get($id)
    {
        $this->checkAccess();
        $articleData = $this->articleTable->getArticle(filter_var($id, FILTER_VALIDATE_INT, ['options' => ['min_range' => 1]]));
//        $this->getLogger()->debug(print_r($articleData, true));
        if (!empty($articleData)) {
            $articleEntity = new \GodataRest\Entity\Article\ArticleEntity();
            $articleEntity->flipMapping();
            $articleEntity->exchangeArray($articleData);
            if ($articleEntity->crudAllowed(AbstractEntity::CRUD_READ, $this->userGroups, $this->articleTable->getCrudArr($articleEntity->id))) {
                $articleEntity->escapeForOutput();
                $this->responseArr['data'] = $articleEntity->getArrayCopy();
                $this->responseArr['articleListCount'] = $this->articleListTable->articleListExist($articleEntity->id);
            } else {
                $this->getResponse()->setStatusCode(\Zend\Http\PhpEnvironment\Response::STATUS_CODE_401);
            }
        } else {
            $this->responseArr['messages'][] = 'no article available';
        }
//        $this->getLogger()->debug('$responseArr: ' . print_r($this->responseArr, true));
        return new JsonModel(
                $this->responseArr
        );
    }

    /**
     * GET
     * @return JsonModel {"count":0,"size":0,"page":1,"data":[{"id":"0","articleNo":"0","articleType":"0","articleGroup":"1","articleClass":"1","descShort":"empty"},{...}]}
     */
    public function getList()
    {
        $this->checkAccess();
        $this->responseArr['size'] = (int) $this->params()->fromQuery('size', 0);
        $this->responseArr['page'] = (int) $this->params()->fromQuery('page', 1);
        $digitsValidator = new \Zend\Validator\Digits();
        $articleNo = trim($this->params()->fromQuery('articleNo', '')); // must be string ...perhaps somebody search for 007
        if (!empty($articleNo) && !$digitsValidator->isValid($articleNo)) {
//            $this->getLogger()->debug('no valid');
            $this->responseArr['messages'][] = 'articleNo allow only Digits';
        }
        $desc = trim($this->params()->fromQuery('desc', ''));
        $articleType = (int) $this->params()->fromQuery('articleType', '');
//        $this->getLogger()->debug('$articleNo: ' . $articleNo);
        $articeListData = $this->articleTable->getArticleList(
                $this->responseArr['size'], $this->responseArr['page'], $articleNo, $desc, $articleType
        );
        if (!empty($articeListData['data'])) {
            $this->responseArr['count'] = $articeListData['count'];
            foreach ($articeListData['data'] as $articleData) {
                $articleEntity = new \GodataRest\Entity\Article\ArticleEntity();
                $articleEntity->flipMapping();
                $articleEntity->exchangeArray($articleData);
//                $this->getLogger()->debug('storage: ' . print_r($articleEntity->getArrayCopy(), true));
                if ($articleEntity->crudAllowed(AbstractEntity::CRUD_READ, $this->userGroups)) {
                    $articleEntity->escapeForOutput();
                    $this->responseArr['data'][] = $articleEntity->getArrayCopy();
                } else {
                    $this->responseArr['count'] -= 1;
                }
            }
        } else {
            $this->responseArr['count'] = 0;
            $this->responseArr['data'] = [];
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
        $this->checkAccess();
        if ($data && is_array($data)) {
            $articleEntity = new \GodataRest\Entity\Article\ArticleEntity();
            $articleEntity->exchangeArray($data);
//            $this->getLogger()->debug('$data: ' . print_r($data, true));
            if ($articleEntity->isValid($this->articleNewFilter)) {
                if ($articleEntity->crudAllowed(AbstractEntity::CRUD_CREATE, $this->userGroups,
                                $this->getCrudTablex()->getDefaultCrudGroups('article'))) {
                    $this->responseArr['id'] = $articleEntity->save($this->articleTable);
                    if ($this->responseArr['id'] > 0) {
                        $this->getResponse()->setStatusCode(\Zend\Http\PhpEnvironment\Response::STATUS_CODE_201);
                    } else {
                        $this->getResponse()->setStatusCode(\Zend\Http\PhpEnvironment\Response::STATUS_CODE_400);
                    }
                } else {
                    $this->getResponse()->setStatusCode(\Zend\Http\PhpEnvironment\Response::STATUS_CODE_401);
                }
            } else {
                $this->getResponse()->setStatusCode(\Zend\Http\PhpEnvironment\Response::STATUS_CODE_400);
                $this->responseArr['messages'] = $articleEntity->getValidateMessages();
                $this->getLogger()->debug('invalid: ' . print_r($articleEntity->getValidateMessages(), true));
            }
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
        $this->checkAccess();
        $idFiltered = filter_var($id, FILTER_VALIDATE_INT, ['options' => ['min_range' => 1]]);
        if (!$idFiltered) {
            $this->getResponse()->setStatusCode(\Zend\Http\PhpEnvironment\Response::STATUS_CODE_400);
            $this->responseArr['messages'][] = 'id must be an integer';
        }
        $this->responseArr = ['id' => $idFiltered];
        $articleEntity = new \GodataRest\Entity\Article\ArticleEntity();
        if (!$articleEntity->loadEntity($idFiltered, $this->articleTable)) {
            $this->getResponse()->setStatusCode(\Zend\Http\PhpEnvironment\Response::STATUS_CODE_400);
        } else {
            if ($articleEntity->crudAllowed(AbstractEntity::CRUD_DELETE, $this->userGroups)) {
                $this->responseArr['result'] = $articleEntity->delete($this->articleTable);
                if ($this->responseArr['result'] > 0) {
                    $this->getResponse()->setStatusCode(\Zend\Http\PhpEnvironment\Response::STATUS_CODE_200);
                } else {
                    $this->getResponse()->setStatusCode(\Zend\Http\PhpEnvironment\Response::STATUS_CODE_500);
                }
            } else {
                $this->getResponse()->setStatusCode(\Zend\Http\PhpEnvironment\Response::STATUS_CODE_401);
            }
        }

        return new JsonModel($this->responseArr);
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
        $this->checkAccess();
        $responseArr = ['id' => $id];
        if ($data && is_array($data)) {
//            $this->getLogger()->debug('drin');
            $articleEntity = new \GodataRest\Entity\Article\ArticleEntity();
            $articleEntity->exchangeArray($data);
            $responseArr['result'] = $articleEntity->update($this->articleTable);
            if ($responseArr['result'] > 0) {
                $this->getResponse()->setStatusCode(\Zend\Http\PhpEnvironment\Response::STATUS_CODE_200);
            } else {
                $this->getResponse()->setStatusCode(\Zend\Http\PhpEnvironment\Response::STATUS_CODE_202);
            }
        }
        return new JsonModel($responseArr);
    }

    public function setArticleTable(\GodataRest\Table\Article\ArticleTable $articleTable)
    {
        $this->articleTable = $articleTable;
    }

    public function setArticleListTable(\GodataRest\Table\Article\ArticleListTable $articleListTable)
    {
        $this->articleListTable = $articleListTable;
    }

    public function setArticleNewFilter(\GodataRest\Input\Article\ArticleNewFilter $articleNewFilter)
    {
        $this->articleNewFilter = $articleNewFilter;
        $this->articleNewFilter->init();
    }

}
