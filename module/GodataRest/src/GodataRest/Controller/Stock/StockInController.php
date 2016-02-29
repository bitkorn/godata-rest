<?php

namespace GodataRest\Controller\Stock;

use Zend\View\Model\JsonModel;

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
     * GET
     * @param int $id
     * @return JsonModel Article or message
     */
    public function get($id)
    {
//        $this->getLogger()->debug('Article GET ID: ' . $id);
        $stockInData = $this->stockInTable->getStockIn($id);
//        $this->getLogger()->debug(print_r($articleData, true));
        if (!empty($stockInData)) {
            $stockInEntity = new \GodataRest\Entity\Stock\StockInEntity();
            $stockInEntity->flipMapping();
            $stockInEntity->exchangeArray($stockInData);
            $stockInEntity->escapeForOutput();
            $stockIn = $stockInEntity->getArrayCopy();
        } else {
            $stockIn['messages'][] = 'no stock available';
        }
        return new JsonModel(
                $stockIn
        );
    }

    /**
     * GET
     * @return JsonModel {"count":0,"size":0,"page":1,"data":[{"id":"0","articleNo":"0","articleType":"0","articleGroup":"1","articleClass":"1","descShort":"empty"},{...}]}
     */
    public function getList()
    {
        $stockIns['size'] = (int) $this->params()->fromQuery('size', 0);
        $stockIns['page'] = (int) $this->params()->fromQuery('page', 1);
        $articleNo = (int) $this->params()->fromQuery('articleNo', 0);
         /*
          * Date from AngularJS:
          * 2016-02-15T23:00:00.000Z
          */
        $stockIns['entry_time_from'] = \GodataRest\Tools::angularDateToISO8601($this->params()->fromQuery('entryTimeFrom', date(DATE_ISO8601, 0)));
        $stockIns['entry_time_to'] = \GodataRest\Tools::angularDateToISO8601($this->params()->fromQuery('entryTimeTo', date(DATE_ISO8601)));
        $dateValidator = new \Zend\Validator\Date(['format' => DATE_ISO8601]);
        if (!$dateValidator->isValid($stockIns['entry_time_from']) || !$dateValidator->isValid($stockIns['entry_time_to'])) {
//            $this->getLogger()->debug('date is not valid (from): ' . $stockIns['entry_time_from']);
//            $this->getLogger()->debug('date is not valid (to): ' . $stockIns['entry_time_to']);
            $timestampFrom = 0;
            $timestampto = 1999999999; // 2033-05-18 05:33:19 (biggest MySQL Unixtime for: select from_unixtime(1999999999))
        } else {
            $timezone = new \DateTimeZone('Europe/Berlin');
            $entryTimeFrom = \DateTime::createFromFormat(DATE_ISO8601, $stockIns['entry_time_from'], $timezone);
            $entryTimeto = \DateTime::createFromFormat(DATE_ISO8601, $stockIns['entry_time_to'], $timezone);
            $timestampFrom = $entryTimeFrom->getTimestamp();
            $timestampto = $entryTimeto->getTimestamp();
            $timestampto += 24 * 60 * 60 - 1; // plus einen Tag minus einer Sekunde
//            $this->getLogger()->debug('entry_time_from: ' . $stockIns['entry_time_from'] . '; unixtime: ' . $timestampFrom . '; date: ' . date('Y-m-d H:i:s' , $timestampFrom));
//            $this->getLogger()->debug('entry_time_to: ' . $stockIns['entry_time_to'] . '; unixtime: ' . $timestampto . '; date: ' . date('Y-m-d H:i:s' , $timestampto));
        }
        $stockInsData = $this->stockInTablex->getStockIns($stockIns['size'], $stockIns['page'], $articleNo, $timestampFrom, $timestampto);
        if (!empty($stockInsData['data'])) {
            $stockIns['count'] = $stockInsData['count'];
            foreach ($stockInsData['data'] as $stockInData) {
                $stockEntity = new \GodataRest\Entity\Stock\StockInEntity();
                $stockEntity->flipMapping();
                $stockEntity->exchangeArray($stockInData);
                $stockEntity->escapeForOutput();
                $stockIns['data'][] = $stockEntity->getArrayCopy();
            }
        } else {
            $stockIns['count'] = 0;
            $stockIns['data'] = [];
        }
        return new JsonModel(
                $stockIns
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
            /**
             * @todo required fields check
             */
            $stockEntity = new \GodataRest\Entity\Stock\StockInEntity();
            $data['entryTime'] = time(); // mit Hand eingeben lassen?!?!???
            $stockEntity->exchangeArray($data);
            $lastInsertId = $stockEntity->save($this->stockInTable);
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
        
        return new JsonModel(
                ['id' => $id, 'result' => 'foo']
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
        $result = 0;
        $jsonArr = new JsonModel();
        $jsonArr->setVariable('id', $id);
        if ($data && is_array($data)) {
            
        }
        return new JsonModel(
                ['id' => $id, 'result' => $result]
        );
    }

    public function setStockInTable(\GodataRest\Table\Stock\StockInTable $stockInTable)
    {
        $this->stockInTable = $stockInTable;
    }

    public function setStockInTablex(\GodataRest\Tablex\Stock\StockInTablex $stockInTablex)
    {
        $this->stockInTablex = $stockInTablex;
    }

}
