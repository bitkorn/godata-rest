<?php

namespace GodataRest\Controller\Common;

use Zend\View\Model\JsonModel;

/**
 * UnitController only for fetch all units.
 * Edit or insert new units can only make the admin :)
 *
 * @author allapow
 */
class UnitController extends \GodataRest\Controller\AbstractGodataController
{

    /**
     *
     * @var \GodataRest\Table\Common\UnitTable
     */
    private $unitTable;
    
    public function getList()
    {
        $units = $this->unitTable->getUnits();
        
        return new JsonModel(
                $units
        );
    }
    
    public function setUnitTable(\GodataRest\Table\Common\UnitTable $unitTable)
    {
        $this->unitTable = $unitTable;
    }

}
