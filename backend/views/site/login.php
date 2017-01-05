<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use backend\assets\AppAssetOth;
use common\widgets\Alert;
use yii\bootstrap\ActiveForm;

/* @var $this \yii\web\View */
/* @var $content string */

AppAssetOth::register($this);

$directoryAsset = Yii::$app->assetManager->getPublishedUrl('@backend/views/layouts');
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="<?=Yii::$app->homeUrl;?>css/img/logo.png?<?=time();?>">
    <?= Html::csrfMetaTags() ?>
    <title>Login</title>
    <?php $this->head() ?>
     <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body class="bf-login">
    <?php $this->beginBody() ?>
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-red">
                    <div class="panel-heading">
                        <h3 class="panel-title"><?=Html::tag('i','',['class' => 'fa fa-lock fa-fw'])?>Please Sign In</h3>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12">
                                <?=Alert::widget() ?>
                            </div>
                        </div>
                         <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
                            <fieldset>
                                <?php
                                    echo $form->field($model, 'username', [
                                        'inputTemplate' => '<div class="input-group">{input}<span class="input-group-addon"><i class="fa fa-user"></i></span></div>',
                                        'inputOptions' => [
                                            'placeholder' => $model->getAttributeLabel('username'),
                                        ],
                                    ])->label(false);
                                ?>
                                
                                <?php
                                    /* echo $form->field($model, 'email', [
                                        'inputTemplate' => '<div class="input-group">{input}<span class="input-group-addon"><i class="fa fa-user"></i></span></div>',
                                        'inputOptions' => [
                                            'placeholder' => $model->getAttributeLabel('email'),
                                        ],
                                    ])->label(false); */
                                ?>
                            
                                <?php
                                    echo $form->field($model, 'password', [
                                            'inputTemplate' => '<div class="input-group">{input}<span class="input-group-addon"><i class="fa fa-lock"></i></span></div>',
                                            'inputOptions' => [
                                                'placeholder' => $model->getAttributeLabel('password'),
                                                //'enableAjaxValidation' => true,
                                            ],
                                        ])->passwordInput()->label(false);
                                ?>
                                <?= $form->field($model, 'rememberMe')->checkbox() ?>
                                <div style="color:#999;margin:1em 0">
                                    If you forgot your password you can <?= Html::a('reset it', ['site/request-password-reset']) ?>.
                                </div>
                                <?= Html::submitButton('Login', ['class' => 'btn btn-outline btn-danger', 'name' => 'login-button']) ?>
                            </fieldset>
                        <?php ActiveForm::end(); ?>
                    </div>
                </div>
                <div class="row hidden-sm hidden-xs">
                    <div class="col-md-12">
                        <?php //Html::img('@web/css/img/logo.png',  ['class' => 'img-responsive']);?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
