<?php


namespace api\modules\v1\models\base;


use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;
use yii\helpers\Url;
use yii\web\Linkable;

/**
 * Class BaseModel
 * @package api\modules\v1\models\base
 */
abstract class BaseModel extends ActiveRecord implements Linkable
{
    /**
     * Autofill timestamp on created_at/updated_at.
     *
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::class,
        ];
    }

    /**
     * Get class name.
     *
     * @param $classname
     * @return false|int|string
     */
    private function get_class_name($classname)
    {
        if ($pos = strrpos($classname, '\\')) return lcfirst(substr($classname, $pos + 1));
        return $pos;
    }


    /**
     * Linkable for rest.
     *
     * @return array
     */
    public function getLinks()
    {
        return [
            'self' => Url::to([$this->get_class_name(get_called_class()) . '/view', 'id' => $this->id], true),
        ];
    }
}