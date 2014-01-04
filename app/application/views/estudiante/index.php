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
    <div class="small-8 columns small-centered">
        <table>
            <thead>
                <tr>
                    <th>RUT</th>
                    <th>Nombre</th>
                    <th>Carrera</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($estudiantes as $estudiante): ?>
                <tr>
                        <td><?= $estudiante->rut; ?></td>
                        <td><?= $estudiante->first_name . ' ' . $estudiante->last_name; ?></td>
                        <td><?= $estudiante->carrera; ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<div class="row">
    <div class="small-8 columns large-centered">
        <?= form_open('estudiante' . '/'. 'obtener'); ?>
        <?= form_fieldset('Obtiene o actualiza un Estudiante'); ?>
        <div class="row">
            <div class="small-4 columns">
                <?= form_label('RUT:', 'rut', $field_attributes); ?>
            </div>
            <div class="small-4 columns">
                <?= form_input($rut); ?>
            </div>
            <div class="small-4 columns">
                <?= form_submit($submit_button); ?>
            </div>
        </div>
    </div>
</div>