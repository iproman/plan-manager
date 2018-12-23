<?php

namespace app\controllers;

use Yii;
use app\models\Task;
use app\models\TaskSearch;
use yii\db\ActiveRecord;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;

/**
 * TaskController implements the CRUD actions for Task model.
 */
class TaskController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Task models.
     *
     * @param null $project_id
     * @return string
     */
    public function actionIndex($project_id = null)
    {
        $searchModel = new TaskSearch();

        if (!empty($project_id)) {
            $dataProvider = new ActiveDataProvider([
                'query' => Task::find()
                    ->where(['=', 'project_id', $project_id])
                    ->orderBy([
                        'created_at' => SORT_DESC,
                    ]),
            ]);
        } else {
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        }

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
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

        // todo переделать логику
        if (!empty($project_id)) {
            if ($model->load(Yii::$app->request->post())) {
                $model->project_id = $project_id;
                $model->save();

                return $this->redirect([
                    'view',
                    'id' => $model->id,
                    'project_id' => Yii::$app->request->get('project_id')
                ]);
            }
        } else {
            if ($model->load(Yii::$app->request->post()) && $model->save()) {

                return $this->redirect(['view', 'id' => $model->id]);
            }
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
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException
     */
    public function actionUpdate($id, $project_id = null)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index', 'id' => $model->id, 'project_id' => $project_id]);
        }
        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Task model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
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

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    /**
     * Return new value
     *
     * @return array
     */
    public function actionChange()
    {
        // Check if there is an Editable ajax request
        if (isset($_POST['hasEditable'])) {
            // use Yii's response format to encode output as JSON
            \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

            // todo another controller
            // todo sending via post/checking class/branch with rules/array

            $class = Task::class;
            $attribute = 'branch';

            if (null === ($value = Yii::$app->getRequest()->post('branch'))) {
                return [
                    'success' => false,
                    'msg' => "Необходимо задать значение для изменяемого атрибута через параметр 'value'."
                ];
            } else {
                if (null === ($pk = Yii::$app->getRequest()->get('id'))) {
                    return [
                        'success' => false,
                        'msg' => "Необходимо задать значение первичного ключа через параметр 'pk'."
                    ];
                } else {
                    /** @var $class ActiveRecord */
                    $model = $class::findOne($pk);
                    if (!$model instanceof ActiveRecord) {
                        return [
                            'success' => false,
                            'msg' => "Невозможно найти модель для первичного ключа $pk."
                        ];
                    } else {
                        $model->$attribute = $value;
                        if ($model->save(false, [$attribute]) !== false) {
                            return [
                                'success' => true,
                                'msg' => "Значение для &laquo;" .
                                    $model->getAttributeLabel($attribute) .
                                    "&raquo; успешно изменено.",
                                'newValue' => $model->$attribute,
                            ];
                        } else {
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
