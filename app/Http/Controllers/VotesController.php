<?php

namespace App\Http\Controllers;

use App\Word;

class VotesController extends Controller
{
    public function like(Word $word)
    {
        $word->liked();

        return redirect('/');
    }
}
