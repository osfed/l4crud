L4CRUD
===

Un paquete para Laravel 4 que se encarga de crear un C.R.U.D (Crear, Leer, Actualizar y Eliminar) entero en minutos.

Más información del paquete en http://raw.adigheorghe.ro

Instalación
=============

Agrega `osfed/l4crud` en  "requirement" en el archivo "composer.json" de tu aplicación Laravel:

"osfed/l4crud" : "dev-master"

Una vez que hayas realizado el paso anterior ejecuta siguiente comando en el directorio principal de tu aplicación Laravel:

composer update

Una vez que el paque este instalado el paquete necesitas agregar el "service provider". Aggrega la siguiente línea en la sección "providers" en el archivo app/config/app.php de tu proyecto Laravel.

'Osfed\L4CRUD\RawServiceProvider'

Los assets del paquete necesitan se públicos, para esto ejecuta el siguiente comando:

php artisan asset:publish osfed/l4crud

Migrar la base de datos con el comando:

php artisan migrate --package="osfed/l4crud"

El usuario para ingresar es: admin
La contraseña para ingresar es: admin

Documentación
=============

Hay un archivo sql contiene datos de ejemplo

 - ruta_de_instalacion/vendor/Osfed/L4CRUD/raw.sql

Para ver el ejemplo completo necesitas importar el archivo anterior a tu base de datos, configurar la conexión y acceder al ejemplo desde:

 - http://localhost_o_ruta_de_tu_aplicacion/raw_items

El código de ejemplo está disponible en

 - vendor/Osfed/L4CRUD/src/controllers/RawController.php
