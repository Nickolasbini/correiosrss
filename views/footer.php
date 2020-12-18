<footer>
	<div class='social-midia'>
		<ul class='social-midia-group'>
			<li id='whatsapp' class='social-midia-item' title='Whats App'>
				<img class='social-midia-icon' src="./img/whatsapp-icon.png">
			</li>
			<li id='facebook' class='social-midia-item' title='Facebook'>
				<img class='social-midia-icon' src="./img/facebook-icon.png">
			</li>
			<li id='instagram' class='social-midia-item' title='Instagram'>
				<img class='social-midia-icon' src="./img/instagram-icon.png">
			</li>
		</ul>
	</div>

	<div class='to-top-div'>
		<a id='go-top' class='to-top-button' title='Inicio'>
			<img class='to-top-image' src="./img/arrowtop-icon.png">
		</a>
	</div>

	<span class='signature'><small>&copy;nci web solutions</small></span>
</footer>

<style type="text/css">
	footer{
		
        height: 100px;
        width: 100%;
		background-color: 01A0C7;
		margin-top: 100px;
		display: flex;
		justify-content: center;
	}

	.social-midia{
		width: 80%;
	}
	.social-midia-group{
		display: inline-flex;
	}
	.social-midia-item{
		list-style-type: none;
		margin: 10px;
	}
	.social-midia-icon{
		height: 40px;
		width: 40px;
		border-radius: 20px;
		cursor: pointer;
	}

	.to-top-div{
		width: 20%;
		margin-top: auto;
		margin-bottom: auto;
		display: flex;
		justify-content: flex-end;
		margin-right: 20px;
	}
	.to-top-image{
		height: 60px;
		width: 60px;
		border-radius: 40px;
		border: 2px solid white;
		cursor: pointer;
	}
	.to-top-image:hover{
		border: 2px solid green;
		background: white;
	}

	.signature{
		color: white;
		position: absolute;
		margin-top: 80px;
	}

	@media screen and (max-width: 301px) {
		.to-top-image{
			height: 50px;
			width: 50px;
		}
		.social-midia-icon{
			height: 30px;
			width: 30px;
		}
	}
	@media screen and (max-width: 251px) {
		.to-top-image{
			height: 40px;
			width: 40px;
		}
		.social-midia-icon{
			height: 20px;
			width: 20px;
		}
	}

</style>


<script>
	$("#go-top").on('click', function() {
		window.scrollTo({
		  top: 0,
		  left: 0,
		  behavior: 'smooth'
		});
	});
</script>