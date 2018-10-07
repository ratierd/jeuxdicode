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

class SessionController extends AbstractActionController
{

    public $evenementtable;
    public $sessiontable;
    public $sessionformtable;
    public $membretable;
    public $evenementformtable;
    public $propositiontable;
    
    /* Actions */

    public function detailAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);
        if (! $id) {
            return $this->redirect()->toRoute('home');
        }

        $session = $this->getSessionTable()->getSessionById($id);
        $membre = $this->getMembreTable()->getMembreById($session->auteur);


        return new ViewModel(array('session' => $session, 'membre' => $membre));
    }

    public function addAction(){
        $id = (int) $this->params()->fromRoute('id', 0);
        if (! $id) {
            //Pas d'id spécifié -> retourner à la page d'accueil
            //return $this->redirect()->toRoute('home');
        }
        //Id spécifié affiché le formulaire d'ajout de session
        $form = new SessionForm();

        $request = $this->getRequest();
        if($request->isPost()) {
            $session = new Session();
            $form->setInputFilter($session->getInputFilter());
            $form->setData($request->getPost());

            if($form->isValid()) {
                $session->exchangeArray($form->getData());
                $this->getSessionFormTable()->savesession($session);

                return $this->redirect()->toRoute('home');
            }
        }
        else{
            $form->get('auteur')->setValue(1);// 1 pour l'instant à modifier plus tard pour prendre en compte les différents auteurs
            $form->get('idevenement')->setValue($id);
        }
        $ev = $this->getEvenementTable()->getEvenementById($id);
        return new ViewModel(array('evenement'=>$ev, 'form'=>$form));
    }
    
    public function editAction(){
        $id = (int) $this->params()->fromRoute('id', 0);
        if (! $id) {
            //Pas d'id spécifié -> retour à la page d'accueil
            return $this->redirect()->toRoute('home');
        }
        //Id spécifié -> modifier l'evenement correspondant
        // TODO : Implémenter l'action d'edition de session
        $form = new SessionForm();

        $request = $this->getRequest();
        if($request->isPost()) {
            $session = new Session();
            $form->setInputFilter($session->getInputFilter());
            $form->setData($request->getPost());

            if($form->isValid()) {
                $session->exchangeArray($form->getData());
                $this->getSessionFormTable()->saveSession($session);
                return $this->redirect()->toRoute('home');
            }
        }
        $se = $this->getSessionTable()->getSessionById($id);
        $form->get('idsession')->setValue($id);
        $form->get('titre')->setValue($se->titre);
        $form->get('description')->setValue($se->description);
        $form->get('auteur')->setValue($se->auteur);
        $form->get('idevenement')->setValue($se->idevenement);
        return new ViewModel(array('form'=>$form));
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