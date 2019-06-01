<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Response;
use app\models\forms\{
    LoginForm,
    ContactForm
};
use app\models\entities\{
    Task,
    Event,
    Project
};
use app\models\service\{
    Statuses,
    HighCharts
};

class SiteController extends BaseController
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     * @throws \Throwable
     */
    public function actionIndex()
    {
        $taskDone = Task::getCountedTasks(Statuses::STATUS_DONE);
        $taskInWork = Task::getCountedTasks(Statuses::STATUS_IN_WORK);
        $taskWarning = Task::getCountedTasks(Statuses::STATUS_WARNING);
        $taskNew = Task::getCountedTasks(Statuses::STATUS_NEW);
        $taskRejected = Task::getCountedTasks(Statuses::STATUS_REJECTED);
        $countedTasks = [
            0 => $taskNew,
            1 => $taskInWork,
            2 => $taskDone,
            3 => $taskWarning,
            4 => $taskRejected,
        ];

        $totalTasks = Task::find()->count('*');

        $done = HighCharts::getCountedHighChartsResults('done');
        $new = HighCharts::getCountedHighChartsResults('new');
        $in_work = HighCharts::getCountedHighChartsResults('in_work');
        $warning = HighCharts::getCountedHighChartsResults('warning');
        $dayLabels = HighCharts::getCountedHighChartsResults();

        $recentEvents = Event::getRecentEvents();

        $projects = Project::getProjectsAndCountedTasks();

        return $this->render(
            'index',
            compact(
                'taskDone',
                'taskInWork',
                'taskWarning',
                'taskNew',
                'taskRejected',
                'done',
                'new',
                'in_work',
                'warning',
                'dayLabels',
                'recentEvents',
                'totalTasks',
                'countedTasks',
                'projects'
            )
        );
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }
}
