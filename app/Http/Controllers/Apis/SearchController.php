<?php

namespace App\Http\Controllers\Apis;

use App\Sheng\Transformers\WordTransformer;
use App\Word;

class SearchController extends ApiController
{
    protected $wordsTransformer;

    /**
     * SearchController constructor.
     * @param $wordsTransformer
     */
    public function __construct(WordTransformer $wordsTransformer)
    {
        $this->wordsTransformer = $wordsTransformer;
    }

    public function index()
    {
         return $this->wordsTransformer->transformCollection(
             Word::search(request('searchString'))->paginate(10)
         );
    }
}
