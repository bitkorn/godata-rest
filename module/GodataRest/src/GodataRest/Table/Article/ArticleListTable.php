<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace GodataRest\Table\Article;

use Zend\Db\Adapter\AdapterAwareInterface;
use Zend\Db\TableGateway\AbstractTableGateway;

/**
 * Description of ArticleList
 *
 * @author allapow
 */
class ArticleListTable extends AbstractTableGateway implements AdapterAwareInterface
{

    protected $table = 'article_list';

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
     * @param int $articleId
     * @return int
     */
    public function articleListExist($articleId)
    {
        if (!$articleId) {
            return 0;
        }
        $select = $this->sql->select();
        $select->columns(['entries_count' => new \Zend\Db\Sql\Predicate\Expression('COUNT(id)')], false);
        $select->where(['article_id_parent' => $articleId]);
        try {
            $result = $this->selectWith($select);
        } catch (\RuntimeException $ex) {
            $this->logger->debug($ex->getMessage());
        }
        
        if (empty($result)) {
            return 0;
        }
        $resultArray = $result->current();
//        $this->logger->debug(print_r($resultArray, true));
        return (int) $resultArray['entries_count'];
    }

    public function createArticleListPart(array $data)
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
    
    public function updateArticleListPart($id, $data)
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

    public function deleteArticleListPart($id)
    {
        $delete = $this->sql->delete();
        $delete->where(['id' => $id]);
        $result = $this->deleteWith($delete);
        if ($result == 1) {
//            $this->sql->select()->columns([]);
            return $id;
        }
        return 0;
    }
}
