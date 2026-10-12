<?php

namespace App\Support;

use Inertia\Inertia;

final class Toast
{
    /**
     * Flash a success toast notification.
     */
    public static function success(string $message): void
    {
        self::flash('success', $message);
    }

    /**
     * Flash an error toast notification.
     */
    public static function error(string $message): void
    {
        self::flash('error', $message);
    }

    /**
     * Internal flash handler.
     */
    private static function flash(string $type, string $message): void
    {
        Inertia::flash('toast', [
            'type' => $type,
            'message' => $message,
        ]);
    }
}
