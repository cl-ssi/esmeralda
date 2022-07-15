<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Google\Cloud\ErrorReporting\Bootstrap;
use Google\Cloud\Logging\LoggingClient;
use Google\Cloud\Core\Report\SimpleMetadataProvider;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        
        $this->reportable(function (Throwable $e) {
            $projectId = 'saludiquique';
            $service = 'esmeralda';
            $version = '3';
            
            $metadata = new SimpleMetadataProvider([], $projectId, $service, $version);

            $logging = new LoggingClient(['projectId' => $projectId]);

            $logger = $logging->psrLogger('error-log', [
                'metadataProvider' => $metadata
            ]);

            Bootstrap::init($logger);
            Bootstrap::exceptionHandler($e);
        });
    }
}
