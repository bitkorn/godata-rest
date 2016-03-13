<?php

namespace GodataRest\Controller\Common;

use Zend\View\Model\JsonModel;
use Zend\Http\PhpEnvironment\Response;

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
    
    /**
     *
     * @var \GodataRest\Table\Common\User\UserTable
     */
    private $userTable;
    
    public function getList()
    {
        $this->headers = $this->request->getHeaders();
        $authorization = $this->headers->get('Authorization')->getFieldValue();
        $decoded = explode(':', base64_decode(substr($authorization, 6)));
        if(!empty($decoded[0]) && !empty($decoded[1])) {
            $userEntity = new \GodataRest\Entity\Common\UserEntity();
            $userEntity->exchangeArray(['login' => $decoded[0], 'passwd' => $decoded[1]]);
//            $userEntity->save($this->userTable); // create user on the fly
            $userId = $userEntity->canLogin($this->userTable);
            if($userId > 0) {
                $userData = $this->userTable->getUserById($userId);
                $userEntity->exchangeArray($userData);
                $this->userContainer->entity = $userEntity;
                $sessionId = $this->userContainer->getManager()->getId();
                $this->responseArr['data'] = $sessionId;
                $this->responseArr['result'] = 1;
                $this->getLogger()->debug('$userContainer->entity: ' . print_r($this->userContainer->entity, true));
//                $this->getLogger()->debug('$this->user: ' . print_r($this->user, true));
            } else {
                $this->getResponse()->setStatusCode(Response::STATUS_CODE_400);
                $this->responseArr['messages'][] = 'so net';
            }
        } else {
            $this->getResponse()->setStatusCode(Response::STATUS_CODE_400);
            $this->responseArr['messages'][] = 'username and password can\'t be empty';
        }
        return new JsonModel(
                $this->responseArr
        );
    }
    
    public function setUserTable(\GodataRest\Table\Common\User\UserTable $userTable)
    {
        $this->userTable = $userTable;
    }

}
