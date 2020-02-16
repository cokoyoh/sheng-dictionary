<?php


namespace App\Sheng\Transformers;


class WordTransformer extends Transformer
{

    public function transform($word)
    {
        $definition = $word->definition;

         return [
             'id' => $word->id,
             'user' => $word->user->name,
             'description' =>  optional($definition)->description,
             'date' => $word->created_at->toFormattedDateString(),
             'examples' => optional($definition)->examples,
             'title' => optional($definition)->title,
             'editable' => auth()->id() == $word->user_id
         ];
    }
}
