<!DOCTYPE html>
<html lang="es">
<head>
<title>Trabajos de titulo</title>
<link rel="stylesheet"
	href="http://foundation.zurb.com/assets/css/templates/foundation.css">
<script
	src="http://ajax.aspnetcdn.com/ajax/modernizr/modernizr-2.7.1.js"></script>
</head>
<body>
	<div class="row">
		<div class="large-12 columns">

			<!-- Navigation -->
			<nav class="top-bar" data-topbar>
				<ul class="title-area">
					<!-- Title Area -->
					<li class="name">
						<h1>
							<a href="#"> Top Bar Title </a>
						</h1>
					</li>
					<li class="toggle-topbar menu-icon"><a href="#"><span>menu</span></a></li>
				</ul>

				<section class="top-bar-section">
					<ul class="left">
						<li><a href="#">Link 1</a></li>
						<li><a href="#">Link 2</a></li>
					</ul>

					<ul class="right">
						<li class="search">
							<form>
								<input type="search">
							</form>
						</li>

						<li class="has-button"><a class="small button" href="#">Search</a>
						</li>
					</ul>
				</section>
			</nav>

			<!-- End Navigation -->

		</div>
	</div>

	<div class="row">
		<div class="large-12 columns">
			<form action="<?php echo base_url(); ?>tesis/editar" method="post">
				<div class="row">
					<div class="four columns">
						<label>Titulo</label>
						<input name="titulo" type="text" value="<?php echo $query->titulo; ?>" />
						<label>Fecha Publicacion</label>
						<input name="fecha_publicacion" type="text" value="<?php echo $query->fecha_publicacion; ?>" />
						<label>Fecha Disponibilidad</label>
						<input name="fecha_disponibilidad" type="date" value="<?php echo $query->fecha_disponibilidad; ?>" />
						<label>Abstact</label>
						<textarea name="abstract"><?php echo $query->abstract; ?></textarea>
						<label>Ubicacion Fichero</label>
						<input name='ubicacion_fichero' type="text" value="<?php echo $query->ubicacion_fichero; ?>">
						<input type="hidden" name="id" / value="<?php echo $query->id; ?>" />
						<input type="submit" class="button" value="Modificar">
					</div>
				</div>
			</form>
		</div>
	</div>

	<!-- Footer -->

	<footer class="row">
		<div class="large-12 columns">
			<hr>
			<div class="row">
				<div class="large-6 columns">
					<p>Copyright no one at all. Go to town.</p>
				</div>
				<div class="large-6 columns">
					<ul class="inline-list right">
						<li><a href="#">Link 1</a></li>
						<li><a href="#">Link 2</a></li>
						<li><a href="#">Link 3</a></li>
						<li><a href="#">Link 4</a></li>
					</ul>
				</div>
			</div>
		</div>
	</footer>
</body>
</html>
