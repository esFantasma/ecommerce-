<?php

if($_SESSION["perfil"] != "administrador"){

echo '<script>

  window.location = "inicio";

</script>';

return;

}

?>

<div class="content-wrapper">

  <section class="content-header">

    <h1>
      Gestor comercio
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Gestor comercio</li>
    
    </ol>

  </section>

  <section class="content">

    <div class="row">

      <div class="col-md-6 col-xs-12">
        
      <!--=====================================
      BLOQUE 1
      BLOCK 1
      ======================================-->
      
      <?php

        /*=============================================
        ADMINISTRACIÓN DE LOGOTIPO E ICONO
        LOGO AND ICON ADMINISTRATION
        =============================================*/

        include "comercio/logotipo.php";

        /*=====================================
        ADMINISTRAR COLORES
        MANAGE COLORS
        ======================================*/
  
        include "comercio/colores.php";

        /*=====================================
        ADMINISTRAR REDES SOCIALES
        MANAGE SOCIAL NETWORKS
        ======================================*/
  
        include "comercio/redSocial.php";
        
      ?>
      
      </div>


      <div class="col-md-6">
        
      <!--=====================================
      BLOQUE 2
      BLOCK 2
      ======================================-->

        <?php
        
       /*=====================================
        ADMINISTRAR CÓDIGOS
        MANAGE CODES
        ======================================*/
  
        include "comercio/codigos.php";

        /*=====================================
        ADMINISTRAR COMERCIO
        ADMINISTRATE COMMERCE
        ======================================*/
  
        include "comercio/informacion.php";

        ?>
   
      </div>

    </div>
 
  </section>

</div>