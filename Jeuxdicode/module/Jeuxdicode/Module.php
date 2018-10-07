<?php
namespace Jeuxdicode;

use Jeuxdicode\Model\Evenement;
use Jeuxdicode\Model\EvenementTable;
use Jeuxdicode\Form\EvenementForm;
use Jeuxdicode\Model\EvenementFormTable;
use Jeuxdicode\Model\Membre;
use Jeuxdicode\Model\MembreTable;
use Jeuxdicode\Model\Session;
use Jeuxdicode\Model\SessionTable;
use Jeuxdicode\Form\SessionForm;
use Jeuxdicode\Model\SessionFormTable;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;
use Jeuxdicode\Model\Proposition;
use Jeuxdicode\Model\PropositionTable;

class Module
{

    public function getAutoLoaderConfig()
    {
        return array(
            'Zend\Loader\ClassMapAutoloader' => array(
                __DIR__ . '/autoload_classmap.php'
            ),
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__
                )
            )
        )
        ;
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getServiceConfig()
    {
        return array(
            'factories' => array(
                'Jeuxdicode\Model\MembreTable' => function ($sm) {
                    $tableGateway = $sm->get('MembreTableGateway');
                    $table = new MembreTable($tableGateway);
                    return $table;
                },
                'MembreTableGateway' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Membre());
                    return new TableGateway('membre', $dbAdapter, null, $resultSetPrototype);
                },
                
                
                'Jeuxdicode\Model\SessionTable' => function ($sm) {
                    $tableGateway = $sm->get('SessionTableGateway');
                    $table = new SessionTable($tableGateway);
                    return $table;
                },
                'SessionTableGateway' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Session());
                    return new TableGateway('session', $dbAdapter, null, $resultSetPrototype);
                },
                
                'Jeuxdicode\Model\SessionFormTable' => function ($sm) {
                    $tableGateway = $sm->get('SessionFormTableGateway');
                    $table = new SessionFormTable($tableGateway);
                    return $table;
                },
                'SessionFormTableGateway' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Session());
                    return new TableGateway('session', $dbAdapter, null, $resultSetPrototype);
                },
                
                
                'Jeuxdicode\Model\EvenementTable' => function ($sm) {
                    $tableGateway = $sm->get('EvenementTableGateway');
                    $table = new EvenementTable($tableGateway);
                    return $table;
                },
                'EvenementTableGateway' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Evenement());
                    return new TableGateway('evenementriche', $dbAdapter, null, $resultSetPrototype);
                },
                
                'Jeuxdicode\Model\EvenementFormTable' => function ($sm) {
                    $tableGateway = $sm->get('EvenementFormTableGateway');
                    $table = new EvenementFormTable($tableGateway);
                    return $table;
                },
                'EvenementFormTableGateway' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Evenement());
                    return new TableGateway('evenement', $dbAdapter, null, $resultSetPrototype);
                },
                
                'Jeuxdicode\Model\PropositionTable' => function ($sm) {
                    $tableGateway = $sm->get('PropositionTableGateway');
                    $table = new PropositionTable($tableGateway);
                    return $table;
                },
                'PropositionTableGateway' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Proposition());
                    return new TableGateway('proposition', $dbAdapter, null, $resultSetPrototype);
                },
                
            )
        );
    }
}