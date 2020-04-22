<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
        <link rel="shortcut icon" href="<?php echo Yii::app()->request->baseUrl; ?>/images/imgSub.ico" type="image/x-icon" />
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

	<!-- blueprint CSS framework -->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" />
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
	<![endif]-->

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>

<div class="contenedor" style="width: 100%; margin: 0 auto; background-color: white;" > 
  <div class="containeder" id="paedge">

	<div id="headdeer">
		
	</div><!-- header -->

        <?php if(!Yii::app()->user->isGuest){ ?>
            <div id="mainmenu">
                    <?php $this->widget('zii.widgets.CMenu',array(
                            'items'=>array(
                                   // array('label'=>'Información', 'url'=>array('/site/index')),
                                    //array('label'=>'Login', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
                                    array('label'=>'Cerrar sesión ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest)
                            ),
                    )); ?>
            </div><!-- mainmenu -->
        <?php } ?>

	<?php echo $content; ?>

  </div><!-- page -->
</div>
</body>
</html>
