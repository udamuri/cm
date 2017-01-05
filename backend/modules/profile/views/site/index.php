<?php
use yii\helpers\Html;
use yii\widgets\LinkPager;
use app\components\Constants;

$this->title = Yii::$app->user->identity->email;
$this->params['breadcrumbs'][] = "Profile";
$this->params['breadcrumbs'][] = $this->title;

$img = yii::getAlias('@backend/web/folderuser/'.Yii::$app->user->identity->id.'profile.png');
$img_s = Yii::$app->homeUrl.'folderuser/'.Yii::$app->user->identity->id.'profile.png?'.time();
if(!file_exists($img))
{
    $img_s = Yii::$app->homeUrl.'css/img/profile.png?'.time();
}

$this->registerJsFile(Yii::$app->homeUrl."js/index.js", ['depends' => [\yii\web\JqueryAsset::className()], 'position' =>  \yii\web\View::POS_HEAD]);
$this->registerJsFile(Yii::$app->homeUrl."js/profile.js", ['depends' => [\yii\web\JqueryAsset::className()], 'position' =>  \yii\web\View::POS_HEAD]);
$this->registerJsFile(Yii::$app->homeUrl."template/production/js/input_mask/jquery.inputmask.js", ['depends' => [\yii\web\JqueryAsset::className()], 'position' =>  \yii\web\View::POS_HEAD]);
$this->registerJsFile(Yii::$app->homeUrl."plugins/cropit/dist/jquery.cropit.js", ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerCssFile(Yii::$app->homeUrl."plugins/cropit/dist/jquery.cropit.css", ['depends' => [\yii\web\JqueryAsset::className()]]);
$token = $this->renderDynamic('return Yii::$app->request->csrfToken;');

$jsx = <<< 'SCRIPT'
    IndexObj.initialScript();
    ProfileObj.initialScript();
SCRIPT;
$this->registerJs('IndexObj.baseUrl = "'. Yii::$app->homeUrl.'"', \yii\web\View::POS_HEAD);
$this->registerJs('IndexObj.csrfToken = "'. $token.'"',  \yii\web\View::POS_HEAD);
$this->registerJs('ProfileObj.profilePicture = "'. $img_s.'"');
$this->registerJs($jsx);


?>

<div class="row">
    <div class="col-md-6 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Account Setting</h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <br />
                <div id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">

                    <div class="form-group" id="box-username">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Username<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" id="user-name" value="<?=$modes->username;?>" required="required" class="form-control col-md-7 col-xs-12">
                            <div id="text-username" class="help-block"></div>
                        </div>
                    </div>
                    <div class="form-group" id="box-email">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Email<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" id="user-email" value="<?=$modes->email;?>" name="last-name" required="required" class="form-control col-md-7 col-xs-12">
                            <div id="text-email" class="help-block"></div>
                        </div>
                    </div>
                    <div class="ln_solid"></div>
                    <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                            <button id="update-user" type="submit" class="btn btn-success">Save Change</button>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Change Password</h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <br />
                <div id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
                    <div class="form-group" id="box-password">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Old Password</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input id="password" class="form-control col-md-7 col-xs-12" type="password" name="middle-name">
                            <div id="text-password" class="help-block"></div>
                        </div>
                    </div>
                    <div class="form-group" id="box-new_password">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">New Password</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input id="new_password" class="form-control col-md-7 col-xs-12" type="password" name="middle-name">
                            <div id="text-new_password" class="help-block"></div>
                        </div>
                    </div>
                    <div class="form-group" id="box-password_repeat">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Repeat Password</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input id="password_repeat" class="form-control col-md-7 col-xs-12" type="password" name="middle-name">
                            <div id="text-password_repeat" class="help-block"></div>
                        </div>
                    </div>
                    <div class="ln_solid"></div>
                    <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                            <button type="submit" id="new-password-save" class="btn btn-success">Save Change</button>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Foto</h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <?= Html::tag('button',Html::tag('i','',['class'=>'fa fa-image']).'&nbsp;Upload',['class'=>'btn btn-default','id'=>'xbtn_pictute_upload'])?>
                <div class="clearfix"></div>
                <div class="margin-bottom-5"></div>
                <div class="row">
                     <?= Html::img($img_s, ['id'=>'profile1', 'class'=>'thumbnail img-responsive'])?>
                </div>
                <div class="clearfix"></div>
            </div>
    </div>

</div>

<!-- Modal Picture Crop -->
<div class="modal fade bs-example-modal-lg" id="myModalCrop" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <b><i class="fa fa-image"></i>&nbsp;Set Thumbnail</b>
      </div>
      <div class="modal-body">
            <p id="cropit-content">
                
            </p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" id="d-id-save-crop-profile-picture" >Save</button>
        <button type="button" class="btn btn-default" id="d-id-upload-crop-profile-picture" >Browse</button>
        <button type="button" class="btn btn-default" id="d-id-close-crop-profile-picture" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!-- Modal Picture Crop -->