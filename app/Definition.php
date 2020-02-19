<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Definition extends Model
{
    protected $table = 'definitions';

    protected $guarded = [];

    protected $touches = ['word'];

    public function word()
    {
        return $this->belongsTo(Word::class);
    }
}
