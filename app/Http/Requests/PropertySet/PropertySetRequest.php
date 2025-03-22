<?php

namespace App\Http\Requests\PropertySet;

use App\Http\Requests\Request;

class PropertySetRequest extends Request
{
    public function rules(): array
    {
        return [
            'property_set' => ['required', 'integer'],
        ];
    }
}
