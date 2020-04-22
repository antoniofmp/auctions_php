<?php
/**
 * Esta es la plantilla para generar un  archivo controller class para la prodiedad CRUD.
 * Las siguientes variables estan disponibles en esta plantilla:
 * - $this: BootCrudCode object
 */
?>
<?php echo "<?php\n"; ?>

class <?php echo $this->controllerClass; ?> extends <?php echo $this->baseControllerClass."\n"; ?>
{
	/**
	 * @var string el diseño predeterminado de las vistas. El valor predeterminado es '//layouts/column2', que significa
	 * con diseño de dos columnas. Ver 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // realizar el control de acceso para las operaciones CRUD
		);
	}

	/**
	 * Especificación de las reglas de acceso.
	 * Este método es usado por filtro 'accessControl'.
	 * @return array access control rules (arreglo con las reglas de control de acceso)
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // permitir a los usuarios realizar acciones 'view' e 'index' (ver e inicio)
				'actions'=>array('index','view'),
				'users' => array(*),
			),
			array('allow', // permite al usuario autenticado para ejecutar acciones 'create' y 'update' (crear y actualizar)
				'actions'=>array('create','update'),
				'users'=>array(*),
			),
			array('allow', // permite que el usuario de administración para llevar a cabo acciones 'admin' y 'delete' (administrar y borrar)
				'actions'=>array('admin','delete'),
				'users'=>array(*),
			),
			array('deny',  // negar todos los usuarios que no cumplan con ninguna regla
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Mostrar un Modelo en Particular.
	 * @param integer $id el ID del modelo que sera mostrado
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Crear un nuevo registro en el modelo .
	 * Si la creación es satisfactoria, el explorador sera redirigido a la pagina 'admin'.
	 */
	public function actionCreate()
	{
			
		$model=new <?php echo $this->modelClass; ?>;
		
		// Descomentar la siguiente linea si es necesitada la validación AJAX
		// $this->performAjaxValidation($model);

		if(isset($_POST['<?php echo $this->modelClass; ?>']))
		{
			$model->attributes=$_POST['<?php echo $this->modelClass; ?>'];
			
			if($model->save())
			{
				$this->redirect(array('admin')); 
				// Comente la linea anterior Descomente la siguiente si desea que luego de guardar el navegador regrese a la vista 'view'
				//$this->redirect(array('view','id'=>$model-><?php echo $this->tableSchema->primaryKey; ?>));
				// Descomente la siguiente linea si desea grabar traza de seguridad
				//$this->seg_operaciones($model->tableName(), $val_antes, $val_despues, $transaccion, $this->module->getName());
			}	
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Actualizar un registro particular en el modelo.
	 * Si la creación es satisfactoria, el explorador sera redirigido a la pagina 'admin'.
	 * @param integer $id el ID del modelo que sera actualizado
	 */
	public function actionUpdate($id)
	{
		
		$model=$this->loadModel($id);
		
		
		// Descomentar la siguiente linea si es necesitada la validación AJAX
		// $this->performAjaxValidation($model);

		if(isset($_POST['<?php echo $this->modelClass; ?>']))
		{
			$model->attributes=$_POST['<?php echo $this->modelClass; ?>'];
			
			if($model->save())
			{
				$this->redirect(array('admin'));  
				// Comente la linea anterior Descomente la siguiente si desea que luego de guardar el navegador regrese a la vista 'view'
				//$this->redirect(array('view','id'=>$model-><?php echo $this->tableSchema->primaryKey; ?>));
				// Descomente la siguiente linea si desea grabar traza de seguridad
							}	
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Borrar un registro particular en el modelo.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id el ID del modelo que sera borrado
	 */
	public function actionDelete($id)
	{
	
        $model = $this->loadModel($id);
        $val_antes = $model->attributes;
       
        //$model->fDesac = Yii::app()->dateFormatter->format('dd-MM-yyyy HH:mm:ss',time());
        //$model->uDesac = $usuario->id;
        if ($model->save()) 
		{
            $val_despues = $model->attributes;
            //$this->seg_operaciones($model->tableName(), $val_antes, $val_despues, $transaccion, $this->module->getName());
            $this->redirect(array('admin'));
        }	
		
	}

	/**
	 * Listado de todo el modelo.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('<?php echo $this->modelClass; ?>');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Administración del Modelo.
	 */
	public function actionAdmin()
	{
		$model=new <?php echo $this->modelClass; ?>('search');
		$model->unsetAttributes();  // borrar los valores predeterminados
		if(isset($_GET['<?php echo $this->modelClass; ?>']))
			$model->attributes=$_GET['<?php echo $this->modelClass; ?>'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Devuelve el modelo de datos basado en la clave principal que figura en la variable GET.
	 * Si no se encuentra el modelo de datos, una excepción HTTP se levanta.
	 * @param integer el ID del modelo que sera cargado
	 */
	public function loadModel($id)
	{
		$model=<?php echo $this->modelClass; ?>::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'La página solicitada no existe.');
		return $model;
	}

	/**
	 * Realiza la validación de AJAX.
	 * @param CModel el modelo que sera validado
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='<?php echo $this->class2id($this->modelClass); ?>-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
