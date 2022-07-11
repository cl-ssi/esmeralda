<?php

namespace App\Logging;

use Monolog\Logger;

class GoogleCloudLogging
{
    /**
     * Create a custom Monolog instance.
     *
     *
     * @param  array  $config
     * @return \Monolog\Logger
     */
    public function __invoke(array $config){
        $logger = new Logger("GoogleCloudHandler");
        return $logger->pushHandler(
            new GoogleCloudHandler(
                $config['projectId'], 
                $config['labels']
            )
        );
    }
}
