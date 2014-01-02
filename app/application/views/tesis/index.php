<div class="row">
    <div class="small-2 columns">
        <h2>Test</h2>
    </div>
    <div class="small-8 columns">
        <table>
            <thead>
                <tr>
                    <th>id</th>
                    <th>Titulo</th>
                    <th>Autor</th>
                    <th>Fecha de Publicacion</th>
                    <th>Abstract</th>
                    <th>Modificar</th>
                    <th>Eliminar</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($query as $tesis): ?>
                    <tr>
                        <td><?php echo $tesis->id; ?>
                        <td><?php echo $tesis->titulo; ?></td>
                        <td><?= $tesis->last_name . ', ' . $tesis->first_name ;?></td>
                        <td><?php echo $tesis->fecha_publicacion; ?></td>
                        <td><?php echo $tesis->abstract; ?></td>
                        <td><a class="button tiny round" href="<?php echo base_url(); ?>tesis/edit/<?php echo $tesis->id; ?>">Modificar</a></td>
                        <td><a class="button tiny round alert" href="<?php echo base_url(); ?>tesis/eliminar/<?php echo $tesis->id; ?>">Eliminar</a></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="small-2 columns">
        <div class="defensas">
            <h2>Próximas Defensas</h2>
        </div>
        <?php if($defensas): ?>
            <?php foreach ($defensas as $tesis): ?>
                <p>tesis"<?= $tesis->titulo;?>"</p>
                <p>por <?= $tesis->last_name . ', ' . $tesis->first_name;?></p>
                <p>en <?= $tesis->fecha_evaluacion;?></p>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No hay defensas proximamente</p>
        <?php endif; ?>

    </div>
</div>

