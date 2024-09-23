<?php

namespace App\AWS;

use Aws\Sqs\SqsClient;
use Aws\Result;

class SQS{

    private SqsClient $client;
    public function __construct()
    {
        $this->client = new SqsClient(
            [
                'credentials' => [
                    'key'=> env('AWS_ACCESS_KEY_ID'),
                    'secret' => env('AWS_SECRET_ACCESS_KEY')
                ],
                'region'=> env('AWS_DEFAULT_REGION')
            ]
        );
    }


    public function sendMessage(array $message):Result{
        return $this->client->sendMessage($message);
    }
}