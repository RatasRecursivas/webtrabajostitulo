	<div class="row">
		<div class="large-12 columns">
			<form action="<?php echo base_url(); ?>tesis/agregar" method="post">
				<div class="row">
					<div class="four columns">
						<label>Titulo</label>
						<input name="titulo" type="text" />
						<label>Fecha Publicacion</label>
						<input name="fecha_publicacion" type="text" />
						<label>Fecha Disponibilidad</label>
						<input name="fecha_disponibilidad" type="text">
						<label>Abstact</label>
						<textarea name="abstract"></textarea>
						<label>Ubicacion Fichero</label>
						<input name='ubicacion_fichero' type="text">
						<input type="submit" class="button" value="Agregar">
					</div>
				</div>
			</form>
		</div>
	</div>