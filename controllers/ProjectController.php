<?php

namespace app\controllers;

use Yii;
use app\models\entities\Project;
use app\models\entities\ProjectSearch;
use yii\web\NotFoundHttpException;
use app\models\service\EventDispatcher as ED;
use rmrevin\yii\fontawesome\FA;

/**
 * ProjectController implements the CRUD actions for Project model.
 */
class ProjectController extends BaseController
{
    /**
     * Lists all Project models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProjectSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Project model.
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
     * Creates a new Project model.
     * If creation is successful, the browser will be redirected to the 'index' page.
     * @return string|\yii\web\Response
     * @throws \yii\db\Exception
     */
    public function actionCreate()
    {
        $model = new Project();

        if ($model->load(Yii::$app->request->post())) {
            if ($model->save()) {

                /**
                 * Add new event for project creating.
                 */
                ED::createEvent(
                    'New project created #' . $model->id,
                    FA::_FA,
                    $model->id,
                    'project'
                );
                $this->flashMessages('success', 'New project successfully created');
            } else {
                $this->flashMessages('error', 'Can\'t create new project');
            }
            return $this->redirect(['index']);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Project model.
     * If update is successful, the browser will be redirected to the 'view' page.
     *
     * @param $id
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException
     * @throws \yii\db\Exception
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            if ($model->save()) {

                /**
                 * Add new event for project updating.
                 */
                ED::createEvent(
                    'Project successfully updated #' . $model->id,
                    FA::_PENCIL_SQUARE,
                    $model->id,
                    'project'
                );

                $this->flashMessages('success', 'Successful update');
            } else {
                $this->flashMessages('error', 'Can\'t update project');
            }
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Project model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     *
     * @param $id
     * @return \yii\web\Response
     * @throws NotFoundHttpException
     * @throws \Throwable
     * @throws \yii\db\Exception
     * @throws \yii\db\StaleObjectException
     */
    public function actionDelete($id)
    {
        $t = $id;
        if ($this->findModel($id)->delete()) {

            /**
             * Add new event for project deleting.
             */
            ED::createEvent(
                'Project was deleted',
                FA::_TRASH_O,
                $t,
                ''
            );

            $this->flashMessages('success', 'Successful delete');
        } else {
            $this->flashMessages('error', 'Can\'t delete project');
        }

        return $this->redirect(['index']);
    }

    /**
     * Finds the Project model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Project the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Project::findOne($id)) !== null) {
            return $model;
        }

        $this->flashMessages('error', 'The requested page does not exist.');

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
