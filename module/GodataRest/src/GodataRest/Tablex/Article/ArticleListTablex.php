<?php

namespace GodataRest\Tablex\Article;

use Zend\Db\Adapter\Driver\Pdo\Result;

/**
 * Description of ArticleListTablex
 *
 * @author allapow
 */
class ArticleListTablex extends \GodataRest\Tablex\AbstractGodataTablex
{

    const ARTICLE_LIST_TABLE = 'article_list';
    const ARTICLE_TABLE = 'article';

    private $query = 'SELECT al.*, ARTICLE_COLUMS,
                        (SELECT COUNT(id) FROM article_list WHERE article_id_parent=al.article_id) AS count_sub_articles
                        FROM article_list al
                        LEFT JOIN article a ON a.id = al.article_id
                        where article_id_parent=?';

    /**
     * article database columns except column 'id'
     * @var array
     */
    private $articleDbColums = ['article_no', 'article_type', 'article_group', 'article_class', 'desc_short', 'desc_long', 'desc_tec',
        'date_create', 'date_edit', 'user_create', 'user_edit', 'unit', 'status',
        'default_store_id', 'default_store_place'];

    public function buildQuery()
    {
        $goodArticleColumns = 'a.' . implode(',a.', $this->articleDbColums);
        
        $goodQuery = str_replace('ARTICLE_COLUMS', $goodArticleColumns, $this->query);
//        $this->logger->debug('$goodQuery: ' . $goodQuery);
        return $goodQuery;
    }

    /**
     * Give article from the next level (in db.article_list) and join them with db.article
     * and count sub articles:
     * SELECT al.*, (SELECT COUNT(id) FROM article_list WHERE article_id_parent=al.article_id) AS countSub FROM article_list al where article_id_parent=14;
     * @param int $articleId
     * @return array
     */
    public function getArticleList($articleId)
    {
        $parameter = new \Zend\Db\Adapter\ParameterContainer(array($articleId));
        $stmt = $this->adapter->createStatement($this->buildQuery(), $parameter);
        $result = $stmt->execute();
        $returnArray = [];
        if($result->count() > 0) {
            $returnArr = array();
            while ($result->valid()) {
                $current = $result->current();
    //            $returnArr[$current['topic_id']] = $current;
                $returnArr[] = $current;
                $result->next();
            }
            if(count($returnArr) > 0) {
                return $returnArr;
            }
        }
        
        
//        $sql = new \Zend\Db\Sql\Sql($this->adapter);
//        $select = $sql->select(self::ARTICLE_LIST_TABLE);
//        $articleColums = \GodataRest\Entity\Article\ArticleListEntryEntity::$articleDbColums;
//        try {
//            $select->join(self::ARTICLE_TABLE, 'article_list.article_id = article.id', $articleColums);
//
//            $selectSub = $sql->select(self::ARTICLE_LIST_TABLE);
//            $selectSub->columns(['count_sub_articles' => new \Zend\Db\Sql\Expression('COUNT(id)')]);
////            $selectSub->where(['article_id_parent' => new \Zend\Db\Sql\Expression('article_list.article_id')]);
//            $selectSub->where->equalTo('article_id_parent', 'article_list.article_id');
//            $this->logger->debug('$selectSub: ' . $selectSub->getSqlString());
//            $select->columns(['id', 'article_id_parent', 'article_id', 'quantity', 'desc', 'count_sub_articles' => $selectSub]);
//
//            $select->where(['article_id_parent' => $articleId]);
//        } catch (\Exception $ex) {
//            $this->logger->err($ex->getMessage());
//            $this->logger->err(get_class($ex));
//        }
//        $this->logger->debug('$select: ' . $select->getSqlString());
//        try {
//            /** \Zend\Db\Adapter\Driver\Pdo\Statement */
//            $stmt = $sql->prepareStatementForSqlObject($select);
////            $this->logger->debug('$stmt class: ' . get_class($stmt));
//            /** \Zend\Db\Adapter\Driver\Pdo\Result */
//            $result = $stmt->execute();
////            $this->logger->debug('$result class: ' . get_class($result));
//            if (!empty($result) && $result instanceof Result && $result->count() > 0) {
//                while ($result->next()) {
//                    $returnArray[] = $result->current();
//                }
//            }
//        } catch (\RuntimeException $ex) {
//            $this->logger->err($ex->getMessage());
//        }
        return $returnArray;
    }
    
    public function getArticleDbColums()
    {
        return $this->articleDbColums;
    }

}
