<div class="row">
    <div class="large-8 columns large-centered">
        <?php if (count($facultades) > 1): ?>
            <table>
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Modificar</th>
                        <th>Eliminar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($facultades as $facultad): ?>
                        <?php if ($facultad->id != 1): ?>
                            <tr>
                                <td><?= $facultad->nombre_facultad; ?></td>
                                <td><a class="button tiny round" href="<?= site_url('/facultad/editar/' . $facultad->id); ?>">Modificar</a></td>
                                <td><a class="button tiny round alert" href="<?= site_url('/facultad/eliminar/' . $facultad->id); ?>">Eliminar</a></td>
                            </tr>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <h3>No se encontraron facultades, que tal si <?= anchor('facultad/agregar', 'agrega una?'); ?></h3>
        <?php endif; ?>
    </div>
</div>