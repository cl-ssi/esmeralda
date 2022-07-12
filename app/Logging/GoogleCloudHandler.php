<?php

namespace App\Logging;

use Monolog\Logger;
use Monolog\Handler\AbstractProcessingHandler;
use Google\Cloud\Logging\LoggingClient;

class GoogleCloudHandler extends AbstractProcessingHandler {

    public function __construct($projectId, $logName, $labels, $level = Logger::DEBUG, $bubble = true)
    {
        $this->projectId    = $projectId;
        $this->logName      = $logName;
        $this->labels       = $labels;

        parent::__construct($level, $bubble);
    }

    protected function write(array $record):void
    {
        $httpRequest = [
            'requestMethod' => $_SERVER['REQUEST_METHOD'] ?? '',
            'requestUrl'    => $_SERVER['APP_URL'].$_SERVER['REQUEST_URI'],
            'status'        => $record['level'] ?? '',
            'userAgent'     => $_SERVER['HTTP_USER_AGENT'] ?? '',
            'remoteIp'      => $_SERVER['REMOTE_ADDR'] ?? '',
            'referer'       => $_SERVER['HTTP_REFERER'] ?? '',
            'protocol'      => $_SERVER['SERVER_PROTOCOL'] ?? '',
            //'latency'     => '60.005603935s',
            //'requestSize' => '1593',
            //'responseSize'=> '1176',
        ];

        $options = [
            'httpRequest'   => $httpRequest,
            'severity'      => $record['level_name'],
            'labels'        => $this->labels,
        ];
        
        $logger = (new LoggingClient([
            'projectId' => $this->projectId]
            ))->logger($this->logName, $options);
            
        
        $data = array(
            'user_id'       => auth()->user()->id ?? '',
            'message'       => $record['message'],
            'uri'           => $_SERVER['APP_URL'].$_SERVER['REQUEST_URI'],
            'formatted'     => $record['formatted'],
            'context'       => json_encode($record['context']),
            'extra'         => json_encode($record['extra']),
            'channel'       => $record['channel'],
            //'level'         => $record['level'],
            //'level_name'    => $record['level_name'],
            //'record_datetime' => $record['datetime']->format('Y-m-d H:i:s'),
            //'created_at'    => date("Y-m-d H:i:s"),
        );

        $entry = $logger->entry($data, $options);
        $logger->write($entry);
    }
}
