<?php
/* @var $this SubastasController */
/* @var $model Subastas */

$this->breadcrumbs=array(
	'Subastases'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Subastas', 'url'=>array('index')),
	array('label'=>'Create Subastas', 'url'=>array('create')),
	array('label'=>'View Subastas', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Subastas', 'url'=>array('admin')),
);
?>

<h1>Update Subastas <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>