<?php

namespace Jeuxdicode\Model;

use Zend\Db\TableGateway\TableGateway;
use Zend\Db\TableGateway\AbstractTableGateway;
use Zend\Db\ResultSet\ResultSet;
use Jeuxdicode\Model\Evenement;

class EvenementFormTable extends AbstractTableGateway {
    
    protected $tableGateway;
    
    public function __construct(TableGateway $tableGateway) {
        $this->tableGateway = $tableGateway;
    }
    
    public function fetchAll() {
        $resultSet = $this->tableGateway->select();
        return $resultSet;
    }
    
    public function getEvenementById($id) {
        $resultSet = $this->tableGateway->select(array(
            'idevenement' => $id
        ));
        return $resultSet->current();
    }
    
    public function saveEvenement(Evenement $evenement) {
        $data = array(
            'titre' => $evenement->titre,
            'date_debut' => $evenement->date_debut,
            'date_fin' => $evenement->date_fin,
            'description_resume' => $evenement->description_resume,
            'nbpartmax' => $evenement->nbpartmax,
            'adresse' => $evenement->adresse,
        );
        
        $id = (int)$evenement->idevenement;
        
        if($id == 0) {
            $this->tableGateway->insert($data);
        }
        else {
            if($this->getEvenementById($id)) {
                $this->tableGateway->update($data, array('idevenement' => $id));
            }
            else {
                throw new \Exception('Evenement id does not exist');
            }
        }
    }
    
    public function getLastIdEvent() {
        $id = $this->tableGateway->getLastInsertValue();
        return $id;
    }
}

?>