<?php

namespace app\components;

use app\models\AmsType;
use app\models\City;
use app\models\Contract;
use app\models\ContractToWorkType;
use app\models\Customer;
use app\models\forms\ReportSearch;
use app\models\Order;
use app\models\OrderOrder;
use app\models\OrderStatus;
use app\models\OrderWorkType;
use app\models\Placement;
use app\models\TaskSearch;
use app\models\TaskStatus;
use app\models\TaskWorkKind;
use app\models\User;
use app\models\WorkKind;
use app\models\WorkType;
use kartik\grid\GridView;
use yii\base\Component;
use yii\base\InvalidConfigException;
use yii\base\Model;
use yii\helpers\ArrayHelper;
use yii\helpers\VarDumper;
use yii\web\JsExpression;

/**
 * Class ReportColumn
 * @package app\components
 */
class ReportColumn extends Component
{
    const DATE_COLUMNS = [
        'contract_contract_date',
        'task_created_at',
        'task_updated_at',
        'order_date',
        'fact_end_date',
        'order_deadline',
        'created_at',
        'updated_at',
        'email_date',
        'email_matching_date',
        'edo_date',
        'edo_getting_date',
        'contract_contract_date',
        'contract_contract_deadline',
        'contract_created_at',
        'contract_updated_at',
        'task_task_deadline'
    ];

    /**
     * @var array
     */
    public $columns;

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
    }

    /**
     * @return array
     */
    public function getGridColumns()
    {
        for ($i = 0; $i < count($this->columns); $i++){
            $column = $this->columns[$i];

            if($column['attribute'] == 'contract_city_id'){
                $this->columns[$i]['filter'] = ArrayHelper::map(City::find()->all(), 'id', 'name');
                $this->columns[$i]['value'] = function($model){
                    $city = City::findOne($model['contract_city_id']);
                    if($city != null){
                        return $city->name;
                    }
                };
                $this->columns[$i]['filterType'] = GridView::FILTER_SELECT2;
                $this->columns[$i]['filterWidgetOptions'] = [
                    'options' => ['prompt' => ''],
                    'pluginOptions' => ['allowClear' => true],
                ];
            } else if($column['attribute'] == 'contract_contract_type'){

                $this->columns[$i]['filter'] = array(
                    'c Подрядчиком' => '<i class="fa fa-wrench" style="font-size: 15px;" title="с Подрядчиком"></i>\'',
                    'с Заказчиком' => '<i class="fa fa-usd" style="font-size: 15px;" title="с Заказчиком"></i>',
                );
                $this->columns[$i]['filterType'] = GridView::FILTER_SELECT2;
                $this->columns[$i]['content'] = function($data){
                    $icon = '';

                    if($data['contract_contract_type'] == 'c Подрядчиком'){
                        $icon = '<i class="fa fa-wrench" style="font-size: 15px;" title="с Подрядчиком"></i>';
                    } else if($data['contract_contract_type'] == 'с Заказчиком') {
                        $icon = '<i class="fa fa-usd" style="font-size: 15px;" title="с Заказчиком"></i>';
                    }

                    return $icon;
                };
                $this->columns[$i]['filterWidgetOptions'] = [
                    'pluginOptions' => [
                        'placeholder' => '',
                        'allowClear' => true,
                        'escapeMarkup' => new JsExpression("function(m) { return m; }"),
                    ],
                ];
                $this->columns[$i]['width'] = '1%';
                $this->columns[$i]['hAlign'] = GridView::ALIGN_CENTER;

            }  else if($column['attribute'] == 'contract_contract_status') {

                $this->columns[$i]['filterType'] = GridView::FILTER_SELECT2;
                $this->columns[$i]['filter'] = array(
                        'в Работе' => '<i class="fa fa-cog" style="font-size: 15px;" title="в Работе"></i>',
                        'в Архиве' => '<i class="fa fa-book" style="font-size: 15px;" title="в Архиве"></i>',
                    );
                $this->columns[$i]['filterWidgetOptions'] = [
                        'pluginOptions' => [
                            'placeholder' => '',
                            'allowClear' => true,
                            'escapeMarkup' => new JsExpression("function(m) { return m; }"),
                        ],
                    ];
                $this->columns[$i]['content'] = function($model){
                        $icon = '';

                        if($model['contract_contract_status'] == 'в Работе'){
                            $icon = '<i class="fa fa-cog" style="font-size: 15px;" title="в Работе"></i>';
                        } else if($model['contract_contract_status'] == 'в Архиве') {
                            $icon = '<i class="fa fa-book" style="font-size: 15px;" title="в Архиве"></i>';
                        }

                        return $icon;
                    };
                $this->columns[$i]['width'] = '1%';
                $this->columns[$i]['hAlign'] = GridView::ALIGN_CENTER;

            } else if($column['attribute'] == 'task_work_sum'){
                $this->columns[$i]['filter'] = \yii\helpers\Html::activeInput('number', (new ReportSearch()), 'startWorkSum', ['class' => 'form-control', 'placeholder' => 'От', 'style' => 'display: inline-block;']).' '.\yii\helpers\Html::activeInput('number', (new ReportSearch()), 'endWorkSum', ['class' => 'form-control', 'placeholder' => 'До', 'style' => 'display: inline-block;']);
                $this->columns[$i]['value'] = function($model){
                    return $model['task_work_sum'];
                };

            } else if($column['attribute'] == 'task_priority') {

                $this->columns[$i]['filter'] = [
                    'Средний' => 'Средний',
                    'Высокий' => 'Высокий',
                    'Низкий' => 'Низкий',
                ];
                $this->columns[$i]['filterType'] = GridView::FILTER_SELECT2;
                $this->columns[$i]['filterWidgetOptions'] = [
                    'options' => ['prompt' => ''],
                    'pluginOptions' => ['allowClear' => true, 'multiple' => true],
                ];
                $this->columns[$i]['value'] = function($model){
                    return $model['task_priority'];
                };

            } else if ($column['attribute'] == 'type'){

                $this->columns[$i]['filter'] = array(
                    'c Подрядчиком' => '<i class="fa fa-wrench" style="font-size: 15px;" title="с Подрядчиком"></i>\'',
                    'с Заказчиком' => '<i class="fa fa-usd" style="font-size: 15px;" title="с Заказчиком"></i>',
                );
                $this->columns[$i]['filterType'] = GridView::FILTER_SELECT2;
                $this->columns[$i]['content'] = function($data){
                    $icon = '';

                    if($data['contract_contract_type'] == 'c Подрядчиком'){
                        $icon = '<i class="fa fa-wrench" style="font-size: 15px;" title="с Подрядчиком"></i>';
                    } else if($data['contract_contract_type'] == 'с Заказчиком') {
                        $icon = '<i class="fa fa-usd" style="font-size: 15px;" title="с Заказчиком"></i>';
                    }

                    return $icon;
                };
                $this->columns[$i]['filterWidgetOptions'] = [
                    'pluginOptions' => [
                        'placeholder' => '',
                        'allowClear' => true,
                        'escapeMarkup' => new JsExpression("function(m) { return m; }"),
                    ],
                ];
                $this->columns[$i]['width'] = '1%';
                $this->columns[$i]['hAlign'] = GridView::ALIGN_CENTER;

            } else if($column['attribute'] == 'task_payment_balance'){

                $this->columns[$i]['content'] = function($data){
                    $sum = \app\models\Payments::find()->where(['task_id' => $data['task_id']])->sum('sum');
                    return $sum;
                };

            } else if($column['attribute'] == 'task_payment_debt'){

                $this->columns[$i]['content'] = function($data){
                    $sum = \app\models\Payments::find()->where(['task_id' => $data['task_id']])->sum('sum');
                    if($data['task_work_sum'] != null && $sum != null){
                        return $data['task_work_sum'] - $sum;
                    }
                    return null;
                };

            } else if($column['attribute'] == 'contract_customer_id'){

                $this->columns[$i]['filter'] = ArrayHelper::map(Customer::find()->all(), 'id', 'name');
                $this->columns[$i]['value'] = function($model){
                    $customer = Customer::findOne($model['contract_customer_id']);
                    if($customer != null){
                        return $customer->name;
                    }
                };
                $this->columns[$i]['filterType'] = GridView::FILTER_SELECT2;
                $this->columns[$i]['filterWidgetOptions'] = [
                    'options' => ['prompt' => ''],
                    'pluginOptions' => ['allowClear' => true],
                ];
            } else if($column['attribute'] == 'contract_author_id'){

//                $this->columns[$i]['filter'] = ArrayHelper::map(City::find()->all(), 'id', 'name');
//                $this->columns[$i]['value'] = function($model){
//                    $city = City::findOne($model['contract_city_id']);
//                    if($city != null){
//                        return $city->name;
//                    }
//                };
//                $this->columns[$i]['filterType'] = GridView::FILTER_SELECT2;
//                $this->columns[$i]['filterWidgetOptions'] = [
//                    'options' => ['prompt' => ''],
//                    'pluginOptions' => ['allowClear' => true],
//                ];

                $this->columns[$i]['filter'] = ArrayHelper::map(User::find()->all(), 'id', 'name');
                $this->columns[$i]['value'] = function($model){
                    $user = User::findOne($model['contract_author_id']);
                    if($user != null){
                        return $user->name;
                    }
                };
            } else if($column['attribute'] == 'author_id'){
                $this->columns[$i]['filter'] = ArrayHelper::map(User::find()->all(), 'id', 'name');
                $this->columns[$i]['value'] = function($model){
                    $user = User::findOne($model['author_id']);
                    if($user != null){
                        return $user->name;
                    }
                };
            } else if($column['attribute'] == 'city_id'){
                $this->columns[$i]['filter'] = ArrayHelper::map(City::find()->all(), 'id', 'name');
                $this->columns[$i]['value'] = function($model){
                    $city = City::findOne($model['city_id']);
                    if($city != null){
                        return $city->name;
                    }
                };
            } else if($column['attribute'] == 'contract_id'){
//                [
//                    'class'=>'\kartik\grid\DataColumn',
//                    'attribute'=>'contract_id',
//                    'content' => function($data){
//                        $contract = Contract::find()->where(['id' => $data->contract_id])->one();
//
//                        if($contract){
//                            return "({$contract->project_name}, ".($contract->customer ? $contract->customer->name : '').", {$contract->contract_date})";
//                        }
//
//                    },
//                    'width' => '20%',
//                    'contentOptions' => ['style' => 'white-space: nowrap;'],
//                    'filter' => $contractList,
//                    'filterType' => GridView::FILTER_SELECT2,
//                    'filterWidgetOptions' => [
//                        'options' => ['prompt' => ''],
//                        'pluginOptions' => ['allowClear' => true],
//                    ],
//                ],

                $contractList = [];
                $contracts = Contract::find()->where(['contract_status' => 'в Работе'])->all();

                foreach ($contracts as $contract){
                    /** @var $contract Contract */
                    $contractList[$contract->id] = "{$contract->project_name}, {$contract->customer->name}, {$contract->contract_number}, ".date('d.m.Y', strtotime($contract->contract_date));
                }


                $this->columns[$i]['filter'] = $contractList;
                $this->columns[$i]['value'] = function($data){

                    $contract = Contract::find()->where(['id' => $data['contract_id']])->one();
//
                    if($contract){
                        return "({$contract->project_name}, ".($contract->customer ? $contract->customer->name : '').", {$contract->contract_date})";
                    }
                };

                $this->columns[$i]['filterType'] = GridView::FILTER_SELECT2;
                $this->columns[$i]['filterWidgetOptions'] = [
                    'options' => ['prompt' => ''],
                    'pluginOptions' => ['allowClear' => true],
                ];
            } else if($column['attribute'] == 'order_status_id'){
                $this->columns[$i]['filter'] = ArrayHelper::map(OrderStatus::find()->all(), 'id', 'name');
                $this->columns[$i]['value'] = function($model){
                    $status = OrderStatus::findOne($model['order_status_id']);
                    if($status != null){
                        return $status->name;
                    }
                };
            } else if($column['attribute'] == 'related_orders'){

                $this->columns[$i]['filter'] = ['1' => 'Есть', '0' => 'Нет'];
                $this->columns[$i]['label'] = 'Заказы';
                $this->columns[$i]['content'] = function($data){
                    $ordersPks = ArrayHelper::getColumn(OrderOrder::find()->where(['order_one_id' => $data['order_id']])->all(), 'order_two_id');
                    $orders = \app\models\Order::findAll($ordersPks);

                    $modelOrder = Order::findOne($data['order_id']);


                    if($modelOrder){
                        foreach($orders as $order){
                            if($order->contract->contract_type == 'c Подрядчиком'){
                                return 'Есть';
                            }
                        }

                        if($modelOrder->contract->contract_type != 'c Подрядчиком'){
                            return 'Нет';
                        }
                    }
                };

            } else if($column['attribute'] == 'construction_type'){

                $this->columns[$i]['filter'] = array(
                    'Модернизация' => 'Модернизация',
                    'Строительство' => 'Строительство',
                );

            } else if($column['attribute'] == 'expired'){

                $this->columns[$i]['filter'] = [0 => 'Нет', 1 => 'Да'];
                $this->columns[$i]['content'] = function($data){
                    $orderModel = Order::findOne($data['order_id']);
                    if($orderModel) {
                        if($orderModel->isExpired()){
                            return '<i class="fa fa-exclamation-triangle text-danger"></i>';
                        }
                    }
                };
            } else if($column['attribute'] == 'ams_type_id'){
                $this->columns[$i]['filter'] = ArrayHelper::map(AmsType::find()->all(), 'id', 'name');
                $this->columns[$i]['value'] = function($model){
                    $type = AmsType::findOne($model['ams_type_id']);
                    if($type != null){
                        return $type->name;
                    }
                };
                $this->columns[$i]['filterType'] = GridView::FILTER_SELECT2;
                $this->columns[$i]['filterWidgetOptions'] = [
                    'options' => ['prompt' => '', 'multiple' => true],
                    'pluginOptions' => [
                        'allowClear' => true,
                        'tags' => false,
                        'tokenSeparators' => [','],
                    ],
                ];
            } else if($column['attribute'] == 'placement_id'){
                $this->columns[$i]['filter'] = ArrayHelper::map(Placement::find()->all(), 'id', 'name');
                $this->columns[$i]['value'] = function($model){
                    $placement = Placement::findOne($model['placement_id']);
                    if($placement != null){
                        return $placement->name;
                    }
                };
                $this->columns[$i]['filterType'] = GridView::FILTER_SELECT2;
                $this->columns[$i]['filterWidgetOptions'] = [
                    'options' => ['prompt' => '', 'multiple' => true],
                    'pluginOptions' => [
                        'allowClear' => true,
                        'tags' => false,
                        'tokenSeparators' => [','],
                    ],
                ];
            } else if($column['attribute'] == 'task_author_id'){
                $this->columns[$i]['filter'] = ArrayHelper::map(User::find()->all(), 'id', 'name');
                $this->columns[$i]['value'] = function($model){
                    $user = User::findOne($model['task_author_id']);
                    if($user != null){
                        return $user->name;
                    }
                };
            } else if($column['attribute'] == 'task_order_id'){
                $this->columns[$i]['filter'] = ArrayHelper::map(Order::find()->all(), 'id', 'order_number');
                $this->columns[$i]['value'] = function($model){
                    $order = Order::findOne($model['task_order_id']);
                    if($order != null){
                        return $order->order_number;
                    }
                };
                $this->columns[$i]['filterType'] = GridView::FILTER_SELECT2;
                $this->columns[$i]['filterWidgetOptions'] = [
                    'options' => ['prompt' => ''],
                    'pluginOptions' => ['allowClear' => true],
                ];
            } else if($column['attribute'] == 'task_task_status_id'){
//                $this->columns[$i]['filter'] = ArrayHelper::map(TaskStatus::find()->all(), 'id', 'name');
                $this->columns[$i]['filter'] = TaskStatus::getStatusList();
                $this->columns[$i]['value'] = function($model){
                    $status = TaskStatus::findOne($model['task_task_status_id']);
                    if($status != null){
                        return $status->name;
                    }
                };
                $this->columns[$i]['filterType'] = GridView::FILTER_SELECT2;
                $this->columns[$i]['filterWidgetOptions'] = [
                    'options' => ['prompt' => ''],
                    'pluginOptions' => ['allowClear' => true],
                ];
            } else if($column['attribute'] == 'task_responsible_id'){
                $this->columns[$i]['filter'] = ArrayHelper::map(User::find()->all(), 'id', 'name');
                $this->columns[$i]['value'] = function($model){
                    $user = User::findOne($model['task_responsible_id']);
                    if($user != null){
                        return $user->name;
                    }
                };
                $this->columns[$i]['filterType'] = GridView::FILTER_SELECT2;
                $this->columns[$i]['filterWidgetOptions'] = [
                    'options' => ['prompt' => ''],
                    'pluginOptions' => ['allowClear' => true],
                ];
            } else if($column['attribute'] == 'task_checker_id'){
                $this->columns[$i]['filter'] = ArrayHelper::map(User::find()->all(), 'id', 'name');
                $this->columns[$i]['value'] = function($model){
                    $user = User::findOne($model['task_checker_id']);
                    if($user != null){
                        return $user->name;
                    }
                };
                $this->columns[$i]['filterType'] = GridView::FILTER_SELECT2;
                $this->columns[$i]['filterWidgetOptions'] = [
                    'options' => ['prompt' => ''],
                    'pluginOptions' => ['allowClear' => true],
                ];
            } else if($column['attribute'] == 'task_normocontroller_id'){
                $this->columns[$i]['filter'] = ArrayHelper::map(User::find()->all(), 'id', 'name');
                $this->columns[$i]['value'] = function($model){
                    $user = User::findOne($model['task_normocontroller_id']);
                    if($user != null){
                        return $user->name;
                    }
                };
                $this->columns[$i]['filterType'] = GridView::FILTER_SELECT2;
                $this->columns[$i]['filterWidgetOptions'] = [
                    'options' => ['prompt' => ''],
                    'pluginOptions' => ['allowClear' => true],
                ];
            } else if($column['attribute'] == 'task_gip_id'){
                $this->columns[$i]['filter'] = ArrayHelper::map(User::find()->all(), 'id', 'name');
                $this->columns[$i]['value'] = function($model){
                    $user = User::findOne($model['task_gip_id']);
                    if($user != null){
                        return $user->name;
                    }
                };
                $this->columns[$i]['filterType'] = GridView::FILTER_SELECT2;
                $this->columns[$i]['filterWidgetOptions'] = [
                    'options' => ['prompt' => ''],
                    'pluginOptions' => ['allowClear' => true],
                ];
            } else if($column['attribute'] == 'contract_workTypes'){
                $this->columns[$i]['filterType'] = GridView::FILTER_SELECT2;
                $this->columns[$i]['filter'] = ArrayHelper::map(WorkType::find()->asArray()->all(), 'id', 'name');
                $this->columns[$i]['filterWidgetOptions'] = [
                    'options' => ['prompt' => '', 'multiple' => true],
                    'pluginOptions' => [
                        'allowClear' => true,
                        'tags' => false,
                        'tokenSeparators' => [','],
                    ],
                ];

                //                [
//                    'class'=>'\kartik\grid\DataColumn',
//                    'attribute'=>'contract_id',
//                    'content' => function($data){
//                        $contract = Contract::find()->where(['id' => $data->contract_id])->one();
//
//                        if($contract){
//                            return "({$contract->project_name}, ".($contract->customer ? $contract->customer->name : '').", {$contract->contract_date})";
//                        }
//
//                    },
//                    'width' => '20%',
//                    'contentOptions' => ['style' => 'white-space: nowrap;'],
//                    'filter' => $contractList,
//                    'filterType' => GridView::FILTER_SELECT2,
//                    'filterWidgetOptions' => [
//                        'options' => ['prompt' => ''],
//                        'pluginOptions' => ['allowClear' => true],
//                    ],
//                ],

                $this->columns[$i]['value'] = function($model){
                    $types = ArrayHelper::getColumn(WorkType::findAll(ArrayHelper::getColumn(ContractToWorkType::find()->where(['contract_id' => $model['contract_id']])->all(), 'work_type_id')), 'name');
                    return implode(', ', $types);
                };
            } else if($column['attribute'] == 'workTypes'){
                $this->columns[$i]['filterType'] = GridView::FILTER_SELECT2;
                $this->columns[$i]['filter'] = ArrayHelper::map(WorkType::find()->asArray()->all(), 'id', 'name');
                $this->columns[$i]['filterWidgetOptions'] = [
                    'options' => ['prompt' => '', 'multiple' => true],
                    'pluginOptions' => [
                        'allowClear' => true,
                        'tags' => false,
                        'tokenSeparators' => [','],
                    ],
                ];
                $this->columns[$i]['value'] = function($model){
                    $types = ArrayHelper::getColumn(WorkType::findAll(ArrayHelper::getColumn(OrderWorkType::find()->where(['order_id' => $model['order_id']])->all(), 'work_type_id')), 'name');
                    return implode(', ', $types);
                };
            } else if($column['attribute'] == 'task_workKinds'){
                $this->columns[$i]['filterType'] = GridView::FILTER_SELECT2;
                $this->columns[$i]['filter'] = (new User())->getListKind();
                $this->columns[$i]['filterWidgetOptions'] = [
                    'options' => ['prompt' => '', 'multiple' => true],
                    'pluginOptions' => [
                        'allowClear' => true,
                        'tags' => false,
                        'tokenSeparators' => [','],
                    ],
                ];
                $this->columns[$i]['value'] = function($data){
//                    $types = ArrayHelper::getColumn(WorkKind::findAll(ArrayHelper::getColumn(TaskWorkKind::find()->where(['task_id' => $model['task_id']])->all(), 'work_kind_id')), 'name');
//                    return implode(', ', $types);

//                    var_dump($data);


                    $subgroup = \app\models\Subgroups::findOne($data['task_subgroup_id']);

                    if($subgroup){
                        return $subgroup->name;
                    }
                };
            } else if(in_array($column['attribute'], self::DATE_COLUMNS)){

//                $this->columns[$i]['filterInputOptions'] = ['class' => 'form-control', 'type' => 'date'];
                $this->columns[$i]['filterType'] =  GridView::FILTER_DATE_RANGE;
                $this->columns[$i]['filterWidgetOptions'] =  [
                    'convertFormat'=>true,
                    'pluginOptions' => [
                        'opens'=>'right',
                        'locale' => [
                            'cancelLabel' => 'Clear',
                            'format' => 'Y-m-d',
                        ]
                    ]
                ];
            }
        }



        //        VarDumper::dump($this->columns, 10, true);
//        exit;

        return $this->columns;
    }
}