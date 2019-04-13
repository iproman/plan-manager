<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Response;
use app\models\forms\LoginForm;
use app\models\forms\ContactForm;
use app\models\entities\Task;
use app\models\entities\Event;

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
     */
    public function actionIndex()
    {
        $taskDone = Task::getCountedTasks(Task::STATUS_DONE);
        $taskInWork = Task::getCountedTasks(Task::STATUS_IN_WORK);
        $taskWarning = Task::getCountedTasks(Task::STATUS_WARNING);

        $done = Task::getCountedHighChartsResults('done');
        $new = Task::getCountedHighChartsResults('new');
        $in_work = Task::getCountedHighChartsResults('in_work');
        $warning = Task::getCountedHighChartsResults('warning');
        $dayLabels = Task::getCountedHighChartsResults();

        $recentEvents = Event::getRecentEvents();

        return $this->render(
            'index',
            compact(
                'taskDone',
                'taskInWork',
                'taskWarning',
                'done',
                'new',
                'in_work',
                'warning',
                'dayLabels',
                'recentEvents'
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
