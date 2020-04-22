<?php Yii::app()->bootstrap->register(); ?>
<script>
  /* El formulario de inicio es básicamente un modal estático, que tiene como fondo una imagen. */
    $(function(){
            $('#myModal').on('show', function () {
                    $(this).css({width:'700px',height:'450px',left:'44%',top:'15%'});
                    $(this).find('.modal-body').css({width:'auto',
                                                     height:'430px', 
                                                     'max-height':'100%',
                                                     'max-width':'100%'});
            });
            $("#myModal").modal({backdrop: 'static',});//Modal estático
            $("#error-div").hide();
           // $('.modal-backdrop').css("background-image", "url(/images/iberdrola.jpg)"); //Imagen de fondo
            $('.modal-backdrop').css("width", "100%");
            $('.modal-backdrop').css("height", "100%");
    });
</script>

<!-- Modal de inicio  -->
<?php $this->beginWidget('bootstrap.widgets.TbModal', array('id'=>'myModal')); ?>

<div class="modal-header">
    <!-- <img src="<?php //echo "/images/favicon.ico" ?>" style="max-width: 50px; max-height: 40px; width: 50px; height: 40px; margin-left: 310px;">--> <h4 style="text-align:center; font: normal 15pt Arial">Subastas</h4> 
</div>

<div class="modal-body">
    
<div class="form">
<!-- Formulario de página de inicio -->
<?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id'=>'LoginForm',
    'enableAjaxValidation'=>false,
    'enableClientValidation'=>true,
    'htmlOptions'=>array('class'=>'well','style'=>"height: 240px;",'autocomplete'=>'off',),
)); ?>
<div id="error-div" class="alert alert-block alert-error">
</div> 

    <div class="row" style="margin-left: 20px; font: normal 10pt helvetica-neue-bold;">
            <br />
            <?php echo $form->labelEx($model,'Usuario'); ?>
            <?php echo $form->textField($model,'username'); ?>
            <?php echo $form->error($model,'username'); ?>
    </div>

    <div class="row" style="margin-left: 20px; font: normal 10pt helvetica-neue-bold;">
            <?php echo $form->labelEx($model,'Clave'); ?>
            <?php echo $form->passwordField($model,'password'); ?>
            <?php echo $form->error($model,'password'); ?>
    </div>
    
    <div class="row buttons" style="margin-left: 20px; margin-top: 5px;">
        <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'label'=>'Entrar')); ?>
    </div>
     
  <?php $this->endWidget(); ?>
<?php $this->endWidget(); ?>

<script>
  $(document).keypress(function (e) {
    var key = e.which;
    if(key == 13)//Enter key code
     {
       $("#yw0").trigger("click");  
       return false;  
     }
   });  
  
  $("label[for='LoginForm_Clave']").text('Contraseña');
  $("#LoginForm_password_em_").show();
  $(".btn").css({'font':'normal 10pt arial','margin-top':'14px'});
</script>