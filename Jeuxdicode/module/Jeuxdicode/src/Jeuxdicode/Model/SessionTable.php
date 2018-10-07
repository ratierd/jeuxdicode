<?php
namespace Jeuxdicode\Model;

use Zend\Db\TableGateway\TableGateway;
use Zend\Db\TableGateway\AbstractTableGateway;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\Sql\Sql;

class SessionTable extends AbstractTableGateway {

    protected $tableGateway;

    public function __construct(TableGateway $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }

    public function fetchAll()
    {
        $resultSet = $this->tableGateway->select();
        return $resultSet;
    }
    
    public function getSessionsByIdEvent($idevent) {
              
        // Avec jointure avec membre
        /*
        $sql = new Sql($this->tableGateway->adapter);
        
        
         *  SELECT *
         *  FROM session s, membre m
         *  WHERE s.auteur = m.idmembre
         *  AND s.idevenement = $idevent;
        
        
        $select= $sql->select()
        ->from(array('s' => 'session'))
        ->join(array('m' => 'membre'), 'm.idmembre = s.auteur', array())
        ->where('s.idevenement = '.$idevent);
        
        $resultSet = $this->tableGateway->selectWith($select);
        */     
            
        // Sans jointure avec Membre
        $resultSet = $this->tableGateway->select(array('idevenement'=> $idevent ));
        
        return $resultSet;
    }
    
    public function getSessionById($id) {
        $resultSet = $this->tableGateway->select(array('idsession' => $id));
        return $resultSet->current();
    }
}
?>
