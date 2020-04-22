<?php
/**
 * The following variables are available in this template:
 * - $this: the BootCrudCode object
 */
?>
<?php
echo "<?php\n";
$nameColumn=$this->guessNameColumn($this->tableSchema->columns);
$label=$this->pluralize($this->class2name($this->modelClass));
echo "\$this->breadcrumbs=array(
	'$label'=>array('index'),
	\$model->{$nameColumn},
);\n";
?>

$this->beginWidget('bootstrap.widgets.TbBox', array(
    'title' => '<?php echo $this->modelClass; ?> #'.<?php echo "\$model->".$this->tableSchema->primaryKey; ?>,
	'headerIcon' => 'icon-search icon-white',
	'headerButtons' => array(
	array(
		'class' => 'bootstrap.widgets.TbButtonGroup',
		'type' => 'primary', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
		'buttons' => array(
				//array('label'=>'Listar', 'url'=>array('index'),'icon' => 'icon-home icon-white'),
				array('label'=>'Crear', 'url'=>array('create'),'icon' => 'icon-file icon-white'),
				array('label'=>'Editar', 'url'=>array('update','id'=>$model-><?php echo $this->tableSchema->primaryKey; ?>),'icon' => 'icon-edit icon-white'),
				array('label'=>'Ver Todos', 'url'=>array('admin'),'icon' => 'icon-th-list icon-white'),
				),
		)
	),	

));
?>

<?php echo "<?php"; ?> $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
<?php
foreach($this->tableSchema->columns as $column)
	echo "\t\t'".$column->name."',\n";
?>
	),
)); 
$this->endWidget();
?>
