<?php
/**
 * Las siguientes variables estan disponibles en esta plantilla:
 * - $this: El objeto BootCrudCode 
 * - $wcontent: El contenido del mensaje de ayuda para la busqueda avanzada 
 */
?>
<?php
echo "<?php\n";
$label=$this->pluralize($this->class2name($this->modelClass));
echo "\$this->breadcrumbs=array(
	'$label'=>array('index'),
	'Admin',
);\n";
?>
$this->beginWidget('bootstrap.widgets.TbBox', array(
    'title' => '<?php echo $this->pluralize($this->class2name($this->modelClass)); ?>',
	'headerIcon' => 'icon-home icon-white',
	'headerButtons' => array(
	array(
		'class' => 'bootstrap.widgets.TbButtonGroup',
		'type' => 'primary', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
		'buttons' => array(
				//Descomente la siguiente linea si desea ver el link al index
				//array('label'=>'Listar', 'url'=>array('index')),
				array('label'=>' Nuevo', 'url'=>array('create'),'icon' => 'icon-file icon-white', 'size'=>'small'),
				),
		)
	),	

));



echo "<br> <br>";
Yii::app()->clientScript->registerScript('search', "
$(function() {
	$('.search-form').toggle();
	return false;
});
$('.search-button').click(function(){
	$('.accordion-toggle').click();
});

$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('<?php echo $this->class2id($this->modelClass); ?>-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
<?php
$wcontent='Usted puede utilizar los comparadores siguientes  (<, <=, >, >=, <> or =) al principio de cada uno de los valores de la busqueda para especificar la forma en la comparacion se debe hacer.
';
?>
?>



<div class="accordion" id="accordion2">
<?php echo "<?php \$collapse = \$this->beginWidget('bootstrap.widgets.TbCollapse'); ?>"; ?>
<div class="accordion-group">
    <div class="accordion-heading">
        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseOne">
            <i class="icon-search"></i> Busqueda Avanzada
        </a>
    </div>
    <div id="collapseOne" class="accordion-body collapse ">
        <div class="accordion-inner">
		<div class="search-form" style="display:none">
		<br>
		<br>
		<?php echo "<?php 

		 \$this->widget('bootstrap.widgets.TbButton', array(
			'label'=>'',
			'icon'=>'icon-info-sign icon-white',
			'type'=>'warning',
			'htmlOptions'=>array('data-title'=>'Ayuda','data-trigger'=>'focus hover', 'data-content'=>'$wcontent', 'rel'=>'popover','data-placement'=>'bottom'),
		));

		?>\n"

		?>
		<br>
		<br>
		<?php echo "<?php \$this->renderPartial('_search',array(
			'model'=>\$model,
		)); ?>\n"; ?>      
		</div>		
        </div>
    </div>
</div>

<?php echo "<?php \$this->endWidget(); ?>" ?>

<?php echo "<?php"; ?> $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'<?php echo $this->class2id($this->modelClass); ?>-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'type'=>'striped bordered condensed',
	'columns'=>array(
<?php
$count=0;
foreach($this->tableSchema->columns as $column)
{
	if(++$count==7)
		echo "\t\t/*\n";
	echo "\t\t'".$column->name."',\n";
}
if($count>=7)
	echo "\t\t*/\n";
?>
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); 

$this->endWidget();
?>
