<html>
<head>
	<title>Peixaria - Area do Administrador</title>

	<!-- Font Awesome -->
	<link href="resourses/fontawesome/css/all.css" rel="stylesheet">
	<link rel="shortcut icon" href="#">

	<!-- Jquery -->
	<script src="resourses/jquery/jquery-3.5.1.js"></script>
</head>
<body>

	<section class='main-admin-view'>

		<div class='side-admin-bar'>

			<ul class='side-bar-master-item'>

				<li class='admin-area-item'>
					<a class='area' title='categoria'>
						<img src="img/categoria-icon.jpg">
						Gerenciar Categorias
					</a>
				</li>

				<li class='admin-area-item'>
					<a class='area' title='produto'>
						<img src="img/produto-icon.jpg">
						Gerenciar Produtos
					</a>
				</li>

				<li class='admin-area-item'>
					<a class='area' title='promocao'>
						<img src="img/promocao-icon.jpg">
						Gerenciar Promoções
					</a>
				</li>

			</ul>

		</div>

		<div class='scene-admin'>
			<h1>
				<img class="scene-admin-icon">
			</h1>
			<h2>O que gostaria de fazer?</h2>
			<input type="radio" id="saveNew" name="option" value="save" class="selected">
			<label for="saveNew">Novo</label><br>
			<input type="radio" id="save" name="option" value="save">
			<label for="save">Alterar</label><br>
			<input type="radio" id="remove" name="option" value="remove">
			<label for="remove">Excluir</label> 

			<div id="getForm">
				<i class="fas fa-angle-right"></i>
			</div>
		</div>

		<div class='scene-admin-results'>
			
			

		</div>

	</section>

	<style type="text/css">
		.main-admin-view{
			display: flex;
		}

		.side-admin-navigationbar{
			width: 10%;
			border: 1px solid black;

		}

		.admin-area-item{
			cursor: pointer;
			margin: 20px;
			list-style-type: none;
		}
		.admin-area-item > a > img{
			width: 30px;
			height: 30px;
			border-radius: 100%;
		}

		.scene-admin{
			display: none;
			width: 80%;
			border: 1px solid black;
			height: 90%;
		}
		.scene-admin{
			text-align: center;
		}
		.scene-admin-icon{
			width: 300px;
			height: 300px;
			border-radius: 100%;
			border: 5px solid;
			border-color: 01A0C7;
		}

		#getForm{
			margin-top: 50px;
			padding: 10px;
		}
		#getForm > i{
			font-size: 30px;
		}

	</style>


	<script type="text/javascript">
		$( document ).ready(function() {
	    	$('input').removeClass('selected');
	    	$('input').prop('checked', false);
		});

		// Manage the radio button click
		$('input').on('click', function(){
			$('input').removeClass('selected');
			$(this).toggleClass('selected');
		});

		var optionChosen = '';
		$('.area').on('click', function(){
			$('input').removeClass('selected');
	    	$('input').prop('checked', false);
	    	$('.scene-admin-results').hide()
			$('.scene-admin').show();

			optionChosen = $(this).attr('title');
			$('.scene-admin-icon').attr('src', 'img/'+optionChosen+'-icon.jpg');
		});

		$('#getForm').on('click', function(){
			var action = $('input[type="radio"]:checked').attr('id');
			if(action == null){
				alert('Selecione uma opção');
			}else{
				callPage(action, optionChosen);
				$('.scene-admin').hide();
			}	
		});

		// Get list of Page Options
		function callPage(url, action){
			$.ajax({
		        type: "POST",
		        url: "Class/adminController.php",
		        data: {url: url, action: 'action-' + action + 'GetList'}, 
		        success: function(result){
		        	console.log(result);
		        	var result = JSON.parse(result);
		        	if(result['success']){
			        	$('.scene-admin-results').html(result['content']);
						$('.scene-admin-results').show();
		        	}
		        }
    		});
		}

		// Gets the Forms and Input elements
		function GetIconsAndOptions(){
			$.ajax({
		        type: "POST",
		        url: "Class/adminController.php",
		        data: {action: 'action-GetIcons&Options'}, 
		        success: function(result){
			        $('.scene-admin').html(result)
		        }
    		});
		}

		// Save New Category
		$(document).on('click', '#salvar', function(){
			var categoryName = $('#nomeCategoria').val();
			$.ajax({
		        type: "POST",
		        url: "Class/categoryController.php",
		        data: {action: 'action-save', categoryName: categoryName}, 
		        dataType: 'JSON',
		        success: function(result){
			        alert(result.content);
			        location.reload(); 
		        }
    		});
		});

		
		// Action to alter Category
		$(document).on('click', '#alterButton', function(){
			var categoryId   = $('#Categorias').find(':selected').val()
			var categoryName = $('#newNameField').val();

			$.ajax({
		        type: "POST",
		        url: "Class/categoryController.php",
		        data: {action: 'action-saveNew', categoryId: categoryId, categoryName: categoryName}, 
		        dataType: 'JSON',
		        success: function(result){
			        alert(result.content);
			        location.reload(); 
		        }
    		});				
		});

		// Action to remove Category
		$(document).on('click', '#removeThis', function(){
			var parameters = $('#removeList').find(':selected').val();
			if(!parameters){
				alert('Todas as categorias estão em uso');
			}else{
				$.ajax({
			        type: "POST",
			        url: "Class/categoryController.php",
			        data: {action: 'action-removeCategory', parameters: parameters}, 
			        dataType: 'JSON',
			        success: function(result){
				        alert(result.content);
				        location.reload(); 
			        }
	    		});
			}
		});

		// Product Controller

		/**
		*Generates base64 of file and attributes this value to informed element Id
		*
		*@param <file>   file 	   - required
		*@param <string> elementId - required 
		*
		*@return <nill> 
		*/
		function getBase64(file, elementId) {
		    var reader = new FileReader();
		    reader.readAsDataURL(file);
		    reader.onload = function () {
		    	$('#'+elementId+'').attr('src', reader.result);
		    };
		}

		// Input type file get value and set it to IMG
		$(document).on('input', '#photo', function(){
			var file = $('#photo')[0].files[0];
			// verify size of 5MB max '45843'
			console.log(file['size']);
			if(file['size'] < 3145728){
				getBase64(file, 'myPhoto');
			}else{
				alert('Tamanho maximo do arquivo deve ser de 5MB');
			}
		}); 

		// Save New Product
		$(document).on('click', '#saveProduct', function(){
			var productPhoto 	   = $('#myPhoto').attr('src');
			var productTitle 	   = $('#title').val();
			var productDescription = $('#description').val();
			var categoryId   	   = $('#categoryChoosen').find(':selected').val();
			var productPrice 	   = $('#price').val();
			
			var parameters = {
				productPhoto: productPhoto,
				productTitle: productTitle,
				productDescription: productDescription,
				categoryId: categoryId,
				productPrice: productPrice
			};
			// Verify first if the product is Numeric and is of the Currency
			// format 
			if(!productTitle || !productDescription || !categoryId || !productPrice){
				alert('Alguns campos obrigatórios estão vazios');
			}else{
				$.ajax({
			        type: "POST",
			        url: "Class/produtoController.php",
			        data: {action: 'action-save', parameters}, 
			        dataType: 'JSON',
			        success: function(result){
				        alert(result.content);
				        location.reload(); 
			        }
	    		});
			}

			
		});

		
		// Action to alter Product
		$(document).on('click', '#alterButton', function(){
			var categoryId   = $('#Categorias').find(':selected').val()
			var categoryName = $('#newNameField').val();

			$.ajax({
		        type: "POST",
		        url: "Class/produtoController.php",
		        data: {action: 'action-saveNew', categoryId: categoryId, categoryName: categoryName}, 
		        dataType: 'JSON',
		        success: function(result){
			        alert(result.content);
			        location.reload(); 
		        }
    		});				
		});

		// Action to remove Product
		$(document).on('click', '#removeThis', function(){
			var parameters = $('#removeList').find(':selected').val();
			$.ajax({
		        type: "POST",
		        url: "Class/productController.php",
		        data: {action: 'action-removeCategory', productId: parameters}, 
		        dataType: 'JSON',
		        success: function(result){
			        alert(result.content);
			        location.reload(); 
		        }
    		});
		});

	</script>

</body>
</html>