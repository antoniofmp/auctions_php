<?php
/* @var $this SubastasController */
/* @var $model Subastas */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'subastas-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'codigo'); ?>
		<?php echo $form->textField($model,'codigo',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'codigo'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'importeTasacion'); ?>
		<?php echo $form->textField($model,'importeTasacion',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'importeTasacion'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'importeEjecutante'); ?>
		<?php echo $form->textField($model,'importeEjecutante',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'importeEjecutante'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'comparativa'); ?>
		<?php echo $form->textField($model,'comparativa',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'comparativa'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ejecutante'); ?>
		<?php echo $form->textField($model,'ejecutante',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'ejecutante'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'descripcion_juzgado'); ?>
		<?php echo $form->textField($model,'descripcion_juzgado',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'descripcion_juzgado'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->