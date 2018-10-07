<?php
namespace Jeuxdicode\Model;

use Zend\Db\TableGateway\TableGateway;
use Zend\Db\TableGateway\AbstractTableGateway;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\Sql\Sql;

class MembreTable extends AbstractTableGateway
{

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
    
    public function getMembreById($id) {
        $resultSet = $this->tableGateway->select(array('idmembre' => $id));
        return $resultSet->current();
    }   
    
    
    public function getMembresByIdEvent($id)
    {        
        $sql = new Sql($this->tableGateway->adapter); 
        
        /*
         *  SELECT *
         *  FROM participation P, membre M
         *  WHERE M.idmembre = P.idmembre
         *  AND P.idevenement = 1;
         */ 
        
        $select= $sql->select()
        ->from(array('m' => 'membre'))
        ->join(array('p' => 'participation'), 'm.idmembre = p.idmembre', array())
        ->where('p.idevenement = '.$id);   
        
        $resultSet = $this->tableGateway->selectWith($select);
        
        return $resultSet;
    }
}

?>
