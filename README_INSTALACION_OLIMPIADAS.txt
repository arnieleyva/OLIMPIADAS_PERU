OLIMPIADAS PERU - GUIA RAPIDA DE INSTALACION
=============================================

ARCHIVOS NECESARIOS
1. Carpeta del proyecto: OLIMPIADAS_PERU
2. Base de datos: olimpiadas_peru.sql

REQUISITOS
- XAMPP instalado en C:\xampp
- Apache y MySQL encendidos
- Navegador web

PASOS DE INSTALACION

1. Copiar la carpeta OLIMPIADAS_PERU dentro de:

   C:\xampp\htdocs\

   Debe quedar asi:

   C:\xampp\htdocs\OLIMPIADAS_PERU

2. Abrir phpMyAdmin:

   http://localhost/phpmyadmin

3. Crear una base de datos llamada:

   olimpiadas_peru

4. Entrar a esa base de datos y usar la opcion Importar.

5. Seleccionar el archivo:

   olimpiadas_peru.sql

6. Ejecutar la importacion.

7. Abrir el sistema en el navegador:

   http://localhost/OLIMPIADAS_PERU/

ACCESO DE PRUEBA
- Usuario: admin@admin.com
- Contrasena: password

COMO VER EL MONITOREO

1. Ingresar con el usuario administrador.
2. Bajar por el menu izquierdo hasta Monitoreo.
3. Revisar salud, Apache, MariaDB, logs y mantenimiento.
4. Health JSON:

   http://localhost/OLIMPIADAS_PERU/health.php

ACTIVAR EL MANTENIMIENTO AUTOMATICO

Abrir PowerShell como administrador y ejecutar:

powershell -ExecutionPolicy Bypass -File C:\xampp\htdocs\OLIMPIADAS_PERU\maintenance\install_scheduled_tasks.ps1

Esto crea:
- Health check cada 5 minutos.
- Backup diario a las 23:00.
- Rotacion de logs a las 00:15.

NOTAS
- La carpeta img ya contiene las imagenes del sistema.
- No se incluyeron logs ni backups de la computadora original.
- Los nuevos logs se generan al navegar por el sistema.
- Los backups se guardan en C:\xampp\backups\olimpiadas_peru.
- Si no se ven los cambios visuales, presionar Ctrl+F5.
- Si Apache o MySQL no inician, revisar sus puertos en XAMPP.
- El ZIP no tiene contrasena.
