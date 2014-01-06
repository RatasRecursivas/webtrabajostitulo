<div class="large-4 columns">
    <h2>Filtros</h2>

</div>
<div class="large-8 columns large-centered">
    <table>
        <thead>
        <h2>Tesis</h2>
        <tr>
            <th>Titulo</th>
            <th>Autor</th>
            <th>Fecha de Publicacion</th>
            <th width="1">Modificar</th>
            <th width="1">Eliminar</th>
        </tr>
        </thead>
        <tbody>
            <?php $id = 1; ?>
            <?php foreach ($query as $tesis): ?>
                <tr>
                    <td><a href="<?= base_url(); ?>index.php/tesis/ver/<?= $tesis->id; ?>"><?= $tesis->titulo ?></a></td>
                    <td><?= $tesis->last_name_estudiante . ', ' . $tesis->first_name_estudiante; ?></td>
                    <td><?php echo $tesis->fecha_publicacion; ?></td>
                    <td><a class="button tiny round" href="<?= site_url() . '/tesis/editar/' . $tesis->id; ?>">Modificar</a></td>
                    <td><a class="button tiny round alert" href="<?= site_url() . '/tesis/eliminar/' . $tesis->id; ?>">Eliminar</a></td>
                    <?php $id = $id + 1 ?>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>