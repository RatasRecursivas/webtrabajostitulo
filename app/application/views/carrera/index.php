<div class="row">
    <div class="small-2 columns">
        <h3>Chiquilines</h3>
    </div>
    <div class="small-8 columns">
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
                    <tr>
                        <td><?= $carrera->codigo; ?> </td>
                        <td><?= $carrera->nombre_carrera; ?></td>
                        <td> <?= $carrera->nombre_facultad; ?></td>
                        <td><a class="button tiny round" href="<?= site_url('/carrera/editar/' . $carrera->codigo); ?>">Modificar</a></td>
                        <td><a class="button tiny round alert" href="<?= site_url('/carrera/eliminar/' . $carrera->codigo); ?>">Eliminar</a></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="small-2 columns">

    </div>
</div>