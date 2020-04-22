<?php
/**
 * Las siguientes variables estan disponibles en esta plantilla:
 * - $this: El objeto BootCrudCode 
 */
?>
<?php
echo "<?php\n";
$label=$this->pluralize($this->class2name($this->modelClass));
echo "\$this->breadcrumbs=array(
	'$label',
);\n";
?>
$this->beginWidget('bootstrap.widgets.TbBox', array(
    'title' => '<?php echo $label; ?>',
	'headerIcon' => 'icon-home icon-white',
	'headerButtons' => array(
	array(
		'class' => 'bootstrap.widgets.TbButtonGroup',
		'type' => 'primary', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
		'buttons' => array(
					array('label'=>'Crear', 'url'=>array('create'),'icon' => 'icon-file icon-white'),
					array('label'=>'Ver Todos', 'url'=>array('admin'),'icon' => 'icon-th-list icon-white'),
				),
		)
	),	

));
?>

<?php echo "<?php"; ?> $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); 
$this->endWidget(); 
?>
