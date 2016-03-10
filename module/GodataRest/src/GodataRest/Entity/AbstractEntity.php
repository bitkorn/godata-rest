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
     * Public because ArticleListEntryEntity takes a copy.
     * @var array
     */
    protected $mapping = [];
    protected $escapekeys = [];
    
    /**
     * Associative array with messages from validation.
     * @var array [key($this->mapping) => ['message1','message2']]
     */
    protected $validateMessages = [];

    /**
     * Flip if data comes from DB
     */
    public function flipMapping()
    {
        $this->mapping = array_flip($this->mapping);
    }

    /**
     * First set $storage empty-values to have no unset key.
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
    
    /**
     * Validate input data for storage in database.
     * In this direction (input -> database) the $this->mapping array are not fliped!
     * If data are invalid, the messages key in $this->validateMessages is the key from unplipped $this->mapping.
     * @param \Zend\InputFilter\InputFilter $inputFilter
     * @return boolean
     */
    public function isValid(\Zend\InputFilter\InputFilter $inputFilter) {
        $inputFilter->setData($this->storage);
        $isValid = $inputFilter->isValid();
        if(!$isValid) {
            $messages = $inputFilter->getMessages();
            $flippedMapping = array_flip($this->mapping);
            foreach ($messages as $key => $message) {
                if(isset($flippedMapping[$key])) {
                    $this->validateMessages[$flippedMapping[$key]] = $message;
                }
            }
        }
        return $isValid;
    }

    public function escapeForOutput()
    {
        $escaper = new \Zend\Escaper\Escaper('utf-8');
        foreach ($this->escapekeys as $escapeKey) {
            $this->storage[$escapeKey] = $escaper->escapeHtml($this->storage[$escapeKey]);
        }
    }
    
    public function getMapping()
    {
        return $this->mapping;
    }

    public function getEscapekeys()
    {
        return $this->escapekeys;
    }
    
    public function getValidateMessages()
    {
        return $this->validateMessages;
    }

}
