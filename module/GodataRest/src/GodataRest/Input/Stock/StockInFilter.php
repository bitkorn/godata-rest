<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace GodataRest\Input\Stock;

use Zend\InputFilter\InputFilter;

/**
 * Description of StockInFilter
 *
 * @author allapow
 * @todo because we use filter NumberFormat ...dynamic local is recommendet
 */
class StockInFilter extends InputFilter
{

    /**
     *
     * @var array
     */
    private $stockInMapping;

    /**
     *
     * @var \GodataRest\Validator\Article\ExistArticleId
     */
    private $existArticleIdValidator;

    /**
     *
     * @var \GodataRest\Validator\Store\ExistStoreId
     */
    private $existStoreIdValidator;

    /**
     *
     * @var \GodataRest\Validator\Common\ExistUnitId
     */
    private $existUnitIdValidator;

    public function init()
    {
        $this->stockInMapping = (new \GodataRest\Entity\Stock\StockInEntity())->getMapping();

        $this->add(array(
            'name' => $this->stockInMapping['articleId'],
            'required' => true,
            'filters' => array(
                array('name' => 'Digits'),
            ),
            'validators' => array(
                $this->existArticleIdValidator
            ),
        ));

        $this->add(array(
            'name' => $this->stockInMapping['storeId'],
            'required' => true,
            'filters' => array(
                array('name' => 'Digits'),
            ),
            'validators' => array(
                $this->existStoreIdValidator
            ),
        ));

        $this->add(array(
            'name' => $this->stockInMapping['storePlace'],
            'required' => true,
            'filters' => array(
                array('name' => 'StringTrim'),
                array('name' => 'StripTags'),
                array('name' => 'HtmlEntities'), // erhoeht bei Umlauten die Zeichenkette um Faktor 6
            ),
            'validators' => array(
                array(
                    'name' => 'StringLength',
                    'break_chain_on_failure' => TRUE,
                    'options' => array(
                        'encoding' => 'UTF-8',
                        'min' => 1,
                        'max' => 40,
                    )),
            ),
        ));

        $this->add(array(
            'name' => $this->stockInMapping['charge'],
            'required' => true,
            'filters' => array(
                array('name' => 'StringTrim'),
                array('name' => 'StripTags'),
                array('name' => 'HtmlEntities'), // erhoeht bei Umlauten die Zeichenkette um Faktor 6
            ),
            'validators' => array(
                array(
                    'name' => 'StringLength',
                    'break_chain_on_failure' => TRUE,
                    'options' => array(
                        'encoding' => 'UTF-8',
                        'min' => 1,
                        'max' => 80,
                    )),
            ),
        ));

        $this->add(array(
            'name' => $this->stockInMapping['quantity'],
            'required' => true,
            'filters' => array(
//                array('name' => 'NumberFormat'), // does not work
//                array('name' => 'NumberParse'), // does not work
            ),
            'validators' => array(
                array(
                    'name' => 'IsFloat'
                )
            ),
        ));

        $this->add(array(
            'name' => $this->stockInMapping['unit'],
            'required' => true,
            'filters' => array(
                array('name' => 'NumberFormat'),
            ),
            'validators' => array(
                $this->existUnitIdValidator
            ),
        ));

        return parent::init();
    }

    public function setExistArticleIdValidator(\GodataRest\Validator\Article\ExistArticleId $existArticleIdValidator)
    {
        $this->existArticleIdValidator = $existArticleIdValidator;
    }

    public function setExistStoreIdValidator(\GodataRest\Validator\Store\ExistStoreId $existStoreIdValidator)
    {
        $this->existStoreIdValidator = $existStoreIdValidator;
    }
    
    public function setExistUnitIdValidator(\GodataRest\Validator\Common\ExistUnitId $existUnitIdValidator)
    {
        $this->existUnitIdValidator = $existUnitIdValidator;
    }

}
