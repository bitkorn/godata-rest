<?php

namespace GodataRest\Input\Article;

use Zend\InputFilter\InputFilter;

/**
 * Description of ArticleEditFilter
 *
 * @author allapow
 * @todo because we use filter NumberFormat ...dynamic local is recommendet
 */
class ArticleEditFilter extends ArticleNewFilter
{

    public function init()
    {
        $this->add(array(
            'name' => $this->articleMapping['descLong'],
            'required' => false,
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
                        'min' => 0,
                        'max' => 10000,
                    )),
            ),
        ));
        $this->add(array(
            'name' => $this->articleMapping['descTec'],
            'required' => false,
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
                        'min' => 0,
                        'max' => 120,
                    )),
            ),
        ));

        $this->add(array(
            'name' => $this->articleMapping['priceIndependent'],
            'required' => false,
            'filters' => array(
            ),
            'validators' => array(
                array('name' => 'IsFloat'),
            ),
        ));

        return parent::init();
    }

}
