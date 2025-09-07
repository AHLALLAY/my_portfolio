<?php

namespace App\Services;

use App\Repositories\User_R;

class User_S
{
    public $user_R;
    
    public function __construct(User_R $user_R) 
    { 
        $this->user_R = $user_R; 
    }

    // AUTHENTIFICATION
    public function login($credentials) 
    { 
        return $this->user_R->login($credentials); 
    }
    
    public function register($userData) 
    { 
        return $this->user_R->register($userData); 
    }
    
    public function logout() 
    { 
        return $this->user_R->logout(); 
    }
    
    public function refresh() 
    { 
        return $this->user_R->refresh(); 
    }
    
    public function me() 
    { 
        return $this->user_R->me(); 
    }

    // GESTION UTILISATEUR
    public function getUser($id) 
    { 
        return $this->user_R->getUser($id); 
    }
    
    public function updateUser($id, $userData) 
    { 
        return $this->user_R->updateUser($id, $userData); 
    }
    
    public function deleteUser($id) 
    { 
        return $this->user_R->deleteUser($id); 
    }
    
    public function getAllUsers() 
    { 
        return $this->user_R->getAllUsers(); 
    }
}
