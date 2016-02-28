<?php

namespace GodataRest\Tablex\Stock;

use Zend\Db\Adapter\Driver\Pdo\Result;

/**
 * Description of Article
 *
 * @author allapow
 */
class StockInTablex extends \GodataRest\Tablex\AbstractGodataTablex
{

    public function getStockIns($size, $page = 1, $articleNo = '', $entryTimeFrom = 0, $entryTimeTo = 0)
    {
        $returnArray = ['data' => []];
//        $this->logger->debug('count articles: ' . $this->countArticles());
//        $this->logger->debug('$size: ' . $size . '; $page: ' . $page);
        $returnArray['count'] = $this->countStockIns($articleNo, $entryTimeFrom, $entryTimeTo);
//        $this->logger->debug('count: ' . $returnArray['count']);
        if ($returnArray['count'] > 0) {
            $sql = new \Zend\Db\Sql\Sql($this->adapter);
            $select = $sql->select('stock_in');
            if ($articleNo != '') {
                $selectSubArticle = $sql->select('article')->columns(['id']);
                $selectSubArticle->where(['article_no' => $articleNo]);
                $select->where->in('article_id', $selectSubArticle);
            }
            if (!empty($entryTimeFrom)) {
                $select->where->greaterThanOrEqualTo('entry_time', $entryTimeFrom);
            }
            if (!empty($entryTimeTo)) {
                $select->where->lessThanOrEqualTo('entry_time', $entryTimeTo);
            }
            if ($size > 0) {
                $offset = ($page - 1) * $size;
                $select->offset($offset);
                $select->limit($size);
            }
            try {
                /** \Zend\Db\Adapter\Driver\Pdo\Statement */
                $stmt = $sql->prepareStatementForSqlObject($select);
//                $this->logger->debug('$stmt class: ' . get_class($stmt));
                /** \Zend\Db\Adapter\Driver\Pdo\Result */
                $result = $stmt->execute();
//                $this->logger->debug('$result class: ' . get_class($result));
                if (!empty($result) && $result instanceof Result && $result->count() > 0) {
                    while ($result->next()) {
                        $returnArray['data'][] = $result->current();
                    }
                }
            } catch (\RuntimeException $ex) {
                $this->logger->err($ex->getMessage());
            }
        }
//        $this->logger->debug('articleList: ' . print_r($returnArray, true));
        return $returnArray;
    }

    public function countStockIns($articleNo = '', $entryTimeFrom = 0, $entryTimeTo = 0)
    {
        $sql = new \Zend\Db\Sql\Sql($this->adapter);
        $select = $sql->select('stock_in');
        $select->columns([new \Zend\Db\Sql\Expression('COUNT(id) AS count_id')]);
        if ($articleNo != '') {
            $selectSubArticle = $sql->select('article')->columns(['id']);
            $selectSubArticle->where(['article_no' => $articleNo]);
            $select->where->in('article_id', $selectSubArticle);
        }
        if (!empty($entryTimeFrom)) {
            $select->where->greaterThanOrEqualTo('entry_time', $entryTimeFrom);
        }
        if (!empty($entryTimeTo)) {
            $select->where->lessThanOrEqualTo('entry_time', $entryTimeTo);
        }
        try {
            $stmt = $sql->prepareStatementForSqlObject($select);
            $result = $stmt->execute();
            $current = $result->current();
            return $current['count_id'];
        } catch (\RuntimeException $ex) {
            $this->logger->err($ex->getMessage());
        }
        return 0;
    }

}
