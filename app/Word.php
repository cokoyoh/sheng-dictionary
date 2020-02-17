<?php

namespace App;

use App\Sheng\Transformers\WordTransformer;
use App\Traits\ManageVotes;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Word extends Model
{
    use Searchable, ManageVotes;

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

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function dislikes()
    {
        return $this->hasMany(Dislike::class);
    }

    public function toSearchableArray()
    {
        return (new WordTransformer())->transform($this);
    }
}
