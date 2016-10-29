<?php
	$username = '';
	if (!\Yii::$app->user->isGuest) {
		$username = Yii::$app->user->identity->username;

		$imga = yii::getAlias('@backend/web/folderuser/'.Yii::$app->user->identity->id.'profile.png');
		$img_e = Yii::$app->homeUrl.'folderuser/'.Yii::$app->user->identity->id.'profile.png';
		if(!file_exists($imga))
		{
		    $img_e = Yii::$app->homeUrl.'css/img/profile.png';
		}

	}

?>

<div class="col-md-3 left_col">
	<div class="left_col scroll-view">

		<div class="navbar nav_title" style="border: 0;">
			<a href="<?=Yii::$app->homeUrl;?>dashboard" class="site_title"><i class="fa fa-info"></i> <span>CM</span></a>
		</div>
		<div class="clearfix"></div>


		<?php if (!\Yii::$app->user->isGuest) { ?>
			<!-- menu prile quick info -->
			<div class="profile">
				<div class="profile_pic">
					<img id="profile-member-1" src="<?=$img_e;?>" alt="..." class="img-circle profile_img">
				</div>
				<div class="profile_info">
					<span>Welcome,</span>
					<h2><?=Yii::$app->user->identity->username;?></h2>
				</div>
			</div>
			<!-- /menu prile quick info -->

			<br />

			<!-- sidebar menu -->
			<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">

				<div class="menu_section">
					<h3>General</h3>
					<ul class="nav side-menu">
						<li><a><i class="fa fa-desktop"></i> Module <span class="fa fa-chevron-down"></span></a>
							<ul class="nav child_menu" style="display: none">
								<li><a href="<?=Yii::$app->homeUrl?>client">Client</a></li>
								<li><a href="<?=Yii::$app->homeUrl?>catalog-category">Catalog Category</a></li>
								<li><a href="<?=Yii::$app->homeUrl?>catalog">Catalog</a></li>
							</ul>
						</li>				
					</ul>
				</div>
				<div class="menu_section">
					<h3>Live On</h3>
					<ul class="nav side-menu">
						<li><a><i class="fa fa-bug"></i> POST <span class="fa fa-chevron-down"></span></a>
							<ul class="nav child_menu" style="display: none">
								<li><a href="<?=Yii::$app->homeUrl?>content-category">Content Category</a></li>
								<li><a href="<?=Yii::$app->homeUrl?>content">Dinamic Content</a></li>
							</ul>
						</li>
					</ul>
				</div>

			</div>
			<!-- /sidebar menu -->
		<?php }	 ?>
	
		<!-- /menu footer buttons -->
		<div class="sidebar-footer hidden-small">
			<a data-toggle="tooltip" data-placement="top" title="Settings">
				<span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
			</a>
			<a data-toggle="tooltip" data-placement="top" title="FullScreen">
				<span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
			</a>
			<a data-toggle="tooltip" data-placement="top" title="Lock">
				<span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
			</a>
			<a data-toggle="tooltip" data-placement="top" title="Logout">
				<span class="glyphicon glyphicon-off" aria-hidden="true"></span>
			</a>
		</div>
		<!-- /menu footer buttons -->
	</div>
</div>

<!-- top navigation -->
<div class="top_nav">

	<div class="nav_menu">
		<nav class="" role="navigation">
			<div class="nav toggle">
				<a id="menu_toggle"><i class="fa fa-bars"></i></a>
			</div>
			
			<?php if (!\Yii::$app->user->isGuest) { ?>
			<ul class="nav navbar-nav navbar-right">
				<li class="">
					<a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
						<img id="profile-member-2" src="<?=$img_e;?>" alt=""><?=Yii::$app->user->identity->username?>
						<span class=" fa fa-angle-down"></span>
					</a>
					<ul class="dropdown-menu dropdown-usermenu animated fadeInDown pull-right">
						<li><a href="<?=Yii::$app->homeUrl;?>profile">  Profile</a>
						</li>
						<li>
							<a href="<?=Yii::$app->homeUrl?>web-setting">
								<span class="badge bg-red pull-right">Web</span>
								<span>Settings</span>
							</a>
						</li>
						<li>
							<a href="javascript:;">Help</a>
						</li>
						<li><a data-method="post" href="<?=Yii::$app->homeUrl?>logout"><i class="fa fa-sign-out pull-right"></i> Log Out</a>
						</li>
					</ul>
				</li>
			</ul>
			<?php } ?>
		</nav>
		
	</div>

</div>
<!-- /top navigation -->