<?php
namespace Jeuxdicode\Model;

class Membre
{

    public $idmembre;
    public $nom;
    public $prenom;
    public $email;

    public function exchangeArray($data)
    {
        $this->idmembre = (! empty($data['idmembre'])) ? $data['idmembre'] : null;
        $this->nom = (! empty($data['nom'])) ? $data['nom'] : null;
        $this->prenom = (! empty($data['prenom'])) ? $data['prenom'] : null;
        $this->email = (! empty($data['email'])) ? $data['email'] : null;
    }

    public function getArrayCopy()
    {
        return get_object_vars($this);
    }
}

?>