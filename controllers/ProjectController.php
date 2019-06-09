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
                /** @var Project $model */

                /**
                 * Add new event for project creating.
                 */
                $message = 'New ' . self::EVENT_PROJECT . ' `' . $model->name . '`` successfully created';

                ED::createEvent(
                    $message,
                    FA::_FA,
                    $model->id,
                    self::EVENT_PROJECT
                );
                $this->flashMessages('success', $message);
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
                    self::EVENT_PROJECT . ' successfully updated #' . $model->id,
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
        $model = $this->findModel($id);
        if ($model->delete()) {
            /** @var Project $model */

            /**
             * Add new event for project deleting.
             */
            $message = self::EVENT_PROJECT . ' `' . $model->name . '` was deleted';

            ED::createEvent(
                $message,
                FA::_TRASH_O,
                $id,
                ''
            );

            $this->flashMessages('success', ucfirst($message));
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
