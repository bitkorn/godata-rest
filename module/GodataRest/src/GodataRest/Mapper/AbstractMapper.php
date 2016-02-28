<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace GodataRest\Mapper;

/**
 * Description of AbstractMapper
 *
 * @author allapow
 */
class AbstractMapper
{

    /**
     *
     * @var array
     */
    protected $data;
    protected $entity;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function computeData()
    {
        if (!isset($this->data) || !is_array($this->data)) {
            throw new Exception('No data to map');
        }
    }

}
