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
     * Constants.
     */
    const EVENT_PROJECT = 'project';

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
                    'New ' . self::EVENT_PROJECT . ' successfully created #' . $model->id,
                    FA::_FA,
                    $model->id,
                    self::EVENT_PROJECT
                );
                $this->flashMessages('success', 'New ' . self::EVENT_PROJECT . '  successfully created');
            } else {
                $this->flashMessages('error', 'Can\'t create new ' . self::EVENT_PROJECT);
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
                    self::EVENT_PROJECT .' successfully updated #' . $model->id,
                    FA::_PENCIL_SQUARE,
                    $model->id,
                    self::EVENT_PROJECT
                );

                $this->flashMessages('success', 'Successful ' . self::EVENT_PROJECT . ' update');
            } else {
                $this->flashMessages('error', 'Can\'t update ' . self::EVENT_PROJECT);
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
                self::EVENT_PROJECT . ' was deleted',
                FA::_TRASH_O,
                $t,
                ''
            );

            $this->flashMessages('success', self::EVENT_PROJECT . ' deleted');
        } else {
            $this->flashMessages('error', 'Can\'t delete ' . self::EVENT_PROJECT);
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
