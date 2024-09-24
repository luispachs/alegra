<?php

namespace App\AWS\Messages;

use Aws\Sqs\SqsClient;
use Illuminate\Database\Eloquent\Model;

class SqsMessage{

    public function getMessage(string $queue ,Model $object,string $id,string $groupId):array{
        $bodyMessage = $object->serialize();
        $date = new \DateTime('now');
        $message = [
            "MessageAttributes"=>[
                "CreationDate"=> [
                    "DataType" => "String",
                    "StringValue" =>$date->format("Y-m-d H:i:s")
                ],
                "OrderId" => [
                    "DataType" => "String",
                    "StringValue" => $id
                ]
            ],
            "QueueUrl" => env($queue),
            "MessageBody" =>$bodyMessage,
            "MessageGroupId" =>$groupId,
            "MessageDeduplicationId" => md5($bodyMessage)
        ];

        return $message;
    }
}