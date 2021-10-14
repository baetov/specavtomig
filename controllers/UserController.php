<?php

namespace app\controllers;

use app\behaviors\RoleBehavior;
use app\models\forms\AvatarForm;
use app\models\ScanSearch;

use Yii;
use app\models\User;
use app\models\UserSearch;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \yii\web\Response;
use yii\helpers\Html;
use app\models\forms\ResetPasswordForm;
use yii\web\UploadedFile;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => \yii\filters\AccessControl::className(),
                'only' => ['index','create','update','view', 'profile'],
                'rules' => [
                    // allow authenticated users
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    // everything else is denied
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                    'bulk-delete' => ['post'],
                ],
            ],
            'role' => [
                'class' => RoleBehavior::class,
                'actions' => [
                    'index' => 'directory_access',
                ],
            ],
        ];
    }

    /**
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     *
     */
    public function actionProfile()
    {
        $request = Yii::$app->request;
        $model = Yii::$app->user->identity;
        $model->scenario = User::SCENARIO_EDIT;

        if($model->load($request->post()) && $model->save()){

            Yii::$app->session->setFlash('success', 'Изменения сохранены');

            return $this->render('profile', [
                'model' => $model,
            ]);
        }

        return $this->render('profile', [
            'model' => $model,
        ]);
    }

    /**
     *
     */
    public function actionUploadAvatar()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $request = Yii::$app->request;
        $model = new AvatarForm();

        if($model->load($request->post())){
            $model->file = UploadedFile::getInstance($model, 'file');
            if($model->upload()){
                return ['success' => 1, 'path' => $model->path];
            }
            return ['success' => 0];
        } else {
            return ['success' => 0];
        }
    }

    /**
     * Updates an existing User model.
     * For ajax request will return json object
     * and for non-ajax request if update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id, $containerPjaxReload = '#crud-datatable-pjax')
    {
        $request = Yii::$app->request;
        $model = $this->findModel($id);
        $model->scenario = User::SCENARIO_EDIT;

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> "Изменить пользователя",
                    'content'=>$this->renderAjax('update', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Отмена',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Сохранить',['class'=>'btn btn-primary','type'=>"submit"])
                ];         
            }else if($model->load($request->post()) && $model->save()){
                $model->file = UploadedFile::getInstance($model, 'file');
                $model->save();
                return [
                    'forceReload'=>$containerPjaxReload,
                    'forceClose' => true,
                ];
            }else{
                 return [
                    'title'=> "Изменить пользователя",
                    'content'=>$this->renderAjax('update', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Отмена',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Сохранить',['class'=>'btn btn-primary','type'=>"submit"])
                ];        
            }
        }else{
            /*
            *   Process for non-ajax request
            */
            if ($model->load($request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                return $this->render('update', [
                    'model' => $model,
                ]);
            }
        }
    }

    /**
     * Displays a single User model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $request = Yii::$app->request;

        if($request->isAjax){
            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                    'title'=> "пользователь",
                    'content'=>$this->renderAjax('view', [
                        'model' => $this->findModel($id),
                    ]),
                    'footer'=> Html::button('Отмена',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a('Изменить',['update','id'=>$id],['class'=>'btn btn-primary','role'=>'modal-remote'])
                ];
        }else{
            return $this->render('view', [
                'model' => $this->findModel($id),
            ]);
        }
    }

    /**
     * Экшен для изменения логина прямо из таблицы. С помощью плагина Editable
     * @param $id
     * @return array
     */
    public function actionEditLogin($id)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $model = User::find()->where(['id'=>$id])->one();
        $model->scenario = User::SCENARIO_EDIT;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return ['output' => $model->login, 'message' => null];
        }else{
            $errors = $model->getFirstErrors();
            $error = reset($errors);
            return ['output' => $model->login, 'message' => $error];
        }
    }

    /**
     * Экшен для изменения логина прямо из таблицы. С помощью плагина Editable
     * @param $id
     * @return array
     */
    public function actionEditName($id)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $model = User::find()->where(['id'=>$id])->one();
        $model->scenario = User::SCENARIO_EDIT;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return ['output' => $model->name, 'message' => null];
        }else{
            $errors = $model->getFirstErrors();
            $error = reset($errors);
            return ['output' => $model->name, 'message' => $error];
        }
    }

    /**
     * Creates a new User model.
     * For ajax request will return json object
     * and for non-ajax request if creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $request = Yii::$app->request;
        $model = new User();

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> "Добавить пользователя",
                    'content'=>$this->renderAjax('create', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Отмена',['class'=>'btn btn-white pull-left btn-sm','data-dismiss'=>"modal"]).
                                Html::button('Создать',['class'=>'btn btn-primary btn-sm','type'=>"submit"])

                ];
            }else if($model->load($request->post()) && $model->save()){
                $model->file = UploadedFile::getInstance($model, 'file');
                $model->save();
                return [
                    'forceReload'=>'#crud-datatable-pjax',
                    'title'=> "Добавление пользователя",
                    'content'=>'<span class="text-success">Создание пользователя успешно завершено</span>',
                    'footer'=> Html::button('ОК',['class'=>'btn btn-default btn-sm pull-left','data-dismiss'=>"modal"]).
                            Html::a('Создать еще',['create'],['class'=>'btn btn-primary btn-sm','role'=>'modal-remote'])

                ];
            }else{
                return [
                    'title'=> "Добавить пользователя",
                    'content'=>$this->renderAjax('create', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Отмена',['class'=>'btn btn-default btn-sm pull-left','data-dismiss'=>"modal"]).
                                Html::button('Создать',['class'=>'btn btn-primary btn-sm','type'=>"submit"])
        
                ];         
            }
        }else{
            /*
            *   Process for non-ajax request
            */
            if ($model->load($request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                return $this->render('create', [
                    'model' => $model,
                ]);
            }
        }
       
    }

    /**
     * @param string $q
     * @return array
     */


    /**
     * Изменяет пароль у конкретного пользователя
     * @param $id
     * @return array
     */
    public function actionResetPassword($id)
    {
        $request = Yii::$app->request;
        $model = new ResetPasswordForm(['uid' => $id]);
//        $model->scenario = ResetPasswordForm::SCENARIO_BY_ADMIN;

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
                return [
                    'title' => "Сменить пароль",
                    'content' => '<span class="text-success">Пароль успешно изменен</span>',
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

    /**
     * Delete an existing User model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $request = Yii::$app->request;
        $deleted = $this->findModel($id)->delete();

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;

            if($deleted == false)
            {
                return ['forceClose'=>true,'forceReload'=> '#report-messages-pjax'];
            }

            return ['forceClose'=>true,'forceReload'=> '#crud-datatable-pjax'];

        }else{
            /*
            *   Process for non-ajax request
            */
            return $this->redirect(['index']);
        }


    }

     /**
     * Delete multiple existing User model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionBulkDelete()
    {
        $request = Yii::$app->request;
        $pks = explode(',', $request->post( 'pks' )); // Array or selected records primary keys
        foreach ( $pks as $pk ) {
            $model = $this->findModel($pk);
            $model->delete();
        }

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;

            return ['forceClose'=>true,'forceReload'=> '#crud-datatable-pjax'];
        }else{
            /*
            *   Process for non-ajax request
            */
            return $this->redirect(['index']);
        }

    }

    /**
     * @inheritdoc
     */
    public function beforeAction($action)
    {
        if(Yii::$app->user->isGuest == false){
//            if(Yii::$app->user->identity->role == User::ROLE_HR){
//                throw new NotFoundHttpException();
//            }
        }

        return parent::beforeAction($action);
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('Запрашиваемой страницы не существует.');
        }
    }
}
