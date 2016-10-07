<?php
use yii\helpers\Html;
use yii\widgets\LinkPager;
use app\components\Constants;

$this->title = 'Web Setting';

$this->registerJsFile(Yii::$app->homeUrl."js/index.js", ['depends' => [\yii\web\JqueryAsset::className()], 'position' =>  \yii\web\View::POS_HEAD]);

$token = $this->renderDynamic('return Yii::$app->request->csrfToken;');

$jsx = <<< 'SCRIPT'
    IndexObj.initialScript();
SCRIPT;
$this->registerJs('IndexObj.baseUrl = "'. Yii::$app->homeUrl.'"', \yii\web\View::POS_HEAD);
$this->registerJs('IndexObj.csrfToken = "'. $token.'"',  \yii\web\View::POS_HEAD);
$this->registerJs($jsx);

?>

<div class="page-title">
    <div class="title_left">
        <h3>

         </h3>
    </div>

    <div class="title_right">
        <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
            <form  id="searchform" class="input-group"  action="<?=Yii::$app->homeUrl;?>web-setting"  method="GET" > 
                <input type="text" name="search" class="form-control" value="<?=$search;?>" placeholder="Search for...">
                <span class="input-group-btn">
                    <button class="btn btn-default" type="submit">Go!</button>
                </span>
            </form>
        </div>
    </div>
</div>

<div class="clearfix"></div>

<div class="row">

    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2><?=$this->title;?><small></small></h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a id="add-new-setting" href="<?=Yii::$app->homeUrl?>create-setting"><i class="fa fa-plus"></i></a>
                    </li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <table id="example" class="table table-striped responsive-utilities jambo_table">
                    <thead>
                        <tr class="headings">
                            <th width="1%">No</th>
                            <th>Setting Name</th>
                            <th>Setting Content</th>
                            <th width="5%">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                            $start = (int)$offset * (int)$page;
                            foreach ($models as $model) {
                                $start++;
                                echo '<tr class="odd gradeX">
                                        <td>'.$start.'</td>
                                        <td id="setting_name_'.$model['setting_id'].'" >'.$model['setting_name'].'</td>
                                        <td id="setting_content_'.$model['setting_id'].'" >'.$model['setting_content'].'</td>
                                        <td class="center">
                                            <a id="update-setting-'.$model['setting_id'].'" href="'.Yii::$app->homeUrl.'update-setting/'.$model['setting_id'].'" class="btn btn-xs btn-success update-obat" ><i class="fa fa-pencil"></i></a>
                                            <!--<a href="#" class="btn btn-xs btn-danger" ><i class="fa fa-trash"></i></a>-->
                                        </td>
                                    </tr>';
                            }
                        ?>
                    </tbody>

                </table>
            </div>

            <div align="right">
                <?php
                    //display pagination
                    echo LinkPager::widget([
                        'pagination' => $pages,
                    ]);
                ?>
            </div>

        </div>
    </div>
</div>         