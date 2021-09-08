# VIBRA-api

Conjunto de servicios REST-API para aplicación movil y web de www.soyvibra.com

## Instalación

Clonar repositorio

```bash
git clone https://rafifa@bitbucket.org/seneca-dev/vibra-api.git
```

Hacer un checkout de la rama principal de desarrollo "develop", luego ejecutar composer install para instalar librerías.

```bash
git checkout develop
```

```bash
composer install
```

Crear y configurar archivo de entorno ".env", en base al archivo ".env.example". En este archivo se debe configurar la conexión a la base de datos, y adicionalmente colocar el
APP_KEY, se puede colocar el siguiente.

```bash
APP_KEY=base64:j/GjbIYlggY2p9qHtcks3EF+AhzAM1sH+igNatQK5XY=
```

Liberar cache.

```bash
php artisan cache:clear
```

Ejecutar comando para crear la base de datos y seeds.

```bash
php artisan migrate --seed
```

Inicializar claves para la emisión de tokens passport.

```bash
php artisan passport:install
```
