<?php
/**
 * Created by PhpStorm.
 * User: Ilusha
 * Date: 25.09.2017
 * Time: 17:21
 */

namespace app\models\forms;

use app\models\User;
use yii\web\NotFoundHttpException;
use yii\web\UnauthorizedHttpException;
use Yii;
use yii\base\Model;

/**
 * Class ResetPasswordForm
 * Форма для изменения пароля пользователю
 * @package app\models\forms
 * @property int $uid
 * @property String $oldPassword
 * @property String $newPassword
 * @property String $repeatPassword
 * @property \app\models\User $_user
 */
class ResetPasswordForm extends Model
{
    const SCENARIO_DEFAULT = 'default';
    const SCENARIO_BY_ADMIN = 'by_admin';

    public $uid;
    public $oldPassword;
    public $newPassword;
    public $repeatPassword;

    private $_user;


    public function scenarios()
    {
        return [
            self::SCENARIO_DEFAULT => ['uid', 'oldPassword', 'newPassword', 'repeatPassword'],
            self::SCENARIO_BY_ADMIN => ['uid', 'newPassword', 'repeatPassword'],
        ];
    }

    public function rules()
    {
        return [
            [['uid' ,'oldPassword', 'newPassword', 'repeatPassword'], 'required'],
            ['uid', 'integer'],
            ['uid', 'findUser'],
            ['oldPassword', 'validateOldPassword'],
            ['newPassword', 'match', 'pattern' => '/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])[0-9a-zA-Z]{6,50}$/', 'message' => '{attribute} не соответствует всем параметрам безопасности'],
            ['repeatPassword', 'compare', 'compareAttribute' => 'newPassword', 'message' => 'Пароли не совпадают'],
        ];
    }

    /**
     * Меняет
     * @return mixed
     */
    public function resetPassword()
    {
        if($this->validate())
        {
            $this->_user->setPassword($this->newPassword);
            return $this->_user->save();
        }
    }

    public function attributeLabels()
    {
        return [
            'uid' => 'Пользователь',
            'oldPassword' => 'Текущий пароль',
            'newPassword' => 'Новый пароль',
            'repeatPassword' => 'Повторите пароль',
        ];
    }

    /**
     * Проверяет есть ли в БД пользователь с uid
     * @param $attribute
     * @param $params
     */
    public function findUser($attribute, $params)
    {
        $this->_user = User::findOne($this->$attribute);

        if($this->_user == null)
        {
            $this->addError($attribute, "Пользователь под id «{$this->uid}» не найден");
        }
    }

    /**
     * Валидатор для праверки пароля пользователя
     */
    public function validateOldPassword($attribute, $params)
    {
        if($this->_user->validatePassword($this->$attribute) == false)
        {
            $this->addError('oldPassword', 'Неверный пароль');
        }
    }
}