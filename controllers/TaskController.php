<?php

namespace app\controllers;

use Yii;
use yii\web\NotFoundHttpException;
use app\models\entities\Task;
use app\models\entities\TaskSearch;
use app\models\entities\Project;
use app\models\service\EventDispatcher as ED;
use rmrevin\yii\fontawesome\FA;

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
     * @throws \yii\db\Exception
     */
    public function actionCreate($project_id = null)
    {
        $model = new Task();

        if ($model->load(Yii::$app->request->post())) {
            if ($model->save()) {

                /**
                 * Add new event for created task.
                 */
                ED::createEvent(
                    'New task created #' . $model->id,
                    FA::_TASKS,
                    $model->id,
                    'task'
                );
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
     * @throws \yii\db\Exception
     */
    public function actionUpdate($id, $project_id = null, $page = null)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            if ($model->save()) {

                /**
                 * Add new event for task updating.
                 */
                ED::createEvent(
                    'Task successfully updated #' . $model->id,
                    FA::_PENCIL,
                    $model->id,
                    'task'
                );

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
        $t = $id;

        if ($this->findModel($id)->delete()) {

            /**
             * Add new event for task deleting.
             */
            ED::createEvent(
                'Task was deleted',
                FA::_TRASH,
                $t,
                ''
            );

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
}
