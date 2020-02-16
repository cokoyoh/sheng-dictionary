<?php

namespace App\Http\Controllers\Apis;

use App\Http\Controllers\Controller;
use App\Sheng\Transformers\WordTransformer;
use App\Word;
use Illuminate\Http\Request;

class WordsController extends ApiController
{
    protected $wordsTransformer;

    /**
     * WordsController constructor.
     * @param $wordsTransformer
     */
    public function __construct(WordTransformer $wordsTransformer)
    {
        $this->wordsTransformer = $wordsTransformer;
    }


    public function getWords()
    {
        $paginatedWords = Word::latest()->paginate(20);

        $words = $this->wordsTransformer->transformCollection($paginatedWords);

        return $this->respondWithJson($words);
    }
}
