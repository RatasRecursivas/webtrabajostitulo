Portal trabajos de titulación Escuela de informática UTEM
=================
Proyecto final para el ramo Ingeniería en Software.
Construido sobre el framework PHP Code Igniter en su versión 2.1.4.

Requisitos
--------

* PHP 5.3+ (Encriptación bcrypt; versión utilizada: 5.3.10)
* Servidor web (Utilizado: Apache 2.2.22)
* Módulo PostgreSQL para PHP
* Base de datos PostgreSQL (Aunque en teoria cualquier otra db soportada por code igniter bastaria)
* Credenciales para el web service de la universidad


Instalación
--------

* Importar la base de datos: 

```
psql -U user -d userdb -h localhost < model/iswdb.trabajostitulo.sql
```
En este ejemplo se importa mediante psql con usuario user, base de datos userdb y corriendo en localhost, pero puede ser importada en otra herramienta.

* Subir los ficheros a un directorio accesible publicamente en el servidor web
* Configurar la base de datos, el fichero `application/config/database.php` contiene las directivas necesarias para esto.
* Configurar la llave de encriptación, esta reside en `$config['encryption_key']` dentro del fichero `application/config/config.php`, esta debe tener 32 caracteres. En este fichero se deben establecer las credenciales del web service, entregadas por el administrador, las directivas son `$config['dirdoc_ws_user']` y `config['dirdoc_ws_password']`

Ya se puede empezar a utilizar la plataforma, el usuario por defecto es ptorrealba@utem.cl y su password es password