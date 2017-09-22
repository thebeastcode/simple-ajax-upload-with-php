* Introducción al curso
* Requerimientos y recursos
	* Conocimientos de PHP
	* Conocimientos de jQuery
	* IDE
	* XAMPP
* Chequeo de variables globales en php.ini
	* phpinfo()
	* file_uploads
	* upload_max_filesize
	* max_file_uploads
	* post_max_size
* HTML basico para explicación
	* HTML5
	* Agregando jQuery
* Creación de clase base para el manejo de imagenes
	* Obtener información de la imagen
		* Nombre del archivo
		* extensión del archivo
	* Validaciones
		* Saber si hay archivos para subir
		* Verificar errores desde $_FILES['file_user']['error']
			* Tipos de error segun el array
			* URL para verificarlos [click aquí para ver referencia](http://php.net/manual/es/features.file-upload.errors.php)
		* Conocer si la imagen es valida
		* Tamaño de archivo
	* Guardar imagen en el servidor
		* Verificación de existencia en el servidor
		* Renombrar imagen para evitar conflictos
		* Guardar imagen actual
* Manejo de imagen desde AJAX jQuery
    * Simple $.ajax()
        * Creación de simple AJAX
        * Envió de parametros
        * Recuperación de respuesta
	* Creación de AJAX request
		* id.submit
		* preventDefault
		* FormData object
		* $.ajax()