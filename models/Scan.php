<?php

namespace app\models;

use app\components\MyUploadedFile;
use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "scan".
 *
 * @property int $id
 * @property string $name название
 * @property string $loaded_at дата и время загрузки
 * @property string $link ссылка на файл
 * @property int $author_id кто загрузил
 * @property int $user_id кто загрузил
 * @property int $claim_id
 * @property int $task_id
 * @property int $constructor_id
 * @property int $commitment_id
 *
 * @property User $author
 */
class Scan extends \yii\db\ActiveRecord
{
    public $listFile;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'scan';
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::class,
                'updatedAtAttribute' => null,
                'createdAtAttribute' => 'loaded_at',
                'value' => date('Y-m-d H:i:s'),
            ],
            [
                'class' => BlameableBehavior::class,
                'updatedByAttribute' => null,
                'createdByAttribute' => 'author_id',
                'value' => Yii::$app->user->id
            ],
        ];
    }
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['loaded_at'], 'safe'],
            [['author_id', 'user_id', 'claim_id', 'task_id', 'constructor_id', 'commitment_id'], 'integer'],
            [['name', 'link'], 'string', 'max' => 255],
            [['author_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['author_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'название',
            'loaded_at' => 'дата и время загрузки',
            'link' => 'ссылка на файл',
            'author_id' => 'кто загрузил',
            'user_id' => 'кто загрузил',
            'claim_id' => 'Claim ID',
            'task_id' => 'Task ID',
            'constructor_id' => 'Constructor ID',
            'commitment_id' => 'Commitment ID',
        ];
    }
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

                $scan = new Scan([
                    'name' => $name,
                    'link' => $path,
                    'claim_id' => $this->claim_id,
                    'task_id' => $this->task_id,
                    'user_id' => $this->user_id,
                    'author_id' => Yii::$app->user->getId(),
                ]);
                $scan->save(false);
            }
        }
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthor()
    {
        return $this->hasOne(User::className(), ['id' => 'author_id']);
    }

    /**
     * @inheritdoc
     * @return ScanQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ScanQuery(get_called_class());
    }
}
