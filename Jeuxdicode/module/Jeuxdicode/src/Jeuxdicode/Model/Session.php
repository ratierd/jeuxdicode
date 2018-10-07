<?php
namespace Jeuxdicode\Model;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

class Session implements InputFilterAwareInterface 
{

    public $idsession;
    public $titre;
    public $description;
    public $auteur;
    public $idevenement;
    
    public $inputFilter;
    
    public function exchangeArray($data)
    {
        $this->idsession = (! empty($data['idsession'])) ? $data['idsession'] : null;
        $this->titre = (! empty($data['titre'])) ? $data['titre'] : null;
        $this->description = (! empty($data['description'])) ? $data['description'] : null;
        $this->auteur = (! empty($data['auteur'])) ? $data['auteur'] : null;
        $this->idevenement = (! empty($data['idevenement'])) ? $data['idevenement'] : null;  
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
                'name' => 'idsession',
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
                'name' => 'description',
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
                'name' => 'auteur',
                'required' => true,
                'filters' => array(
                    array('name' => 'Int'),
                ),
            ));
            
            $inputFilter->add(array(
                'name' => 'idevenement',
                'required' => true,
                'filters' => array(
                    array('name' => 'Int'),
                ),
            ));

            $this->inputFilter = $inputFilter;
        }

        return $this->inputFilter;
    }
    
}

?>