<?php

namespace app\controllers;

use app\behaviors\RoleBehavior;
use app\components\helpers\Notifier;
use app\models\Deal;
use app\models\DealToUser;
use app\models\ExceptionsToWorktype;
use app\models\forms\ResetPasswordForm;
use app\models\ReportSettingColumn;
use app\models\User;
use app\models\UserToGroup;
use app\models\Worktype;
use Yii;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\helpers\VarDumper;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\forms\LoginForm;
use yii\helpers\Html;

class SiteController extends Controller
{
    /**
     * @inheritdoc
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
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
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
        return $this->render('index');
    }

    public function actionTest2()
    {
        $model = new ReportSettingColumn();
        VarDumper::dump($model->attributes, 10, true);
    }

    /**
     * Для изменения пароля
     * @return array
     */
    public function actionResetPassword()
    {
        $request = Yii::$app->request;
        $user = Yii::$app->user->identity;
        $model = new ResetPasswordForm(['uid' => $user->id]);

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet) {
                return [
                    'title' => "Сменить пароль",
                    'content' => $this->renderAjax('reset-password-form', [
                        'model' => $model,
                    ]),
                    'footer' => Html::button('Отмена', ['class' => 'btn btn-white pull-left btn-sm', 'data-dismiss' => "modal"]) .
                        Html::button('Изменить', ['class' => 'btn btn-primary btn-sm', 'type' => "submit"])

                ];
            } else if($model->load($request->post()) && $model->resetPassword()){
                Yii::$app->user->logout();
                return [
                    'title' => "Сменить пароль",
                    'content' => '<span class="text-success">Ваш пароль успешно изменен</span>',
                    'footer' => Html::button('Закрыть', ['class' => 'btn btn-white btn-sm', 'data-dismiss' => "modal"]),
                ];
            } else {
                return [
                    'title' => "Сменить пароль",
                    'content' => $this->renderAjax('reset-password-form', [
                        'model' => $model,
                    ]),
                    'footer' => Html::button('Отмена', ['class' => 'btn btn-white pull-left btn-sm', 'data-dismiss' => "modal"]) .
                        Html::button('Изменить', ['class' => 'btn btn-primary btn-sm', 'type' => "submit"])

                ];
            }
        }
    }

    public function actionTest()
    {
//        $user = User::find()->one();
//
//        if($user)
//        {
//            Notifier::notify($user, 'Тестирование', 'Сообщение');
//        }

//
//
//        $workType = Worktype::find()->where(['id' => 1])->one();
//        $userPks = ArrayHelper::getColumn(ExceptionsToWorktype::find()->where(['worktype_id' => $workType->id])->all(), 'user_id');
//        $usersPks = ArrayHelper::getColumn(UserToGroup::find()->where(['group_id' => $workType->group_id])->andWhere(['not in', 'user_id', $userPks])->all(), 'user_id');
//
//        $usersPksCount = [];
//
//        foreach ($usersPks as $pk)
//        {
////                Deal::find()->
//            $dealPks = ArrayHelper::getColumn(DealToUser::find()->where(['user_id' => $pk])->all(), 'deal_id');
//            $dealsCount = Deal::find()->where(['id' => $dealPks, 'status' => 'в работе'])->count();
//
//            $usersPksCount[] = [
//                'id' => $pk,
//                'count' => floatval($dealsCount)
//            ];
//        }
//
//        usort($usersPksCount, function($a, $b){
//            return $a['count'] > $b['count'];
//        });
//
//        VarDumper::dump($usersPksCount, 10, true);

    }

    /**
     * Login action.
     *
     * @return string
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
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return string
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

    public function actionApplications()
    {
        return $this->render('@app/views/_prototypes/applications');
    }

    public function actionAuto()
    {
        return $this->render('@app/views/_prototypes/auto');
    }

    public function actionAutoView()
    {
        return $this->render('@app/views/_prototypes/auto_view');
    }
}
