<?php
/**
 * Created by PhpStorm.
 * User: Quan Lee
 * Date: 12/7/16
 * Time: 10:47 AM
 */
namespace Company\Model;

use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;
use Zend\Validator\NotEmpty;
use Zend\Validator\StringLength;

class Company implements InputFilterAwareInterface
{
    public $id;
    public $name;
    public $address;
    public $country;
    public $email;
    public $mobile;
    protected $inputFilter;

    public function exchangeArray($data)
    {
        $this->id           = (isset($data['id']))     ? $data['id']     : null;
        $this->name         = (isset($data['name'])) ? $data['name'] : null;
        $this->address      = (isset($data['address']))  ? $data['address']  : null;
        $this->country      = (isset($data['country']))  ? $data['country']  : null;
        $this->email        = (isset($data['email']))  ? $data['email']  : null;
    }

     // Add the following method:
    public function getArrayCopy()
    {
        return get_object_vars($this);
    }

    public function setInputFilter(InputFilterInterface $inputFilter)
    {
        throw new \Exception("Not used");
    }

    public function getInputFilter()
    {
        if (!$this->inputFilter) {
            $inputFilter = new InputFilter();
            $factory     = new InputFactory();

            $inputFilter->add($factory->createInput(array(
                'name'     => 'id',
                'required' => true,
                'filters'  => array(
                    array('name' => 'Int'),
                ),
            )));

            $inputFilter->add($factory->createInput(array(
                'name'     => 'name',
                'required' => true,
                'filters'  => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                    array(
                        'name'    => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min'      => 5,
                            'max'      => 100,
                            'messages' => array(
                                'stringLengthTooShort'  => 'Tên công ty có độ dài từ 5 đến 100 ký tự !',
                                'stringLengthTooLong'   => 'Tên công ty có độ dài từ 5 đến 100 ký tự !'
                            ),
                        ),
                    ),
                ),
            )));

            $inputFilter->add($factory->createInput(array(
                'name'     => 'address',
                'required' => true,
                'filters'  => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                    array(
                        'name'    => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min'      => 1,
                            'max'      => 100,
                            'messages' => array(
                                'stringLengthTooShort'  => 'Địa chỉ không được để trống !',
                                'stringLengthTooLong'   => 'Địa chỉ không được để trống !'
                            ),
                        ),
                    ),
                ),
            )));


            $inputFilter->add($factory->createInput(array(
                'name'     => 'country',
                'required' => true,
                'filters'  => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                    array(
                        'name'    => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min'      => 0,
                            'max'      => 100,
                        ),
                    ),
                ),
            )));
            $inputFilter->add($factory->createInput(array(
                'name'     => 'email',
                'required' => true,
                'filters'  => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                    array(
                        'name'    => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min'      => 0,
                            'max'      => 100,
                        ),
                    ),
                ),
            )));


            $inputFilter->add($factory->createInput(array(
                'name'     => 'mobile',
                'required' => false,
                'filters'  => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                    array(
                        'name'    => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min'      => 0,
                            'max'      => 100,
                        ),
                    ),
                ),
            )));

            $this->inputFilter = $inputFilter;
        }

        return $this->inputFilter;
    }
}