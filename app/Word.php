<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Word extends Model
{
    protected $table = 'words';

    protected $guarded = [];

    public function definitions()
    {
        return $this->hasMany(Definition::class);
    }

    public function addDefinition(array $attributes)
    {
        return $this->definitions()->create($attributes);
    }
}
