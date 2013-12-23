webtrabajostitulo
=================

Instalacion de modelo de base de datos (Se asume Ubuntu 12.04 LTS):
(El fichero model.sql es especial para la tarea de ayudantia)
```
cat model.sql | psql -U user -d userd
```

Es necesario modificar el fichero `application/config/config.php` estableciendo
la url base, la variable `$config['base_url']` es la encargada de esto.

Otro cambio necesario es en el fichero `application/config/database.php` estableciendo
los parametros de conexion de la base de datos.

Finalmente es necesario cambiar la redireccion editando el fichero `.htaccess`
especificando la ruta donde vive la app:
`RewriteRule ^(.*)$ /~pperez/sw/index.php/$1 [L]`