<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

<?php 
include 'simple_html_dom.php';
$cont = $i;
$jota = $j;

    $url = "https://subastas.administraciondejusticia.gob.es/subastas/all_subastaPublica.do?method=getSubasta&idSubasta=10005327".$j;
    $arrContextOptions=array(
    "ssl"=>array(
        "verify_peer"=>false,
        "verify_peer_name"=>false,
    ),
);  
    $html = file_get_html ( $url, false, stream_context_create($arrContextOptions) );
    echo "<pre>";
    echo $html;
    
 $cont++;
 $jota++;

?>

<script>
  var codigoSubasta = $(".bloqueDatoSubasta").first().children().next().text();  //Codigo de la subasta

  var tasacion = $(".bloqueDatoSubasta").first().next().next().children().first().next().text(); // tasacion de la subasta
  
  location.href = "ejemplo2?i=<?php echo $cont; ?>&j=<?php echo $jota; ?>&codSub="+codigoSubasta+"&tas="+tasacion;
</script>
