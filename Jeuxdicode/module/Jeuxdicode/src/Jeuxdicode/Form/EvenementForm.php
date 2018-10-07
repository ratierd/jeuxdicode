<?php
namespace Jeuxdicode\Form;

use Zend\Form\Form;

class EvenementForm extends Form
{
	public function __construct($name = null) {
		
		parent::__construct('Evenement');
		
		// Id de l evenement
		$this->add(array(
			'name' => 'idevenement',
			'type' => 'Hidden',
		));
		
		// Nombre max de participants
		$this->add(array(
				'name' => 'nbpartmax',
				'type' => 'Hidden',
		        'attributes' => array('value' => '10'),
		));
		
		// Titre de l evenement
		$this->add(array(
			'name' => 'titre',
			'type' => 'Text',
			'options' => array(
				'label' => 'Titre de l\'evenement',
		),
		'attributes' => array('class' => 'form-control'),
		));
		
		// Description resumee
		$this->add(array(
				'name' => 'description_resume',
				'type' => 'Text',
				'options' => array(
						'label' => 'Description resume',
				),
				'attributes' => array('class' => 'form-control'),
		));		
		
		// Date et horaire de debut
		$this->add(array(
			'name' => 'date_debut',
            'type' => 'DateTimeLocal',
			'options' => array(
				'label' => 'Date et horaire de debut'
		),
		'attributes' => array(
			'min' => date('Y-m-d\TH:i'),
			'max' => '2020-01-01T00:00:00',
			'step' => 'any',
			'class' => 'form-control'
		),
		));
		
		// Date et horaire de fin
		$this->add(array(
				'name' => 'date_fin',
                'type' => 'DateTimeLocal',
				'options' => array(
						'label' => 'Date et horaire de fin'
				),
				'attributes' => array(
						'min' => date('Y-m-d\TH:i'),
						'max' => '2020-01-01T00:00:00',
						'step' => 'any',
						'class' => 'form-control'
				),
		));
		
		// Adresse
		$this->add(array(
				'name' => 'adresse',
				'type' => 'Text',
				'options' => array(
						'label' => 'Adresse',
				),
				'attributes' => array('class' => 'form-control'),
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
