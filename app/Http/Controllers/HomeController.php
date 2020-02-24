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
        $words = $this->wordsTransformer->transformCollection(Word::paginate(20));

        return view('home', [
            'words' => $words
        ]);
    }

    public function landing()
    {
        $words = $this->wordsTransformer->transformCollection(Word::paginate(20));

        return view('welcome', [
            'words' => $words
        ]);
    }
}
