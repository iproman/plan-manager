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
     * Constants.
     */
    const NEW_EVENT = 'New event successfully created';

    /**
     * @param $title
     * @param $icon_name
     * @param $event_id
     * @param $event_name
     * @throws \yii\db\Exception
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
            $msg = 'Event not saved #' . $model->id;

            Yii::$app->session->setFlash('error', $msg);

            Yii::error($msg, __METHOD__);
            throw new \yii\db\Exception($msg);
        }
        Yii::$app->session->setFlash('success', self::NEW_EVENT);
    }
}