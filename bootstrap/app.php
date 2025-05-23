<?php

use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\PatientMiddleware;
use App\Http\Middleware\PreventUpdateOnSentMessages;
use App\Http\Middleware\PreventBackHistory;
use App\Http\Middleware\PreventLoggedInAccess;

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'patientMiddleware' => PatientMiddleware::class,
            'adminMiddleware' => AdminMiddleware::class,
            'preventUpdateOnSent' => PreventUpdateOnSentMessages::class,
            'preventBackHistory' => PreventBackHistory::class,
            'guest' => PreventLoggedInAccess::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
