<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace GodataRest\Table\Store;

use Zend\Db\Adapter\AdapterAwareInterface;
use Zend\Db\TableGateway\AbstractTableGateway;

/**
 * Description of StoreTable
 *
 * @author allapow
 */
class StoreTable extends AbstractTableGateway implements AdapterAwareInterface
{

    protected $table = 'store';

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
    

    public function existStoreId($id) {
        $select = $this->sql->select();
        $select->columns([new \Zend\Db\Sql\Expression('COUNT(id) AS count_id')]);
        $select->where(['id' => $id]);
        try {
            $result = $this->selectWith($select);
            $current = $result->current();
            return 0 < $current['count_id'];
        } catch (\RuntimeException $ex) {
            $this->logger->err($ex->getMessage());
        }
        return false;
    }
}
