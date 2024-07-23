<?php

namespace app\components\logger;

use Yii;

class DatabaseLogger implements LoggerInterface
{
    private $type;

    public function __construct()
    {
        $this->type = 'database';
    }

    public function send(string $message): void
    {
        $this->saveToDatabase($message);
    }

    public function sendByLogger(string $message, string $loggerType): void
    {
        if ($loggerType === 'database') {
            $this->saveToDatabase($message);
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

    private function saveToDatabase(string $message): void
    {
        Yii::$app->db->createCommand()->insert('log', [
            'message' => $message,
            'created_at' => new \yii\db\Expression('NOW()'),
        ])->execute();
    }
}
