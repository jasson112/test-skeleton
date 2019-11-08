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

Users:

  - nombre de usuario: **root**
  - password: **root**
  

  - nombre de usuario: **sunmedia**
  - password: **sunmedia**
  
Symfony
===

##Instructions to make the app works

You must run the commands above because with that you can enter in the admin panel 

- Command for database update:
    ```
    php bin/console doctrine:schema:update --force
    ```

- Command for creation of the user admin:
    ```
    php bin/console fos:user:create admin admin@example.com admin --super-admin
    ```
- If you want to see all components  serialized you can got to ```/components``` url to see that !

So after you run this commands you now can enter in the admin panel with the ```/admin``` url and you can add users and ads with components

##Troubleshooting

- If you are running the app in Docker have an error with the connection in the database when you run the second command you need to go to .env file and change the connection host to localhost, then run the command again and it will works like a charm.
    - Note: When you finish the execution of the command you have to return the host to database-sunmedia 
  
