<?php


namespace App\Sheng\Transformers;


class UserTransformer extends Transformer
{

    public function transform($user)
    {
        return [
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'status' => $user->status,
            'date' => $user->created_at->toFormattedDateString(),
            'phone' => $user->phone,
        ];
    }
}
