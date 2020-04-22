<?php
/**
 * Las siguientes variables estan disponibles en esta plantilla:
 * - $this: El objeto BootCrudCode 
 */
?>
<?php
echo "<?php\n";
$nameColumn=$this->guessNameColumn($this->tableSchema->columns);
$label=$this->pluralize($this->class2name($this->modelClass));
echo "\$this->breadcrumbs=array(
	'$label'=>array('index'),
	\$model->{$nameColumn}=>array('view','id'=>\$model->{$this->tableSchema->primaryKey}),
	'Actualizar',
);\n";
?>

$this->beginWidget('bootstrap.widgets.TbBox', array(
    'title' => 'Editar <?php echo $this->modelClass; ?> #'.<?php echo "\$model->".$this->tableSchema->primaryKey; ?>,
	'headerIcon' => 'icon-edit icon-white',
	'headerButtons' => array(
	array(
		'class' => 'bootstrap.widgets.TbButtonGroup',
		'type' => 'primary', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
		'buttons' => array(
				// Descomentar los demas links si desea usarlos
				//array('label'=>'Listar', 'url'=>array('index'),'icon' => 'icon-home icon-white'),
				array('label'=>'Crear', 'url'=>array('create'),'icon' => 'icon-file icon-white'),
				//array('label'=>'Ver', 'url'=>array('view','id'=>$model-><?php echo $this->tableSchema->primaryKey; ?>),'icon' => 'icon-search icon-white'),
				array('label'=>'Ver Todos', 'url'=>array('admin'),'icon' => 'icon-th-list icon-white'),
				),
		)
	),	

));

<?php echo "echo \$this->renderPartial('_form', array('model'=>\$model)); 
\$this->endWidget(); 
?>"; ?>
