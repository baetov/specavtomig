<?php

use johnitvn\ajaxcrud\CrudAsset;
use app\widgets\ButtonDropdown;
use yii\bootstrap\Modal;
use yii\helpers\Html;
use app\models\Users;
use app\models\Notification;

CrudAsset::register($this);
?>

<div id="header" class="header navbar navbar-default navbar-fixed-top">
            <!-- begin container-fluid -->
            <div class="container-fluid">
                <!-- begin mobile sidebar expand / collapse button -->
                <div class="navbar-header">
                    <a href="<?=Yii::$app->homeUrl?>" class="navbar-brand">
                        <p>TTEL</p>
                    </a>
                    <button type="button" class="navbar-toggle" data-click="top-menu-toggled">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>
                <!-- end mobile sidebar expand / collapse button -->

                <?php if(Yii::$app->user->isGuest == false): ?>
                    <!-- begin header navigation right -->
                    <ul class="nav navbar-nav navbar-right">
                        <li class="navbar-user">

                        </li>
                        <li class="dropdown navbar-user">

                            <a id="btn-dropdown" href="javascript:;" class="dropdown-toggle" onclick="event.preventDefault(); $('#user-actions').toggle();">
                                <i class="fa fa-user-circle" aria-hidden="true"></i>
                                <span class="hidden-xs"><?=Yii::$app->user->identity->login?></span> <b class="caret"></b>
                            </a>
                            <ul id="user-actions" class="dropdown-menu animated fadeInLeft">
                                <li class="arrow"></li>
                                <li> <?= Html::a('Настройки пользователи', ['user/profile']) ?> </li>
                                <li class="divider"></li>
                                <li> <?= Html::a('Выйти', ['/site/logout'], ['data-method' => 'post']) ?> </li>
                            </ul>
                        </li>
                    </ul>

                <?php endif; ?>
            </div>
            <!-- end container-fluid -->
        </div>
