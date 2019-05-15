<!--=====================================
BANNER
======================================-->

<?php

$servidor = Ruta::ctrRutaServidor();
$url = Ruta::ctrRuta();

$ruta = $rutas[0];

$banner = ControladorProductos::ctrMostrarBanner($ruta);

date_default_timezone_set('America/Bogota');

$fecha = date('Y-m-d');
$hora = date('H:i:s');

$fechaActual = $fecha.' '.$hora;

if($banner != null){

	if($banner["estado"] != 0){

		echo '<figure class="banner">

				<img src="'.$servidor.$banner["img"].'" class="img-responsive" width="100%">';	

				if($banner["ruta"] != "sin-categoria"){

					/*=============================================
					BANNER PARA CATEGORÍAS
					BANNER FOR CATEGORIES
					=============================================*/

					if($banner["tipo"] == "categorias"){

						$item = "ruta";
						$valor = $banner["ruta"];

						$ofertas = ControladorProductos::ctrMostrarCategorias($item, $valor);

						if($ofertas["oferta"] == 1){

							echo '<div class="textoBanner textoIzq">

								<h1 style="color:#fff" class="text-uppercase">'.$ofertas["categoria"].'</h1>

							</div>

							<div class="textoBanner textoDer">
							
								<h1 style="color:#fff">OFERTAS ESPECIALES</h1>';

								if($ofertas["precioOferta"] != 0){
									
									echo '<h2 style="color:#fff"><strong>Todos los productos a $ '.$ofertas["precioOferta"].'</strong></h2>';

								}

								if($ofertas["descuentoOferta"] != 0){
								
									echo '<h2 style="color:#fff"><strong>Todos los productos con '.$ofertas["descuentoOferta"].'% OFF</strong></h2>';
								}

							echo '<h3 class="col-md-0 col-sm-0 col-xs-0" style="color:#fff">
								
								La oferta termina en<br>

								<div class="countdown2" finOferta="'.$ofertas["finOferta"].'">


							</h3>';

							$datetime1 = new DateTime($ofertas["finOferta"]);
							$datetime2 = new DateTime($fechaActual);

							$interval = date_diff($datetime1, $datetime2);

							$finOferta = $interval->format('%a');

							if($finOferta == 0){

								echo '<h3 class="col-lg-0" style="color:#fff">La oferta termina hoy</h3>';

							}else if($finOferta == 1){
		
								echo '<h3 class="col-lg-0" style="color:#fff">La oferta termina en '.$finOferta.' día</h3>';
		
							}else{
		
								echo '<h3 class="col-lg-0" style="color:#fff">La oferta termina en '.$finOferta.' días</h3>';
		
							}


							echo '</div>';

						}

					}

					/*=============================================
					BANNER PARA SUBCATEGORÍAS
					BANNER FOR SUBCATEGORIES
					=============================================*/

					if($banner["tipo"] == "subcategorias"){

						$item = "ruta";
						$valor = $banner["ruta"];

						$ofertas = ControladorProductos::ctrMostrarSubCategorias($item, $valor);

						if($ofertas[0]["oferta"] == 1){

							echo '<div class="textoBanner textoIzq">

								<h1 style="color:#fff" class="text-uppercase">'.$ofertas[0]["subcategoria"].'</h1>

							</div>

							<div class="textoBanner textoDer">
							
								<h1 style="color:#fff">OFERTAS ESPECIALES</h1>';

								if($ofertas[0]["precioOferta"] != 0){
									
									echo '<h2 style="color:#fff"><strong>Todos los productos a $ '.$ofertas[0]["precioOferta"].'</strong></h2>';

								}

								if($ofertas[0]["descuentoOferta"] != 0){
								
									echo '<h2 style="color:#fff"><strong>Todos los productos con '.$ofertas[0]["descuentoOferta"].'% OFF</strong></h2>';
								}

							echo '<h3 class="col-md-0 col-sm-0 col-xs-0" style="color:#fff">
								
								La oferta termina en<br>

								<div class="countdown2" finOferta="'.$ofertas[0]["finOferta"].'">


							</h3>';

							$datetime1 = new DateTime($ofertas[0]["finOferta"]);
							$datetime2 = new DateTime($fechaActual);

							$interval = date_diff($datetime1, $datetime2);

							$finOferta = $interval->format('%a');

							if($finOferta == 0){

								echo '<h3 class="col-lg-0" style="color:#fff">La oferta termina hoy</h3>';

							}else if($finOferta == 1){
		
								echo '<h3 class="col-lg-0" style="color:#fff">La oferta termina en '.$finOferta.' día</h3>';
		
							}else{
		
								echo '<h3 class="col-lg-0" style="color:#fff">La oferta termina en '.$finOferta.' días</h3>';
		
							}


							echo '</div>';

						}




						
					}



				}

		echo '</figure>';

	}

}

?>

<!--=====================================
BARRA PRODUCTOS
PRODUCTS BAR
======================================-->

<div class="container-fluid well well-sm barraProductos">

	<div class="container">
		
		<div class="row">

			<div class="col-sm-6 col-xs-12">
				
				<div class="btn-group">
					
					 <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">

					  Ordenar Productos <span class="caret"></span></button>

					  <ul class="dropdown-menu" role="menu">

					  <?php
					  	
						echo '<li><a href="'.$url.$rutas[0].'/1/recientes">Más reciente</a></li>
							  <li><a href="'.$url.$rutas[0].'/1/antiguos">Más antiguo</a></li>';

						?>

					  </ul>

				</div>

			</div>
			
			<div class="col-sm-6 col-xs-12 organizarProductos">

				<div class="btn-group pull-right">

					 <button type="button" class="btn btn-default btnGrid" id="btnGrid0">
					 	
						<i class="fa fa-th" aria-hidden="true"></i>  

						<span class="col-xs-0 pull-right"> GRID</span>

					 </button>

					 <button type="button" class="btn btn-default btnList" id="btnList0">
					 	
						<i class="fa fa-list" aria-hidden="true"></i> 

						<span class="col-xs-0 pull-right"> LIST</span>

					 </button>
					
				</div>		

			</div>

		</div>

	</div>

</div>

<!--=====================================
LISTAR PRODUCTOS
LIST PRODUCT
======================================-->

<div class="container-fluid productos">

	<div class="container">
		
		<div class="row">

			<!--=====================================
			BREADCRUMB O MIGAS DE PAN
			BREADCRUMB OR MIGAS OF BREAD
			======================================-->

			<ul class="breadcrumb fondoBreadcrumb text-uppercase">
				
				<li><a href="<?php echo $url;  ?>">INICIO</a></li>
				<li class="active pagActiva"><?php echo $rutas[0] ?></li>

			</ul>

			<?php

			/*=============================================
			LLAMADO DE PAGINACIÓN
			PAGING CALL
			=============================================*/

			if(isset($rutas[1]) && preg_match('/^[0-9]+$/', $rutas[1])){

				if(isset($rutas[2])){

					if($rutas[2] == "antiguos"){

						$modo = "ASC";
						$_SESSION["ordenar"] = "ASC";

					}else{

						$modo = "DESC";
						$_SESSION["ordenar"] = "DESC";

					}

				}else{

					if(isset($_SESSION["ordenar"])){

						$modo = $_SESSION["ordenar"];

					}else{

						$modo = "DESC";

					}		

				}

				$base = ($rutas[1] - 1)*12;
				$tope = 12;

			}else{

				$rutas[1] = 1;
				$base = 0;
				$tope = 12;
				$modo = "DESC";
				$_SESSION["ordenar"] = "DESC";

			}

			/*=============================================
			LLAMADO DE PRODUCTOS DE CATEGORÍAS, SUBCATEGORÍAS Y DESTACADOS
			CALLING CATEGORIES, SUBCATEGORIES AND HIGHLIGHTS PRODUCTS
			=============================================*/

			if($rutas[0] == "articulos-gratis"){

				$item2 = "precio";
				$valor2 = 0;
				$ordenar = "id";

			}else if($rutas[0] == "lo-mas-vendido"){

				$item2 = null;
				$valor2 = null;
				$ordenar = "ventas";

			}else if($rutas[0] == "lo-mas-visto"){

				$item2 = null;
				$valor2 = null;
				$ordenar = "vistas";

			}else{

				$ordenar = "id";
				$item1 = "ruta";
				$valor1 = $rutas[0];

				$categoria = ControladorProductos::ctrMostrarCategorias($item1, $valor1);

				if(!$categoria){

					$subCategoria = ControladorProductos::ctrMostrarSubCategorias($item1, $valor1);

					$item2 = "id_subcategoria";
					$valor2 = $subCategoria[0]["id"];

				}else{

					$item2 = "id_categoria";
					$valor2 = $categoria["id"];

				}
			}	

			

			$productos = ControladorProductos::ctrMostrarProductos($ordenar, $item2, $valor2, $base, $tope, $modo);
			$listaProductos = ControladorProductos::ctrListarProductos($ordenar, $item2, $valor2);


			if(!$productos){

				echo '<div class="col-xs-12 error404 text-center">

						 <h1><small>¡Oops!</small></h1>

						 <h2>Aún no hay productos en esta sección</h2>

					</div>';

			}else{

				echo '<ul class="grid0">';

					foreach ($productos as $key => $value) {

					if($value["estado"] != 0){
					
						echo '<li class="col-md-3 col-sm-6 col-xs-12">

							<figure>
								
								<a href="'.$url.$value["ruta"].'" class="pixelProducto">
									
									<img src="'.$servidor.$value["portada"].'" class="img-responsive">

								</a>

							</figure>

							<h4>
					
								<small>
									
									<a href="'.$url.$value["ruta"].'" class="pixelProducto">
										
										'.$value["titulo"].'<br>

										<span style="color:rgba(0,0,0,0)">-</span>';

										$fecha = date('Y-m-d');
										$fechaActual = strtotime('-30 day', strtotime($fecha));
										$fechaNueva = date('Y-m-d', $fechaActual);

										if($fechaNueva < $value["fecha"]){

											echo '<span class="label label-warning fontSize">Nuevo</span> ';

										}

										if($value["oferta"] != 0 && $value["precio"] != 0){

											echo '<span class="label label-warning fontSize">'.$value["descuentoOferta"].'% off</span>';

										}

									echo '</a>	

								</small>			

							</h4>

							<div class="col-xs-6 precio">';

							if($value["precio"] == 0){

								echo '<h2><small>GRATIS</small></h2>';

							}else{

								if($value["oferta"] != 0){

									echo '<h2>

											<small>
						
												<strong class="oferta">USD $'.$value["precio"].'</strong>

											</small>

											<small>$'.$value["precioOferta"].'</small>
										
										</h2>';

								}else{

									echo '<h2><small>USD $'.$value["precio"].'</small></h2>';

								}
								
							}
											
							echo '</div>

							<div class="col-xs-6 enlaces">
								
								<div class="btn-group pull-right">
									
									<button type="button" class="btn btn-default btn-xs deseos" idProducto="'.$value["id"].'" data-toggle="tooltip" title="Agregar a mi lista de deseos">
										
										<i class="fa fa-heart" aria-hidden="true"></i>

									</button>';

									if($value["tipo"] == "virtual" && $value["precio"] != 0){

										if($value["oferta"] != 0){

											echo '<button type="button" class="btn btn-default btn-xs agregarCarrito"  idProducto="'.$value["id"].'" imagen="'.$servidor.$value["portada"].'" titulo="'.$value["titulo"].'" precio="'.$value["precioOferta"].'" tipo="'.$value["tipo"].'" peso="'.$value["peso"].'" data-toggle="tooltip" title="Agregar al carrito de compras">

											<i class="fa fa-shopping-cart" aria-hidden="true"></i>

											</button>';

										}else{

											echo '<button type="button" class="btn btn-default btn-xs agregarCarrito"  idProducto="'.$value["id"].'" imagen="'.$servidor.$value["portada"].'" titulo="'.$value["titulo"].'" precio="'.$value["precio"].'" tipo="'.$value["tipo"].'" peso="'.$value["peso"].'" data-toggle="tooltip" title="Agregar al carrito de compras">

											<i class="fa fa-shopping-cart" aria-hidden="true"></i>

											</button>';

										}

									}

									echo '<a href="'.$url.$value["ruta"].'" class="pixelProducto">
									
										<button type="button" class="btn btn-default btn-xs" data-toggle="tooltip" title="Ver producto">
											
											<i class="fa fa-eye" aria-hidden="true"></i>

										</button>	
									
									</a>

								</div>

							</div>

						</li>';

					}
				}

				echo '</ul>

				<ul class="list0" style="display:none">';

				foreach ($productos as $key => $value) {

					if($value["estado"] != 0){

						echo '<li class="col-xs-12">
					  
				  		<div class="col-lg-2 col-md-3 col-sm-4 col-xs-12">
							   
							<figure>
						
								<a href="'.$url.$value["ruta"].'" class="pixelProducto">
									
									<img src="'.$servidor.$value["portada"].'" class="img-responsive">

								</a>

							</figure>

					  	</div>  	
							  
						<div class="col-lg-10 col-md-7 col-sm-8 col-xs-12">
							
							<h1>

								<small>
		
									<a href="'.$url.$value["ruta"].'" class="pixelProducto">
										
										'.$value["titulo"].'<br>';

										$fecha = date('Y-m-d');
										$fechaActual = strtotime('-30 day', strtotime($fecha));
										$fechaNueva = date('Y-m-d', $fechaActual);

										if($fechaNueva < $value["fecha"]){

											echo '<span class="label label-warning">Nuevo</span> ';

										}

										if($value["oferta"] != 0 && $value["precio"] != 0){

											echo '<span class="label label-warning">'.$value["descuentoOferta"].'% off</span>';

										}		

									echo '</a>

								</small>

							</h1>

							<p class="text-muted">'.$value["titular"].'</p>';

							if($value["precio"] == 0){

								echo '<h2><small>GRATIS</small></h2>';

							}else{

								if($value["oferta"] != 0){

									echo '<h2>

											<small>
						
												<strong class="oferta">USD $'.$value["precio"].'</strong>

											</small>

											<small>$'.$value["precioOferta"].'</small>
										
										</h2>';

								}else{

									echo '<h2><small>USD $'.$value["precio"].'</small></h2>';

								}
								
							}

							echo '<div class="btn-group pull-left enlaces">
						  	
						  		<button type="button" class="btn btn-default btn-xs deseos"  idProducto="'.$value["id"].'" data-toggle="tooltip" title="Agregar a mi lista de deseos">

						  			<i class="fa fa-heart" aria-hidden="true"></i>

						  		</button>';

						  		if($value["tipo"] == "virtual" && $value["precio"] != 0){

										if($value["oferta"] != 0){

											echo '<button type="button" class="btn btn-default btn-xs agregarCarrito"  idProducto="'.$value["id"].'" imagen="'.$servidor.$value["portada"].'" titulo="'.$value["titulo"].'" precio="'.$value["precioOferta"].'" tipo="'.$value["tipo"].'" peso="'.$value["peso"].'" data-toggle="tooltip" title="Agregar al carrito de compras">

											<i class="fa fa-shopping-cart" aria-hidden="true"></i>

											</button>';

										}else{

											echo '<button type="button" class="btn btn-default btn-xs agregarCarrito"  idProducto="'.$value["id"].'" imagen="'.$servidor.$value["portada"].'" titulo="'.$value["titulo"].'" precio="'.$value["precio"].'" tipo="'.$value["tipo"].'" peso="'.$value["peso"].'" data-toggle="tooltip" title="Agregar al carrito de compras">

											<i class="fa fa-shopping-cart" aria-hidden="true"></i>

											</button>';

										}

									}

						  		echo '<a href="'.$url.$value["ruta"].'" class="pixelProducto">

							  		<button type="button" class="btn btn-default btn-xs" data-toggle="tooltip" title="Ver producto">

							  		<i class="fa fa-eye" aria-hidden="true"></i>

							  		</button>

						  		</a>
							
							</div>

						</div>

						<div class="col-xs-12"><hr></div>

					</li>';

					}

				}

				echo '</ul>';
			}

			?>

			<div class="clearfix"></div>

			<center>

			<!--=====================================
			PAGINACIÓN
			PAGINATION
			======================================-->
			
			<?php

				if(count($listaProductos) != 0){

					$pagProductos = ceil(count($listaProductos)/12);

					if($pagProductos > 4){

						/*=============================================
						LOS BOTONES DE LAS PRIMERAS 4 PÁGINAS Y LA ÚLTIMA PÁG
						THE BUTTONS OF THE FIRST 4 PAGES AND THE LAST PAGE
						=============================================*/

						if($rutas[1] == 1){

							echo '<ul class="pagination">';
							
							for($i = 1; $i <= 4; $i ++){

								echo '<li id="item'.$i.'"><a href="'.$url.$rutas[0].'/'.$i.'">'.$i.'</a></li>';

							}

							echo ' <li class="disabled"><a>...</a></li>
								   <li id="item'.$pagProductos.'"><a href="'.$url.$rutas[0].'/'.$pagProductos.'">'.$pagProductos.'</a></li>
								   <li><a href="'.$url.$rutas[0].'/2"><i class="fa fa-angle-right" aria-hidden="true"></i></a></li>

							</ul>';

						}

						/*=============================================
						LOS BOTONES DE LA MITAD DE PÁGINAS HACIA ABAJO
						THE BUTTONS OF THE HALF OF PAGES DOWN
						=============================================*/

						else if($rutas[1] != $pagProductos && 
							    $rutas[1] != 1 &&
							    $rutas[1] <  ($pagProductos/2) &&
							    $rutas[1] < ($pagProductos-3)
							    ){

								$numPagActual = $rutas[1];

								echo '<ul class="pagination">
									  <li><a href="'.$url.$rutas[0].'/'.($numPagActual-1).'"><i class="fa fa-angle-left" aria-hidden="true"></i></a></li> ';
							
								for($i = $numPagActual; $i <= ($numPagActual+3); $i ++){

									echo '<li id="item'.$i.'"><a href="'.$url.$rutas[0].'/'.$i.'">'.$i.'</a></li>';

								}

								echo ' <li class="disabled"><a>...</a></li>
									   <li id="item'.$pagProductos.'"><a href="'.$url.$rutas[0].'/'.$pagProductos.'">'.$pagProductos.'</a></li>
									   <li><a href="'.$url.$rutas[0].'/'.($numPagActual+1).'"><i class="fa fa-angle-right" aria-hidden="true"></i></a></li>

								</ul>';

						}

						/*=============================================
						LOS BOTONES DE LA MITAD DE PÁGINAS HACIA ARRIBA
						THE BUTTONS OF THE HALF OF PAGES UP
						=============================================*/

						else if($rutas[1] != $pagProductos && 
							    $rutas[1] != 1 &&
							    $rutas[1] >=  ($pagProductos/2) &&
							    $rutas[1] < ($pagProductos-3)
							    ){

								$numPagActual = $rutas[1];
							
								echo '<ul class="pagination">
								   <li><a href="'.$url.$rutas[0].'/'.($numPagActual-1).'"><i class="fa fa-angle-left" aria-hidden="true"></i></a></li> 
								   <li id="item1"><a href="'.$url.$rutas[0].'/1">1</a></li>
								   <li class="disabled"><a>...</a></li>
								';
							
								for($i = $numPagActual; $i <= ($numPagActual+3); $i ++){

									echo '<li id="item'.$i.'"><a href="'.$url.$rutas[0].'/'.$i.'">'.$i.'</a></li>';

								}


								echo '  <li><a href="'.$url.$rutas[0].'/'.($numPagActual+1).'"><i class="fa fa-angle-right" aria-hidden="true"></i></a></li>
									</ul>';
						}

						/*=============================================
						LOS BOTONES DE LAS ÚLTIMAS 4 PÁGINAS Y LA PRIMERA PÁG
						THE BUTTONS OF THE LAST 4 PAGES AND THE FIRST PAGE
						=============================================*/

						else{

							$numPagActual = $rutas[1];

							echo '<ul class="pagination">
								   <li><a href="'.$url.$rutas[0].'/'.($numPagActual-1).'"><i class="fa fa-angle-left" aria-hidden="true"></i></a></li> 
								   <li id="item1"><a href="'.$url.$rutas[0].'/1">1</a></li>
								   <li class="disabled"><a>...</a></li>
								';
							
							for($i = ($pagProductos-3); $i <= $pagProductos; $i ++){

								echo '<li id="item'.$i.'"><a href="'.$url.$rutas[0].'/'.$i.'">'.$i.'</a></li>';

							}

							echo ' </ul>';

						}

					}else{

						echo '<ul class="pagination">';
						
						for($i = 1; $i <= $pagProductos; $i ++){

							echo '<li id="item'.$i.'"><a href="'.$url.$rutas[0].'/'.$i.'">'.$i.'</a></li>';

						}

						echo '</ul>';

					}

				}

			?>

			</center>

</div>

</div>

</div>