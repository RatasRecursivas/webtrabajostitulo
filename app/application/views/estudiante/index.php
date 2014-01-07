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

$label_rut = 'rut';
?>


<div class="row">
    <div class="large-10 columns large-centered">
        <?php if (count($estudiantes) > 1): ?>
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
                        <?php if ($estudiante->rut != 12345678): ?>
                            <tr>
                                <td><?= format_rut($estudiante->rut); ?></td>
                                <td><?= $estudiante->first_name . ' ' . $estudiante->last_name; ?></td>
                                <td><?= $estudiante->carrera; ?></td>
                                <td><?= ($estudiante->email) ? mailto($estudiante->email) : 'No hay email registrado'; ?></td>
                                <td><?= anchor('estudiante/obtener/' . $estudiante->rut, 'Actualizar', 'class="button tiny"'); ?></td>
                                <td><?= anchor('estudiante/eliminar/' . $estudiante->rut, 'Eliminar', 'class="button tiny alert"'); ?></td>
                            </tr>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <h3>No se encontraron estudiantes, que tal si agrega uno?</h3>
        <?php endif; ?>
    </div>
</div>

<div class="row">
    <div class="small-6 columns large-centered">
        <?= form_open('estudiante' . '/' . 'obtener', array('method' => 'get')); ?>
        <?= form_fieldset('Obtiene a un estudiante desde Dirdoc'); ?>
        <div class="row">
            <div class="small-2 columns">
                <?= form_label_vandalizado('RUT:', 'rut', $field_attributes, 'Ingrese el rut sin digito verificador, puntos ni guion'); ?>
            </div>
            <div class="small-6 columns">
                <?= form_input($rut); ?>
                <?php if($error_rut): echo '<small class="error">Ingrese bien el rut Sin digito verificar ni puntos ni guion</small>';  endif?>
            </div>
            <div class="small-4 columns">
                <?= form_submit($submit_button); ?>
            </div>
        </div>
    </div>
</div>
