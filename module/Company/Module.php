<?php

/**
 * Created by PhpStorm.
 * User: Quan Lee
 * Date: 12/7/16
 * Time: 10:2 AM
 */
namespace Company;
// Cần phải đặt namepace trước khi làm điều gì đó;
use Company\Model\Company;
use Company\Model\CompanyTable;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;

class Module
{

    public function getAutoloaderConfig()
    {
        // Phương thức giúp nạp các lớp xử dụng trong module vào dự án để có thể sử dụng
        return array(
            'Zend\Loader\ClassMapAutoloader' => array(
                __DIR__ . '/autoload_classmap.php',
            ),
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    public function getServiceConfig()
    {
        return array(
            'factories' => array(
                'Company\Model\CompanyTable' =>  function($sm) {
                    $tableGateway = $sm->get('CompanyTableGateway');
                    $table = new CompanyTable($tableGateway);
                    return $table;
                },
                'CompanyTableGateway' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Company());
                    return new TableGateway('company', $dbAdapter, null, $resultSetPrototype);
                },
            ),
        );
    }

    public function getConfig()
    {
        //Trả ra mảng những cài đặt cấu hình sử dụng trong module
        return include __DIR__ . '/config/module.config.php';
    }
}