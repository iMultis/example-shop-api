<?php

namespace App\Http\Requests;

class CollectionRequest extends Request
{
    const PARAM_PAGE = 'page';
    const PARAM_PER_PAGE = 'per_page';

    public function rules(): array
    {
        return [
            self::PARAM_PAGE => ['integer', 'min:1'],
            self::PARAM_PER_PAGE => ['integer', 'min:1'],
        ];
    }
}
