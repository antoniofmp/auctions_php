<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

<?php 
include 'simple_html_dom.php';
$cont = $i; // varia el num de iteraciones
$jota = $j; //varia en la url (el codigo de la subasta)
$iteraciones = $numIteraciones; 

    $url = "https://subastas.boe.es/detalleSubasta.php?idSub=SUB-JA-2015-".$j."&ver=1";
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
  //Ver=1
 if($(".datosSubastas").length > 0 && $(".advertencia").length == 0){
  var indice = $(".datosSubastas").children().children().first().next();
  var indice2 = $(".datosSubastas").children().children().first().next();
  
  if(indice.next().children().first().text() == "Fecha de finalización"){
   var fechaFin = $(".datosSubastas").children().children().first().next().next().children().first().next().text();
  
   var fecha = fechaFin.substring(0, 19).trim();
   var di = fecha.substring(0, 2);
   var mes = fecha.substring(3, 5);
   var anio = fecha.substring(6, 10);
   fecha = di +'/'+mes+'/'+anio;
  
   var today = new Date();
   var dd = today.getDate();
   var mm = today.getMonth()+1; //January is 0!

   var yyyy = today.getFullYear();
   if(dd<10){
       dd='0'+dd
   } 
   var d = 0;
   if(mm==1 || mm==3 || mm==5 || mm==7 || mm==8 || mm==10 || mm==12){
     d = 31 - dd;
   }
   else{
     d = 30 - dd;  
   }
   var m = mm+1; //nuevo mes
   var y = yyyy; //año
   
   if(m == 13){ //año si mes siguiente es enero  (nmalo)
     m = '01'; //mes enero
     y = yyyy+1; //nuevo año si mes siguiente es enero
   }
   else if(m<10){
     m = '0'+m;  
   }
   
   var dia = 40 - d;
   
   var luego = dia+'/'+m+'/'+y;  //40 dias despues
   
   var partes1 = fecha.split("/");
   var d1 = new Date(partes1[2], partes1[1]-1, partes1[0]);
   
   var partes2 = luego.split("/");
   var d2 = new Date(partes2[2], partes2[1]-1, partes2[0]);
  
   if(d1 <= d2){ //si la fecha de la subasta es menor que la fecha de aqui a 40 dias (esta comp esta mala)
     var identificador = $(".datosSubastas").children().children().children().first().next().children().text();
     var cantRecl;
     var valorSub;
     
     if(indice.next().next().children().first().text() == "Cantidad reclamada"){
       cantRecl = indice.next().next().children().first().next().text();
     }
     else{
       var i = 0;
       while(i < 30){
        indice = indice.next();
         if(indice.next().next().children().first().text() == "Cantidad reclamada"){
           cantRecl = indice.next().next().children().first().next().text();
          i = 30;  
         }
         else{
          i++;
         }
       }
     }
     
     if(indice2.next().next().next().next().next().children().first().text() == "Valor subasta"){
       var valorSub = indice2.next().next().next().next().next().children().first().next().text(); //Es lo que era antes la tasacion
     }
     else{
       var j = 0;
       while(j < 30){
        indice2 = indice2.next();
         if(indice2.next().next().next().next().next().children().first().text() == "Valor subasta"){
           var valorSub = indice2.next().next().next().next().next().children().first().next().text(); //Es lo que era antes la tasacion
          j = 30;  
         }
         else{
          j++;
         }
       }
     }
     
     location.href = 'ejecutar1?i=<?php echo $cont; ?>&j=<?php echo $jota; ?>&numIteraciones=<?php echo $iteraciones; ?>&ident='+identificador+'&valorSub='+valorSub+'&cantRecl='+cantRecl+'&fechaFin='+fechaFin;
   }
   else{
      var cont1 = <?php echo $cont; ?>;
      var jota1 = <?php echo $jota; ?>;
      var numIteraciones1 = <?php echo $iteraciones; ?>;
   
      cont1 = cont1 + 1; 
      jota1 = jota1 + 1;
      location.href = 'ejecutarExec?i='+cont1+'&j='+jota1+'&numIteraciones='+numIteraciones1;  
    }
   }
   else{
    var cont2 = <?php echo $cont; ?>;
    var jota2 = <?php echo $jota; ?>;
    var numIteraciones2 = <?php echo $iteraciones; ?>;
    
    cont2 = cont2 + 1;
    jota2 = jota2 + 1;
    location.href = 'ejecutarExec?i='+cont2+'&j='+jota2+'&numIteraciones='+numIteraciones2;
   }
 }
 else{ //no existe o ya esta concluida la subasta
   var cont3 = <?php echo $cont; ?>;
   var jota3 = <?php echo $jota; ?>;
   var numIteraciones3 = <?php echo $iteraciones; ?>;
   
   cont3 = cont3 + 1;
   jota3 = jota3 + 1;
   location.href = 'ejecutarExec?i='+cont3+'&j='+jota3+'&numIteraciones='+numIteraciones3;
 }
</script>
