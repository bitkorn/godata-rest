<?php

namespace GodataRest\Table\Common\User;

use Zend\Db\Adapter\AdapterAwareInterface;
use Zend\Db\TableGateway\AbstractTableGateway;

/**
 *
 * @author allapow
 */
class UserTable extends AbstractTableGateway implements AdapterAwareInterface
{

    protected $table = 'user';

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

    public function getUsers($order = 'id', $orderDirection = 'ASC')
    {
        $select = $this->sql->select();
        $select->order($order . ' ' . $orderDirection);
        try {
            $result = $this->selectWith($select);
        } catch (\RuntimeException $ex) {
            $this->logger->err($ex->getMessage());
        }
        $users = [];
        while ($result->valid()) {
            $current = $result->current();
            $users[] = $current->getArrayCopy();
            $result->next();
        }
        return $users;
    }

    public function createUser(array $data)
    {
        $insert = $this->sql->insert();
        $insert->values($data);
        $stmt = $this->sql->prepareStatementForSqlObject($insert);
        $result = $stmt->execute(); // Zend\Db\Adapter\Driver\Pdo\Result
        if ($result->valid() && ($result instanceof \Zend\Db\Adapter\Driver\ResultInterface)) {
            return $result->getGeneratedValue();
        }
        return 0;
    }

    public function updateUser($id, $data)
    {
        $update = $this->sql->update();
        $update->set($data)->where(['id' => $id]);
        $stmt = $this->sql->prepareStatementForSqlObject($update);
        $result = $stmt->execute(); // Zend\Db\Adapter\Driver\Pdo\Result
        if ($result->valid() && ($result instanceof \Zend\Db\Adapter\Driver\ResultInterface)) {
            return $result->count();
        }
        return 0;
    }

    public function deleteUser($id)
    {
        $delete = $this->sql->delete();
        $delete->where(['id' => $id]);
        $result = $this->deleteWith($delete);
        if (is_int($result)) {
            return $result;
        }
        return 0;
    }

    /**
     * 
     * @param type $id
     * @param type $password
     * @return int The user id or 0 if failing.
     */
    public function comparePassword($id, $password)
    {
        $select = $this->sql->select();
//        $select->columns([new \Zend\Db\Sql\Expression('COUNT(id) AS count_id')]);
        $select->where(['login' => $id, 'passwd' => $password]);
        try {
            $result = $this->selectWith($select);
            if($result->count() != 1) {
                return 0;
            }
            $current = $result->current();
            return $current['id'];
        } catch (\RuntimeException $ex) {
            $this->logger->err($ex->getMessage());
        }
        return 0;
    }
    
    public function getUserByLogin($login)
    {
        $select = $this->sql->select();
        $select->where(['login' => $login]);
        $result = $this->selectWith($select);
        if (empty($result) || $result->count() != 1) {
            return [];
        }
        $resultArray = $result->toArray();
        return $resultArray[0];
    }
    
    public function getUserById($id)
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

}
