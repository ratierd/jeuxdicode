<?php
namespace Jeuxdicode\Model;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

class Evenement implements InputFilterAwareInterface {

    public $idevenement;
    public $titre;
    public $description_resume;
    public $date_debut;
    public $adresse;
    public $status;
    public $nbpartmax;
    public $date_fin;
    
    public $inputFilter;

    public function exchangeArray($data)
    {
        $this->idevenement = (! empty($data['idevenement'])) ? $data['idevenement'] : null;
        $this->titre = (! empty($data['titre'])) ? $data['titre'] : null;
        $this->description_resume = (! empty($data['description_resume'])) ? $data['description_resume'] : null;
        $this->date_debut = (! empty($data['date_debut'])) ? $data['date_debut'] : null;
        $this->date_fin = (! empty($data['date_fin'])) ? $data['date_fin'] : null;
        $this->adresse = (! empty($data['adresse'])) ? $data['adresse'] : null;
        $this->status = (! empty($data['status'])) ? $data['status'] : null;
        $this->nbpartmax = (! empty($data['nbpartmax'])) ? $data['nbpartmax'] : null;
    }

    public function getArrayCopy()
    {
        return get_object_vars($this);
    }
    
    public function setInputFilter(InputFilterInterface $inputFilter) {
        throw new \Exception("Not usef");
    }
    
    public function getInputFilter() {
        if(!$this->inputFilter) {
            $inputFilter = new InputFilter();
            
            $inputFilter->add(array(
                'name' => 'idevenement',
                'required' => true,
                'filters' => array(
                    array('name' => 'Int'),
                ),
            ));
            
            $inputFilter->add(array(
                'name' => 'titre',
                'required' => true,
                'filters' => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                    array(
                        'name' => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min' => 1,
                            'max' => 20,
                        ),
                    ),
                ),
            ));
            
            $inputFilter->add(array(
                'name' => 'description_resume',
                'required' => true,
                'filters' => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                    array(
                        'name' => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min' => 1,
                            'max' => 100,
                        ),
                    ),
                ),
            ));
            
            $inputFilter->add(array(
                'name' => 'date_debut',
                'required' => true,
            ));
            
            $inputFilter->add(array(
                'name' => 'date_fin',
                'required' => true,
            ));
            
            $inputFilter->add(array(
                'name' => 'adresse',
                'required' => true,
                'filters' => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                    array(
                        'name' => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min' => 1,
                            'max' => 100,
                        ),
                    ),
                ),
            ));
            
            $this->inputFilter = $inputFilter;
        }
        
        return $this->inputFilter;
    }
    
    
}

?>