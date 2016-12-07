<?php
/**
 * Created by PhpStorm.
 * User: Quan Lee
 * Date: 12/7/16
 * Time: 10:43 AM
 */
namespace Company\Form;

use Zend\Form\Form;
use Zend\Validator\NotEmpty;
use Zend\Validator\StringLength;

class CompanyForm extends Form
{
    public function __construct($name = null)
    {

        parent::__construct('company');
        $this->setAttribute('method', 'post');
        $this->add(array(
            'name' => 'id',
            'attributes' => array(
                'type'  => 'hidden',
            ),
        ));
        $this->add(array(
            'name' => 'name',
            'attributes' => array(
                'type'  => 'text',
            ),
            'options' => array(
                'label' => 'name',
            ),
        ));
        $this->add(array(
            'name' => 'address',
            'attributes' => array(
                'type'  => 'text',
            ),
            'options' => array(
                'label' => 'address',
            )
        ));
        $this->add(array(
            'name' => 'country',
            'attributes' => array(
                'type'  => 'text',
            ),
            'options' => array(
                'label' => 'country',
            )
        ));
        $this->add(array(
            'name' => 'email',
            'attributes' => array(
                'type'  => 'text',
            ),
            'options' => array(
                'label' => 'email',
            )
        ));
        $this->add(array(
            'name' => 'mobile',
            'attributes' => array(
                'type'  => 'text',
            ),
            'options' => array(
                'label' => 'mobile',
            )
        ));
        $this->add(array(
            'name' => 'submit',
            'attributes' => array(
                'type'  => 'submit',
                'value' => 'Go',
                'id' => 'submitbutton',
            ),
        ));


    }
}