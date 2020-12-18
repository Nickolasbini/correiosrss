
<html>
<head>
	<title>Peixaria Claudia Pescados</title>

	<!-- Font Awesome -->
	<link href="resourses/fontawesome/css/all.css" rel="stylesheet">
	<link rel="shortcut icon" href="#">

	<!-- Jquery -->
	<script src="resourses/jquery/jquery-3.5.1.js"></script>
</head>
<body>

	<?php require_once('views/header.php'); ?>


	<?php require_once('views/promotions.php'); ?>


	<?php require_once('views/footer.php'); ?>

	<style type="text/css">
	body{
		overflow-x: hidden;
	}

	.disabled{
		display: none;
	}

	</style>

	<script type="text/javascript">
		$( document ).ready(function() {

	    	//loadPromotions();
		});

		var promotionsContent = [];
		function setPromotionsContent(arrayValue){
			promotionsContent = arrayValue;
		};

		function loadPromotions(){
			 $.ajax({
		        type: "POST",
		        url: "Class/promocao.php",
		        data: {action: 'getPromotions'}, 
		        success: function(result){
		        	var content = result;
		        	//var content = JSON.parse(result);
		        	if(content['success'] == true){
		        		setPromotionsContent(content['content']);
		        		showPromotions();
		        	}else{
		        		$('#preview-img').attr('src', '');
		        		$('#preview-img').html('Nenhuma promoção');
		        	}
		        }
    		});
		}

		function showPromotions(){
				setInterval(function(){
					if(b == 2){
						b = 0;
					}					
					// here it'll change the photo
					
					$('#preview-img').attr('src', './img/'+a[b]);
					b++;
					console.log('he')
			    } , 6000);
		}
		

	</script>

	
</body>
</html>