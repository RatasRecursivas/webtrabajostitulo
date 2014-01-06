<div class="large-3 columns">
    <h2>Filtros</h2>

</div>
<div class="large-6 columns large-centered">
    <table>
        <thead>
        <h2> Tesis </h2>
        <tr>
            <th >Titulo</th>
            <th >Autor</th>
            <th >Fecha de Publicacion</th>
            <th >Abstract</th>
            <!--<th width="1">Modificar</th>-->
            <!--<th width="1">Eliminar</th>-->
        </tr>
        </thead>
        <tbody>
            <?php $id = 1; ?>
            <?php foreach ($query as $tesis): ?>
                <tr>
                    <td><a href="<?= base_url(); ?>index.php/tesis/ver/<?= $tesis->id; ?>"><?= $tesis->titulo ?></a></td>
                    <td><?= $tesis->last_name_estudiante . ', ' . $tesis->first_name_estudiante; ?></td>
                    <td><?php echo $tesis->fecha_publicacion; ?></td>
                    <td><?php echo $tesis->abstract; ?></td>
                    <!--<td><a class="button tiny round" href="<?php echo base_url(); ?>index.php/tesis/editar/<?php echo $tesis->id; ?>">Modificar</a></td>-->
                    <!--<td><a class="button tiny round alert" href="<?php echo base_url(); ?>index.php/tesis/eliminar/<?php echo $tesis->id; ?>">Eliminar</a></td>-->
                    <?php $id = $id + 1 ?>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<div class="large-3  columns">
    <table>
        <div class="defensas"></div>

        <thead>
        <h2>Próximas Defensas</h2>
        <tr> 
            <th>Defensas</th>
            <th>Estudiante</th>
            <th>Dia defensa</th>
        </tr>
        </thead>
        <tbody>
            <?php if ($defensas): ?>
                <?php foreach ($defensas as $tesis): ?>
                    <tr>          
                <td><?= $tesis->titulo; ?></td>
                <td><?= $tesis->last_name . ', ' . $tesis->first_name; ?></td>
                <td><?= $tesis->fecha_evaluacion; ?></td>
                </tr>
            <?php endforeach; ?>
            <?php else: ?>
            <p>No hay defensas proximamente</p>
        <?php endif; ?>
        </tbody>
    </table>
</div>