<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreWordRequest;
use App\Word;

class WordsController extends Controller
{
    public function store(StoreWordRequest $request, Word $word = null)
    {
        $word = auth()->user()->addWord(\request()->only('title'));

        $input = \request()->except('title');

        $input['word_id'] = $word->id;

        $word->addDefinition($input);

        return redirect()->route('words.show', $word);
    }
}