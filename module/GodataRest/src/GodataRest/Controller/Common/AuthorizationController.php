<?php

namespace GodataRest\Controller\Common;

use Zend\View\Model\JsonModel;

/**
 * Says the App if HTTP Authorization string is ok.
 *
 * @author allapow
 */
class AuthorizationController extends \GodataRest\Controller\AbstractGodataController
{
    
    public function getList()
    {
        $this->checkAccess();
        if($this->isUser) {
            $this->responseArr['result'] = 1;
        }
        
        return new JsonModel(
                $this->responseArr
        );
    }

}
