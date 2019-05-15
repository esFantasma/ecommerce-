<div class="content-wrapper">

  <section class="content-header">

    <h1>
      Gestor Subcategorías
    </h1>

    <ol class="breadcrumb">

      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>

      <li class="active">Gestor Subcategorías</li>

    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">
  
        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarSubCategoria">
          
          Agregar subcategoría

        </button>

      </div>

      <div class="box-body">
        
       <table class="table table-bordered table-striped dt-responsive tablaSubCategorias" width="100%">
         
        <thead>
         
         <tr>
           
           <th style="width:10px">#</th>
           <th>Subcategoria</th>
           <th>Categoria</th>
           <th>Ruta</th>
           <th>Estado</th>
           <th>Descripción</th>
           <th>Palabras claves</th>
           <th>Portada</th>
           <th>Tipo de Oferta</th>
           <th>Valor Oferta</th>
           <th>Imagen Oferta</th>
           <th>Fin Oferta</th>
           <th>Acciones</th>

         </tr> 

        </thead>

       </table>

      </div>

    </div>

  </section>

</div>

<!--=====================================
MODAL AGREGAR SUBCATEGORÍA
MODAL ADD SUBCATEGORY
======================================-->

<div id="modalAgregarSubCategoria" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        MODAL HEAD
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar subcategoría</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        MODAL BODY
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!--=====================================
            ENTRADA PARA EL NOMBRE DE LA SUBCATEGORÍA
            ENTRY FOR THE NAME OF THE SUBCATEGORY
            ======================================-->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                <input type="text" class="form-control input-lg validarSubCategoria tituloSubCategoria" name="tituloSubCategoria" placeholder="Ingresar subcategoría" required>

              </div>

            </div>

            <!--=====================================
            ENTRADA PARA LA RUTA DE LA SUBCATEGORÍA
            ENTRY FOR THE SUBCATEGORY ROUTE
            ======================================-->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-link"></i></span> 

                <input type="text" class="form-control input-lg rutaSubCategoria" name="rutaSubCategoria" placeholder="Ruta url de la subcategoría" readonly required>

              </div>

            </div>

            <!--=====================================
            ENTRADA PARA SELECCIONAR LA CATEGORÍA
            ENTRY TO SELECT THE CATEGORY
            ======================================-->

            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                <select class="form-control input-lg seleccionarCategoria" name="seleccionarCategoria" required>
                  
                  <option value="">Selecionar categoría</option>

                  <?php

                  $item = null;
                  $valor = null;

                  $categorias = ControladorCategorias::ctrMostrarCategorias($item, $valor);

                  foreach ($categorias as $key => $value) {
                    
                    echo '<option value="'.$value["id"].'">'.$value["categoria"].'</option>';
                  }

                  ?>
  
                </select>

              </div>

            </div>

            <!--=====================================
            ENTRADA PARA LA DESCRIPCION
            ENTRY FOR THE DESCRIPTION
            ======================================-->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-pencil"></i></span> 

                <textarea type="text" maxlength="120" class="form-control input-lg"  name="descripcionSubCategoria" rows="3" placeholder="Ingresar descripción subcategoría" required></textarea>

              </div>

            </div>

            <!--=====================================
            ENTRADA PARA LAS PALABRAS CLAVES
            ENTRY FOR THE KEYWORDS
            ======================================-->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-key"></i></span> 

                <input type="text" class="form-control input-lg tagsInput" data-role="tagsinput"  name="pClavesSubCategoria" placeholder="Ingresar palabras claves" required>

              </div>

            </div>

            <!--=====================================
            ENTRADA PARA SUBIR LA FOTO DE PORTADA
            ENTRY TO RAISE THE COVER PHOTO
            ======================================-->

            <div class="form-group">
              
              <div class="panel">SUBIR FOTO PORTADA</div>

              <input type="file" class="fotoPortada" name="fotoPortada">

              <p class="help-block">Tamaño recomendado 1280px * 720px <br> Peso máximo de la foto 2MB</p>

              <img src="vistas/img/cabeceras/default/default.jpg" class="img-thumbnail previsualizarPortada" width="100%">

            </div>

            <!--=====================================
            ENTRADA PARA LA OFERTA
            ENTRY FOR THE OFFER
            ======================================-->
            
            <div class="form-group">
              
              <select class="form-control input-lg selActivarOferta" name="selActivarOferta">
                
                <option value="">No tiene oferta</option>
                <option value="oferta">Activar oferta</option>
               
              </select>

            </div>

           <div class="datosOferta" style="display:none">

              <!--=====================================
              VALOR DE LA OFERTA
              VALUE OF THE OFFER
              ======================================-->
              
              <div class="form-group row">
                
                <div class="col-xs-6">

                  <div class="input-group">
                
                    <span class="input-group-addon"><i class="ion ion-social-usd"></i></span> 
                    <input class="form-control input-lg valorOferta" type="number" value="0" id="precioOferta" name="precioOferta" min="0" placeholder="Precio">

                  </div>

                </div>

                 <div class="col-xs-6">
                   
                   <div class="input-group">
                     
                    <input class="form-control input-lg valorOferta" type="number" value="0" id="descuentoOferta" name="descuentoOferta" min="0" placeholder="Descuento">
                    <span class="input-group-addon"><i class="fa fa-percent"></i></span>

                  </div>

                </div>

              </div>

              <!--=====================================
              FECHA DE LA OFERTA
              DATE OF THE OFFER
              ======================================-->

              <div class="form-group">
                
                <div class="input-group date">
                    
                    <input type='text' class="form-control datepicker input-lg valorOferta" name="finOferta">
                    
                    <span class="input-group-addon">
                        
                        <span class="glyphicon glyphicon-calendar"></span>
                    
                    </span>
               
                </div>
            
              </div>

              <!--=====================================
              ENTRADA PARA LA FOTO DE LA OFERTA
              ENTRY FOR THE PHOTO OF THE OFFER
              ======================================-->

               <div class="form-group">
                
                <div class="panel">SUBIR FOTO OFERTA</div>

                <input type="file" class="fotoOferta valorOferta" name="fotoOferta">

                <p class="help-block">Tamaño recomendado 640px * 430px <br> Peso máximo de la foto 2MB</p>

                <img src="vistas/img/ofertas/default/default.jpg" class="img-thumbnail previsualizarOferta" width="100px">

              </div>

            </div>
  
          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        FOOT OF THE MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar subcategoría</button>

        </div>

         <?php

          $crearSubCategoria = new ControladorSubCategorias();
          $crearSubCategoria -> ctrCrearSubCategoria();

        ?>

      </form>

    </div>

  </div>

</div>

<!--=====================================
MODAL EDITAR SUBCATEGORÍA
MODAL EDIT SUBCATEGORÍA
======================================-->

<div id="modalEditarSubCategoria" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        MODAL HEAD
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Editar subcategoría</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        MODAL BODY
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!--=====================================
            ENTRADA PARA EDITAR EL TITULO DE LA SUBCATEGORÍA
            ENTRY TO EDIT THE TITLE OF THE SUBCATEGORY
            ======================================-->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                <input type="text" class="form-control input-lg validarSubCategoria tituloSubCategoria"  name="editarTituloSubCategoria" required>

                <input type="hidden" class="editarIdSubCategoria" name="editarIdSubCategoria">
                <input type="hidden" class="editarIdCabecera" name="editarIdCabecera">

              </div>

            </div>

            <!--=====================================
            ENTRADA PARA EDITAR LA RUTA DE LA SUBCATEGORÍA
            ENTRY TO EDIT THE ROUTE OF THE SUBCATEGORY
            ======================================-->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-link"></i></span> 

                <input type="text" class="form-control input-lg rutaSubCategoria" name="rutaSubCategoria" readonly required>

              </div>

            </div>

            <!--=====================================
            ENTRADA PARA EDITAR LA SELECCIÓN DE LA CATEGORÍA
            ENTRY TO EDIT THE SELECTION OF THE CATEGORY
            ======================================-->

            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                <select class="form-control input-lg seleccionarCategoria" name="seleccionarCategoria" required>
                  
                  <option class="optionEditarCategoria"></option>

                  <?php

                  $item = null;
                  $valor = null;

                  $categorias = ControladorCategorias::ctrMostrarCategorias($item, $valor);

                  foreach ($categorias as $key => $value) {
                    
                    echo '<option value="'.$value["id"].'">'.$value["categoria"].'</option>';
                  }

                  ?>
  
                </select>

              </div>

            </div>

            <!--=====================================
            ENTRADA PARA EDITAR LA DESCRIPCIÓN
            ENTRY TO EDIT THE DESCRIPTION
            ======================================-->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-pencil"></i></span> 

                <textarea type="text" maxlength="120" class="form-control input-lg descripcionSubCategoria"  name="descripcionSubCategoria" required></textarea>

               

              </div>

            </div>

            <!--=====================================
            ENTRADA PARA EDITAR LAS PALABRAS CLAVES
            ENTRY TO EDIT THE KEYWORDS
            ======================================-->
            
            <div class="form-group editarPalabrasClaves">
            

            </div>

            <!--=====================================
            ENTRADA PARA EDITAR LA FOTO DE PORTADA
            ENTRY TO EDIT THE COVER PHOTO
            ======================================-->

            <div class="form-group">
              
              <div class="panel">SUBIR FOTO PORTADA</div>

              <input type="file" class="fotoPortada" name="fotoPortada">
              <input type="hidden" class="antiguaFotoPortada" name="antiguaFotoPortada">

              <p class="help-block">Tamaño recomendado 1280px * 720px <br> Peso máximo de la foto 2MB</p>

              <img src="vistas/img/cabeceras/default/default.jpg" class="img-thumbnail previsualizarPortada" width="100%">

            </div>

            <!--=====================================
            ENTRADA PARA EDITAR LA OFERTA
            ENTRY TO EDIT THE OFFER
            ======================================-->
            
            <div class="form-group">
              
              <select class="form-control input-lg selActivarOferta" name="selActivarOferta">
                
                <option value="">No tiene oferta</option>
                <option value="oferta">Activar oferta</option>
               
              </select>

            </div>

           <div class="datosOferta" style="display:none">

              <!--=====================================
              ENTRADA PARA EDITAR EL TIPO DE OFERTA
              ENTRY TO EDIT THE TYPE OF OFFER
              ======================================-->
              
              <div class="form-group row">
                
                <div class="col-xs-6">

                  <div class="input-group">
                
                    <span class="input-group-addon"><i class="ion ion-social-usd"></i></span> 
                    <input class="form-control input-lg valorOferta" type="number" value="0" id="precioOferta" name="precioOferta" min="0" placeholder="Precio">

                  </div>

                </div>

                 <div class="col-xs-6">
                   
                   <div class="input-group">
                     
                    <input class="form-control input-lg valorOferta" type="number" value="0" id="descuentoOferta" name="descuentoOferta" min="0" placeholder="Descuento">
                    <span class="input-group-addon"><i class="fa fa-percent"></i></span>

                  </div>

                </div>

              </div>

              <!--=====================================
              ENTRADA PARA EDITAR LA FECHA DE LA OFERTA
              ENTRY TO EDIT THE DATE OF THE OFFER
              ======================================-->

              <div class="form-group">
                
                <div class="input-group date">
                    
                    <input type='text' class="form-control datepicker input-lg valorOferta finOferta" name="finOferta">
                    
                    <span class="input-group-addon">
                        
                        <span class="glyphicon glyphicon-calendar"></span>
                    
                    </span>
               
                </div>
            
            </div>

               <!--=====================================
              ENTRADA PARA EDITAR LA FOTO DE LA OFERTA
              ENTRY TO EDIT THE PHOTO OF THE OFFER
              ======================================-->

               <div class="form-group">
                
                <div class="panel">SUBIR FOTO OFERTA</div>

                <input type="file" class="fotoOferta" name="fotoOferta">
                <input type="hidden" class="antiguaFotoOferta" name="antiguaFotoOferta">

                <p class="help-block">Tamaño recomendado 640px * 430px <br> Peso máximo de la foto 2MB</p>

                <img src="vistas/img/ofertas/default/default.jpg" class="img-thumbnail previsualizarOferta" width="100px">

              </div>

            </div>
  
          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        FOOT OF THE MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar cambios</button>

        </div>

         <?php

            $crearCategoria = new ControladorSubCategorias();
            $crearCategoria -> ctrEditarSubCategoria();

        ?>

      </form>

    </div>

  </div>

</div>

<?php

  $eliminarCategoria = new ControladorSubCategorias();
  $eliminarCategoria -> ctrEliminarSubCategoria();

?>

<script>
  
$(document).keydown(function(e){
  
  if(e.keyCode == 13){

    e.preventDefault();

  }

})

</script>
