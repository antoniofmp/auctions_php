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
	'$label'=>array('admin'),
	'Crear',
);\n";
?>

$this->beginWidget('bootstrap.widgets.TbBox', array(
    'title' => 'Crear <?php echo $this->modelClass; ?>',
	'headerIcon' => 'icon-file icon-white',
	'headerButtons' => array(
	array(
		'class' => 'bootstrap.widgets.TbButtonGroup',
		'type' => 'primary', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
		'buttons' => array(
				array('label'=>'Ver Todos','url'=>array('admin'),'icon' => 'icon-th-list icon-white'),
			),
		)
	),	

));

<?php echo "echo \$this->renderPartial('_form', array('model'=>\$model)); 
\$this->endWidget(); 
?>"; ?>
