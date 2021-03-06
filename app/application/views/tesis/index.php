<div class="large-3 columns">
    <?php
    $default_carrera = '';
    $default_profesor = '';
    $default_categoria = '';
    $default_facultad = '';
    if (sizeof($filtro_default)) { //habemus datos por get!
//        var_dump($filtro_default);
        $default_carrera = $filtro_default['carrera_default'];
        $default_profesor = $filtro_default['profesor_default'];
        $default_categoria = $filtro_default['categoria_default'];
        $default_facultad = $filtro_default['facultad_default'];
    }

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
        $select_profesores[$profesor->rut] = $profesor->last_name . ' ' . $profesor->first_name;
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
            <?= form_dropdown('carrera', $select_carreras, $default_carrera); ?> 
            <?= form_label('Profesor:') ?>
            <?= form_dropdown('profesor', $select_profesores, $default_profesor); ?> 
            <?= form_label('Facultad:') ?>
            <?= form_dropdown('facultad', $select_facultades, $default_facultad); ?> 
            <?= form_label('Categoria:') ?>
            <?= form_dropdown('categoria', $select_categorias, $default_categoria); ?>   
            <?= form_submit($submit_filtro); ?> 
        </div>
        <?= form_fieldset_close() ?>
        <?= form_close() ?>
    </div>

    <div class="row">
        <div class="large 12 columns">
            <h2>Próximas Defensas</h2>
            <?php if (!$defensas): ?>
                <p>No hay defensas proximamente</p>
            <?php else: ?>
                <table> 
                    <thead>
                        <tr> 
                            <th>Defensas</th>
                            <th>Estudiante</th>
                            <th>Dia defensa</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($defensas as $tesis): ?>
                            <tr>          
                                <td><?= $tesis->titulo; ?></td>
                                <td><?= $tesis->last_name . ', ' . $tesis->first_name; ?></td>
                                <td><?= $tesis->fecha_evaluacion; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>
        </div>
    </div>

</div>
<div class="large-9 columns">
    <h2>Tesis</h2>
    <?php if ($query): ?>
        <?php foreach ($query as $tesis): ?>
            <ul class="pricing-table">
                <li class="title"><div class="row"><div class="large-3 columns">Titulo:</div><div class="large-9 columns"><?= anchor('/tesis/ver/' . $tesis->id, $tesis->titulo); ?></div></div></li>
                <li class="description"><div class="row"><div class="large-3 columns">Autor:</div><div class="large-9 columns"><?= $tesis->last_name_estudiante . ', ' . $tesis->first_name_estudiante; ?></div></div></li>
                <li class="description"><div class="row"><div class="large-3 columns">Abstract:</div><div class="large-9 columns wrapped"><?= ($tesis->abstract) ? $tesis->abstract : '-'; ?></div></div></li>
                <li class="description"><div class="row"><div class="large-3 columns">Fecha publicación:</div><div class="large-9 columns wrapped"><?= $tesis->fecha_publicacion; ?></div></div></li>
            </ul>
        <?php endforeach; ?>
    <?php else: ?>
        <h3>No se encontraron tesis, lo sentimos</h3>
    <?php endif; ?>
</div>