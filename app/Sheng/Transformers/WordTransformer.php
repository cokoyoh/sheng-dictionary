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
             'title' => $word->title,
             'editable' => auth()->id() == $word->user_id,
             'likes' => $this->getTotalLikes($word),
             'dislikes' => $this->getTotalDislikes($word)
         ];
    }

    private function getTotalLikes($word)
    {
        return $word->likes()->count();
    }

    private function getTotalDislikes($word)
    {
        return $word->dislikes()->count();
    }
}
