<?php
namespace Jeuxdicode\Model;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

class Proposition {

    public $idproposition;
    public $idmembre;
    public $titre;
    public $description;

    public $inputFilter;

    public function exchangeArray($data)
    {
        $this->idproposition = (! empty($data['idproposition'])) ? $data['idproposition'] : null;
        $this->idmembre = (! empty($data['idmembre'])) ? $data['idmembre'] : null;
        $this->titre = (! empty($data['titre'])) ? $data['titre'] : null;
        $this->description = (! empty($data['description'])) ? $data['description'] : null;
    }

    public function getArrayCopy()
    {
        return get_object_vars($this);
    }

}

?>