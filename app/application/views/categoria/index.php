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
                <?php foreach ($categorias as $categoria): ?>
                <tr>
                        <td><?= $categoria->nombre_categoria; ?></td>
                        <td><a class="button tiny round" href="<?= site_url('/categoria/editar/'. $categoria->id) ; ?>">Modificar</a></td>
                        <td><a class="button tiny round alert" href="<?= site_url('/categoria/eliminar/'. $categoria->id) ; ?>">Eliminar</a></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>