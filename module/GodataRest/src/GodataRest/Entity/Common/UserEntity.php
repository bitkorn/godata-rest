<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace GodataRest\Entity\Common;

/**
 *
 * @author allapow
 */
class UserEntity extends \GodataRest\Entity\AbstractEntity
{

    /**
     *
     * @var array Array with Key=property; value=db column
     */
    protected $mapping = [
        'id' => 'id',
        'login' => 'login',
        'passwd' => 'passwd',
        'email' => 'email',
        'groups' => 'groups'
    ];
    private $shieldPassword;
    
    private $userGroups;

    /**
     * Takes the password from storage to shield storage.
     * Data from outer: $this->update() do not update the passowrd
     * Data from DB: do not send password along the outside
     * @param array $data
     */
    public function exchangeArray($data)
    {
        parent::exchangeArray($data);
        $this->shieldPassword = $this->storage['passwd'];
        unset($this->storage['passwd']);
    }

    private function encryptPassword()
    {
        $apache = new \Zend\Crypt\Password\Apache();
        $apache->setFormat('sha1');
        return $apache->create($this->shieldPassword);
    }

    /**
     * Userdata (login and password) come from outer and the password is not encrypted.
     * @param \GodataRest\Table\Common\User\UserTable $userTable
     * @return boolean
     */
    public function canLogin(\GodataRest\Table\Common\User\UserTable $userTable)
    {
        return $userTable->comparePassword($this->storage['login'], $this->encryptPassword());
    }

    /**
     * Userdata come from outer and the password is not encrypted.
     * @param \GodataRest\Table\Common\User\UserTable $userTable
     * @return int
     */
    public function save(\GodataRest\Table\Common\User\UserTable $userTable)
    {
        $tmpStorage = $this->storage;
        $tmpStorage['passwd'] = $this->encryptPassword();
        return $userTable->createUser($tmpStorage);
    }

    /**
     * Userdata come from outer. This update do not update the password.
     * @param \GodataRest\Table\Common\User\UserTable $userTable
     * @return int
     */
    public function update(\GodataRest\Table\Common\User\UserTable $userTable)
    {
        return $userTable->updateUser($this->storage['id'], $this->storage);
    }

    /**
     * Userdata come from outer and the password is not encrypted.
     * @param \GodataRest\Table\Common\User\UserTable $userTable
     * @return int
     */
    public function updatePassword(\GodataRest\Table\Common\User\UserTable $userTable)
    {
        return $userTable->updateUser($this->storage['id'], $this->storage);
    }
    
    public function getUserGroups()
    {
        if(empty($this->storage['groups'])) {
            return [];
        }
        if(empty($this->userGroups)) {
            $this->userGroups = explode(',', $this->storage['groups']);
        }
        return $this->userGroups;
    }

}
