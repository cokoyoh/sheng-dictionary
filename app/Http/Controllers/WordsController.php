<?php

namespace App\Http\Controllers;

class WordsController extends Controller
{
    public function store($id = null)
    {
        $word = auth()->user()->addWord(\request()->only('title'));

        $input = \request()->except('title');

        $input['word_id'] = $word->id;

        $word->addDefinition($input);

        return redirect()->route('words.show', $word);
    }
}
