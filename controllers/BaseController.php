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
use yii\filters\VerbFilter;
use yii\db\ActiveRecord;

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

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Mapping between model classes and there attributes.
     * Key represents a fully qualified model class name and value is an array
     * with model's attribute names which should be changed.
     *
     * @var array
     */
    private static $_attributesMap = [
        'app\models\entities\Task' => [
            'name',
            'branch',
            'status',
        ],
    ];

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
                return [
                    'success' => false,
                    'msg' => "Не указано fully qualified имя класса ActiveRecord."
                ];
            } else {
                if (!array_key_exists($class, self::$_attributesMap)) {
                    return [
                        'success' => false,
                        'msg' => "Изменение атрибутов класса $class не поддерживается."
                    ];
                } else {
                    if (null === ($attribute = Yii::$app->getRequest()->get('att'))) {
                        return [
                            'success' => false,
                            'msg' => "Необходимо указать название атрибута через параметр 'name'."
                        ];
                    } else {
                        if (!in_array($attribute, self::$_attributesMap[$class])) {
                            return [
                                'error' => true,
                                'msg' => "Изменение значения атрибута $attribute не поддерживается.",
                            ];
                        } else {
                            if (null === ($value = (Yii::$app->getRequest()->post('value')))
                            ) {
                                $this->flashMessages('error', 'Необходимо задать значение для изменяемого
                 атрибута через параметр \'value\'.');
                                return [
                                    'success' => false,
                                    'msg' => "Необходимо задать значение для изменяемого атрибута через параметр 'value'."
                                ];
                            } else {
                                if (null === ($pk = Yii::$app->getRequest()->get('id'))) {
                                    $this->flashMessages('error', "Необходимо задать значение первичного ключа через
                    параметр 'pk'.");
                                    return [
                                        'success' => false,
                                        'msg' => "Необходимо задать значение первичного ключа через параметр 'pk'."
                                    ];
                                } else {
                                    /** @var $class ActiveRecord */
                                    $model = $class::findOne($pk);
                                    if (!$model instanceof ActiveRecord) {
                                        $this->flashMessages('error', "Невозможно найти модель для первичного ключа $pk.");
                                        return [
                                            'success' => false,
                                            'msg' => "Невозможно найти модель для первичного ключа $pk."
                                        ];
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
                                            $this->flashMessages('error', "Ошибка сохранения модели $class!");
                                            return [
                                                'success' => false,
                                                'msg' => "Ошибка сохранения модели $class!"
                                            ];
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