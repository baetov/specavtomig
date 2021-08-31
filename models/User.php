<?php

namespace app\models;

use app\components\MyUploadedFile;
use DateTime;
use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\web\UploadedFile;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $user_type тип
 *  @property string $cities Логин
 * @property string $login Логин
 * @property string $name ФИО
 * @property string $email email
 * @property string $phone телефон
 * @property string $type тип пользователя
 * @property string $birth_date дата рождения
 * @property int $position_id Должность
 * @property int $role_id Роль
 * @property int $inn Роль
 * @property string $avatar Аватар
 * @property string $password_hash Зашифрованный пароль
 * @property int $access Доступ
 * @property int $is_deletable Можно удалить или нельзя
 * @property string $created_at
 *
 * @property Crew $crew
 * @property string $address
 *
 * @property UploadedFile $file
 *

 * @property Role $role

 */
class User extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{
    const SCENARIO_DEFAULT = 'default';
    const SCENARIO_EDIT = 'edit';

    public $password;

    public $listFile;

    public $file;

    private $oldPasswordHash;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        return [
            self::SCENARIO_DEFAULT => [
                'name', 'login', 'type', 'is_deletable', 'user_type','user_kind',
                'inn', 'password','cities', 'password_hash', 'role_id','crew_id',
                'phone','address','listFile','birth_date','avatar'],
            self::SCENARIO_EDIT => [
                'name', 'login', 'type', 'is_deletable', 'password', 'user_type',
                'user_kind','inn', 'password_hash', 'cities', 'role_id','crew_id',
                'position_id', 'phone', 'address', 'birth_date', 'listFile', 'avatar'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['login', 'name'], 'required'],
            [['password'], 'required', 'on' => self::SCENARIO_DEFAULT],
            ['birth_date', function(){
                if($this->birth_date > date('Y-m-d') or strlen($this->birth_date) > 10){
                    $this->addError('birth_date', 'Некорректная дата');
                    return false;
                }
            }],
            [['listFile',], 'validateListFile'],
            ['login', 'email'],
            [['login', 'phone'], 'unique'],
            [['cities'], 'safe'],
            ['file', 'file'],
            [['role', 'access', 'is_deletable','crew_id'], 'integer'],
            [['login', 'password_hash', 'password', 'name','type', 'inn', 'address', 'avatar',], 'string', 'max' => 255],
            ['inn', 'string', 'min' => 12, 'max' => 12],
            ['inn', 'match', 'pattern' => '/^[0-9]\w*$/i', 'message' => 'Должны быть только цифры'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function beforeDelete()
    {
        parent::beforeDelete();

        $uid = Yii::$app->user->identity->id;

        if($uid == $this->id)
        {
            Yii::$app->session->setFlash('error', "Вы авторизованы под пользователем «{$this->login}». Удаление невозможно!");
            return false;
        }

        if($this->is_deletable == false)
        {
            Yii::$app->session->setFlash('error', "Этот пользователь не может подлежать удалению. Удаление невозможно!");
            return false;
        } else {
            return true;
        }
    }

  

    public function getCommentatorAvatar()
    {
        return '/'.$this->getRealAvatar();
    }

    public function getCommentatorName()
    {
        return $this->name;
    }

   
  

    /**
     * @param string $attribute
     */
    public function validateListFile($attribute)
    {
        foreach($this->$attribute as $index => $row) {
//            if ($row['name'] == null) {
//                $key = $attribute . '[' . $index . '][name]';
//                $this->addError($key, 'Обязательное для заполненния');
//            }
            foreach ($_FILES['User']['name'][$attribute] as $indexFile => $file){
                if($file['file_new'] == null){
                    $key = $attribute . '[' . $index . '][file_new]';
                    $this->addError($key, 'Обязательное для заполненния');
                }
            }
        }
    }

    /**
     * @param string $action
     * @return bool
     */
    public function can($action)
    {
        if(Yii::$app->user->identity->role_id != null){
            $role = Role::findOne(Yii::$app->user->identity->role_id);

            if($role){
                if(isset($role->$action)){
                    return $role->$action == 1;
                }
            }
        }
        return false;
    }

    /**
     * @return string
     */
    public function getRealAvatar()
    {
        return $this->avatar != null ? $this->avatar : 'img/nouser.png';
    }

    /**
     * @return bool
     */
    public function isSuperAdmin()
    {
        return $this->role_id == 1;
    }


    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }


    /**
     * @inheritdoc
     */
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if($this->file != null){
                $fileName = Yii::$app->security->generateRandomString();
                if(is_dir('upload') == false){
                    mkdir('upload');
                }
                $path = "uploads/{$fileName}.{$this->file->extension}";
                $this->file->saveAs($path);
                if($this->file != null && file_exists($this->file)){
                    unlink($this->file);
                }
                $this->avatar = $path;
            }

            if ($this->isNewRecord) {
                $this->created_at = date('Y-m-d H:i:s');
            }
            if($this->password != null){
                $this->password_hash = Yii::$app->security->generatePasswordHash($this->password);
            } else {
                $this->password_hash = $this->oldPasswordHash;
            }

//            if($this->isNewRecord){
//                try {
//                    Yii::$app->mailer->compose()
//                        ->setTo($this->login)
//                        ->setFrom('hh.notify@yandex.ru')
//                        ->setSubject('Вы зарегистрированы')
//                        ->setHtmlBody("Ваш логин: {$this->login}<br> Ваш пароль: {$this->password}<br><a href='".Url::toRoute(['site/login'], true)."'>Войти в систему</a>")
//                        ->send();
//                } catch (\Exception $e)
//                {
//                    Yii::warning('Email sending failed');
//                }
//            }

            return true;
        }
        return false;
    }

    /**
     * @inheritdoc
     */
    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);





        if($this->listFile != null){
            $files = MyUploadedFile::getInstancesByName('listFile', true);

            $files = array_combine(ArrayHelper::getColumn($this->listFile, 'name'), $files);
            foreach ($files as $name => $file){
                /** @var $file MyUploadedFile */

                $path = Yii::$app->security->generateRandomString();
                $path = "uploads/{$path}.$file->extension";

                $file->saveAs($path);

                if($name == null){
                    $name = $file->baseName;
                }

                $scan = new Scan([
                    'name' => $name,
                    'link' => $path,
                    'user_id' => $this->id,
                    'author_id' => Yii::$app->user->getId(),
                ]);
                $scan->save(false);
            }
        }
        $this->listFile = null;


    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'login' => 'Email',
            'name' => 'ФИО',
            'email' => 'Email',
            'phone' => 'Номер телефона ',
            'type' => 'Тип пользователя',
            'birth_date' => 'Дата рождения',
            'position_id' => 'Должность',
            'role_id' => 'Роль сотрудника',
            'file' => 'Фотография',
            'avatar' => 'Фотография',
            'password_hash' => 'Password Hash',
            'access' => 'Доступ',
            'is_deletable' => 'Можно ли удалять',
            'created_at' => 'Дата создания',
            'cities' => 'Города выполнения работ',
            'inn' => 'ИНН',
            'user_type' => 'Типы выполняемых работ',
            'user_kind' => 'Виды работ исполнителя',
            'address' => 'Адрес',
            'crew_id' => 'Компания'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getScans()
    {
        return $this->hasMany(Scan::className(), ['author_id' => 'id']);
    }





    /**
     * @return \yii\db\ActiveQuery
     */
//    public function getPosition()
//    {
//        return $this->hasOne(Position::className(), ['id' => 'position_id']);
//    }

    /**
     * @return array
     */
    public static function getUserList()
    {
//        $list = [];
//        $type = WorkType::find()->all();
//        foreach ($type as $item) {
//            $kings = TaskStatusWorkType::find()->where(['work_type_id' => $item->id])->all();
//            $list[$item->name] = ArrayHelper::map(TaskStatus::find()->where(['id' => ArrayHelper::getColumn($kings, 'task_status_id')])->all(), 'id', 'name');
//        }
//        return $list;

        $list = [];

        $users = self::find()->where(['type' => 0])->all();
//        foreach($users as $user){
            $list['Штатный'] = ArrayHelper::map($users, 'id', 'name');
//        }

        $users = self::find()->where(['type' => 1])->all();
//        foreach($users as $user){
            $list['Внештатный'] = ArrayHelper::map($users, 'id', 'name');
//        }

        $users = self::find()->where(['type' => 2])->all();
//        foreach($users as $user){
            $list['Подрядчик'] = ArrayHelper::map($users, 'id', 'name');
//        }

        return $list;
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRole()
    {
        return $this->hasOne(Role::className(), ['id' => 'role_id']);
    }


    /**
     * @inheritdoc
     * @return UserQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new UserQuery(get_called_class());
    }


    /**
     * @inheritdoc
     */
    public function afterFind()
    {
        $this->oldPasswordHash = $this->password_hash;
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        foreach (self::$users as $user) {
            if ($user['accessToken'] === $token) {
                return new static($user);
            }
        }

        return null;
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['login' => $username]);
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->id;
    }


    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->password;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }


//    /**
//        * @inheritdoc
//     */
////    public function getListKind()
////    {
////        $list = [];
////        $type = WorkType::find()->all();
////        foreach ($type as $item) {
////            $kings = WorkKind::find()->where(['work_type_id' => $item->id])->all();
////            foreach ($kings as $king) {
//////                $list[$item->name][$king->name] = ArrayHelper::map(Subgroups::find()->where(['work_kind_id' => $king->id])->all(), 'id', 'name');
////                $list[$king->name] = ArrayHelper::map(Subgroups::find()->where(['work_kind_id' => $king->id])->all(), 'id', 'name');
////            }
////       }
//        return $list;
//    }
}
