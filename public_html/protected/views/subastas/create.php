<?php
/* @var $this SubastasController */
/* @var $model Subastas */

$this->breadcrumbs=array(
	'Subastases'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Subastas', 'url'=>array('index')),
	array('label'=>'Manage Subastas', 'url'=>array('admin')),
);
?>

<h1>Create Subastas</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>