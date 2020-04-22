<?php
/* @var $this SubastasController */
/* @var $model Subastas */

//$this->menu=array(
//	array('label'=>'Ejecutar barrido', 'url'=>array('exec')),
//);
?>

<div class="info">
<?php
 /* Se itera para buscar todos los flashes y se muestra */
 foreach(Yii::app()->user->getFlashes() as $key => $message) {
        echo '<div class="flash-' . $key . '">' . $message . "</div>\n";
    }
?>
</div>

<?php
Yii::app()->clientScript->registerScript(
   'myHideEffect',
   '$(".info").animate({opacity: 1.0}, 5000).fadeOut("slow");',//Se estima con 5000 ms (5 segundos) el tiempo que dura el flash
   CClientScript::POS_READY
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#subastas-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<?php echo CHtml::link('Busqueda avanzada','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<br /><br /><br />
<h5 id="panelh4" >Fechas de finalización de subastas</h5> <h5 id="panelh4" style='margin-left: 470px; margin-top: -32px;'>Rango de coeficientes</h5>
<?php 
/* Formulario del establecedor de rango de fechas y coeficientes */
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
                        'id'=>'subastas-form',
                        'enableAjaxValidation'=>false,
                        'htmlOptions' => array('enctype' => 'multipart/form-data'),
                         ));
?>
<b style="color: rgb(84, 120, 141); ">Desde:</b>
<?php
$datePickerConfig =  array(
                        'name'=>'from_date',
                        'value'=>Yii::app()->request->cookies['from_date']->value,
                        'language'=>'es',
                        'options'=>array(
                            'dateFormat' => 'dd-mm-yy',
                            'showAnim'=>'fold',//'slide','fold','slideDown','fadeIn','blind','bounce','clip','drop'
                            'changeMonth'=>true,
                            'changeYear'=>true,
                            'yearRange'=>'1850:2080',
                        ),
                   );

$this->widget('zii.widgets.jui.CJuiDatePicker',$datePickerConfig);
?>
<b id="bhasta" > Hasta:</b>
<?php
$datePickerConfig =  array(
                        'name'=>'to_date',
                        'value'=>Yii::app()->request->cookies['to_date']->value, 
                        'language'=>'es',
                        'options'=>array(
                            'dateFormat' => 'dd-mm-yy',
                            'showAnim'=>'fold',//'slide','fold','slideDown','fadeIn','blind','bounce','clip','drop'
                            'changeMonth'=>true,
                            'changeYear'=>true,
                            'yearRange'=>'1850:2080',
                        ),
                     );

$this->widget('zii.widgets.jui.CJuiDatePicker',$datePickerConfig);
?>
<b style="color: rgb(84, 120, 141); margin-left: 30px;">Desde coefic:</b>
<?php
  echo $form->textField($model,'from_coef',array('name'=>'from_coef'));
?>

<b style="color: rgb(84, 120, 141);">Hasta coefic:</b>
<?php
  echo $form->textField($model,'to_coef',array('name'=>'to_coef'));
?>

<?php echo CHtml::submitButton($model->isNewRecord ? 'Buscar' : 'Buscar', array('id'=>'buscarPanel')); ?>
<?php $this->endWidget(); ?>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'subastas-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
                array(
                     'name'=>'identificador',
                     'value'=>array($this,'getIdentificador'), //Función implementada en el controlador '$data->getIdentificador()',
                     ),
                array(
                     'name'=>'fechaFin',
                     'value'=>'$data->getFechaFin($data)',
                     'filter'=>'',
                     'htmlOptions'=>array('style'=>'width:10%'),
                    ),
		'tasacion',
		'cantReclamada',
                'coeficiente',
                'localidad',
                'codigoPostal',
		'direccion',
                'acreedor',
                'nombreAcreedor',
//		array(
//			'class'=>'CButtonColumn',
//		),
	),
)); ?>

<a href="/subastas/exportarExcelFechaAsc" style="text-decoration: none;">
  <button class="btn" style="height: 30px; color: white; border-radius: 0px; margin-top: 10px; font-family: arial; border: 0px; background-color: rgb(122, 184, 154); cursor: pointer; "> Excel Fecha Ascendente</button>
</a>

<a href="/subastas/exportarExcelFechaDesc" style="text-decoration: none; margin-left: 20px;">
  <button class="btn" style="height: 30px; color: white; border-radius: 0px; margin-top: 10px; font-family: arial; border: 0px; background-color: rgb(122, 184, 154); cursor: pointer; "> Excel Fecha Descendente</button>
</a>

<a href="/subastas/exportarExcelCoefDesc" style="text-decoration: none; margin-left: 20px;">
  <button class="btn" style="height: 30px; color: white; border-radius: 0px; margin-top: 10px; font-family: arial; border: 0px; background-color: rgb(122, 184, 154); cursor: pointer; "> Excel Coeficiente</button>
</a>

<br /><br />
<a href="/subastas/pdfFechaAsc" style="text-decoration: none;">
  <button class="btn" style="height: 30px; color: white; border-radius: 0px; margin-top: 10px; font-family: arial; border: 0px; background-color: rgb(84, 120, 141); cursor: pointer; "> PDF Fecha Ascendente</button>
</a>

<a href="/subastas/pdfFechaDesc" style="text-decoration: none; margin-left: 25px;">
  <button class="btn" style="height: 30px; color: white; border-radius: 0px; margin-top: 10px; font-family: arial; border: 0px; background-color: rgb(84, 120, 141); cursor: pointer; "> PDF Fecha Descendente</button>
</a>

<a href="/subastas/pdfCoefAsc" style="text-decoration: none; margin-left: 27px;">
  <button class="btn" style="height: 30px; color: white; border-radius: 0px; margin-top: 10px; font-family: arial; border: 0px; background-color: rgb(84, 120, 141); cursor: pointer; "> PDF Coeficiente</button>
</a>

<?php 
/* Formulario del establecedor de rango de fechas */
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
                        'id'=>'subastasConf-form',
                        'action' => Yii::app()->createUrl('subastas/exec'),
                        'enableAjaxValidation'=>false,
                        'htmlOptions' => array('enctype' => 'multipart/form-data'),
                         ));
?>

<br /><br /><br />
<b style="color: rgb(84, 120, 141);">Desde ID subasta:</b>
<?php
  echo $form->numberField($model,'desdeSubasta',array('name'=>'desdeSubasta','required'=>'required'));
?>

<b style="color: rgb(84, 120, 141);">Num. iteraciones:</b>
<?php
  echo $form->numberField($model,'numIteraciones',array('name'=>'numIteraciones','required'=>'required'));
?>
<b style="color: rgb(84, 120, 141); margin-left: 5px;">¿Borrar datos anteriores?:</b>
<?php
  echo $form->dropDownList($model,'borrar',array('Si'=>'Si','No'=>'No'),array('empty' => '--Seleccionar--','required'=>'required','name'=>'borrar'));
?>
<?php echo CHtml::submitButton($model->isNewRecord ? 'Ejecutar barrido' : 'Ejecutar barrido', array('id'=>'confSubasta')); ?>
<?php $this->endWidget(); ?>