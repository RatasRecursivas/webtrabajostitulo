<div class="large-3 columns">
    <?php
    $select_carreras = array(
        '' => 'NO FILTRAR',
    );
    foreach ($carreras as $carrera) {
        $select_carreras[$carrera->nombre_carrera] = $carrera->nombre_carrera;
    }
    $select_facultades = array(
        '' => 'NO FILTRAR',
    );
    foreach ($facultades as $facultad) {
        $select_facultades[$facultad->nombre_facultad] = $facultad->nombre_facultad;
    }
    $select_profesores = array(
        '' => 'NO FILTRAR',
    );
    foreach ($profesores as $profesor) {
        $select_profesores[$profesor->last_name . ' ' . $profesor->first_name] = $profesor->last_name . ' ' . $profesor->first_name;
    }
    $select_categorias = array(
        '' => 'NO FILTRAR',
    );
    foreach ($categorias as $categoria) {
        $select_categorias[$categoria->nombre_categoria] = $categoria->nombre_categoria;
    }
    $for = array(
        'method' => 'get',
    );
    $submit_filtro = array(
        'value' => 'Filtrar!',
        'class' => 'success button'
    );
    ?> 
    <div class="row">
        <h2>Filtros</h2>
        <?= form_open('tesis/', $for) ?>
        <?= form_fieldset('Rellene los filtro') ?>
        <div class="large-12 columns">
            <?= form_label('Carrera:') ?>
            <?= form_dropdown('Carrera', $select_carreras); ?> 
            <?= form_label('Profesor:') ?>
            <?= form_dropdown('Profesor', $select_profesores); ?> 
            <?= form_label('Facultad:') ?>
            <?= form_dropdown('facultad', $select_facultades); ?> 
            <?= form_label('Categoria:') ?>
            <?= form_dropdown('categoria', $select_categorias); ?>   
            <?= form_submit($submit_filtro); ?> 
        </div>
        <?= form_fieldset_close() ?>
        <?= form_close() ?>
    </div>

    <div class="row">
        <div class="large 12 columns">
            <h2>Próximas Defensas</h2>
            <table> 
                <thead>
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
    </div>

</div>
<div class="large-9 columns">
    <h2> Tesis </h2>
    <table>
        <thead>
            <tr>
                <th >Titulo</th>
                <th >Autor</th>
                <th >Fecha de Publicacion</th>
                <th >Abstract</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($query as $tesis): ?>
                <tr>
                    <td><a href="<?= base_url(); ?>index.php/tesis/ver/<?= $tesis->id; ?>"><?= $tesis->titulo ?></a></td>
                    <td><?= $tesis->last_name_estudiante . ', ' . $tesis->first_name_estudiante; ?></td>
                    <td><?= $tesis->fecha_publicacion; ?></td>
                    <td><?= $tesis->abstract; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>