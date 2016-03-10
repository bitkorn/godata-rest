<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace GodataRest\Input\Article;

use Zend\InputFilter\InputFilter;

/**
 * Description of StockInFilter
 *
 * @author allapow
 * @todo because we use filter NumberFormat ...dynamic local is recommendet
 */
class ArticleNewFilter extends InputFilter
{

    /**
     *
     * @var array
     */
    private $articleMapping;
    
    /**
     *
     * @var \GodataRest\Validator\Article\ExistArticleType
     */
    private $existArticleTypeValidator;
    
    /**
     *
     * @var \GodataRest\Validator\Article\ExistArticleGroup
     */
    private $existArticleGroupValidator;

    public function init()
    {
        $this->articleMapping = (new \GodataRest\Entity\Article\ArticleEntity())->getMapping();

        $this->add(array(
            'name' => $this->articleMapping['articleNo'],
            'required' => true,
            'filters' => array(
//                array('name' => 'Digits'), // kill all what is no digit
            ),
            'validators' => array(
                array('name' => 'Digits'),
                // company special validator imaginable
            ),
        ));

        $this->add(array(
            'name' => $this->articleMapping['articleType'],
            'required' => true,
            'filters' => array(
                array('name' => 'Digits'),
            ),
            'validators' => array(
                $this->existArticleTypeValidator
            ),
        ));

        $this->add(array(
            'name' => $this->articleMapping['articleGroup'],
            'required' => true,
            'filters' => array(
                array('name' => 'Digits'),
            ),
            'validators' => array(
                $this->existArticleGroupValidator
            ),
        ));

        $this->add(array(
            'name' => $this->articleMapping['descShort'],
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
                        'min' => 2,
                        'max' => 120,
                    )),
            ),
        ));

        return parent::init();
    }
    
    public function setExistArticleTypeValidator(\GodataRest\Validator\Article\ExistArticleType $existArticleTypeValidator)
    {
        $this->existArticleTypeValidator = $existArticleTypeValidator;
    }
    
    public function setExistArticleGroupValidator(\GodataRest\Validator\Article\ExistArticleGroup $existArticleGroupValidator)
    {
        $this->existArticleGroupValidator = $existArticleGroupValidator;
    }

}
