<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserService
{
    /**
     * Get all users (admins) except the current one if specified.
     */
    public function getAllUsers($exceptId = null)
    {
        $query = User::query();
        
        if ($exceptId) {
            $query->where('id', '!=', $exceptId);
        }
        
        return $query->latest()->paginate(10);
    }

    /**
     * Create a new user.
     */
    public function createUser(array $data)
    {
        $data['password'] = Hash::make($data['password']);
        $data['role'] = $data['role'] ?? 'admin';
        
        return User::create($data);
    }

    /**
     * Update an existing user.
     */
    public function updateUser(User $user, array $data)
    {
        if (isset($data['password']) && filled($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        $user->update($data);
        
        return $user;
    }

    /**
     * Delete a user.
     */
    public function deleteUser(User $user)
    {
        return $user->delete();
    }
}
