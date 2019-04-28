<?php
/**
 * Created by PhpStorm.
 * User: iproman
 * Date: 28.04.2019
 * Time: 17:21
 */

namespace app\models\service;

use app\models\entities\Event;
use Yii;

/**
 * Class EventDispatcher
 * @package app\models\service
 */
abstract class EventDispatcher
{
    /**
     * @param $title
     * @param $icon_name
     * @param $event_id
     * @param $event_name
     * @return bool
     */
    public static function createEvent($title, $icon_name, $event_id, $event_name)
    {
        $model = new Event();
        $model->setAttributes([
            'title' => $title,
            'icon_name' => $icon_name,
            'event_id' => $event_id,
            'event_name' => $event_name,
        ], false);
        if (!$model->save()) {
            return Yii::$app->session->setFlash('error', 'Event not saved');
        }
        return false;
    }
}