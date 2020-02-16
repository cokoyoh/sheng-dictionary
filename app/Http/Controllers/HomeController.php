<?php

namespace App\Http\Controllers;

use App\Sheng\Transformers\DefinitionTransformer;
use App\Sheng\Transformers\WordTransformer;
use App\Word;

class HomeController extends Controller
{
    protected $definitionsTransformer;
    protected $wordsTransformer;

    /**
     * Create a new controller instance.
     *
     * @param DefinitionTransformer $definitionsTransformer
     * @param WordTransformer $wordsTransformer
     */
    public function __construct(
        DefinitionTransformer $definitionsTransformer,
        WordTransformer $wordsTransformer
    ) {
        $this->middleware('auth')->except('landing');
        $this->definitionsTransformer = $definitionsTransformer;
        $this->wordsTransformer = $wordsTransformer;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $words = $this->getWords();

        return view('home', [
            'words' => $words
        ]);
    }

    public function landing()
    {
        $words = $this->getWords();

        return view('welcome', [
            'words' => $words
        ]);
    }

    private function getWords()
    {
        return Word::latest()->take(20)->get()->map(function ($word) {
            $definition = $word->definition;

            return [
                'id' => $word->id,
                'user' => $word->user->name,
                'description' =>  optional($definition)->description,
                'date' => $word->created_at->toFormattedDateString(),
                'examples' => optional($definition)->examples,
                'title' => $word->title,
                'editable' => auth()->id() == $word->user_id
            ];
        });
    }
}
