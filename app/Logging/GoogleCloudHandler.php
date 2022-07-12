<?php

namespace App\Logging;

use Illuminate\Support\Facades\Auth; // TODO: es necesario?
use Monolog\Logger;
use Monolog\Handler\AbstractProcessingHandler;
use Google\Cloud\Logging\LoggingClient;

class GoogleCloudHandler extends AbstractProcessingHandler {
    /**
    *
    * Reference:
    * https://github.com/markhilton/monolog-mysql/blob/master/src/Logger/Monolog/Handler/MysqlHandler.php
    */

    public function __construct($projectId, $labels, $level = Logger::DEBUG, $bubble = true)
    {
        $this->labels = $labels;
        $this->projectId = $projectId;

        parent::__construct($level, $bubble);
    }

    protected function write(array $record):void
    {
        $options = [
            'severity' => $record['level_name'],
            'labels' => $this->labels
        ];

        $logger = (new LoggingClient([
            'projectId' => $this->projectId
        ]))->logger($this->projectId, $options);

        $data = array(
            'user_id'       => auth()->user()->id ?? '',
            'message'       => $record['message'],
            'uri'           => $_SERVER['REQUEST_URI'] ?? '',
            'formatted'     => $record['formatted'],
 
            'context'       => json_encode($record['context']),
            'level'         => $record['level'],
            'level_name'    => $record['level_name'],
            'channel'       => $record['channel'],
            
            'extra'         => json_encode($record['extra']),
            'remote_addr'   => $_SERVER['REMOTE_ADDR'] ?? '',
            'user_agent'    => $_SERVER['HTTP_USER_AGENT'] ?? '',
            'record_datetime' => $record['datetime']->format('Y-m-d H:i:s'),
            'created_at'    => date("Y-m-d H:i:s"),
        );

        $entry = $logger->entry($data, $options);
        $logger->write($entry);
    }
}
