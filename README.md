# Projeto LibroApi
## Setar variaveis .env
```
DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=sail
DB_PASSWORD=password
```

## Instalação
Dentro do projeto usando o laravel sail a partir desse comando é possível subir o projeto:
```
docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v "$(pwd):/var/www/html" \
    -w /var/www/html \
    laravelsail/php83-composer:latest \
    composer install --ignore-platform-reqs
```
Após instalar as dependencias pode setar o key com o comando:
```
./vendor/bin/sail up -d
./vendor/bin/sail artisan key:generate
```
## Executando migrations
```
./vendor/bin/sail artisan migrate
```
## Listagem de rotas
```
./vendor/bin/sail artisan route:list
```

