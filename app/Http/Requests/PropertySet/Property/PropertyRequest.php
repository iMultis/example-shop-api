<?php

namespace App\Http\Requests\PropertySet\Property;

use App\Http\Requests\PropertySet\PropertySetRequest;

class PropertyRequest extends PropertySetRequest
{
    public function rules(): array
    {
        return parent::rules() + [
            'property' => ['required', 'integer'],
        ];
    }
}
