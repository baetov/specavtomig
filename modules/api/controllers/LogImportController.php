<?php

namespace app\modules\api\controllers;

use app\components\helpers\Notifier;
use app\models\AutoRate;
use app\models\AutoRateLog;
use app\models\Export;
use app\models\InfoDaft;
use app\models\LogImport;
use app\models\Order;
use app\models\PortfolioRateAuto;
use app\models\Portfolio;
use app\models\Task;
use app\models\WhiteName;
use app\models\WhiteProducer;
use yii\helpers\ArrayHelper;
use yii\helpers\VarDumper;
use yii\rest\ActiveController;
use yii\web\Response;
use app\models\User;
use app\models\PortfolioRate;

/**
 * Default controller for the `api` module
 */
class LogImportController extends ActiveController
{
    public $modelClass = 'app\models\Api';

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            [
                'class' => 'yii\filters\ContentNegotiator',
                'formats' => [
                    'application/json' => Response::FORMAT_JSON,
                ],
            ],
        ];
    }

    public function actionParse()
    {
        /** @var LogImport[] $logImports */
        $logImports = LogImport::find()->where(['status' => LogImport::STATUS_NEW])->all();

        foreach ($logImports as $logImport)
        {
            if($logImport->link == null){
                continue;
            }

            $content = json_decode(file_get_contents($logImport->link), true);

            $contentHistory = [];

            foreach ($content as $row)
            {
                $name = null;
                $publisher = null;
                $version = null;
                foreach ($row as $elements)
                {
                    if($elements['Name'] == 'Name'){
                        $name = $elements['Value'];
                    } else if($elements['Name'] == 'Publisher'){
                        $publisher = $elements['Value'];
                    } else if($elements['Name'] == 'Version'){
                        $version = $elements['Value'];
                    }
                }

//                $commonValue = ArrayHelper::getValue($row, 'Name').ArrayHelper::getValue($row, 'Value').ArrayHelper::getValue($row, 'Result');
                $commonValue = $name.$publisher.$version;

                if(in_array($commonValue, $contentHistory) == false){
                    $contentHistory[] = $commonValue;
                } else {
                    continue;
                }


                (new InfoDaft([
                    'log_import_id' => $logImport->id,
                    'producer' => $publisher,
                    'name' => $name,
                    'version' => $version,
                    'created_at' => date('Y-m-d H:i:s'),
                ]))->save(false);
            }

            $logImport->status = LogImport::STATUS_PARSED;
            $logImport->save(false);
        }
    }

    public function actionExport()
    {
        /** @var Export $export */
        $export = Export::find()->where(['status' => Export::STATUS_NEW])->one();

        if($export)
        {
            // Создание папки для файлов
            if(is_dir('uploads') == false)
            {
                mkdir('uploads');
            }
            if(is_dir("uploads/{$export->id}") == false)
            {
                mkdir("uploads/{$export->id}");
            }
            /** @var WhiteName[] $names */
            $names = WhiteName::find()->all();
            /** @var WhiteProducer[] $producers */
            $producers = WhiteProducer::find()->all();



            // Файл SoftwareNames
            if($export->software_names == null){
                $data = [];
                foreach ($names as $name)
                {
                    $templates = json_decode($name->template);

                    if($templates){
                        foreach ($templates as $template)
                        {
                            $data[] = ["OriginalName" => $template, "NormalizeName" => $name->name];
                        }
                    }
                }

                $path = "uploads/{$export->id}/SoftwareNames.json";

                $export->software_names = "uploads/{$export->id}/SoftwareNames.json";

                $fp = fopen($path, 'w');
                fwrite($fp, json_encode($data, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
                fclose($fp);

                $export->save(false);
                return;
            }


            // Файл SoftwareNames_Train
            if($export->software_names_train == null){
                $data = '';
                foreach ($names as $name)
                {
                    $templates = json_decode($name->fasktext);

                    if($templates){
                        foreach ($templates as $template)
                        {
                            $data .= "__label__".str_replace(' ', '_', $name->name).' '.str_replace('*', '', mb_strtolower($template))."\n";
                        }
                    }
                }

                $path = "uploads/{$export->id}/SoftwareNames_Train.json";

                $export->software_names_train = "uploads/{$export->id}/SoftwareNames_Train.json";

                $fp = fopen($path, 'w');
                fwrite($fp, $data);
                fclose($fp);

                $export->save(false);
                return;
            }


            // Файл SoftwarePublishers_Original
            if($export->software_publishers_original == null){
                $data = [];
                foreach ($producers as $producer)
                {
                    $data[] = ["OriginalName" => "__label__".mb_strtolower(str_replace(' ', '_', $producer->producer)), "NormalizeName" => $producer->producer];
                }

                $path = "uploads/{$export->id}/SoftwarePublishers_Original.json";

                $export->software_publishers_original = "uploads/{$export->id}/SoftwarePublishers_Original.json";

                $fp = fopen($path, 'w');
                fwrite($fp, json_encode($data, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
                fclose($fp);

                $export->save(false);
                return;
            }


            // Файл SoftwareNames_Original
            if($export->software_names_original == null){
                $data = [];
                foreach ($names as $name)
                {
                    $data[] = ["OriginalName" => "__label__".mb_strtolower(str_replace(' ', '_', $name->name)), "NormalizeName" => $name->name];
                }

                $path = "uploads/{$export->id}/SoftwareNames_Original.json";

                $export->software_names_original = "uploads/{$export->id}/SoftwareNames_Original.json";

                $fp = fopen($path, 'w');
                fwrite($fp, json_encode($data, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
                fclose($fp);

                $export->save(false);
                return;
            }


            // Файл SoftwarePublishers_Train
            if($export->software_publishers_train == null){
                $data = '';
                foreach ($producers as $producer)
                {
                    $templates = json_decode($producer->fasktext);

                    if($templates){
                        foreach ($templates as $template)
                        {
                            $data .= "__label__".str_replace(' ', '_', $producer->producer).' '.str_replace('*', '', mb_strtolower($template))."\n";
                        }
                    }
                }

                $path = "uploads/{$export->id}/SoftwarePublishers_Train.json";

                $export->software_publishers_train = "uploads/{$export->id}/SoftwarePublishers_Train.json";

                $fp = fopen($path, 'w');
                fwrite($fp, $data);
                fclose($fp);

                $export->save(false);
                return;
            }


            // Файл SoftwarePublishers
            if($export->software_publishers == null){
                $data = [];
                foreach ($producers as $producer)
                {
                    $templates = json_decode($producer->template);

                    if($templates){
                        foreach ($templates as $template)
                        {
                            $data[] = ["OriginalName" => $template, "NormalizeName" => $producer->producer];
                        }
                    }
                }

                $path = "uploads/{$export->id}/SoftwarePublishers.json";

                $export->software_publishers = "uploads/{$export->id}/SoftwarePublishers.json";

                $fp = fopen($path, 'w');
                fwrite($fp, json_encode($data, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
                fclose($fp);

                $export->status = Export::STATUS_PARSED;
                $export->save(false);
                return;
            }
        }
    }
 }
