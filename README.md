# TestNA
Test Nexo Abogados

El siguiente proyecto es una prueba asignada, con un tiempo estimado de respuesta de 4 dias.
Hasta el momento de este documento se encuentran desarroladas los siguientes puntos:

Rutas Api:
Posee una Api Rest con los siguentes basamentos, se crearon carpetas internas par subdividir las rutas de la misma con el objetivo de volver mucho mas practico y escalable la api, de tal forma se crea la carpeta base llamada v1, para identificar asi la version de la misma y pueda migrarse a diferentes versiones, dentro de esta hay dos documentos cada uno representa a un endpoint diferente, evidentemente dentro de estos se definen las rutas de cada uno, es por esto que en el archivo api principal se hacen llamados a cada uno de estos.

Middleware:
Se crearon dos middleware para proteger la ruta, ademas de darle uso al ya predefinido por el paquete Sanctum, el cual valida las credenciales de acceso a la api, los middleware que se crearon sirver para definir y separar las acciones correspondientes en base a dos grupos de usuarios, los abogados y los administradores.
de igual manera los middleware son llamados en las funciones __construct de las clases

Instalación:
Para la instalacion del proyecto se ejecutan los procesos comunes al momento de trabajar con repositorios en github:
en la consola git: git clone "ruta_del_proyecto"
en la terminal del equipo: composer install y npm install

Primeramente hay que recurrir a crear el archivo .env, donde se define la base de datos que se quiera utilizar, de igual forma se anexara una migracion .sql de la base de datos utlizadas como respaldo.
Para las migraciones: php artisan migrate
para los seed: php artisan db:seed

de esta forma se obtendria el entorno de desarrollo oportuno para la ejecución del proyecto

Inicio:
Para ponerlo a funcionar, se monta en un servidor, se puede correr la terminal con el comando php artisan serve
Si se generaron los seeders, verificar el archivo UserSeeder.php el cual genera los usuarios y sus claves, de manera generica es 12345678.
En caso de no querer ejecutar los seeders, la api cuenta con el proceso de registro de usuarios.

Modelos:
Los modelos estan establecidos en su debida carpeta, y con las relaciones ORM que conectan a unas tablas con otras, dependiendo su cardinalidad.
dentro de estos existen ademas una funcion estatica la cual es llamada en el controlador, para una funcion en particular que devuelve un codigo correlativo.

Vistas:
Se dejaron las vistas predetermnadas de autenticación de Laravel pues el desarrollo se trata de backend

Controladores:
Existen tres controladores clave:
AuthController el cual tiene la logica de autenticación, registro y salida de usuarios.
Abogados/SuscriptoresController, en este esta toda la logica de procesos para los suscriptores abogados, 
PanelAdmin/SuscriptoresController, aqui se encuentran las funciones para los usuarios administradores.

BD:
Se genero la base de datos en base a algunas consideraciones, basadas en el sistema de cobro por suscripción.

Consideraciones Finales:
La elaboración y ejecución de la api se realizó con Postman.
Los documentos del proyecto estan en la rama master.

Documento Elaborado por Darwin Salinas, 12/04/2022 para NexoAbogados.
