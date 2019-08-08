# Nessus Consolidator
<img src="https://github.com/SVelizDonoso/nc/raw/master/screen/cap2.png" >
Nessus Consolidator es una herramienta Liviana escrita en PHP con SQLite, que permite consolidar reportes con extensión .nessus en una sola base de datos SQLite. 
La idea principal de esta herramienta es ayudar al Pentester a realizar reportes de una o varias redes escaneadas, automatizando procesos manuales de consolidación sin tener que pagar una herramienta para realizar esta tarea que obviamente nadie quiere hacer.

# Dependencias
 Antes de ejecutar el script asegúrate de tener instalada la extensión sqlite y simplexml, según tu versión de php para en tu Kali Linux
 
 <br>
Ver versión de PHP en la consola:

```sh
php -v
```

Ver versión extensiones instaladas en PHP:

```sh
php -m
```

Para instalar sqlite según tu versión de php:

```sh
PHP5 sudo apt-get install php5-sqlite
PHP7.0 sudo apt-get install php7.0-sqlite
PHP7.1 sudo apt-get install php7.1-sqlite
PHP7.2 sudo apt-get install php7.2-sqlite
PHP7.3 sudo apt-get install php7.3-sqlite
```
Para instalar simplexml según tu versión de php:

```sh
PHP5 sudo apt-get install php5-xml
PHP7.0 sudo apt-get install php7.0-xml
PHP7.1 sudo apt-get install php7.1-xml
PHP7.2 sudo apt-get install php7.2-xml
PHP7.3 sudo apt-get install php7.3-xml
```

# Instalación

Por defecto, el tamaño de carga de archivo PHP está configurado en un máximo de 2 MB, si deseas incrementar el tamaño del archivo a subir debes ingresar a php.ini:

Buscamos el archivo con el siguiente comando:
```sh
php -i | grep php.ini
```
Editamos el archivo en las variables upload_max_filesize y post_max_size, en mi caso uso 20M :

```sh
; Maximum allowed size for uploaded files.
; http://php.net/upload-max-filesize 

upload_max_filesize = 20M
  
; Maximum size of POST data that PHP will accept.
; Its value may be 0 to disable the limit. It is ignored if POST data reading
; is disabled through enable_post_data_reading.
; http://php.net/post-max-size 

post_max_size = 20M
```

levantar servicio apache2
```sh
service apache2 restart
```

Descarga de Código Fuente
```sh
cd /var/www/html
git clone https://github.com/SVelizDonoso/nc.git
chmod 777 -R nc
```
Para finalizar abrimos firefox desde la consola con el comando:
```sh
/usr/bin/firefox -new-window http://127.0.0.1/nc/
```
<img src="https://github.com/SVelizDonoso/nc/raw/master/screen/cap4.png" >


# Advertencia
Este software se creo SOLAMENTE para ser utilizado desde una Red interna, se recomienda no exponer el servidor a la RED. No soy responsable de su uso. Úselo con extrema precaución.

# Autor
@svelizdonoso https://github.com/SVelizDonoso/
