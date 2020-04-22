<?php

class SubastasController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','exec','ejecutar1','ejecutar2','ejecutar3','ejecutar4','ejecutarExec','exportarExcelFechaDesc','exportarExcelFechaAsc','exportarExcelCoefDesc','exportarExcelCoefAsc','pdfFechaAsc','pdfFechaDesc','pdfCoefAsc'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('@'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Subastas;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Subastas']))
		{
			$model->attributes=$_POST['Subastas'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Subastas']))
		{
			$model->attributes=$_POST['Subastas'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Subastas');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
            unset(Yii::app()->request->cookies['from_date']);
            unset(Yii::app()->request->cookies['to_date']);
            unset(Yii::app()->request->cookies['from_coef']);
            unset(Yii::app()->request->cookies['to_coef']);
            /* Se preparan las cookies que guardaran las fechas indicadas en el rango de fechas */
            Yii::app()->request->cookies['from_date'] = new CHttpCookie('from_date', ''); 
            Yii::app()->request->cookies['to_date'] = new CHttpCookie('to_date', '');
            Yii::app()->request->cookies['from_coef'] = new CHttpCookie('from_coef', ''); 
            Yii::app()->request->cookies['to_coef'] = new CHttpCookie('to_coef', '');
            
            $model=new Subastas('search');
            $model->unsetAttributes();  // clear any default values
            
            if(!empty($_POST))
            {
             $desde = '';
             $hasta = '';
              if($_POST['from_date'] != ''){
                $desde = Yii::app()->dateFormatter->format('yyyy-MM-dd',$_POST['from_date']);
                Yii::app()->request->cookies['from_date'] = new CHttpCookie('from_date', Yii::app()->dateFormatter->format('dd-MM-yyyy',$desde));
              }
              if($_POST['to_date'] != ''){
                $hasta = Yii::app()->dateFormatter->format('yyyy-MM-dd',$_POST['to_date']);
                Yii::app()->request->cookies['to_date'] = new CHttpCookie('to_date', Yii::app()->dateFormatter->format('dd-MM-yyyy',$hasta));
              }
             $model->from_date = $desde;
             $model->to_date = $hasta;
             $model->from_coef = $_POST['from_coef']; //Campo de "desde" del coeficiente
             $model->to_coef = $_POST['to_coef'];//Campo de "hasta" del coeficiente
            }
            
            if(isset($_GET['Subastas'])){
                    $model->attributes=$_GET['Subastas'];
            }

            $this->render('admin',array(
                    'model'=>$model,
            ));
	}
        
        public function actionExec()
	{
            if(!empty($_POST['numIteraciones']) && !empty($_POST['desdeSubasta']) && !empty($_POST['borrar'])){
              if($_POST['borrar'] == "Si"){
                 Subastas::model()->deleteAll(); //Se borra todo lo que haya en la BD antes de hacer el barrido
              }
                $cont = 0; // varia en el num de iteraciones
                $iteraciones  = $_POST['numIteraciones']; //cantidad de iteraciones
                $jota = $_POST['desdeSubasta']; //varia en la url (a partir de que ID de subasta se quieren hacer las iteraciones)
           
                $this->render('ejecutar1',array(
                    'i'=>$cont,'j'=>$jota,'numIteraciones'=>$iteraciones,
               ));
            }
	}
        
        public function actionEjecutar1()
	{
            $cont = $_GET['i'];
            $jota = $_GET['j'];
            
            $iteraciones  = $_GET['numIteraciones']; 
            $identif = $_GET['ident']; 
            $tasacion = $_GET['valorSub']; 
            $cantRecl = $_GET['cantRecl'];
            $fechaFin = $_GET['fechaFin']; //yyyy-MM-dd
            $fechaFin = explode(" ",$fechaFin);
            $fech = explode("-",$fechaFin[9]);
            $dia = $fech[0];
            $mes = $fech[1];
            $anio = $fech[2];
            
            if($tasacion > 0){
              $coeficiente = number_format(($cantRecl / $tasacion)*100,2) . "%";
              $this->render('ejecutar2',array(
                    'i'=>$cont,'j'=>$jota,'id'=>$model->id,'numIteraciones'=>$iteraciones,
                    'ident'=>$identif,'tasac'=>$tasacion,'cantRec'=>$cantRecl,'fechaF'=>$anio."-".$mes."-".$dia,'coef'=>$coeficiente,
              ));
            }
            else{
                $coeficiente = 10000;
                $this->render('ejecutar2',array(
                    'i'=>$cont,'j'=>$jota,'id'=>$model->id,'numIteraciones'=>$iteraciones,
                    'ident'=>$identif,'tasac'=>$tasacion,'cantRec'=>$cantRecl,'fechaF'=>$anio."-".$mes."-".$dia,'coef'=>$coeficiente,
              ));
            }
	}
        
        public function actionEjecutar2()
	{
            $cont = $_GET['i'];
            $jota = $_GET['j'];
            $id = $_GET['id'];
            $iteraciones  = $_GET['numIteraciones']; 
            
            $dir = $_GET['dir']; 
            
            $identif = $_GET['identif']; 
            $tasacion = $_GET['tasacion']; 
            $fechaFin = $_GET['fechaFin'];
            $cantRecl = $_GET['cantRecl'];
            $coeficiente = $_GET['coeficiente'];
            
            $this->render('ejecutar3',array(
                   'i'=>$cont,'j'=>$jota,'id'=>$id,'numIteraciones'=>$iteraciones,
                   'ident'=>$identif,'tasac'=>$tasacion,'cantRec'=>$cantRecl,'fechaF'=>$fechaFin,'coef'=>$coeficiente,'direccionAutGest'=>$dir,
            ));
	}
        
        public function actionEjecutar3()
	{
            $cont = $_GET['i'];
            $jota = $_GET['j'];
            $id = $_GET['id'];
            $iteraciones  = $_GET['numIteraciones']; 
            
            $loc = $_GET['localidad'];
            $codPostal = $_GET['codPostal'];
            $dirBien = $_GET['direccionBien']; //dirección del bien
            $identif = $_GET['identif']; 
            $tasacion = $_GET['tasacion']; 
            $fechaFin = $_GET['fechaFin'];
            $cantRecl = $_GET['cantRecl'];
            $coeficiente = $_GET['coeficiente'];
            $dirAutGest = $_GET['dirAutGest'];
            
            echo $dirBien;
            echo " ";
            $localidadBien = $dirBien . ", " .$loc;
            
            $str = explode(" ",$dirAutGest);
            $tam = count($str);
            $ciudad = $str[$tam-1];
            
            $loc = strtolower($loc);
            $ciudad = strtolower($ciudad);
            
            if($loc == $ciudad){
               $dirAutGest = "Si"; 
            }
            elseif($loc != $ciudad){
               $dirAutGest = "No"; 
            }
            
            $this->render('ejecutar4',array(
                    'i'=>$cont,'j'=>$jota,'id'=>$model->id,'numIteraciones'=>$iteraciones,
                    'ident'=>$identif,'tasac'=>$tasacion,'cantRec'=>$cantRecl,'fechaF'=>$fechaFin,'coef'=>$coeficiente,'dirAutGest'=>$dirAutGest,'localidadBien'=>$localidadBien,'codPostal'=>$codPostal,
            ));
	}
        
        public function actionEjecutar4()
	{
            $cont = $_GET['i'];
            $jota = $_GET['j'];
            $id = $_GET['id'];
            $iteraciones  = $_GET['numIteraciones']; 
            
            $nombre = $_GET['nombre'];
            $nombreAcreedor = $_GET['nombreAcreedor'];
            
            $identif = $_GET['identif']; 
            $tasacion = $_GET['tasacion']; 
            $fechaFin = $_GET['fechaFin'];
            $cantRecl = $_GET['cantRecl'];
            $coeficiente = $_GET['coeficiente'];
            $dirAutGest = $_GET['dirAutGest'];
            $locBien = $_GET['locBien'];
            $codPostal = $_GET['codPostal'];
            
            $model=new Subastas;
            
            if($nombre == -1){ //no coincide
               $model->acreedor = "No";
               $model->nombreAcreedor = $nombreAcreedor;
               $model->identificador = $identif;
               $model->fechaFin = $fechaFin;
               $model->tasacion = $tasacion;
               $model->cantReclamada = $cantRecl;
               $model->coeficiente = $coeficiente;
               $model->direccion = $dirAutGest;
               $model->localidad = $locBien;
               $model->codigoPostal = $codPostal;
               
               if(trim($model->localidad)!='undefined,'){
                   $model->save();
               }
                
               $this->render('ejecutar1',array(
                    'i'=>$cont,'j'=>$jota,'numIteraciones'=>$iteraciones,
              ));
            }
            else{
              $model->acreedor = "Si";
              $model->nombreAcreedor = $nombreAcreedor;
              $model->identificador = $identif;
              $model->fechaFin = $fechaFin;
              $model->tasacion = $tasacion;
              $model->cantReclamada = $cantRecl;
              $model->coeficiente = $coeficiente;
              $model->direccion = $dirAutGest;
              $model->localidad = $locBien;
              $model->codigoPostal = $codPostal;
               
              if(trim($model->localidad)!='undefined,'){
                   $model->save();
               }
              
              $this->render('ejecutar1',array(
                    'i'=>$cont,'j'=>$jota,'numIteraciones'=>$iteraciones,
              ));
            }
	}
        
        public function actionEjecutarExec()
	{
           $cont = $_GET['i'];
           $jota = $_GET['j'];
           $iteraciones  = $_GET['numIteraciones']; 
            
           if($cont<$iteraciones){ // contador del número de iteraciones
              $this->render('ejecutar1',array(
                     'i'=>$cont,'j'=>$jota,'numIteraciones'=>$iteraciones,
              ));
           }
           else{
               Yii::app()->user->setFlash('success',"Barrido ejecutado satisfactoriamente.");
               $this->redirect(array('admin')); //Barrido terminado.
           }
	}
        
        /*
         * Acción para exportar a Excel
         */
        public function actionExportarExcelFechaDesc()
	{
           $model = Subastas::model()->findAll(array("order" => "fechaFin DESC"));
           
           Yii::app()->request->sendFile('Resumen subastas.xls',
              $this->renderPartial('excel',array(
                  'model'=>$model,
              ),true)
           );
        }
        
        public function actionExportarExcelFechaAsc()
	{
           $model = Subastas::model()->findAll(array("order" => "fechaFin ASC"));
           
           Yii::app()->request->sendFile('Resumen subastas.xls',
              $this->renderPartial('excel',array(
                  'model'=>$model,
              ),true)
           );
        }
        
        public function actionExportarExcelCoefDesc()
	{
           $model = Subastas::model()->findAll(array("order" => "coeficiente ASC"));
           
           Yii::app()->request->sendFile('Resumen subastas.xls',
              $this->renderPartial('excel',array(
                  'model'=>$model,
              ),true)
           );
        }
        
        /*
         * Función para hacer lo del hipervinculo
         */
        public function getIdentificador($data)
        {
          $idSubasta = $data->id; //ID de la subasta (id de la BD)
          $subasta = Subastas::model()->find('id = ?', array($idSubasta));
          
          echo "<a href='https://subastas.boe.es/detalleSubasta.php?idSub=$subasta->identificador&ver=1' target='_blank'>";
          echo $subasta->identificador;
          echo "</a>";
        }
        
        public function actionPdfFechaAsc()
        {
            $subastas = Subastas::model()->findAll(array("order" => "fechaFin ASC"));
            
            $this->render('pdf',array(
                'subastas'=>$subastas,
            ));
        }
        
        public function actionPdfFechaDesc()
        {
            $subastas = Subastas::model()->findAll(array("order" => "fechaFin DESC"));
            
            $this->render('pdf',array(
                'subastas'=>$subastas,
            ));
        }
        
        public function actionPdfCoefAsc()
        {
            $subastas = Subastas::model()->findAll(array("order" => "coeficiente ASC"));
            
            $this->render('pdf',array(
                'subastas'=>$subastas,
            ));
        }
        
	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Subastas the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Subastas::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Subastas $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='subastas-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
