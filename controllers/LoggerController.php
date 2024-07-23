<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\components\logger\LoggerFactory;

class LoggerController extends Controller
{
    /**
     * Sends a log message to the default logger.
     * @param string $message
     */
    public function actionLog(string $message = "This is a log message.")
    {
        $loggerType = Yii::$app->params['defaultLogger'];
        $logger = LoggerFactory::create($loggerType);
        $logger->send($message);

        return $this->render('index', [
          'result' => ["\"{$message}\": was sent via {$loggerType}"],
        ]);
    }

    /**
     * Sends a log message to a special logger.
     *
     * @param string $type
     * @param string $message
     */
    public function actionLogTo(string $type, string $message = "This is a log message for type.")
    {
        try {
            $logger = LoggerFactory::create($type);
            $logger->sendByLogger($message, $type);

            return $this->render('index', [
              'result' => ["\"{$message}\": was sent via {$type}"],
            ]);
        } catch (\InvalidArgumentException $e) {
            return $this->asJson(['status' => 'Error', 'message' => $e->getMessage()]);
        }
    }

    /**
     * Sends a log message to all loggers.
     * @param string $message
     */
    public function actionLogToAll(string $message = "Messages logged to all loggers")
    {
        $types = Yii::$app->params['activeLoggerTypes'];

        $results = [];

        foreach ($types as $type) {
            try {
                $logger = LoggerFactory::create($type);
                $logger->sendByLogger($message, $type);
                $results[] = "\"{$message}\": was sent via {$type}";
            } catch (\InvalidArgumentException $e) {
                $results[$type] = 'Error: ' . $e->getMessage();
            }
        }

        return $this->render('index', [
          'result' => $results,
        ]);
    }
}
