<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreWordRequest;
use App\Word;

class WordsController extends Controller
{
    public function create(Word $word = null)
    {
         return view('words.create', [
             'word' => $word ?? new Word()
         ]);
    }

    public function store(StoreWordRequest $request)
    {
        $word = auth()->user()->addWord(\request()->only('title'));

        $input = \request()->only('description', 'examples');

        $input['word_id'] = $word->id;

        $word->addDefinition($input);

        return redirect()->route('home');
    }

    public function update(Word $word)
    {
        $this->authorize('updateWord', $word);

        $word->update(request()->only('title'));

        $word->definition()->update(request()->only('examples', 'description'));

        return redirect()->route('home');
    }
}
