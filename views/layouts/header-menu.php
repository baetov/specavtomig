<?php

use yii\helpers\Url;

?>

<div id="top-menu" class="top-menu" style="margin-top: -16px;">
    <?php if(Yii::$app->user->isGuest == false): ?>
        <?php
        echo \app\admintheme\widgets\TopMenu::widget(
            [
                'options' => ['class' => 'nav'],
                'items' => [
                        ['label' => 'Заявки', 'icon' => 'fa fa-file-text', 'url' => ['/bid'],],
                        ['label' => 'Резервные заявки', 'icon' => 'fa fa-file-text', 'url' => ['/reserve-bid'],],
                        ['label' => 'Справочники', 'icon' => 'fa fa-list-ul', 'url' => '/client', 'options' => ['class' => 'has-sub'],
                        'items' => [
//                            ['label' => 'Пользователи', 'icon' => 'fa  fa-user-o', 'url' => ['/user'],],
//                            ['label' => 'Роли', 'icon' => 'fa fa-address-card', 'url' => ['/role'],],
                            ['label' => 'Контрагенты', 'icon' => 'fa fa-flag', 'url' => ['/client'],],
                            ['label' => 'Техника', 'icon' => 'fa fa-file-text', 'url' => ['/technic'],],
                            ['label' => 'Водтели', 'icon' => 'fa fa-flag', 'url' => ['/driver'],],
//                            ['label' => 'Виды техники', 'icon' => 'fa fa-flag', 'url' => ['/technic-type'],],
                            ['label' => 'Виды работ','icon' => 'fa fa-cogs','url' => ['/work-kind'],],
                    ]],
                    ['label' => 'Только для администратора', 'icon' => 'fa fa-list-ul', 'url' => '/user', 'options' => ['class' => 'has-sub'],'visible' =>Yii::$app->user->identity->can('directory_access'),
                        'items' => [
                            ['label' => 'Пользователи', 'icon' => 'fa  fa-user-o', 'url' => ['/user'],],
                            ['label' => 'Роли', 'icon' => 'fa fa-address-card', 'url' => ['/role'],],
//                            ['label' => 'Контрагенты', 'icon' => 'fa fa-flag', 'url' => ['/client'],],
//                            ['label' => 'Техника', 'icon' => 'fa fa-file-text', 'url' => ['/technic'],],
//                            ['label' => 'Водтели', 'icon' => 'fa fa-flag', 'url' => ['/driver'],],
                            ['label' => 'Виды техники', 'icon' => 'fa fa-flag', 'url' => ['/technic-type'],],
//                            ['label' => 'Виды работ','icon' => 'fa fa-cogs','url' => ['/work-kind'],],
                        ]],


                ],
            ]
        );
        ?>
    <?php endif; ?>
</div>
