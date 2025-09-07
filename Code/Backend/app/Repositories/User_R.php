<?php

namespace App\Repositories;

use App\Interfaces\User_I;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class User_R implements User_I
{
    // AUTHENTIFICATION
    public function login($credentials)
    {
        try {
            if (!Auth::attempt($credentials)) {
                throw new \Exception('Identifiants invalides');
            }

            $user = Auth::user();
            $token = $user->createToken('auth_token')->plainTextToken;

            return [
                'user' => $user,
                'token' => $token,
                'token_type' => 'Bearer'
            ];
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function register($userData)
    {
        try {
            $userData['password'] = Hash::make($userData['password']);
            $user = User::create($userData);
            $token = $user->createToken('auth_token')->plainTextToken;

            return [
                'user' => $user,
                'token' => $token,
                'token_type' => 'Bearer'
            ];
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function logout()
    {
        try {
            Auth::user()->currentAccessToken()->delete();
            return true;
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function refresh()
    {
        try {
            $user = Auth::user();
            $user->tokens()->delete();
            $token = $user->createToken('auth_token')->plainTextToken;

            return [
                'user' => $user,
                'token' => $token,
                'token_type' => 'Bearer'
            ];
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function me()
    {
        try {
            return Auth::user();
        } catch (\Exception $e) {
            throw $e;
        }
    }

    // GESTION UTILISATEUR
    public function getUser($id)
    {
        try {
            return User::findOrFail($id);
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function updateUser($id, $userData)
    {
        try {
            $user = User::findOrFail($id);
            if (isset($userData['password'])) {
                $userData['password'] = Hash::make($userData['password']);
            }
            $user->update($userData);
            return $user;
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function deleteUser($id)
    {
        try {
            $user = User::findOrFail($id);
            return $user->delete();
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function getAllUsers()
    {
        try {
            return User::all();
        } catch (\Exception $e) {
            throw $e;
        }
    }
}
