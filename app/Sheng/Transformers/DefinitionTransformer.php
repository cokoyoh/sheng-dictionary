<?php


namespace App\Sheng\Transformers;


class DefinitionTransformer extends Transformer
{

    public function transform($definition)
    {
        return [
            'description' => $definition->description,
            'examples' => $definition->examples,
            'date' => $definition->created_at->toFormattedDateString(),
        ];
    }
}
