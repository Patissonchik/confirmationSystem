<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository {
    public function find($id) {
        return User::find($id);
    }

    public function findByEmail($email) {
        return User::where('email', $email)->first();
    }

    public function create(array $data) {
        return User::create($data);
    }

    public function update($id, array $data) {
        $user = $this->find($id);
        if ($user) {
            $user->update($data);
        }
        return $user;
    }

    public function delete($id) {
        $user = $this->find($id);
        if ($user) {
            return $user->delete();
        }
        return false;
    }
}

