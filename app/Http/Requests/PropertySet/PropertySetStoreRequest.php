<?php

namespace App\Http\Requests\PropertySet;

use App\Http\Requests\Request;

class PropertySetStoreRequest extends Request
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
        ];
    }
}
