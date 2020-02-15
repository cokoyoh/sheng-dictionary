<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Word extends Model
{
    protected $table = 'words';

    protected $guarded = [];

    public function definition()
    {
        return $this->hasOne(Definition::class);
    }

    public function addDefinition(array $attributes)
    {
        return $this->definition()->create($attributes);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
