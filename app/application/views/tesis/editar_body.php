<div class="row">
    <div class="large-12 columns">
        <form action="<?php echo base_url(); ?>tesis/editar" method="post">
            <div class="row">
                <div class="four columns">
                    <label>Titulo</label>
                    <input name="titulo" type="text" value="<?php echo $query->titulo; ?>" />
                    <label>Fecha Publicacion</label>
                    <input name="fecha_publicacion" type="text" value="<?php echo $query->fecha_publicacion; ?>" />
                    <label>Fecha Disponibilidad</label>
                    <input name="fecha_disponibilidad" type="date" value="<?php echo $query->fecha_disponibilidad; ?>" />
                    <label>Abstact</label>
                    <textarea name="abstract"><?php echo $query->abstract; ?></textarea>
                    <label>Ubicacion Fichero</label>
                    <input name='ubicacion_fichero' type="text" value="<?php echo $query->ubicacion_fichero; ?>">
                    <input type="hidden" name="id" / value="<?php echo $query->id; ?>" />
                           <input type="submit" class="button" value="Modificar">
                </div>
            </div>
        </form>
    </div>
</div>