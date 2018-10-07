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

class EvenementController extends AbstractActionController
{

    public $evenementtable;
    public $sessiontable;
    public $sessionformtable;
    public $membretable;
    public $evenementformtable;
    public $propositiontable;
    
    /* Actions */
    
    public function listallAction(){
        $listEvt = $this->getEvenementTable()->fetchAll();
        return new ViewModel(array(
            'evenements' => $listEvt
        ));
    }
    
    public function detailAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);
        if (! $id) {
            //Pas d'id spécifié -> retour à la page d'accueil
            return $this->redirect()->toRoute('home');
        }
        //Id spécifié ->  afficher les details de l'événement correspondant
        $ev = $this->getEvenementTable()->getEvenementById($id);
        $sessions = $this->getSessionTable()->getSessionsByIdEvent($id);
        $participants = $this->getMembreTable()->getMembresByIdEvent($id);
        
        return new ViewModel(array(
            'evenement' => $ev, 'sessions' => $sessions, 'participants' => $participants
        ));
    }

    public function addAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);
        if(! $id) {
            //Pas d'id spécifié -> création d'événement sans proposition
            $form = new EvenementForm();    

            $request = $this->getRequest();
            if($request->isPost()) {
                $evenement = new Evenement();
                $form->setInputFilter($evenement->getInputFilter());
                $form->setData($request->getPost());

                if($form->isValid()) {
                    $evenement->exchangeArray($form->getData());
                    $this->getEvenementFormTable()->saveEvenement($evenement);
                    $id = $this->getEvenementFormTable()->getLastIdEvent();
                    return $this->redirect()->toRoute('gestsession', array('action'=>'add', 'id' => $id));
                }
            }
            return new ViewModel(array('form'=>$form));
        }
        else{
            // Id spécifié -> création d'événement avec proposition
            $form = new EvenementForm();
            
            $request = $this->getRequest();
            if($request->isPost()) {
                $evenement = new Evenement();
                $form->setInputFilter($evenement->getInputFilter());
                $form->setData($request->getPost());

                if($form->isValid()) {
                    $evenement->exchangeArray($form->getData());
                    $this->getEvenementFormTable()->saveEvenement($evenement);
                    $id = $this->getEvenementFormTable()->getLastIdEvent();
                    return $this->redirect()->toRoute('gestsession', array('action'=>'add', 'id' => $id));
                }
            }
            else{
                $prop = $this->getPropositionTable()->getPropositionById($id);
                $form->get('titre')->setValue($prop->titre);
                $form->get('description_resume')->setValue($prop->description);
            }
            return new ViewModel(array('form'=>$form));
        }
    }
    
    public function editAction(){
        $id = (int) $this->params()->fromRoute('id', 0);
        if (! $id) {
            //Pas d'id spécifié -> retour à la page d'accueil
            return $this->redirect()->toRoute('home');
        }
        //Id spécifié -> modifier l'evenement correspondant
        // TODO : Implémenter l'action d'edition d'événement
        $form = new EvenementForm();

        $request = $this->getRequest();
        if($request->isPost()) {
            $evenement = new Evenement();
            $form->setInputFilter($evenement->getInputFilter());
            $form->setData($request->getPost());

            if($form->isValid()) {
                $evenement->exchangeArray($form->getData());
                $this->getEvenementFormTable()->saveEvenement($evenement);
                return $this->redirect()->toRoute('home');
            }
        }
        $ev = $this->getEvenementTable()->getEvenementById($id);
        $form->get('idevenement')->setValue($id);
        $form->get('nbpartmax')->setValue($ev->nbpartmax);
        $form->get('titre')->setValue($ev->titre);
        $form->get('description_resume')->setValue($ev->description_resume);
        $timeData_debut = explode(" ", $ev->date_debut);
        $form->get('date_debut')->setValue($timeData_debut[0] . "T" . $timeData_debut[1]);
        $timeData_fin = explode(" ", $ev->date_fin);
        $form->get('date_fin')->setValue($timeData_fin[0] . "T" . $timeData_fin[1]);
        $form->get('adresse')->setValue($ev->adresse);
        return new ViewModel(array('form'=>$form));
    }
    
    /* Acces aux tables */
    
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