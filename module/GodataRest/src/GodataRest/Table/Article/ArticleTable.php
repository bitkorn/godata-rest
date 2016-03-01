<?php

namespace GodataRest\Table\Article;

use Zend\Db\Adapter\AdapterAwareInterface;
use Zend\Db\TableGateway\AbstractTableGateway;
use Zend\Db\ResultSet\ResultSetInterface;

/**
 * Description of Article
 *
 * @author allapow
 */
class ArticleTable extends AbstractTableGateway implements AdapterAwareInterface
{

    protected $table = 'article';

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
    public function getArticle($id)
    {
        if(is_nan($id) || $id < 0) { // can be 0
            return [];
        }
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
     * @return array
     */
    public function getArticleList($size, $page = 1, $articleNo = '', $desc = '', $articleType = 0)
    {
        $returnArray = ['data' => []];
//        $this->logger->debug('count articles: ' . $this->countArticles());
//        $this->logger->debug('$size: ' . $size . '; $page: ' . $page);
        $returnArray['count'] = $this->countArticles($articleNo, $desc, $articleType);
        if ($returnArray['count'] > 0) {
            $select = $this->sql->select();
            if ($articleNo != '') {
                $select->where->like('article_no', "%$articleNo%");
            }
            if (!empty($desc)) {
//                $select->where(new \Zend\Db\Sql\Predicate\Like('desc_short', "%$search%"));
                $select->where->like('desc_short', "%$desc%")->or->like('desc_long', "%$desc%");
            }
            if (!empty($articleType)) {
                $select->where(['article_type' => $articleType]);
            }
            if ($size > 0) {
                $offset = ($page - 1) * $size;
                $select->offset($offset);
                $select->limit($size);
            }
            try {
                $result = $this->selectWith($select);
                if (!empty($result) && $result instanceof ResultSetInterface && $result->count() > 0) {
                    $returnArray['data'] = $result->toArray();
                }
            } catch (\RuntimeException $ex) {
                $this->logger->err($ex->getMessage());
            }
        }
//        $this->logger->debug('articleList: ' . print_r($returnArray, true));
        return $returnArray;
    }

    public function countArticles($articleNo = '', $desc = '', $articleType = 0)
    {
        $select = $this->sql->select();
        $select->columns([new \Zend\Db\Sql\Expression('COUNT(id) AS count_id')]);
        if ($articleNo != '') {
            $select->where->like('article_no', "%$articleNo%");
        }
        if (!empty($desc)) {
//                $select->where(new \Zend\Db\Sql\Predicate\Like('desc_short', "%$search%"));
            $select->where->like('desc_short', "%$desc%")->or->like('desc_long', "%$desc%");
        }
        if (!empty($articleType)) {
            $select->where(['article_type' => $articleType]);
        }
        try {
            $result = $this->selectWith($select);
            $current = $result->current();
            return $current['count_id'];
        } catch (\RuntimeException $ex) {
            $this->logger->err($ex->getMessage());
        }
        return 0;
    }

    /**
     * 
     * @param array $data
     * @return int Last insert ID
     */
    public function createArticle(array $data)
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

    public function deleteArticle($id)
    {
        $delete = $this->sql->delete();
        $delete->where(['id' => $id]);
        $result = $this->deleteWith($delete);
        if(is_int($result)) {
            return $result;
        }
        return 0;
    }

    /**
     * 
     * @param int $id
     * @param array $data
     * @return int
     */
    public function updateArticle($id, $data)
    {
//        $this->logger->debug('data: ' . print_r($data, true));
        $update = $this->sql->update();
        $update->set($data)->where(['id' => $id]);
        $stmt = $this->sql->prepareStatementForSqlObject($update);
        $result = $stmt->execute(); // Zend\Db\Adapter\Driver\Pdo\Result
//        $result = $this->updateWith($update);
        if ($result->valid() && ($result instanceof \Zend\Db\Adapter\Driver\ResultInterface)) {
            return $result->count();
        }
        return 0;
    }

}
