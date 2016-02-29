<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace GodataRest\Entity;

/**
 * Description of AbstractEntity
 *
 * @author allapow
 */
class AbstractEntity extends \Zend\Stdlib\ArrayObject
{

    /**
     * Public because ArticleListEntryEntity take a copy.
     * @var array
     */
    public $mapping = [];
    public $escapekeys = [];

    /**
     * Flip if data comes from DB
     */
    public function flipMapping()
    {
        $this->mapping = array_flip($this->mapping);
    }

    /**
     * First set storage empty values to have no unset key.
     * Exchange $data to an Array and set class members.
     * @param array $data
     */
    public function exchangeArray($data)
    {
        $storageKeys = array_values($this->mapping);
        foreach ($storageKeys as $storageKey) {
            $this->storage[$storageKey] = '';
        }
        foreach ($data as $key => $value) {
            if (isset($this->mapping[$key])) {
                $this->storage[$this->mapping[$key]] = $this->$key = $value;
            }
        }
    }

    public function escapeForOutput()
    {
        $escaper = new \Zend\Escaper\Escaper('utf-8');
        foreach ($this->escapekeys as $escapeKey) {
            $this->storage[$escapeKey] = $escaper->escapeHtml($this->storage[$escapeKey]);
        }
    }

}
