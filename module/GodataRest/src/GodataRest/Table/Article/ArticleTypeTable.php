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
class ArticleTypeTable extends AbstractTableGateway implements AdapterAwareInterface
{

    protected $table = 'article_type';

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
     * Die hier sollte man wohl cachen weil sie sich sehr selten ändern.
     * 
     * @return array
     */
    public function getArticleTypesIdAssoc()
    {
        $resultArray = $this->getArticleTypes();
        $articleTypesIdAssoc = [];
        foreach ($resultArray as $articleType) {
            $articleTypesIdAssoc[$articleType['id']] = $articleType;
        }
        return $articleTypesIdAssoc;
    }

    /**
     * This is used for AngularJS directive select.
     * @return array
     */
    public function getArticleTypes()
    {
        $select = $this->sql->select();
        $result = $this->selectWith($select);
        if (empty($result) || $result->count() < 1) {
            return [];
        }
        $resultArray = $result->toArray();
        return $resultArray;
    }

}
