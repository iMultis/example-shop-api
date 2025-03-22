<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Property extends Model
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
