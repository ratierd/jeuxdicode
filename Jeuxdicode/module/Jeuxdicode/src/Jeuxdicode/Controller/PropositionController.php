<?php
/**
* Zend Framework (http://framework.zend.com/)
*
* @link 
http://github.com/zendframework/ZendSkeletonApplication for the
canonical source repository
*
* @copyright Copyright (c) 2005 - 2014 Zend Technologies USA Inc.
(http://www.zend.com)
* @license http://framework.zend.com/license/new-bsd New BSD 
License
*/
namespace Jeuxdicode\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Db\TableGateway\TableGateway;
use Zend\Form\Form;
use Jeuxdicode\Model\Evenement;
use Jeuxdicode\Form\EvenementForm;
use Jeuxdicode\Model\EvenementFormTable;
use Jeuxdicode\Model\Session;
use Jeuxdicode\Form\SessionForm;
use Jeuxdicode\Model\SessionFormTable;

class PropositionController extends AbstractActionController
{

    public $evenementtable;
    public $sessiontable;
    public $sessionformtable;
    public $membretable;
    public $evenementformtable;
    public $propositiontable;
    
    /* Actions */

    public function listallAction(){
        $listProp = $this->getPropositionTable()->fetchAll();
        return new ViewModel(array(
            'propositions' => $listProp
        ));
    }

    public function addAction()
    {
        // créer une proposition
        return $this->redirect()->toRoute('home');
    }
    
    /* Accès aux tables */

    public function getEvenementTable() {
        if (! $this->evenementtable) {
            $sm = $this->getServiceLocator();
            $this->evenementtable = $sm->get('Jeuxdicode\Model\EvenementTable');
        }
        return $this->evenementtable;
    }

    public function getEvenementFormTable() {
        if (! $this->evenementformtable) {
            $sm = $this->getServiceLocator();
            $this->evenementformtable = $sm->get('Jeuxdicode\Model\EvenementFormTable');
        }

        return $this->evenementformtable;
    }

    public function getPropositionTable() {
        if (! $this->propositiontable) {
            $sm = $this->getServiceLocator();
            $this->propositiontable = $sm->get('Jeuxdicode\Model\PropositionTable');
        }
        return $this->propositiontable;
    }    

    public function getSessionTable() {
        if (! $this->sessiontable) {
            $sm = $this->getServiceLocator();
            $this->sessiontable = $sm->get('Jeuxdicode\Model\SessionTable');
        }
        return $this->sessiontable;
    }

    public function getSessionFormTable() {
        if (! $this->sessionformtable) {
            $sm = $this->getServiceLocator();
            $this->sessionformtable = $sm->get('Jeuxdicode\Model\SessionFormTable');
        }

        return $this->sessionformtable;
    }

    public function getMembreTable() {
        if (! $this->membretable) {
            $sm = $this->getServiceLocator();
            $this->membretable = $sm->get('Jeuxdicode\Model\MembreTable');
        }
        return $this->membretable;
    }
}