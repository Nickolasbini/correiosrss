<section class="preview-master-box">
	
		<a class="preview-arrow arrow-left">
			<i class="fas fa-arrow-left arrow"></i>
		</a>

		<a class="img-button">
			<img id="preview-img" src="./img/logo.png">
		</a>

		<a class="preview-arrow arrow-right">
			<i class="fas fa-arrow-right arrow"></i>
		</a>
	
</section>

<div class="preview-photo-buttom">
	<ul>
		<li></li>
	</ul>	
</div>


<style>
	
	.preview-master-box{
		display: flex;
		width: 100%;
		justify-content: center;
	}

	.img-button{
		display: flex;
		width: 90%;
		justify-content: center;
	}
	.img-button > img{
		width: 50%;
	}

	.preview-arrow{
		margin-top: auto;
		margin-bottom: auto;
		border: 5px solid white;
		padding: 5px;
		border-radius: 100%;
		background: black;
	}

	.arrow{
		color: white;
		font-size: 40px;
	}

	@media screen and (max-width: 1500px) {
		.img-button > img{
			width: 100%;
		}
	}

	@media screen and (max-width: 800px) {
		.preview-arrow{
			position: fixed;
		}
		.arrow-left{
			left: 0;
		}
		.arrow-right{
			right: 0;
		}
		.arrow{
			font-size: 20px;
		}

		.img-button{
			width: 100%;
		}
		.img-button > img{
			width: 100%;
		}
	}
</style>