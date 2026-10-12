<?php

namespace App\Actions\Concerns;

use App\Support\Toast;
use Illuminate\Support\Facades\Log;

trait HandlesSafeExecution
{
    /**
     * Safely execute an operation, flash a localized toast on failure, and redirect back.
     */
    protected function safeExecute(
        \Closure $callback,
        string $errorMessage,
    ): mixed {
        try {
            return $callback();
        } catch (\Exception $e) {
            Log::error($e->getMessage(), ['exception' => $e]);

            Toast::error($errorMessage);

            // Safely redirect back so Inertia can display the toast even in production
            if (request()->inertia()) {
                abort(redirect()->back());
            }

            throw $e;
        }
    }
}
