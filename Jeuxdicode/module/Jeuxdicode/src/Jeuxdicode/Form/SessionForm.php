<?php
namespace Jeuxdicode\Form;

use Zend\Form\Form;

class SessionForm extends Form
{
    public function __construct($name = null) {

        parent::__construct('Session');

        // Id de la session
        $this->add(array(
            'name' => 'idsession',
            'type' => 'Hidden',
        ));

        // Titre de la session
        $this->add(array(
            'name' => 'titre',
            'type' => 'Text',
            'options' => array(
                'label' => 'Titre de la session',
            ),
            'attributes' => array('class' => 'form-control'),
        ));

        // Description de la session
        $this->add(array(
            'name' => 'description',
            'type' => 'Text',
            'options' => array(
                'label' => 'Description',
            ),
            'attributes' => array('class' => 'form-control'),
        ));
        
        //Id de l'auteur
        $this->add(array(
            'name' => 'auteur',
            'type' => 'Hidden',
        ));
        
        //Id de l'événement
        $this->add(array(
            'name' => 'idevenement',
            'type' => 'Hidden',
        ));

        // Submit
        $this->add(array(
            'name' => 'submit',
            'attributes' => array(
                'type'  => 'submit',
                'value' => 'Valider »',
                'class' => 'btn btn-success',
            ),
        ));
    }
}

?>
