<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Services\User_S;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;

class User_C extends Controller
{
    protected $user_S;
    
    public function __construct(User_S $user_S)
    { 
        $this->user_S = $user_S; 
    }

    // AUTHENTIFICATION
    public function login(LoginRequest $request)
    {
        try {
            $credentials = $request->only('email', 'password');
            $result = $this->user_S->login($credentials);
            
            return response()->json([
                'message' => 'Connexion réussie',
                'data' => $result,
                'status' => 'success'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Erreur de connexion',
                'error' => $e->getMessage(),
                'status' => 'failed'
            ], 401);
        }
    }

    public function register(RegisterRequest $request)
    {
        try {
            $userData = $request->validated();
            $result = $this->user_S->register($userData);
            
            return response()->json([
                'message' => 'Utilisateur créé avec succès',
                'data' => $result,
                'status' => 'success'
            ], 201);
        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Erreur de validation',
                'errors' => $e->errors(),
                'status' => 'failed'
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Erreur lors de la création',
                'error' => $e->getMessage(),
                'status' => 'failed'
            ], 500);
        }
    }

    public function logout()
    {
        try {
            $this->user_S->logout();
            
            return response()->json([
                'message' => 'Déconnexion réussie',
                'status' => 'success'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Erreur de déconnexion',
                'error' => $e->getMessage(),
                'status' => 'failed'
            ], 500);
        }
    }

    public function refresh()
    {
        try {
            $result = $this->user_S->refresh();
            
            return response()->json([
                'message' => 'Token rafraîchi avec succès',
                'data' => $result,
                'status' => 'success'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Erreur lors du rafraîchissement',
                'error' => $e->getMessage(),
                'status' => 'failed'
            ], 500);
        }
    }

    public function me()
    {
        try {
            $user = $this->user_S->me();
            
            return response()->json([
                'message' => 'Informations utilisateur récupérées',
                'data' => $user,
                'status' => 'success'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Erreur lors de la récupération',
                'error' => $e->getMessage(),
                'status' => 'failed'
            ], 500);
        }
    }

    // GESTION UTILISATEUR
    public function getUser($id)
    {
        try {
            $user = $this->user_S->getUser($id);
            
            return response()->json([
                'message' => 'Utilisateur trouvé',
                'data' => $user,
                'status' => 'success'
            ], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => 'Utilisateur non trouvé',
                'error' => $e->getMessage(),
                'status' => 'failed'
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Erreur inattendue',
                'error' => $e->getMessage(),
                'status' => 'failed'
            ], 500);
        }
    }

    public function updateUser($id, UpdateUserRequest $request)
    {
        try {
            $userData = $request->validated();
            $user = $this->user_S->updateUser($id, $userData);
            
            return response()->json([
                'message' => 'Utilisateur modifié avec succès',
                'data' => $user,
                'status' => 'success'
            ], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => 'Utilisateur non trouvé',
                'error' => $e->getMessage(),
                'status' => 'failed'
            ], 404);
        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Erreur de validation',
                'errors' => $e->errors(),
                'status' => 'failed'
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Erreur inattendue',
                'error' => $e->getMessage(),
                'status' => 'failed'
            ], 500);
        }
    }

    public function deleteUser($id)
    {
        try {
            $result = $this->user_S->deleteUser($id);
            
            return response()->json([
                'message' => 'Utilisateur supprimé avec succès',
                'status' => 'success'
            ], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => 'Utilisateur non trouvé',
                'error' => $e->getMessage(),
                'status' => 'failed'
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Erreur inattendue',
                'error' => $e->getMessage(),
                'status' => 'failed'
            ], 500);
        }
    }

    public function getAllUsers()
    {
        try {
            $users = $this->user_S->getAllUsers();
            
            return response()->json([
                'message' => 'Utilisateurs récupérés avec succès',
                'data' => $users,
                'status' => 'success'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Erreur inattendue',
                'error' => $e->getMessage(),
                'status' => 'failed'
            ], 500);
        }
    }
}
