<?php

namespace app\models\forms;

use app\models\Project;
use Yii;
use app\components\helpers\TagHelper;
use app\models\Candidate;
use app\models\CandidateEmail;
use app\models\EmailTemplate;
use app\models\Settings;
use yii\base\Model;

/**
 * Class EmailForm
 * @package app\models\forms
 */
class EmailForm extends Model
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
            'templateId' => 'Шаблон',
            'message' => 'Сообщение'
        ];
    }

    /**
     * @return boolean
     */
    public function send()
    {
        if($this->validate())
        {
            $templateModels = [];
            $candidate = Candidate::findOne($this->candidateId);
            $templateModels[] = $candidate;

            if($this->projectId != null){
                $project = Project::findOne($this->projectId);
                $templateModels[] = $project;
            }


            $template = EmailTemplate::findOne($this->templateId);

            $this->message = TagHelper::handleModel($this->message, $templateModels);

//            $apiKey = Settings::findByKey('token_sms_ru')->value;
//
//            $ch = curl_init("https://sms.ru/sms/send");
//            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
//            curl_setopt($ch, CURLOPT_TIMEOUT, 30);
//            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query(array(
//                "api_id" => $apiKey,
//                "to" => $candidate->phone,
//                "msg" => $this->message,
//                "json" => 1
//            )));
//            $body = curl_exec($ch);
//            curl_close($ch);
//
//            $json = json_decode($body);

            $result = Yii::$app->mailer->compose()
                ->setFrom('hh.notify@yandex.ru')
                ->setTo($candidate->email)
                ->setSubject($template->name)
                ->setHtmlBody($this->message)
                ->send();

            $candidateSms = new CandidateEmail([
                'candidate_id' => $this->candidateId,
                'project_id' => $this->projectId,
                'text' => $this->message,
            ]);

            if($result){
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