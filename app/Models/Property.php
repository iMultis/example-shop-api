<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Property extends OwnedModel
{
    protected $fillable = [
        'name',
        'propertySet',
    ];

    public function propertySet(): BelongsTo
    {
        return $this->belongsTo(PropertySet::class);
    }
}
