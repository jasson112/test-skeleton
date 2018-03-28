# test-skeleton

Este es el repositorio para la prueba técnica de SunMedia, puedes usar este skeleton o hacerlo tu mismo.


## Docker (opcional)

En este repositorio tienes configurado una composición de contenedores docker que puedes utilizar, para ello tienes que tener instalado docker y docker-compose.

Para acceder al contenedor del servidor web: 

  - **docker-compose exec --user application webserver bash**
  
Para acceder al contenedor del servidor de la base de datos: 

  - **docker-compose exec database bash**
  
Los puertos expuestos:

  - **Servidor web**: 80
  - **Servidor base de datos**: 3306
  
Base de datos: sunmedia

Usuarios:

  - nombre de usuario: **root**
  - password: **root**
  

  - nombre de usuario: **sunmedia**
  - password: **sunmedia**
  
  
