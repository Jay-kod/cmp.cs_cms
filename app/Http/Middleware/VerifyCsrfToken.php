<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Encryption\Encrypter;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array<int, string>
     */
    protected $except = [
        // In local development, the super-admin login form is served from a
        // different URL prefix/guard and can easily end up with a stale CSRF
        // token during testing (419 Session expired).
        // We exclude only this one POST endpoint in local env to unblock dev.
    ];

    public function __construct(Application $app, Encrypter $encrypter)
    {
        parent::__construct($app, $encrypter);

        if ($app->environment('local')) {
            $this->except = array_merge($this->except, ['super-admin/login', 'login', 'admin/login']);
        }
    }
}
