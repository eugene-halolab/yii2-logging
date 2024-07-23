<?php

namespace app\components\logger;

use Yii;

class EmailLogger implements LoggerInterface
{
    private $type;

    public function __construct()
    {
        $this->type = 'email';
    }

    public function send(string $message): void
    {
        $this->sendEmail($message);
    }

    public function sendByLogger(string $message, string $loggerType): void
    {
        if ($loggerType === 'email') {
            $this->sendEmail($message);
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

    private function sendEmail(string $message): void
    {
        Yii::$app->mailer->compose()
            ->setTo(Yii::$app->params['logEmail'])
            ->setFrom([Yii::$app->params['senderEmail'] => Yii::$app->params['senderName']])
            ->setSubject('Log Message')
            ->setTextBody($message)
            ->send();
    }
}
