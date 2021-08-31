<?php

namespace app\models\forms;

use app\components\helpers\TagHelper;
use app\models\Candidate;
use app\models\CandidateSms;
use app\models\Project;
use app\models\Settings;
use app\models\SmsTemplate;
use yii\base\Model;

/**
 * Class SmsForm
 * @package app\models\forms
 */
class SmsForm extends Model
{
    /**
     * @var integer
     */
    public $candidateId;

    /**
     * @var integer
     */
    public $projectId;

    /**
     * @var integer
     */
    public $templateId;

    /**
     * @var string
     */
    public $message;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['candidateId', 'message'], 'required'],
            [['candidateId', 'projectId', 'templateId'], 'integer'],
            [['message'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'candidateId' => 'Кандидат',
            'projectId' => 'Проект',
            'templateId' => 'Шаблон',
            'message' => 'Сообщение',
        ];
    }

    /**
     * @return boolean
     */
    public function send()
    {
        if($this->validate())
        {
            $templatesModels = [];

            $candidate = Candidate::findOne($this->candidateId);
            $templatesModels[] = $candidate;

            if($this->projectId) {
                $project = Project::findOne($this->projectId);
                $templatesModels[] = $project;
            }

            $this->message = TagHelper::handleModel($this->message, $templatesModels);

            $apiKey = Settings::findByKey('token_sms_ru')->value;

            $ch = curl_init("https://sms.ru/sms/send");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_TIMEOUT, 30);
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query(array(
                "api_id" => $apiKey,
                "to" => $candidate->phone,
                "msg" => $this->message,
                "json" => 1
            )));
            $body = curl_exec($ch);
            curl_close($ch);

            $json = json_decode($body);

            $candidateSms = new CandidateSms([
                'candidate_id' => $this->candidateId,
                'project_id' => $this->projectId,
                'text' => $this->message,
            ]);

            if($json->status == 'OK'){
                $candidateSms->sent = 1;
            } else {
                $candidateSms->sent = 0;
            }

            $candidateSms->save(false);

            if($candidateSms->sent = 1) {
                return true;
            }

            return false;
        }

        return false;
    }
}