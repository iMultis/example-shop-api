<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PropertySet extends Model
{
    protected $fillable = [
        'name',
    ];

    public function properties(): HasMany
    {
        return $this->hasMany(Property::class);
    }
}
