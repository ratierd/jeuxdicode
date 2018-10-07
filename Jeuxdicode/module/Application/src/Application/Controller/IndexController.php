<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */
namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Db\TableGateway\TableGateway;
use Zend\Db\ResultSet\ResultSet;
use Jeuxdicode\Model\EvenementTableGateway;
use Jeuxdicode\Model\PropositionTable;

class IndexController extends AbstractActionController
{

    public function indexAction()
    {
        $sm = $this->getServiceLocator();
        $table = $sm->get('Jeuxdicode\Model\EvenementTable');
        $table2 = $sm->get('Jeuxdicode\Model\PropositionTable');
        $evtCourant = $table->getEvenementCourant();
        $evtPasses = $table->getEvenementPasses();
        $prop = $table2->fetchAll();
        return new ViewModel(array(
            'evenementCourant' => $evtCourant,
            'evenementPasses' => $evtPasses,
            'propositions' => $prop,
        ));
    }
}
