<?php

namespace Spatie\Translatable\Events;

class TranslationHasBeenSet
{
    public function __construct(
        public mixed $model,
        public string $key,
        public string $locale,
        public mixed $oldValue,
        public mixed $newValue,
    ) {
        //
    }
}
