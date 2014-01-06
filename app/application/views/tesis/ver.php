<div class="row">
    <div class="small-2 columns">
        <h2>Prueba</h2>
    </div>
    <div class="small-8 columns">
        <h2><?= $tesis->titulo; ?></h2>
        <table class="text-center">
            <tbody>
                <tr>
                    <td><p>Título:</p></td>
                    <td><p><?= $tesis->titulo; ?></p></td>
                </tr>
                <tr>
                    <td><p>Autor:</p></td>
                    <td><p><?=$tesis->last_name_estudiante . ', ' . $tesis->first_name_estudiante ;?></p></td>
                </tr>
                <tr>
                    <td><p>Abstract:</p></td>
                    <td><p><?= $tesis->abstract; ?></p></td>
                </tr>
                <tr>
                    <td><p>Fecha de publicación:</p></td>
                    <td><p><?= $tesis->fecha_publicacion; ?></p></td>
                </tr>
                <tr>
                    <td><p>Fecha de evaluacion:</p></td>
                    <td><p><?= $tesis->fecha_evaluacion; ?></p></td>
                </tr>
                <tr>
                    <td><p>Fecha de disponibilidad:</p></td>
                    <td><p><?= $tesis->feha_disponibilidad; ?></p></td>
                </tr>
                <tr>
                    <td><p>Categoria:</p></td>
                    <td><p><?= $tesis->nombre_categoria; ?></p></td>
                </tr>
                <tr>
                    <td><p>Profesor Guia:</p></td>
                    <td><p><?= $tesis->last_name_profe . ', '.$tesis->first_name_profe; ?></p></td>
                </tr>
                <tr>
                    <td><p>Ubicacion:</p></td>
                    <td><p><?= $tesis->ubicacion_fichero ?></p></td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="small-2 columns">
        <h2>Prueba 2</h2>
    </div>

</div>