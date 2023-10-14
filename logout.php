<?php
  session_start();

  session_destroy();
  session_unset();
  echo "<script>toastr.warning('Adios');</script>";
  //header("Location: index.php");
?>

            <script text=javascript> 
            var pagina = 'index.php';
             var segundos = 1;
            function redireccion() {document.location.href=pagina;}
            setTimeout("redireccion()",segundos*500); 
           //location.href = 'index.php';</script>


 