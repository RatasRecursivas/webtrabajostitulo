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
        <?php if($profesores): ?>
        <table>
            <thead>
                <tr>
                    <th>RUT</th>
                    <th>Nombre</th>
                    <th>Actualizar desde Dirdoc</th>
                    <th>Eliminar</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($profesores as $profesor): ?>
                    <tr>
                        <td><?= format_rut($profesor->rut); ?></td>
                        <td><?= $profesor->first_name . ' ' . $profesor->last_name; ?></td>
                        <td><?= anchor('profesor/obtener/' . $profesor->rut, 'Actualizar', 'class="button tiny"');?></td>
                        <td><?= anchor('profesor/eliminar/' . $profesor->rut, 'Eliminar', 'class="button tiny alert"');?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<?php endif; ?>

<div class="row">
    <div class="small-6 columns large-centered">
        <?= form_open('profesor' . '/' . 'obtener', array('method' => 'get')); ?>
        <?= form_fieldset('Obtiene a un profesor desde Dirdoc'); ?>
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