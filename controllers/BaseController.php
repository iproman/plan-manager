<?php
/**
 * Created by PhpStorm.
 * User: iproman
 * Date: 06.02.2019
 * Time: 12:35
 */

namespace app\controllers;

use yii\web\Controller;
use Yii;

class BaseController extends Controller
{
    /**
     * Returns session flash messages
     *
     * @param string $key
     * @param bool $message
     * @param bool $remove
     */
    final protected function flashMessages(string $key, $message = true, $remove = true)
    {
        return Yii::$app->session->setFlash($key, $message, $remove);
    }

}