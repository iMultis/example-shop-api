<?php

namespace App\Http\Requests\Auth;

use App\Http\Requests\Request;

class RegisterRequest extends Request
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'string'],
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string', 'min:8'],
        ];
    }
}
