<?php

namespace GodataRest\Table\Stock;

use Zend\Db\Adapter\AdapterAwareInterface;
use Zend\Db\TableGateway\AbstractTableGateway;
//use Zend\Db\ResultSet\ResultSetInterface;

/**
 * Description of Article
 *
 * @author allapow
 */
class StockInTable extends AbstractTableGateway implements AdapterAwareInterface
{

    protected $table = 'stock_in';

    /**
     *
     * @var \Zend\Log\Logger
     */
    private $logger;

    public function setDbAdapter(\Zend\Db\Adapter\Adapter $adapter)
    {
        $this->adapter = $adapter;
        $this->resultSetPrototype = new \Zend\Db\ResultSet\HydratingResultSet();
        $this->initialize();
    }

    public function setLogger(\Zend\Log\Logger $logger)
    {
        $this->logger = $logger;
    }

    /**
     * 
     * @param int $id
     * @return array
     */
    public function getStockIn($id)
    {
        $select = $this->sql->select();
        $select->where(['id' => $id]);
        $result = $this->selectWith($select);
        if (empty($result) || $result->count() != 1) {
            return [];
        }
        $resultArray = $result->toArray();
        return $resultArray[0];
    }

    /**
     * 
     * @param array $data
     * @return int Last insert ID
     */
    public function createStockIn(array $data)
    {
        $insert = $this->sql->insert();
        $insert->values($data);
        $result = $this->insertWith($insert);
        if ($result >= 1) {
//            $this->sql->select()->columns([]);
            return $this->lastInsertValue;
        }
        return 0;
    }

    public function deleteStockIn($id)
    {
        $delete = $this->sql->delete();
        $delete->where(['id' => $id]);
        return $this->deleteWith($delete);
    }

    public function updateStockIn($id, $data)
    {
//        $this->logger->debug('data: ' . print_r($data, true));
        $update = $this->sql->update();
        $update->set($data)->where(['id' => $id]);
        $result = $this->updateWith($update);
        if (empty($result) || !is_array($result)) {
            return 0;
        }
        return count($result);
    }

}
