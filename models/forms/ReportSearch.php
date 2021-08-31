<?php

namespace app\models\forms;

use app\components\ReportColumn;
use app\models\Contract;
use app\models\Order;
use app\models\OrderOrder;
use app\models\ReportSettingColumn;
use app\models\UserToCity;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\data\ArrayDataProvider;
use yii\db\Query;
use yii\helpers\ArrayHelper;
use yii\helpers\VarDumper;

/**
 * Class ReportSearch
 * @package app\models\forms
 */
class ReportSearch extends Model
{
    /**
     * @var array
     */
    public $setting;

    public $oldSetting;

    public $city_id;

    public $type;

    public $customer_id;

    public $author_id;

    public $object_number;

    public $object_address;

    public $order_number;

    public $order_date;

    public $contract_id;

    public $fact_end_date;

    public $order_deadline;

    public $order_status_id;

    public $expired;

    public $scan_added;

    public $related_orders;

    public $comment;

    public $construction_type;

    public $ams_type_id;

    public $placement_id;

    public $letter_date;

    public $letter_text;

    public $order_sum;

    public $email_date;

    public $email_matching_date;

    public $edo_date;

    public $edo_getting_date;

    public $created_at;

    public $workTypes;

    public $updated_at;

    public $task_name;


    public $task_author_id;
    public $task_order_id;
    public $task_workKinds;
    public $task_task_type;
    public $task_priority;
    public $task_task_status_id;
    public $task_responsible_id;
    public $task_task_deadline;
    public $task_checker_id;
    public $task_normocontroller_id;
    public $task_gip_id;
    public $task_work_sum;
    public $task_comment;
    public $task_task_desc;
    public $task_task_rating;
    public $task_payment_status;
    public $task_payment_balance;
    public $task_payment_debt;
    public $task_created_at;
    public $task_updated_at;

    public $contract_name;
    public $contract_customer_id;
    public $contract_contract_number;
    public $contract_contract_date;
    public $contract_contract_type;
    public $contract_contract_status;
    public $contract_city_id;
    public $contract_project_name;
    public $contract_contract_deadline;
    public $contract_contract_sum;
    public $contract_contract_signature_name;
    public $contract_contract_executor_name;
    public $contract_post_address;
    public $contract_scan_id;
    public $contract_comment;
    public $contract_author_id;
    public $contract_created_at;
    public $contract_updated_at;
    public $contract_workTypes;


    public $endWorkSum;
    public $startWorkSum;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['setting','workTypes',  'city_id', 'type', 'customer_id', 'author_id', 'object_number', 'object_address', 'order_number', 'order_date', 'contract_id', 'fact_end_date', 'order_deadline', 'order_status_id', 'expired',
                'startWorkSum', 'endWorkSum', 'scan_added', 'related_orders', 'comment', 'construction_type', 'ams_type_id', 'placement_id', 'letter_date', 'letter_text', 'order_sum', 'email_date', 'email_matching_date', 'edo_date', 'edo_getting_date', 'created_at', 'updated_at',
                'task_name', 'task_author_id', 'task_order_id', 'task_task_type', 'task_priority', 'task_task_status_id', 'task_responsible_id', 'task_task_deadline', 'task_checker_id', 'task_normocontroller_id', 'task_gip_id', 'task_work_sum', 'task_comment', 'task_task_desc', 'task_task_rating', 'task_payment_status', 'task_payment_balance', 'task_payment_debt', 'task_created_at', 'task_updated_at',
                'task_workKinds',
                'contract_name', 'contract_customer_id', 'contract_contract_number', 'contract_contract_date', 'contract_contract_type', 'contract_contract_status', 'contract_city_id', 'contract_project_name', 'contract_contract_deadline', 'contract_contract_sum', 'contract_contract_signature_name', 'contract_contract_executor_name', 'contract_post_address', 'contract_comment', 'contract_author_id', 'contract_created_at', 'contract_updated_at',
                'contract_workTypes'
    ], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'setting' => 'Колонки',
        ];
    }

    /**
     * @param array $params
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = (new Query())->from('contract')->select('
            task.id as task_id,
            task.author_id as task_author_id,
            task.order_id as task_order_id,
            task.task_type as task_task_type,
            task.priority as task_priority,
            task.task_status_id as task_task_status_id,
            task.responsible_id as task_responsible_id,
            task.task_deadline as task_task_deadline,
            task.checker_id as task_checker_id,
            task.normocontroller_id as task_normocontroller_id,
            task.gip_id as task_gip_id,
            task.work_sum as task_work_sum,
            task.comment as task_comment,
            task.task_desc as task_task_desc,
            task.task_rating as task_task_rating,
            task.payment_status as task_payment_status,
            task.payment_balance as task_payment_balance,
            task.payment_debt as task_payment_debt,
            task.created_at as task_created_at,
            task.updated_at as task_updated_at,
            task.subgroup_id as task_subgroup_id,
            order.id as order_id,
            order.order_number as order_order_number,
            order.letter_date as letter_date,
            order.letter_text as letter_text,
            order.type as type,
            order.customer_id as customer_id,
            order.author_id as author_id,
            order.city_id as city_id,
            order.object_number as object_number,
            order.object_address as object_address,
            order.order_number as order_number,
            order.order_date as order_date,
            order.fact_end_date as fact_end_date,
            order.contract_id as contract_id,
            order.order_deadline as order_deadline,
            order.order_status_id as order_status_id,
            order.scan_added as scan_added,
            order.related_orders as related_orders,
            order.comment as comment,
            order.construction_type as construction_type,
            order.placement_id as placement_id,
            order.order_sum as order_sum,
            order.ams_type_id as ams_type_id,
            order.created_at as created_at,
            order.updated_at as updated_at,
            order.email_date as email_date,
            order.email_matching_date as email_matching_date,
            order.edo_date as edo_date,
            order.edo_getting_date as edo_getting_date,
            contract.name as contract_name,
            contract.customer_id as contract_customer_id,
            contract.contract_number as contract_contract_number,
            contract.contract_date as contract_contract_date,
            contract.contract_type as contract_contract_type,
            contract.contract_status as contract_contract_status,
            contract.city_id as contract_city_id,
            contract.project_name as contract_project_name,
            contract.contract_deadline as contract_contract_deadline,
            contract.contract_sum as contract_contract_sum,
            contract.contract_signature_name as contract_contract_signature_name,
            contract.contract_executor_name as contract_contract_executor_name,
            contract.post_address as contract_post_address,
            contract.scan_id as contract_scan_id,
            contract.comment as contract_comment,
            contract.author_id as contract_author_id,
            contract.created_at as contract_created_at,
            contract.updated_at as contract_updated_at,
        ');

        $query->leftJoin('order', 'order.contract_id=contract.id');
        $query->leftJoin('task', 'task.order_id=order.id');

//        LEFT JOIN `contract_to_work_type` ON `contract`.`id` = `contract_to_work_type`.`contract_id`

        $query->leftJoin('contract_to_work_type', 'contract.id=contract_to_work_type.contract_id');
        $query->leftJoin('order_work_type', 'order.id=order_work_type.order_id');
        $query->leftJoin('task_work_kind', 'task.id=task_work_kind.task_id');

//        $query->joinWith(['contract', 'tasks']);

        $this->load($params);


        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        if($this->setting == null){
            $setting = ReportSettingColumn::find();

            if(Yii::$app->user->identity->isSuperAdmin() == false){
                $setting->andWhere(['user_id' => Yii::$app->user->getId()]);
            }

            $setting->orderBy('id desc');

            $setting = $setting->one();
            if($setting){
                $this->setting = $setting->id;
            }
        }

        foreach (array_keys($this->attributes) as $attribute){
            $setting = ReportSettingColumn::findOne($this->setting);
            if($setting){
                if(isset($setting->$attribute)){
                    if($setting->$attribute != 1){
                        $this->$attribute = null;
                    }
                }
            }
        }

        $query->andFilterWhere(['order.author_id' => $this->task_author_id])
            ->andFilterWhere(['task.order_id' => $this->task_order_id])
            ->andFilterWhere(['task.task_type' => $this->task_task_type])
            ->andFilterWhere(['task.priority' => $this->task_priority])
            ->andFilterWhere(['task.task_status_id' => $this->task_task_status_id])
            ->andFilterWhere(['task.responsible_id' => $this->task_responsible_id])
            ->andFilterWhere(['task.task_deadline' => $this->task_task_deadline])
            ->andFilterWhere(['task.checker_id' => $this->task_checker_id])
            ->andFilterWhere(['task.normocontroller_id' => $this->task_normocontroller_id])
            ->andFilterWhere(['task.gip_id' => $this->task_gip_id])
            ->andFilterWhere(['task.work_sum' => $this->task_work_sum])
            ->andFilterWhere(['task.comment' => $this->task_comment])
            ->andFilterWhere(['task.task_rating' => $this->task_task_rating])
            ->andFilterWhere(['task.payment_status' => $this->task_payment_status])
            ->andFilterWhere(['task.payment_balance' => $this->task_payment_balance])
            ->andFilterWhere(['task.payment_debt' => $this->task_payment_debt])
//            ->andFilterWhere(['task.created_at' => $this->task_created_at])
//            ->andFilterWhere(['task.updated_at' => $this->task_updated_at])
//            ->andFilterWhere(['like', 'order_number', $this->order_order_number])
            ->andFilterWhere(['like', 'task.task_desc', $this->task_task_desc]);

        $query->andFilterWhere(['order.customer_id' => $this->customer_id])
            ->andFilterWhere(['order.author_id' => $this->author_id])
            ->andFilterWhere(['order.city_id' => $this->city_id])
            ->andFilterWhere(['order.object_number' => $this->object_number])
            ->andFilterWhere(['like', 'order.object_address', $this->object_address])
            ->andFilterWhere(['order.order_number' => $this->order_number])
//            ->andFilterWhere(['order.order_date' => $this->order_date])
//            ->andFilterWhere(['order.fact_end_date' => $this->fact_end_date])
            ->andFilterWhere(['order.contract_id' => $this->contract_id])
            ->andFilterWhere(['order.order_deadline' => $this->order_deadline])
            ->andFilterWhere(['order.order_status_id' => $this->order_status_id])
//            ->andFilterWhere(['order.expired' => $this->expired])
            ->andFilterWhere(['order.scan_added' => $this->scan_added])
//            ->andFilterWhere(['order.related_orders' => $this->related_orders])
            ->andFilterWhere(['order.comment' => $this->comment])
            ->andFilterWhere(['order.construction_type' => $this->construction_type])
            ->andFilterWhere(['order.ams_type_id' => $this->ams_type_id])
            ->andFilterWhere(['order.placement_id' => $this->placement_id])
            ->andFilterWhere(['order.order_sum' => $this->order_sum])
//            ->andFilterWhere(['order.created_at' => $this->created_at])
//            ->andFilterWhere(['order.updated_at' => $this->updated_at])
//            ->andFilterWhere(['order.email_date' => $this->email_date])
//            ->andFilterWhere(['order.email_matching_date' => $this->email_matching_date])
//            ->andFilterWhere(['order.edo_date' => $this->edo_date])
//            ->andFilterWhere(['order.edo_getting_date' => $this->edo_getting_date])
            ->andFilterWhere(['like', 'order.letter_text', $this->letter_text])
            ->andFilterWhere(['like', 'task.task_desc', $this->task_task_desc]);
//            ->andFilterWhere(['like', 'order_']);

        $query->andFilterWhere(['contract.customer_id' => $this->contract_customer_id])
            ->andFilterWhere(['like', 'contract.contract_number', $this->contract_contract_number])
//            ->andFilterWhere(['contract.contract_date' => $this->contract_contract_date])
            ->andFilterWhere(['or', ['contract.contract_type' => $this->contract_contract_type], ['contract.contract_type' => $this->type]])
            ->andFilterWhere(['contract.contract_status' => $this->contract_contract_status])
            ->andFilterWhere(['contract.project_name' => $this->contract_project_name])
            ->andFilterWhere(['contract.contract_deadline' => $this->contract_contract_deadline])
            ->andFilterWhere(['contract.contract_sum' => $this->contract_contract_sum])
            ->andFilterWhere(['contract.city_id' => $this->contract_city_id])
            ->andFilterWhere(['contract.project_name' => $this->contract_project_name])
            ->andFilterWhere(['contract.contract_deadline' => $this->contract_contract_deadline])
            ->andFilterWhere(['contract.contract_signature_name' => $this->contract_contract_signature_name])
            ->andFilterWhere(['contract.contract_executor_name' => $this->contract_contract_executor_name])
            ->andFilterWhere(['like', 'contract.post_address', $this->contract_post_address])
            ->andFilterWhere(['contract.comment' => $this->contract_comment])
            ->andFilterWhere(['contract.author_id' => $this->contract_author_id])
//            ->andFilterWhere(['contract.created_at' => $this->contract_created_at])
//            ->andFilterWhere(['contract.updated_at' => $this->contract_updated_at])
//            ->andFilterWhere(['order.contract_date' => $this->letter_date])
//            ->andFilterWhere(['order.type' => $this->type])
//            ->andFilterWhere(['order.edo_date' => $this->edo_date])
//            ->andFilterWhere(['order.edo_getting_date' => $this->edo_getting_date])
            ->andFilterWhere(['like', 'contract.name', $this->contract_name])
            ->andFilterWhere(['like', 'task.task_desc', $this->task_task_desc]);

        $query->groupBy('contract.id, task.id, order.id');

        if($this->contract_workTypes != null){
            $query->andFilterWhere(['contract_to_work_type.work_type_id' => $this->contract_workTypes]);
        }

        if($this->workTypes != null){
            $query->andFilterWhere(['order_work_type.work_type_id' => $this->workTypes]);
        }

        if($this->task_workKinds != null){
//            $query->andFilterWhere(['task_work_kind.work_kind_id' => $this->task_workKinds]);
            $query->andFilterWhere(['task.subgroup_id' => $this->task_workKinds]);
        }


        if(Yii::$app->user->identity->can('task_view_all') == false){
            $query->andFilterWhere([
                'or',
                ['task.author_id' => Yii::$app->user->identity->getId()],
                ['task.gip_id' => Yii::$app->user->identity->getId()],
                ['task.checker_id' => Yii::$app->user->identity->getId()],
                ['task.normocontroller_id' => Yii::$app->user->identity->getId()],
                ['task.responsible_id' => Yii::$app->user->identity->getId()],
            ]);
        }

        if(Yii::$app->user->identity->isSuperAdmin()){
            $cityPks = ArrayHelper::merge([Yii::$app->user->identity->city_id], ArrayHelper::getColumn(UserToCity::find()->where(['user_id' => Yii::$app->user->identity->id])->all(), 'city_id'));
            $query->andFilterWhere(['contract.city_id' => $cityPks]);
        }

        foreach (ReportColumn::DATE_COLUMNS as $dateAttribute) {
            if($this->$dateAttribute != null){
                $baseDateAttribute = explode('_', $dateAttribute);
                $baseDateAttribute = $baseDateAttribute[0].'.'.implode('_', array_slice($baseDateAttribute, 1));
//                echo $baseDateAttribute;
//                exit;
                $date = explode(' - ', $this->$dateAttribute);

                $query->andWhere(['between', $baseDateAttribute, $date[0].' 00:00:00', $date[1].' 23:59:59']);
            }
        }

        if($this->endWorkSum != null){
            $query->andWhere(['<=', 'task.work_sum', intval($this->endWorkSum)]);
        }

        if($this->startWorkSum != null){
            $query->andWhere(['>=', 'task.work_sum', intval($this->startWorkSum)]);
        }

//        if($this->expired === '0'){
//            $now = date('Y-m-d');
//            $query->andWhere('(order_deadline > :now AND fact_end_date IS NULL) OR (fact_end_date IS NOT NULL AND fact_end_date < order_deadline) OR (fact_end_date IS NULL AND order_deadline IS NULL)', [':now' => $now]);
//        } else if($this->expired === '1'){
//            $now = date('Y-m-d');
//            $query->andWhere('(order_deadline > :now)', [':now' => $now]);
//        }


        if($this->related_orders === '1'){
            $pks = [];

            $models = Order::find()->all();

            foreach ($models as $model){
                $ordersPks = ArrayHelper::getColumn(OrderOrder::find()->where(['order_one_id' => $model->id])->all(), 'order_two_id');
                $orders = \app\models\Order::findAll($ordersPks);

                foreach($orders as $order){
                    if($order->contract->contract_type == 'c Подрядчиком'){
                        $pks[] = $model->id;
                        break;
                    }
                }
            }

            $query->andWhere(['order.id' => $pks]);

        } else if($this->related_orders === '0'){
            $pks = [];

            $models = Order::find()->all();

            foreach ($models as $model){
//                $ordersPks = ArrayHelper::getColumn(OrderOrder::find()->where(['order_two_id' => $model->id])->all(), 'order_one_id');
                $ordersPks = ArrayHelper::getColumn(OrderOrder::find()->where(['order_one_id' => $model->id])->all(), 'order_two_id');
                $orders = \app\models\Order::findAll($ordersPks);

                foreach($orders as $order){
                    if($order->contract->contract_type == 'c Подрядчиком'){
                        $pks[] = $model->id;
                        break;
                    }
                }
            }

            $query->andWhere(['not in', 'order.id', $pks]);
        }

        if($this->expired === '0'){
            $now = date('Y-m-d');
            $query->andWhere('(order_deadline > :now AND fact_end_date IS NULL) OR (fact_end_date IS NOT NULL AND fact_end_date < order_deadline) OR (fact_end_date IS NULL AND order_deadline IS NULL)', [':now' => $now]);
        } else if($this->expired === '1'){
            $now = date('Y-m-d');
            $query->andWhere('(order_deadline < :now AND fact_end_date IS NULL) OR (fact_end_date IS NOT NULL AND fact_end_date > order_deadline)', [':now' => $now]);
        }

//        echo $query->createCommand()->getRawSql();
//        exit;

        $dataProvider = new ArrayDataProvider([
            'allModels' => $query->all(),
        ]);




//            ->andFilterWhere();

//        VarDumper::dump($dataProvider->models, 10, true);
//        exit;


        return $dataProvider;
    }

    public static function fieldLabels()
    {
        return [

        ];
    }

}