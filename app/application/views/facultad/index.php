<div class="row">
    <div class="small-2 columns">
        <h3>Sidebar1</h3>
    </div>
    <div class="small-8 columns">
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
                <tr>
                        <td><?= $facultad->nombre_facultad; ?></td>
                        <td><a class="button tiny round" href="<?= site_url('/facultad/editar/'. $facultad->id) ; ?>">Modificar</a></td>
                        <td><a class="button tiny round alert" href="<?= site_url('/facultad/eliminar/'. $facultad->id) ; ?>">Eliminar</a></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>