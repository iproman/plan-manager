<?php

namespace app\controllers;

use Yii;
use app\models\Title;
use app\models\TitleSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;

/**
 * TitleController implements the CRUD actions for Title model.
 */
class TitleController extends Controller
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
     * Lists all Title models.
     *
     * @param null $id
     * @return string
     */
    public function actionIndex($id = null)
    {
        $searchModel = new TitleSearch();

        if (!empty($id)) {
            $dataProvider = new ActiveDataProvider([
                'query' => Title::find()
                    ->where(['=', 'project_id', $id])
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
     * Displays a single Title model.
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
     * Creates a new Title model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     *
     * @param null $project_id
     * @return string|\yii\web\Response
     */
    public function actionCreate($project_id = null)
    {
        $model = new Title();
        
        // todo переделать логику
        if (!empty($project_id)) {
            if ($model->load(Yii::$app->request->post())) {
                $model->project_id = $project_id;
                $model->save();

                return $this->redirect(['view', 'id' => $model->id]);
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
     * Updates an existing Title model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Title model.
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
     * Finds the Title model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Title the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Title::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
