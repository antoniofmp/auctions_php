<?php
/* @var $this SubastasController */
/* @var $model Subastas */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'identificador'); ?>
		<?php echo $form->textField($model,'identificador',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'tasacion'); ?>
		<?php echo $form->textField($model,'tasacion',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cantReclamada'); ?>
		<?php echo $form->textField($model,'cantReclamada',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'direccion'); ?>
		<?php echo $form->textField($model,'direccion',array('size'=>60,'maxlength'=>255)); ?>
	</div>
    
        <div class="row">
		<?php echo $form->label($model,'codigoPostal'); ?>
		<?php echo $form->textField($model,'codigoPostal',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'localidad'); ?>
		<?php echo $form->textField($model,'localidad',array('size'=>60,'maxlength'=>255)); ?>
	</div>
    
        <div class="row">
		<?php echo $form->label($model,'acreedor'); ?>
		<?php echo $form->textField($model,'acreedor',array('size'=>60,'maxlength'=>255)); ?>
	</div>
    
        <div class="row">
		<?php echo $form->label($model,'nombreAcreedor'); ?>
		<?php echo $form->textField($model,'nombreAcreedor',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Buscar'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->