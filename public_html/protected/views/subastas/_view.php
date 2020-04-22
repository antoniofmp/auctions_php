<?php
/* @var $this SubastasController */
/* @var $data Subastas */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('codigo')); ?>:</b>
	<?php echo CHtml::encode($data->codigo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('importeTasacion')); ?>:</b>
	<?php echo CHtml::encode($data->importeTasacion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('importeEjecutante')); ?>:</b>
	<?php echo CHtml::encode($data->importeEjecutante); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('comparativa')); ?>:</b>
	<?php echo CHtml::encode($data->comparativa); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ejecutante')); ?>:</b>
	<?php echo CHtml::encode($data->ejecutante); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('descripcion_juzgado')); ?>:</b>
	<?php echo CHtml::encode($data->descripcion_juzgado); ?>
	<br />


</div>