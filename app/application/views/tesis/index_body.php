	<div class="row">
		<div class="large-12 columns">
			<table>
				<thead>
					<tr>
						<th>id</th>
						<th>Titulo</th>
						<th>Fecha de Publicacion</th>
						<th>Abstract</th>
						<th>Modificar</th>
						<th>Eliminar</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($query as $query):?>
					<tr>
						<td><?php echo $query->id; ?>
						<td><?php echo $query->titulo; ?></td>
						<td><?php echo $query->fecha_publicacion; ?></td>
						<td><?php echo $query->abstract; ?></td>
						<td><a class="button tiny round" href="<?php echo base_url(); ?>tesis/editar/<?php echo $query->id; ?>">Modificar</a></td>
						<td><a class="button tiny round alert" href="<?php echo base_url(); ?>tesis/eliminar/<?php echo $query->id; ?>">Eliminar</a></td>
					</tr>
					<?php endforeach;?>
				</tbody>
			</table>
		</div>
	</div>

