<?php

/**
 * Created by PhpStorm.
 * User: Quan Lee
 * Date: 12/7/16
 * Time: 10:50 AM
 */

namespace Company\Model;

use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;
use Zend\Form\Element\Select;
use Zend\Paginator\Adapter\DbSelect;
use Zend\Paginator\Paginator;

class CompanyTable
{
    protected $tableGateway;

    public function __construct(TableGateway $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }


    public function fetchAll()
    {
        // new object cho bảng Company
        $resultSet = $this->tableGateway->select();
        return $resultSet;
    }

    // Get company theo Id
    public function getCompany($id)
    {
        $id  = (int) $id;
        $rowset = $this->tableGateway->select(array('id' => $id));
        $row = $rowset->current();
        if (!$row) {
            throw new \Exception("Could not find row $id");
        }
        return $row;
    }

    // Insert | Update dữ liệu
    public function saveCompany(Company $company)
    {
        $data = array(
            'name' => $company->name,
            'address'  => $company->address,
            'country'  => $company->country,
            'email'     => $company->email,
            'mobile'    => $company->mobile,
        );
        $id = (int)$company->id;
        // Nếu như có Id thì update, không có ID thì insert
        if ($id == 0) {
            $this->tableGateway->insert($data);
        } else {
            if ($this->getCompany($id)) {
                $this->tableGateway->update($data, array('id' => $id));
            } else {
                throw new \Exception('Form id does not exist');
            }
        }
    }

    // Xóa dữ liệu
    public function deleteCompany($id)
    {
        $this->tableGateway->delete(array('id' => $id));
    }
}