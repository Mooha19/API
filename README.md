# API
# Conexión con la base de datos
    La base de datos es mysql, usamos un servidor local desde PHPMyadmin accesible con las credenciales root.
    Instalamos XAMPP, una vez esta instalado, activamos mysql y Apache.
    Accedemos desde localhost al servidor PhpMyadmin e importamos la base de datos osakidetza.sql

# Ejecutar la web
Introducimos la clave de la Api de Chat GPT en nuestro archivo autodiagnostico.php dentro de Panel Usuario.
Ofrecemos dos maneras de ejecutarlo:

1: Desde una herramienta que contenga un servidor Php. Por ejemplo Visual Studio Code, descargando Php Server.

2: Desde XAMPP

    2.1 Accede a la carpeta donde está instalado el XAMPP (Normalmente C:\xampp)
    
    2.2 Accede a la carpeta htdocs
    
    2.3 Introduce en la carpeta "htdocs" la carpeta API-main descargada de GitHub  
    
    2.4 Abre en tu navegador "http://localhost/API-main/app/index.php"
