<?php


namespace App\Sheng\Transformers;


class WordTransformer extends Transformer
{

    public function transform($word)
    {
        $definition = $word->definition;

         return [
             'user' => $word->user->name,
             'description' =>  optional($definition)->description,
             'date' => $word->created_at->toFormattedDateString(),
             'examples' => optional($definition)->examples,
             'title' => optional($definition)->title
         ];
    }
}
