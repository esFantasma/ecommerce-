/*=============================================
PLANTILLA
TEMPLATE
=============================================*/

var rutaOculta = $("#rutaOculta").val();

// Herramienta TOOLTIP
// TOOLTIP tool
$('[data-toggle="tooltip"]').tooltip(); 

$.ajax({

	url:rutaOculta+"ajax/plantilla.ajax.php",
	success:function(respuesta){

		var colorFondo = JSON.parse(respuesta).colorFondo;
		var colorTexto = JSON.parse(respuesta).colorTexto;
		var barraSuperior = JSON.parse(respuesta).barraSuperior;
		var textoSuperior = JSON.parse(respuesta).textoSuperior;
		
		$(".backColor, .backColor a").css({"background": colorFondo,
											"color": colorTexto})

		$(".barraSuperior, .barraSuperior a").css({"background": barraSuperior, 
			                                       "color": textoSuperior})

	}

})

/*=============================================
CUADRÍCULA O LISTA
GRID OR LIST
=============================================*/

var btnList = $(".btnList");
var btnGrid = $(".btnGrid");

for(var i = 0; i < btnList.length; i++){

	$(btnGrid[i]).addClass("backColor");

	$("#btnGrid"+i).click(function(){

		var numero = $(this).attr("id").substr(-1);

		$(".list"+numero).hide();
		$(".grid"+numero).show();

		$("#btnGrid"+numero).addClass("backColor");
		$("#btnList"+numero).attr("style","");
		$("#btnList"+numero).removeClass("backColor");
	})

	$("#btnList"+i).click(function(){

		var numero = $(this).attr("id").substr(-1);

		$(".list"+numero).show();
		$(".grid"+numero).hide();
		
		$("#btnList"+numero).addClass("backColor");
		$("#btnGrid"+numero).attr("style","");
		$("#btnGrid"+numero).removeClass("backColor");

	})

}

/*=============================================
EFECTOS CON EL SCROLL
EFFECTS WITH THE SCROLL
=============================================*/

$(window).scroll(function(){

	var scrollY = window.pageYOffset;

	if(window.matchMedia("(min-width:768px)").matches){

		if($(".banner").html() != null){

			if(scrollY < ($(".banner").offset().top)-150){

				$(".banner img").css({"margin-top":-scrollY/3+"px"})

			}else{

				scrollY = 0;
			}

		}

	}	
	
})

$.scrollUp({

	scrollText:"",
	scrollSpeed: 2000,
	easingType: "easeOutQuint"

});

/*=============================================
MIGAS DE PAN
BREADCRUMBS
=============================================*/

var pagActiva = $(".pagActiva").html();

if(pagActiva != null){

	var regPagActiva = pagActiva.replace(/-/g, " ");

	$(".pagActiva").html(regPagActiva);

}

/*=============================================
ENLACES PAGINACIÓN
LINKS PAGE
=============================================*/

var url = window.location.href;

var indice = url.split("/");

var pagActual =indice[5];

if(isNaN(pagActual)){

   $("#item1").addClass("active");
   
}else{

   $("#item"+pagActual).addClass("active");
 
}

/*=============================================
OFERTAS
OFFERS
=============================================*/
$(".cerrarOfertas").click(function(){

	$(this).parent().remove();

})

if($("#moduloOfertas").children().length == 0){

	$("#moduloOfertas").html(
		'<div class="jumbotron">'+

		'<h1 class="text-center">Lo sentimos</h1>'+

			'<h3 class="text-center">¡En estos momentos no hay ofertas disponibles!</h3>'+ 
				 
		'</div>'

	);
}

/*=============================================
CONTADOR DE TIEMPO
TIME COUNTER
=============================================*/

var finOferta = $(".countdown");
var fechaFinOferta = [];

for(var i = 0; i < finOferta.length; i++){

	fechaFinOferta[i] = $(finOferta[i]).attr("finOferta");

	$(finOferta[i]).dsCountDown({

	endDate: new Date(fechaFinOferta[i]),

	theme: 'flat', 

	titleDays: 'Días', 

	titleHours: 'Horas', 

	titleMinutes: 'Minutos', 

	titleSeconds: 'Segundos' 


	});


}

/*=============================================
CONTADOR DE TIEMPO OFERTAS PRODUCTOS
TIME COUNTER OFFERS PRODUCTS
=============================================*/

var finOferta2 = $('.countdown2').attr("finOferta");

$('.countdown2').dsCountDown({
	endDate: new Date(finOferta2),
	theme: 'black',
	titleDays: 'Dias', 
	titleHours: 'Horas', 
	titleMinutes: 'Min', 
	titleSeconds: 'Seg'

});


/*=============================================
EVENTOS PIXEL DE FACEBOOK
FACEBOOK PIXEL EVENTS
=============================================*/

$(".pixelCategorias").click(function(){

	var titulo = $(this).attr("titulo");

	fbq('track', 'Categoria '+titulo, {

		title: titulo

	})

})

$(".pixelSubCategorias").click(function(){

	var titulo = $(this).attr("titulo");

	fbq('track', 'Subcategoria '+titulo, {

		title: titulo

	})

})


$(".pixelOferta").click(function(){

	var titulo = $(this).attr("titulo");

	fbq('track', 'Oferta '+titulo, {

		title: titulo

	})

})
















