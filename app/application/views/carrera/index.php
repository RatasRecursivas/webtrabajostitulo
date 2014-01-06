<div class="row">
    <div class="small-8 columns large-centered">
        <?php if (count($carreras) > 1): ?>
            <table>
                <thead>
                    <tr>
                        <th>Codigo</th>
                        <th>Nombre</th>
                        <th>Facultad</th>
                        <th>Modificar</th>
                        <th>Eliminar</th>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach ($carreras as $carrera): ?>
                        <?php if ($carrera->codigo != 1) : ?>
                            <tr>
                                <td><?= $carrera->codigo; ?> </td>
                                <td><?= $carrera->nombre_carrera; ?></td>
                                <td> <?= $carrera->nombre_facultad; ?></td>
                                <td><a class="button tiny round" href="<?= site_url('/carrera/editar/' . $carrera->codigo); ?>">Modificar</a></td>
                                <td><a class="button tiny round alert" href="<?= site_url('/carrera/eliminar/' . $carrera->codigo); ?>">Eliminar</a></td>
                            </tr>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <div class="row">
                <div class="small-4 columns large-centered">
                    <?= anchor('/carrera/agregar', 'Agregar nueva carrera', array('class' => 'button')); ?>
                </div>
            </div>
        <?php else: ?>
            <h3>No se encontraron carreras, que tal si <?= anchor('carrera/agregar', 'agrega una?'); ?></h3>
        <?php endif; ?>
    </div>
</div>
