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
    <div class="large-10 columns large-centered">
        <?php if (count($profesores) > 1): ?>
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
                        <?php if ($profesor->rut != 12345678): ?>
                            <tr>
                                <td><?= format_rut($profesor->rut); ?></td>
                                <td><?= $profesor->first_name . ' ' . $profesor->last_name; ?></td>
                                <td><?= anchor('profesor/obtener/' . $profesor->rut, 'Actualizar', 'class="button tiny"'); ?></td>
                                <td><?= anchor('profesor/eliminar/' . $profesor->rut, 'Eliminar', 'class="button tiny alert"'); ?></td>
                            </tr>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <h3>No se encontraron profesores, que tal si agrega uno?</h3>
        <?php endif; ?>
    </div>
</div>

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
                <?php if($error_rut): echo '<small class="error">Ingrese bien el rut Sin digito verificar ni puntos ni guion</small>';  endif?>
            </div>
            <div class="small-4 columns">
                <?= form_submit($submit_button); ?>
            </div>
        </div>
    </div>
</div>