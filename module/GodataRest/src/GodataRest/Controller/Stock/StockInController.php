<?php

namespace GodataRest\Controller\Stock;

use Zend\View\Model\JsonModel;
use Zend\Http\PhpEnvironment\Response;

/**
 * Description of StockInController
 *
 * @author allapow
 */
class StockInController extends \GodataRest\Controller\AbstractGodataController
{

    /**
     *
     * @var \GodataRest\Table\Stock\StockInTable
     */
    private $stockInTable;

    /**
     *
     * @var \GodataRest\Tablex\Stock\StockInTablex
     */
    private $stockInTablex;

    /**
     *
     * @var \GodataRest\Input\Stock\StockInFilter
     */
    private $stockInFilter;

    /**
     * GET
     * @param int $id
     * @return JsonModel Article or message
     */
    public function get($id)
    {
        $this->checkAccess();
        // Tests
//        $stockInFilter = $this->getStockInFilter();
//        $stockInFilter->setData(['article_id' => 14, 'store_id' => 2, 'store_place' => '36gdbf', 'charge' => 'hsg6354', 'quantity' => '22.23', 'unit' => 'sf']);
//        $this->getLogger()->debug('StockInFilter: ' . ($stockInFilter->isValid() ? 'valid': 'unvalid: ' . print_r($stockInFilter->getMessages(), true)));
//        if($stockInFilter->isValid()) {
//            $this->getLogger()->debug('FilterValues: ' . print_r($stockInFilter->getValues(), true));
//        }
//        $unitTable = $this->serviceLocator->get('GodataRest\Table\Common\Unit');
//        $this->getLogger()->debug('UnitsIdAssoc: ' . print_r($unitTable->getUnitsIdAssoc(), true));

        $idFiltered = filter_var($id, FILTER_VALIDATE_INT, ['options' => ['min_range' => 1]]);
        if (!$idFiltered) {
            $this->getResponse()->setStatusCode(Response::STATUS_CODE_400);
            $this->responseArr['messages'][] = 'id must be an integer';
        }
//        $this->getLogger()->debug('$idFiltered: ' . $idFiltered);
//        $stockInData = $this->stockInTable->getStockIn($idFiltered);
//        $this->getLogger()->debug('$stockInData: ' . print_r($stockInData, true));
        $stockInData = $this->stockInTablex->getStockIn($idFiltered);
//        $this->getLogger()->debug('$stockInDataAll: ' . print_r($stockInDataAll, true));
        if (!empty($stockInData)) {
            $stockInEntity = new \GodataRest\Entity\Stock\StockInEntity();
            $stockInEntity->flipMapping();
            $stockInEntity->flipMappingArticle();
            $stockInEntity->exchangeArray($stockInData);
//            $this->getLogger()->debug('$stockInEntity: ' . print_r($stockInEntity->getArrayCopy(), true));
            $stockInEntity->escapeForOutput();
            $this->responseArr['data'] = $stockInEntity->getArrayCopy();
        } else {
            $this->responseArr['messages'][] = 'no stock available';
        }
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
        $articleNo = (int) $this->params()->fromQuery('articleNo', 0);
        /*
         * Date from AngularJS:
         * 2016-02-15T23:00:00.000Z
         */
        $this->responseArr['entry_time_from'] = \GodataRest\Tools::angularDateToISO8601(
                        $this->params()->fromQuery('entryTimeFrom', date(DATE_ISO8601, 0)));
        $this->responseArr['entry_time_to'] = \GodataRest\Tools::angularDateToISO8601(
                        $this->params()->fromQuery('entryTimeTo', date(DATE_ISO8601)));
        $dateValidator = new \Zend\Validator\Date(['format' => DATE_ISO8601]);
        if (!$dateValidator->isValid($this->responseArr['entry_time_from']) || !$dateValidator->isValid($this->responseArr['entry_time_to'])) {
            $timestampFrom = 0;
            $timestampto = 1999999999; // 2033-05-18 05:33:19 (biggest MySQL Unixtime for: select from_unixtime(1999999999))
            $this->responseArr['messages'][] = 'datetime format are not valid';
        } else {
            $timezone = new \DateTimeZone('Europe/Berlin');
            $entryTimeFrom = \DateTime::createFromFormat(DATE_ISO8601, $this->responseArr['entry_time_from'], $timezone);
            $entryTimeto = \DateTime::createFromFormat(DATE_ISO8601, $this->responseArr['entry_time_to'], $timezone);
            $timestampFrom = $entryTimeFrom->getTimestamp();
            $timestampto = $entryTimeto->getTimestamp();
            $timestampto += 24 * 60 * 60 - 1; // plus einen Tag minus einer Sekunde
        }
        $stockInsData = $this->stockInTablex->getStockIns(
                $this->responseArr['size'], $this->responseArr['page'], $articleNo, $timestampFrom, $timestampto);
        if (!empty($stockInsData['data'])) {
            $this->responseArr['count'] = $stockInsData['count'];
            foreach ($stockInsData['data'] as $stockInData) {
                $stockEntity = new \GodataRest\Entity\Stock\StockInEntity();
                $stockEntity->flipMapping();
                $stockEntity->flipMappingArticle();
                $stockEntity->exchangeArray($stockInData);
                $stockEntity->escapeForOutput();
                $this->responseArr['data'][] = $stockEntity->getArrayCopy();
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
     * @param array $data
     * @return JsonModel property id with last insert id, 0 if error
     */
    public function create($data)
    {
        $this->checkAccess();
        if ($data && is_array($data)) {
            $stockEntity = new \GodataRest\Entity\Stock\StockInEntity();
            $data['entryTime'] = time(); // mit Hand eingeben lassen?!?!???
            $stockEntity->exchangeArray($data);
            if ($stockEntity->isValid($this->stockInFilter)) {
                $this->responseArr['id'] = $stockEntity->save($this->stockInTable);
                if ($this->responseArr['id'] > 0) {
                    $this->getResponse()->setStatusCode(Response::STATUS_CODE_201);
                } else {
                    $this->getResponse()->setStatusCode(Response::STATUS_CODE_400);
                }
            } else {
                $this->getResponse()->setStatusCode(Response::STATUS_CODE_400);
                $this->responseArr['messages'] = $stockEntity->getValidateMessages();
//                $this->getLogger()->debug('invalid: ' . print_r($stockEntity->getValidateMessages(), true));
            }
        }
        return new JsonModel($this->responseArr);
    }

    /**
     * DELETE maps to delete().
     * Return either a 200 or 204 response status.
     * @param int $id
     * @return JsonModel id and result property; result is 1 if success.
     * @todo implement CRUD
     */
    public function delete($id)
    {
        $this->checkAccess();
        $idFiltered = filter_var($id, FILTER_VALIDATE_INT, ['options' => ['min_range' => 1]]);
        if (!$idFiltered) {
            $this->getResponse()->setStatusCode(Response::STATUS_CODE_400);
            $this->responseArr['messages'][] = 'id must be an integer';
        }
//        $this->getLogger()->debug('delete: ' . $idFiltered);

        return new JsonModel($this->responseArr);
    }

    /**
     * PUT maps to update().
     * Return either a 200 or 202 response status, as well as the representation of the entity.
     * @param int $id Query/URL Parameter
     * @param json|array $data Data in request body
     * @return JsonModel id and result property; result is 1 if success.
     * @todo implement CRUD
     * @todo use the StockInFilter
     */
    public function update($id, $data)
    {
        $this->checkAccess();
        $idFiltered = filter_var($id, FILTER_VALIDATE_INT, ['options' => ['min_range' => 1]]);
        $this->getLogger()->debug('$idFiltered: ' . $idFiltered);
        if (!$idFiltered) {
            $this->getResponse()->setStatusCode(Response::STATUS_CODE_400);
            $this->responseArr['messages'][] = 'id must be an integer';
        }

        if ($data && is_array($data)) {
            
        }
        return new JsonModel($this->responseArr);
    }

    public function setStockInTable(\GodataRest\Table\Stock\StockInTable $stockInTable)
    {
        $this->stockInTable = $stockInTable;
    }

    public function setStockInTablex(\GodataRest\Tablex\Stock\StockInTablex $stockInTablex)
    {
        $this->stockInTablex = $stockInTablex;
    }

    public function setStockInFilter(\GodataRest\Input\Stock\StockInFilter $stockInFilter)
    {
        $this->stockInFilter = $stockInFilter;
        $this->stockInFilter->init();
    }

}
