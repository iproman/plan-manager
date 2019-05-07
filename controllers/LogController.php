<?php

namespace app\controllers;

use Yii;
use app\models\entities\Log;
use app\models\entities\LogSearch;
use yii\web\NotFoundHttpException;
use app\models\service\EventDispatcher as ED;
use rmrevin\yii\fontawesome\FA;

/**
 * LogController implements the CRUD actions for Log model.
 */
class LogController extends BaseController
{

    /**
     * Constants.
     */
    const EVENT_LOG = 'log';

    /**
     * Lists all Log models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new LogSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Log model.
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
     * Creates a new Log model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     * @throws \yii\db\Exception
     */
    public function actionCreate()
    {
        $model = new Log();

        if ($model->load(Yii::$app->request->post())) {
            if ($model->save()) {
                /**
                 * Add new event for log creating.
                 */
                ED::createEvent(
                    'New ' . self::EVENT_LOG . ' successfully created #' . $model->id,
                    FA::_COGS,
                    $model->id,
                    self::EVENT_LOG
                );

                $this->flashMessages('success', 'New ' . self::EVENT_LOG . ' successfully created');
            } else {
                $this->flashMessages('error', 'Can\'t create new ' . self::EVENT_LOG);
            }
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Log model.
     * If update is successful, the browser will be redirected to the 'view' page.
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
                 * Add new event for log updating.
                 */
                ED::createEvent(
                    self::EVENT_LOG . ' successfully updated #' . $model->id,
                    FA::_COG,
                    $model->id,
                    self::EVENT_LOG
                );

                $this->flashMessages('success', 'Successful ' . self::EVENT_LOG . ' update');
            } else {
                $this->flashMessages('error', 'Can\'t update ' . self::EVENT_LOG);
            }
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Log model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
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
             * Add new event for log deleting.
             */
            ED::createEvent(
                self::EVENT_LOG . ' was deleted',
                FA::_TRASH_O,
                $t,
                ''
            );

            $this->flashMessages('success', self::EVENT_LOG . ' deleted');
        } else {
            $this->flashMessages('error', 'Can\'t delete ' . self::EVENT_LOG);
        }

        return $this->redirect(['index']);
    }

    /**
     * Finds the Log model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Log the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Log::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    /**
     * Drop all logs
     * @return \yii\web\Response
     * @throws \yii\db\Exception
     */
    public function actionPurgeLogs()
    {
        if (Yii::$app->getDb()->createCommand()->truncateTable(Log::tableName())->execute()) {
            /**
             * Add new event for logs deleting.
             */
            ED::createEvent(
                'All ' . self::EVENT_LOG . 's was deleted',
                FA::_TRASH_O,
                '',
                ''
            );

            $this->flashMessages('success', 'All ' . self::EVENT_LOG . 's successfully deleted');

        }

        return $this->redirect(['index']);
    }
}
