<div class="large-8 columns large-centered">
    <?php if ($query): ?>
        <h2>Tesis</h2>
        <table>
            <thead>
                <tr>
                    <th>Titulo</th>
                    <th>Autor</th>
                    <th>Fecha de Publicacion</th>
                    <th width="1">Modificar</th>
                    <th width="1">Eliminar</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($query as $tesis): ?>
                    <tr>
                        <td><a href="<?= base_url(); ?>index.php/tesis/ver/<?= $tesis->id; ?>"><?= $tesis->titulo ?></a></td>
                        <td><?= $tesis->last_name_estudiante . ', ' . $tesis->first_name_estudiante; ?></td>
                        <td><?php echo $tesis->fecha_publicacion; ?></td>
                        <td><a class="button tiny round" href="<?= site_url() . '/tesis/editar/' . $tesis->id; ?>">Modificar</a></td>
                        <td><a class="button tiny round alert" href="<?= site_url() . '/tesis/eliminar/' . $tesis->id; ?>">Eliminar</a></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <div class="row">
            <div class="small-4 columns large-centered">
                <?= anchor('/tesis/agregar', 'Agregar nuevo trabajo de título', array('class' => 'button')); ?>
            </div>
        </div>
    <?php else: ?>
        <h3>No se encontraron trabajos de titulo, que tal si <?= anchor('/tesis/agregar', 'agrega uno?'); ?></h3>
    <?php endif; ?>
</div>