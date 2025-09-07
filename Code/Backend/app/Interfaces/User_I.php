<?php

namespace App\Interfaces;

interface User_I
{
    // AUTHENTIFICATION
    public function login($credentials);
    public function register($userData);
    public function logout();
    public function refresh();
    public function me();
    
    // GESTION UTILISATEUR
    public function getUser($id);
    public function updateUser($id, $userData);
    public function deleteUser($id);
    public function getAllUsers();
}
