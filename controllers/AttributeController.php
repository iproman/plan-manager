<?php
/**
 * Created by PhpStorm.
 * User: iproman
 * Date: 26.04.2019
 * Time: 4:11
 */

namespace app\controllers;

use Yii;
use yii\db\ActiveRecord;

/**
 * Class Attribute
 * @package app\controllers
 */
class AttributeController extends BaseController
{
    /**
     * Return new value
     *
     * @return array
     */
    public function actionChange()
    {
        // Check if there is an Editable ajax request
        if (isset($_POST['hasEditable'])) {

            \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

            if (null === ($class = Yii::$app->getRequest()->get('class'))) {
                return ['message' => "Не указано fully qualified имя класса ActiveRecord."];
            } else {
                if (!array_key_exists($class, Yii::$app->params['editableAttributesMap'])) {
                    return ['message' => "Изменение атрибутов класса $class не поддерживается."];
                } else {
                    if (null === ($attribute = Yii::$app->getRequest()->get('att'))) {
                        return ['message' => "Необходимо указать название атрибута через параметр 'name'."];
                    } else {
                        if (!in_array($attribute, Yii::$app->params['editableAttributesMap'][$class])) {
                            return ['message' => "Изменение значения атрибута $attribute не поддерживается."];
                        } else {
                            if (null === ($value = (Yii::$app->getRequest()->post('value')))
                            ) {
                                return ['message' => "Необходимо задать значение для изменяемого атрибута через параметр 'value'."];
                            } else {
                                if (null === ($pk = Yii::$app->getRequest()->get('id'))) {
                                    return ['message' => "Необходимо задать значение первичного ключа через параметр 'pk'."];
                                } else {
                                    /** @var $class ActiveRecord */
                                    $model = $class::findOne($pk);
                                    if (!$model instanceof ActiveRecord) {
                                        return ['message' => "Невозможно найти модель для первичного ключа $pk."];
                                    } else {
                                        $model->$attribute = $value;
                                        if ($model->save(false, [$attribute]) !== false) {
                                            return [
                                                'success' => true,
                                                'msg' => "Значение для \"" .
                                                    $model->getAttributeLabel($attribute) .
                                                    "\" успешно изменено.",
                                                'newValue' => $model->$attribute,
                                            ];
                                        } else {
                                            return ['message' => "Ошибка сохранения модели $class!"];
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
    }
}