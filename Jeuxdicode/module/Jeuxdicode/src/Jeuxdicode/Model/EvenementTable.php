<?php
namespace Jeuxdicode\Model;

use Zend\Db\TableGateway\TableGateway;
use Zend\Db\TableGateway\AbstractTableGateway;
use Zend\Db\ResultSet\ResultSet;

class EvenementTable extends AbstractTableGateway {

    protected $tableGateway;

    public function __construct(TableGateway $tableGateway) {
        $this->tableGateway = $tableGateway;
    }

    public function fetchAll() {
        $resultSet = $this->tableGateway->select();
        return $resultSet;
    }

    public function getEvenementCourant() {
        $resultSet = $this->tableGateway->select(array(
            'status' => 'courant'
        ));
        return $resultSet->current();
    }
    
    public function getEvenementPasses() {
        $resultSet = $this->tableGateway->select(array(
           'status' => 'passe'
        ));
        return $resultSet;
    }
    
    public function getEvenementById($id) {
        $resultSet = $this->tableGateway->select(array(
            'idevenement' => $id
        ));
        return $resultSet->current();
    }
}

?>