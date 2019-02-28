<?php

namespace app\controllers;

use Yii;
use yii\db\ActiveRecord;
use yii\web\NotFoundHttpException;
use yii\data\ActiveDataProvider;
use app\models\Task;
use app\models\TaskSearch;
use app\models\Project;

/**
 * TaskController implements the CRUD actions for Task model.
 */
class TaskController extends BaseController
{

    /**
     * Lists all Task models.
     *
     * @param null $project_id
     * @return string
     */
    public function actionIndex($project_id = null)
    {
        $searchModel = new TaskSearch();

        $projectName = !empty($project_id) ? Project::getProjectName($project_id) : 'всех проектов';

        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'projectName' => $projectName,
        ]);
    }

    /**
     * Displays a single Task model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Task model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     *
     * @param null $project_id
     * @return string|\yii\web\Response
     */
    public function actionCreate($project_id = null)
    {
        $model = new Task();

        if ($model->load(Yii::$app->request->post())) {
            if ($model->save()) {
                $this->flashMessages('success', 'New task successfully created');
            } else {
                $this->flashMessages('error', 'Can not create new project');
            }
            return $this->redirect([
                'index',
                'project_id' => $project_id,
            ]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Task model.
     * If update is successful, the browser will be redirected to the 'view' page.
     *
     * @param $id
     * @param null $project_id
     * @param null $page
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException
     */
    public function actionUpdate($id, $project_id = null, $page = null)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            if ($model->save()) {
                $this->flashMessages('success', 'Successful update');
            } else {
                $this->flashMessages('error', 'Can\'t update task');
            }
            return $this->redirect(['index', 'id' => $model->id, 'project_id' => $project_id, 'page' => $page]);
        }
        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Task model.
     * If deletion is successful, the browser will be redirected to the 'index' page
     * with define project and page, if exists GET project_id, page
     * Else returns same page as in successful delete, but flashes error.
     *
     * @param $id
     * @param null $project_id
     * @param null $page
     * @return \yii\web\Response
     * @throws NotFoundHttpException
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function actionDelete($id, $project_id = null, $page = null)
    {
        if ($this->findModel($id)->delete()) {
            $this->flashMessages('success', 'Successful delete #' . $id);
        } else {
            $this->flashMessages('error', 'Can\'t delete #' . $id);
        }
        return $this->redirect(['index', 'project_id' => $project_id, 'page' => $page]);
    }

    /**
     * Finds the Task model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Task the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Task::findOne($id)) !== null) {
            return $model;
        }

        $this->flashMessages('error', 'The requested page does not exist.');

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    /**
     * Mapping between model classes and there attributes.
     * Key represents a fully qualified model class name and value is an array
     * with model's attribute names which should be changed.
     *
     * @var array
     */
    private static $_attributesMap = [
        'app\models\Task' => [
            'name',
            'branch',
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
                            if (null === ($value = Yii::$app->getRequest()->post('value'))) {
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
