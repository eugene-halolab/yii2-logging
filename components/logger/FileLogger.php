<?php

namespace app\components\logger;

use Yii;

class FileLogger implements LoggerInterface
{
    private $type;
    private $filePath;

    public function __construct()
    {
        $this->type = 'file';
        $this->filePath = Yii::getAlias('@runtime/logs/logger.log');
    }

    public function send(string $message): void
    {
        $this->writeToFile($message);
    }

    public function sendByLogger(string $message, string $loggerType): void
    {
        if ($loggerType === 'file') {
            $this->writeToFile($message);
        }
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function setType(string $type): void
    {
        $this->type = $type;
    }

    private function writeToFile(string $message): void
    {
        file_put_contents($this->filePath, $message . PHP_EOL, FILE_APPEND);
    }
}
