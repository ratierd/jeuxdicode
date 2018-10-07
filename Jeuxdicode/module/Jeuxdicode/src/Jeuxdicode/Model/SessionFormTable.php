<?php

namespace Jeuxdicode\Model;

use Zend\Db\TableGateway\TableGateway;
use Zend\Db\TableGateway\AbstractTableGateway;
use Zend\Db\ResultSet\ResultSet;
use Jeuxdicode\Model\Session;

class SessionFormTable extends AbstractTableGateway {

    protected $tableGateway;

    public function __construct(TableGateway $tableGateway) {
        $this->tableGateway = $tableGateway;
    }

    public function fetchAll() {
        $resultSet = $this->tableGateway->select();
        return $resultSet;
    }

    public function getSessionById($id) {
        $resultSet = $this->tableGateway->select(array(
            'idsession' => $id
        ));
        return $resultSet->current();
    }

    public function saveSession(Session $session) {
        $data = array(
            'titre' => $session->titre,
            'description' => $session->description,
            'auteur' => $session->auteur,
            'idevenement' => $session->idevenement,
        );
        
        $id = (int)$session->idsession;
        
        if($id == 0) {
            $this->tableGateway->insert($data);
        }
        else {
            if($this->getSessionById($id)) {
                $this->tableGateway->update($data, array('idsession' => $id));
            }
            else {
                throw new \Exception('Session id does not exist');
            }
        }
    }
}

?>