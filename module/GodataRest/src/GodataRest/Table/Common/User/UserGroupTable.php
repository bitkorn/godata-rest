<?php

namespace GodataRest\Table\Common\User;

use Zend\Db\Adapter\AdapterAwareInterface;
use Zend\Db\TableGateway\AbstractTableGateway;

/**
 *
 * @author allapow
 */
class UserGroupTable extends AbstractTableGateway implements AdapterAwareInterface
{

    protected $table = 'user_group';

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

    public function getUserGroups($order = 'order_priority', $orderDirection = 'ASC')
    {
        $select = $this->sql->select();
        $select->order($order . ' ' . $orderDirection);
        try {
            $result = $this->selectWith($select);
        } catch (\RuntimeException $ex) {
            $this->logger->err($ex->getMessage());
        }
        $groups = [];
        while ($result->valid()) {
            $current = $result->current();
            $groups[] = $current->getArrayCopy();
            $result->next();
        }
        return $groups;
    }

}
