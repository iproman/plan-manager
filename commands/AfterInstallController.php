<?php

namespace app\commands;

use yii\console\Controller;
use yii\helpers\FileHelper;

/**
 * Class AfterInstallController
 * @package app\commands
 */
class AfterInstallController extends Controller
{
    public function actionIndex()
    {
        $backupsDir = \Yii::getAlias('@runtime/backups');
        if (!is_dir($backupsDir)) {
            FileHelper::createDirectory($backupsDir);
        }
    }
}