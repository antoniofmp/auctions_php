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

    $url = "https://subastas.boe.es/detalleSubasta.php?idSub=SUB-JA-2015-".$j."&ver=2";
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
  //Ver=2
 if($(".datosSubastas").length > 0){
  var dir = $(".datosSubastas").children().children().first().next().next().children().first().next().text();  //Dirección
  
  location.href = 'ejecutar2?id=<?php echo $id; ?>&i=<?php echo $cont; ?>&j=<?php echo $jota; ?>&numIteraciones=<?php echo $iteraciones; ?>&dir='+dir+'&identif=<?php echo $identif; ?>&tasacion=<?php echo $tasacion; ?>&fechaFin=<?php echo $fechaFin; ?>&cantRecl=<?php echo $cantRecl; ?>&coeficiente=<?php echo $coeficiente; ?>';
 } 
</script>
