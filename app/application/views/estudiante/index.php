<?php
$rut = array(
    'type' => 'text',
    'placeholder' => '12345678',
    'name' => 'rut'
);

$field_attributes = array(
    'class' => 'rigth inline',
);

$submit_button = array(
    'value' => 'Obtener',
    'class' => 'button tiny'
);
?>


<div class="row">
    <div class="small-10 columns small-centered">
        <?php if($estudiantes): ?>
        <table>
            <thead>
                <tr>
                    <th>RUT</th>
                    <th>Nombre</th>
                    <th>Carrera</th>
                    <th>Email</th>
                    <th>Actualizar desde Dirdoc</th>
                    <th>Eliminar</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($estudiantes as $estudiante): ?>
                    <tr>
                        <td><?= format_rut($estudiante->rut); ?></td>
                        <td><?= $estudiante->first_name . ' ' . $estudiante->last_name; ?></td>
                        <td><?= $estudiante->carrera; ?></td>
                        <td><?= ($estudiante->email) ? mailto($estudiante->email): 'No hay email registrado'; ?></td>
                        <td><?= anchor('estudiante/obtener/' . $estudiante->rut, 'Actualizar', 'class="button tiny"');?></td>
                        <td><?= anchor('estudiante/eliminar/' . $estudiante->rut, 'Eliminar', 'class="button tiny alert"');?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<?php endif; ?>

<div class="row">
    <div class="small-6 columns large-centered">
        <?= form_open('estudiante' . '/' . 'obtener', array('method' => 'get')); ?>
        <?= form_fieldset('Obtiene a un estudiante desde Dirdoc'); ?>
        <div class="row">
            <div class="small-2 columns">
                <?= form_label('RUT:', 'rut', $field_attributes); ?>
            </div>
            <div class="small-6 columns">
                <?= form_input($rut); ?>
            </div>
            <div class="small-4 columns">
                <?= form_submit($submit_button); ?>
            </div>
        </div>
    </div>
</div>