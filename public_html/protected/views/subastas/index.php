<?php
/* @var $this SubastasController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Subastases',
);

$this->menu=array(
	array('label'=>'Create Subastas', 'url'=>array('create')),
	array('label'=>'Manage Subastas', 'url'=>array('admin')),
);
?>

<h1>Subastases</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
