<?php

namespace app\models\forms;

use app\models\User;
use Yii;
use yii\base\Model;
use yii\web\UploadedFile;

/**
 * Class AvatarForm
 * @package app\models
 */
class AvatarForm extends Model
{
    /**
     * @var int
     */
    public $userId;

    /**
     * @var UploadedFile
     */
    public $file;

    /**
     * @var string
     */
    public $path;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
//            [['file'], 'required'],
            ['file', 'file', 'skipOnEmpty' => false],
        ];
    }

    /**\
     * @return bool
     */
    public function upload()
    {
        if($this->validate())
        {
            if(is_dir('avatars') == false){
                mkdir('avatars');
            }

            if($this->userId != null){
                $user = User::findOne([$this->userId]);
            } else {
                $user = Yii::$app->user->identity;
            }

            if($user == null){
                return false;
            }

            if($user->avatar != null){
                if(file_exists($user->avatar)){
                    unlink($user->avatar);
                }
            }

            $string = Yii::$app->security->generateRandomString();
            $path = "avatars/{$string}.{$this->file->extension}";
            $this->path = $path;
            $this->file->saveAs($path);
            $user->avatar = $path;
            $user->save(false);
            return true;
        }

        return false;
    }
}