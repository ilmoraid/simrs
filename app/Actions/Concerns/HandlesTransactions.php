<?php

namespace App\Actions\Concerns;

use Closure;
use Illuminate\Support\Facades\DB;

trait HandlesTransactions
{
    /**
     * Execute a closure inside a database transaction.
     *
     * @template T
     *
     * @param  Closure(): T  $callback
     * @param  int<1, max>  $attempts
     * @return T
     */
    protected function transaction(Closure $callback, int $attempts = 1): mixed
    {
        return DB::transaction($callback, $attempts);
    }
}
