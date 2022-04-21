<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Contract extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function relationSelf(): HasMany
    {
        return $this->hasMany(static::class)->onlyTrashed();
    }
    
    public function relationOther(): HasMany
    {
        return $this->hasMany(Client::class)->onlyTrashed();
    }
}
