<?php

namespace App\Concerns;

use Illuminate\Database\Eloquent\Concerns\HasUuids as BaseHasUuids;

trait HasUuids
{
    use BaseHasUuids;

    /**
     * Get the primary key name for the model.
     */
    public function getKeyName(): string
    {
        return 'uuid';
    }
}
