<?php

    namespace App\Traits;

    use Illuminate\Support\Str;

    /**
     * UUID Trait
     */
    trait UuidTrait
    {
        public static function UsesUuid()
        {
            parent::boot();
            static::creating(function ($model) {
                if ( ! $model->getKey()) {
                    $model->{$model->getKeyName()} = (string) Str::uuid();
                }
            });
        }

         /**
         * Get the value indicating whether the IDs are incrementing.
         *
         * @return bool
         */
        public function getIncrementing()
        {
            return false;
        }

        /**
         * Get the auto-incrementing key type.
         *
         * @return string
         */
        public function getKeyType()
        {
            return 'string';
        }
    }
    
?>