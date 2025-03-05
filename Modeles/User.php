<?php
class User {

    private $id;
    private $nom;
    private $prenom;
    private $email;
    private $mdp;


    //constructeur
    public function __construct(array $data){
        $this->hydrate($data);
    }

    //hydratation 
    public function hydrate(array $data){
        foreach($data as $key => $value){
            $method = 'set' . ucfirst($key);

            if(method_exists($this, $method))
            $this->$method($value);
        }
    }

    //setter
    public function setId($id){
        $id = (int) $id;
        if($id>0)
        $this->id=$id;
    }
    public function setNom($nom){
        if(is_string($nom))
        $this->nom=$nom;
    }
    public function setPrenom($prenom){
        if(is_string($prenom))
        $this->prenom=$prenom;
    }
    public function setEmail($email){
        if(is_string($email))
        $this->email=$email;
    }

    //getter
    public function getId(){
        return $this->id;
    }
    public function getNom(){
        return $this->nom;
    }
    public function getPrenom(){
        return $this->prenom;
    }
    public function getEmail(){
        return $this->email;
    }
}