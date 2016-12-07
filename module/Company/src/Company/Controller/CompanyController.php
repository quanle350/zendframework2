<?php
/**
 * Created by PhpStorm.
 * User: Quan Lee
 * Date: 12/7/16
 * Time: 10:40 AM
 */
namespace Company\Controller;


use Zend\Mvc\Controller\AbstractActionController;
use Zend\Mvc\MvcEvent;
use Zend\View\Model\ViewModel;
use Company\Model\Company;
use Company\Form\CompanyForm;

class CompanyController extends AbstractActionController
{
    protected $companyTable;


    public function indexAction()
    {
//        Current controller \ Action
//        $controllerClass = get_class($this);
//        $moduleNamespace = substr($controllerClass, 0, strpos($controllerClass, '\\'));
//        $tmp = substr($controllerClass, strrpos($controllerClass, '\\')+1 );
//        $controllerName = str_replace('Controller', "", $tmp);
//        //set
//        $this->layout()->currentModuleName      = strtolower($moduleNamespace);
//        $this->layout()->currentControllerName  = strtolower($controllerName);
//        $this->layout()->currentActionName      = $this->params('action');

        $view =  new ViewModel(array(
            'companys' => $this->getCompanyTable()->fetchAll(),
        ));
        return $view->setTemplate('company/company/other_view');
       // return array('companys' => $this->getConpanyTable()->fetchAll());
    }


    public function addAction()
    {
        $form = new CompanyForm();
        $form->get('submit')->setValue('Add');

        $request = $this->getRequest();
        if ($request->isPost()) {
            $company = new Company();
            $form->setInputFilter($company->getInputFilter());
            $form->setData($request->getPost());

            if ($form->isValid()) {
                $company->exchangeArray($form->getData());
                $this->getCompanyTable()->saveCompany($company);
                return $this->redirect()->toRoute('company');
            }
        }
        return array('form' => $form);
    }

    public function editAction()
    {

        $id         = (int) $this->params()->fromRoute('id', 0);
        if (!$id)
            return $this->redirect()->toRoute('company', array( 'action' => 'add'  ));

        $company    = $this->getCompanyTable()->getCompany($id);
        $form       = new CompanyForm();
        $form->bind($company);

        $form->get('submit')->setAttribute('value', 'Edit');

        $request    = $this->getRequest();
        if ($request->isPost()) {

            $form->setInputFilter($company->getInputFilter());
            $form->setData($request->getPost());
            if ($form->isValid()) {
                $this->getCompanyTable()->saveCompany($form->getData());
                // Redirect toi trang index
                return $this->redirect()->toRoute('company');
            }
        }
        return array(
            'id' => $id,
            'form' => $form,
        );
    }

    public function deleteAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);
        if (!$id) {
            return $this->redirect()->toRoute('company');
        }

        $request = $this->getRequest();
        if ($request->isPost()) {
            $del = $request->getPost('del', 'No');

            if ($del == 'Yes') {
                $id = (int) $request->getPost('id');
                $this->getCompanyTable()->deleteCompany($id);
            }

            return $this->redirect()->toRoute('company');
        }

        return array(
            'id'    => $id,
            'company' => $this->getCompanyTable()->getCompany($id)
        );
    }

    public function getCompanyTable()
    {
        if (!$this->companyTable) {
            $sm = $this->getServiceLocator();
            $this->companyTable = $sm->get('Company\Model\CompanyTable');
        }
        return $this->companyTable;
    }
}