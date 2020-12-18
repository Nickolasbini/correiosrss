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
			alert('click');
			var file = $('#photo')[0].files[0];
			// verify size of 5MB max '45843'
			if(file['size'] < 50000){
				getBase64(file, 'myPhoto');
			}else{
				alert('Tamanho maximo do arquivo deve ser de 5MB');
			}
		}); 

		// Save New Product
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

		
		// Action to alter Product
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

		// Get value of Product Remove on Input change 
		var categoryTypeText = '';
		$(document).on('input', '#removeList', function(){
			var categoryTypeText = $(this).val();
		}); 

		// Action to remove Product
		$(document).on('click', '#removeThis', function(){
			var parameters = $('#removeList').find(':selected').val();
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
		});