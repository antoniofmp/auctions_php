<?php
/* @var $this SubastasController */
/* @var $model Subastas */

$this->breadcrumbs=array(
	'Subastases'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Subastas', 'url'=>array('index')),
	array('label'=>'Create Subastas', 'url'=>array('create')),
	array('label'=>'Update Subastas', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Subastas', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Subastas', 'url'=>array('admin')),
);
?>

<h1>View Subastas #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'codigo',
		'importeTasacion',
		'importeEjecutante',
		'comparativa',
		'ejecutante',
		'descripcion_juzgado',
	),
)); ?>
