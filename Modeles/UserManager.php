<?php

class UserManager extends Model{

    public function getUser() {
        return $this->getAll('utilisateur', 'User'); // Assurez-vous que la classe est bien "User"
    }
}