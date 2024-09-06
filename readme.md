# Kiwi Test

## Rutas configuradas

- `/authors` - Retorna todos los autores creados
- `/authors/create` - Retorna la vista para crear un autor
- `/authors/{id}` - Retorna un autor que corresponda al ID proporcionado

## Correr la aplicación

### Docker

#### Requerimientos

- Docker

#### Instalar la aplicación

- Corre `docker-compose up --build -d`
- Accede a la aplicación en `http://localhost:8080`

### Entornos apache (Laragon)

#### Requerimientos

- PHP 8.2
- MySQL 8.0
- Composer
- Git
- Apache

#### Instalar la aplicación

- Clona el repositorio en la carpeta correspondiente de tu entorno `git clone git@github.com:cedaesca/kiwi-test.git`
- Instala las dependencias `composer install`
- Accede a la aplicación según la ruta configurada para tu entorno.

#### Configurar la base de datos

- Acceder a `config/services.php`
- Cambiar la siguiente línea `$services->set(DatabaseManagerInterface::class, DatabaseManager::class)->args(['db', 'kiwi_test', 'root', 'pass']);` y en el método `args` pasar los valores de autenticación de la base de datos: hostname, dbname, user, password.

## Correr las pruebas automáticas

### Docker

- Ejecuta el siguiente comando en el terminal `docker-compose run --rm test`

### Entornos tradicionales

- Ejecuta el siguiente comando en el terminal `./vendor/bin/phpunit`
