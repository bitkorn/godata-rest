<?php

namespace GodataRest\Controller\Common;

use Zend\View\Model\JsonModel;

/**
 *
 * @author allapow
 */
class LoginController extends \GodataRest\Controller\AbstractGodataController
{
    /**
     *
     * @var \Zend\Http\Headers 
     */
    private $headers;
    
    public function getList()
    {
        $this->headers = $this->request->getHeaders();
        $authorization = $this->headers->get('Authorization')->getFieldValue();
        $decoded = explode(':', base64_decode(substr($authorization, 6)));
        $this->getLogger()->debug('user:' . $decoded[0] . '; passwd:' . $decoded[1]);
        return new JsonModel(
                $this->responseArr
        );
    }

}
