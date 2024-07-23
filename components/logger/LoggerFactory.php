<?php

namespace app\components\logger;

use yii\base\InvalidArgumentException;

class LoggerFactory
{
    public static function create(string $type): LoggerInterface
    {
        switch ($type) {
            case 'email':
                return new EmailLogger();
            case 'file':
                return new FileLogger();
            case 'database':
                return new DatabaseLogger();
            default:
                throw new InvalidArgumentException("Logger type '$type' is not supported.");
        }
    }
}
