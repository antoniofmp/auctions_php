<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

<?php 
include 'simple_html_dom.php';
$cont = $i; // varia el num de iteraciones
$jota = $j; //varia en la url (el codigo de la subasta)
$iteraciones = $numIteraciones;
$identif = $ident;
$tasacion = $tasac;
$cantRecl  = $cantRec;
$fechaFin = $fechaF;
$coeficiente = $coef;
$dirAutGest = $direccionAutGest;

$dirAutGest = str_replace("'"," ",$dirAutGest);


    $url = "https://subastas.boe.es/detalleSubasta.php?idSub=SUB-JA-2015-".$j."&ver=3";
    $arrContextOptions=array(
    "ssl"=>array(
        "verify_peer"=>false,
        "verify_peer_name"=>false,
    ),
);  
    $html = file_get_html ( $url, false, stream_context_create($arrContextOptions) );
    echo "<pre>";
    echo $html;
?>

<script>
   //Ver=3
 if($(".datosSubastas").length > 0){
  var indice = $(".datosSubastas").children().children().first().next();
  var direccionBien;
  
  if(indice.children().first().text() == "Dirección"){
     direccionBien = indice.children().first().next().text(); //dirección
  }
  else{
     var i = 0;
     while(i < 30){
       indice = indice.next();
        if(indice.children().first().text() == "Dirección"){
          direccionBien = indice.children().first().next().text(); 
          i = 30;  
        }
        else{
          i++;
        }
     }
  }
  
  var codPostal = indice.next().children().first().next().text(); //codigo postal
  var localidad = indice.next().next().children().first().next().text(); //localidad
  
  location.href = 'ejecutar3?id=<?php echo $id; ?>&i=<?php echo $cont; ?>&j=<?php echo $jota; ?>&numIteraciones=<?php echo $iteraciones; ?>&localidad='+localidad+'&codPostal='+codPostal+'&direccionBien='+direccionBien+'&identif=<?php echo $identif; ?>&tasacion=<?php echo $tasacion; ?>&fechaFin=<?php echo $fechaFin; ?>&cantRecl=<?php echo $cantRecl; ?>&coeficiente=<?php echo $coeficiente; ?>&dirAutGest=<?php echo $dirAutGest; ?>';
 } 
</script>