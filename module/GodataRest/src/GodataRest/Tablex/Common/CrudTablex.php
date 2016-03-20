<?php

namespace GodataRest\Tablex\Common;

/**
 * CrudTablex has for all Entities the getDefaultCrudGroupsFoo() function.
 * It is used for CRUD Action CREATE, because there is no entity that we can ask.
 *
 * @author allapow
 */
class CrudTablex extends \GodataRest\Tablex\AbstractGodataTablex
{

    private $tableSchema = 'godatas';
    private $crudGroupsColumnName = 'crud_groups';
    private $defaultCrudGroupsQuery = "SELECT COLUMN_DEFAULT FROM information_schema.columns
                                            WHERE TABLE_SCHEMA = '%s'
                                            AND TABLE_NAME = '%s'
                                            AND COLUMN_NAME = '%s'";

    /**
     * 
     * @return array
     */
    public function getDefaultCrudGroups($tableName)
    {
        $stmt = $this->adapter->createStatement(sprintf($this->defaultCrudGroupsQuery, $this->tableSchema, $tableName, $this->crudGroupsColumnName));
        $result = $stmt->execute();
        $returnArr = [];
        if ($result->count() > 0) {
            if ($result->valid()) {
                $current = $result->current();
                //            $returnArr[$current['topic_id']] = $current;
                $returnArr = explode(',',$current['COLUMN_DEFAULT']);
            }
            if (count($returnArr) == 4) {
                return $returnArr;
            }
        }
        return $returnArr;
    }
    
    public function getDefaultCrudGroupsArticle()
    {
        $stmt = $this->adapter->createStatement(sprintf($this->defaultCrudGroupsQuery, $this->tableSchema, 'article', $this->crudGroupsColumnName));
        $result = $stmt->execute();
        $returnArr = [];
        if ($result->count() > 0) {
            if ($result->valid()) {
                $current = $result->current();
                //            $returnArr[$current['topic_id']] = $current;
                $returnArr = explode(',',$current['COLUMN_DEFAULT']);
            }
            if (count($returnArr) == 4) {
                return $returnArr;
            }
        }
        return $returnArr;
    }

}
