<div class="row">
    <div class="small-8 columns large-centered">
        <?php if (count($categorias) > 1) : ?>
            <table>
                <thead>
                    <tr>
                        <th>Nombre Categoría</th>
                        <th>Nombre Facultdad</th>
                        <th>Modificar</th>
                        <th>Eliminar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($categorias as $categoria): ?>
                        <?php if ($categoria->id != 1) : ?>
                            <tr>
                                <td><?= $categoria->nombre_categoria; ?></td>
                                <td><?= $categoria->nombre_facultad; ?></td>
                                <td><a class="button tiny round" href="<?= site_url('/categoria/editar/' . $categoria->id); ?>">Modificar</a></td>
                                <td><a class="button tiny round alert" href="<?= site_url('/categoria/eliminar/' . $categoria->id); ?>">Eliminar</a></td>
                            </tr>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <div class="row">
                <div class="small-4 columns large-centered">
                    <?= anchor('/categoria/agregar', 'Agregar nueva categoria', array('class' => 'button')); ?>
                </div>
            </div>
        <?php else: ?>
            <h3>No se encontraron categorias, que tal si <?= anchor('categoria/agregar', 'agrega una?'); ?></h3>
        <?php endif; ?>
    </div>
</div>