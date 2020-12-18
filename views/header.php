<header>
	<div id='homepage' class='logo'>
		<img src="img/logo.png">
		<h1>Peixaria Claudia Pescadaos</h1>
	</div>

	<div class='navigation-bar'>
		<a id='navigation-side-menu-icon' class='navigation-side-menu' title='Abrir menu'>
			<span ><i class="fas fa-bars"></i></span>
		</a>
		<ul class='navigation-bar-group'>
			<li class='navigation-bar-item'>
				<a class='navigation-bar-link'>
					Inicio
				</a>
			</li>
			<li class='navigation-bar-item'>
				<div class="dropdown">
					<a class="dropbtn" title='Selecione umas das opções abaixo'>O que procura?</a>
				    <div class="dropdown-content">
					    <a id='selected-products' class='navigation-bar-link-select'>
					    	<img src="./img/produto-icon.jpg"> Produtos
					    </a>
					    <a id='selected-recipe' class='navigation-bar-link-select'>
					    	<img src="./img/receita-icon.jpeg"> Receitas
					    </a>
					    <a id='selected-tips' class='navigation-bar-link-select'>
					    	<img src="./img/dicas-icon.jpeg"> Dicas
					    </a>
				    </div>
				</div> 
			</li>
			<li class='navigation-bar-item'>
				<a class='navigation-bar-link'>
					Endereço
				</a>
			</li>
			<li class='navigation-bar-item'>
				<a class='navigation-bar-link'>
					Quem Somos
				</a>
			</li>
			<li class='navigation-bar-item'>
				<a id='go-contact' class='navigation-bar-link'>
					Contato
				</a>
			</li>
			
		</ul>
	</div>
</header>

<style>
	header{
		display: flex;
		padding: 5px;
	}
	.logo{
		width: 30%;
		text-align: center;
	}
	.logo>h1{
		font-weight: lighter;
	}

	.navigation-bar{
		margin-top: auto;
		margin-bottom: auto;
		margin-left: auto;
		margin-right: auto;
	}
	.navigation-bar-group{
		display: inline-flex;
	}
	.navigation-bar-item{
		list-style-type: none;
		margin: 10px;
	}
	.navigation-bar-link{
		cursor: pointer;
		font-size: 20px;
	}

	.navigation-side-menu{
		display: none;
	}

	/* Generic classes */
	
	.open{
		background-color: 01A0C7;
		margin-top: 20px;
		border-radius: 0px 10px 10px 0px;
		height: 80%;
	}
	.open>.navigation-bar-group{
		display: block;
		margin-top:50%;
		color: white;
	}
	.open>.navigation-bar-group>.navigation-bar-item{
		margin: 20px;
	}
	.open>.navigation-bar-group>.navigation-bar-item>.navigation-bar-link{
		font-size: 20px;
	}

	.selected{
		color: white;
	}
	@media screen and (max-width: 850px) {
		header{
			display: block;
		}
		.logo{
			width: unset;
		}
		
		/* Construct Dropwdown Menu */  
		.navigation-bar-link{
			font-size: 10px;
		}
		.navigation-bar{
			margin-top: unset;
			margin-bottom: unset;
			margin-left: unset;
			margin-right: unset;
			position: absolute;
			top: 0;
			left: 0;
			padding: 20px 20px 20px 0;
		}
		.navigation-bar-group{
			display: none;
		}

		.navigation-side-menu{
			display: block;
		}

		.fa-bars{
			font-size: 30px;
			position: absolute;
			margin-left: 20px;
			cursor: pointer;
		}
	}

	@media screen and (max-width: 350px) {
		.fa-bars{
			font-size: 20px;
			padding: 20px 20px 20px 0;
		}
	}

	/* Style for the O que Procura? */

	.navigation-bar-link-select>img{
		height: 35px;
		width: 35px;
		border-radius: 30px;
	}

	/* Dropdown Button */
		.dropbtn {
		  font-size: 20px;
		  border: none;
		  background: white;
		  border-radius: 0 10px 0 0;
		}

		/* The container <div> - needed to position the dropdown content */
		.dropdown {
		  position: relative;
		  display: inline-block;
		  width: 100%;
		}

		/* Dropdown Content (Hidden by Default) */
		.dropdown-content {
		  display: none;
		  position: absolute;
		  z-index: 1;
		  background-color: 01A0C7;
		  width: 110%;
		  border-radius: 0px 10px 10px 0px;
		}

		/* Links inside the dropdown */
		.dropdown-content a {
		  color: black;
		  padding: 12px 16px;
		  text-decoration: none;
		  display: block;
		  cursor: pointer;
		}

		/* Change color of dropdown links on hover */
		.dropdown-content a:hover {
			background-color: #ddd;
		}

		/* Show the dropdown menu on hover */
		.dropdown:hover .dropdown-content {
			display: block;
		}

		/* Change the background color of the dropdown button when the dropdown content is shown */
		.dropdown:hover .dropbtn {
			border: 1px solid;
			border-radius: 5px 5px 0 0;
			border-color: 01A0C7;
			cursor: pointer;
		}

		@media screen and (max-width: 850px) {
			.dropbtn {
				background: none;
			}
			.dropdown-content a {
				font-size: 20px;
			}

			.dropdown-content a:hover {
				background-color: white;
				border-radius: 5px;
			}
		}

</style>

<script type="text/javascript">
	$('#navigation-side-menu-icon').on('click', function(){
		$('.navigation-bar').toggleClass('open');
		$('.navigation-bar').fadeIn('slow');
		$('.fa-bars').toggleClass('selected');

		if($('.navigation-bar').hasClass('open')){
			$('.arrow-left').hide();
		}else{
			$('.arrow-left').show();
		}
	});

	$("#go-contact").on('click', function() {
		window.scrollTo({
		  bottom: 0,
		  behavior: 'smooth'
		});
	});

</script>