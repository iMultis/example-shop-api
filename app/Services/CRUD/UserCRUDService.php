<?php

namespace App\Services\CRUD;

use App\Http\Requests\CollectionRequest;
use App\Models\User;

class UserCRUDService
{
    public function index(array $options = [])
    {
        return User::latest()->paginate($options[CollectionRequest::PARAM_PER_PAGE] ?? null);
    }

    public function show(array $data)
    {
        return User::findOrFail($data['user']);
    }

    public function store(array $data)
    {
        return User::create($data);
    }

    public function update(array $data)
    {
        $user = User::findOrFail($data['user']);
        $user->update($data);

        return $user;
    }

    public function destroy(array $data)
    {
        return User::findOrFail($data['user'])->delete();
    }
}
