<?php

namespace app\models\forms;

use app\models\History;
use app\models\HistoryClaim;
use app\models\OrderHistory;
use app\models\TaskHistory;
use Yii;
use yii\base\Model;
use app\components\MyUploadedFile;
use yii\helpers\ArrayHelper;
use app\models\Scan;

/**
 * Class ScanForm
 * @package app\models\forms
 */
class ScanForm extends Model
{
    /**
     * @var array
     */
    public $listFile;

    /**
     * @var int
     */
    public $userId;

    /**
     * @var int
     */
    public $claimId;
    /**
     * @var int
     */
    public $taskId;
    /**
     * @var int
     */
    public $commitmentId;
    /**
     * @var int
     */
    public $contractId;
    /**
     * @var int
     */
    public $dealId;
    /**
     * @var int
     */
    public $courtDealId;




    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['listFile'], 'safe'],
            [['userId', 'claimId','taskId','orderId'], 'integer'],
        ];
    }

    /**
     * @return boolean
     */
    public function loadFile()
    {
        if($this->listFile != null){
            $files = MyUploadedFile::getInstancesByName('listFile', true);

            $files = array_combine(ArrayHelper::getColumn($this->listFile, 'name'), $files);
            foreach ($files as $name => $file){
                /** @var $file MyUploadedFile */

                $path = Yii::$app->security->generateRandomString();
                $path = "uploads/{$path}.$file->extension";

                $file->saveAs($path);

                $scan = new Scan([
                    'name' => !$name ? date("m.d.y") : $name,
                    'link' => $path,
                    'claim_id' => $this->claimId,
                    'commitment_id' => $this->commitmentId,
                    'task_id' => $this->taskId,
                    'user_id' => $this->userId,
                    'deal_id' => $this->dealId,
                    'court_deal_id' => $this->courtDealId,
                    'contract_id' => $this->contractId,
                    'author_id' => Yii::$app->user->getId(),
                ]);

                $scan->save(false);
            }

            if($this->claimId != null){
                $info = '';
                foreach ($this->listFile as $item) {
                    $info .= $item['name'].', ';
                }
                (new HistoryClaim([
                    'created_by' => Yii::$app->user->identity->id,
                    'claim_id' => $this->claimId,
                    'history_comment' => 'Были загружены документы: '.$info,
                    'created_at' => date('Y-m-d H:i:s'),
                ]))->save(false);
            }
//            if($this->taskId != null){
//                $info = '';
//                foreach ($this->listFile as $item) {
//                    $info .= $item['name'].', ';
//                }
//                (new TaskHistory([
//                    'user_id' => Yii::$app->user->identity->id,
//                    'task_id' => $this->taskId,
//                    'history_comment' => 'Были загружены документы: '.$info,
//                    'created_at' => date('Y-m-d H:i:s'),
//                ]))->save(false);
//            }
//            if($this->commitmentId != null){
//                $info = '';
//                foreach ($this->listFile as $item) {
//                    $info .= $item['name'].', ';
//                }
//
//            }
        }

        return true;
    }
}