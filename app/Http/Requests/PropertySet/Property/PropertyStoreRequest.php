<?php

namespace App\Http\Requests\PropertySet\Property;

use App\Http\Requests\PropertySet\PropertySetRequest;

class PropertyStoreRequest extends PropertySetRequest
{
    public function rules(): array
    {
        return parent::rules() + [
            'name' => ['required', 'string', 'max:255'],
        ];
    }
}
