<?php
/**
 * Las siguientes variables estan disponibles en esta plantilla:
 * - $this: El objeto BootCrudCode 
 */
?>
<?php echo "<?php \$form=\$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'".$this->class2id($this->modelClass)."-form',
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array('class'=>'well','enctype'=>'multipart/form-data'),	
)); ?>\n"; ?>

	<p class="help-block">Campos con <span class="required">*</span> son requeridos.</p>
<fieldset>
	<?php echo "<?php echo \$form->errorSummary(\$model); ?>\n"; ?>

<?php
foreach($this->tableSchema->columns as $column)
{
	if($column->autoIncrement)
		continue;
?>
	<?php echo "<?php echo ".$this->generateActiveRow($this->modelClass,$column)."; ?>\n"; ?>

<?php
}
?>
</fieldset>
	<div class="form-actions">
		<?php echo "<?php \$this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'icon'=>\$model->isNewRecord ? 'ok white' : 'fa-save ',
			'label'=>\$model->isNewRecord ? 'Crear' : 'Guardar',
		)); ?>\n"; ?>
	</div>

<?php echo "<?php \$this->endWidget(); ?>\n"; ?>
