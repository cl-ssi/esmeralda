# Upgrade to laravel 8.0
## Comandos que utilicé para llegar a poder upgradear segun la documentacion
composer remove milon/barcode
comment line 182 config/app.php
composer remove owen-it/laravel-auditing

composer update

# Laravel 8.0, como debería quedar el composer.json para poder actualziar
    "require": {
        "php": "^7.4.0",
        "ext-json": "*",
        "barryvdh/laravel-dompdf": "^0.8.6",
        "doctrine/dbal": "^2.10",
        "fideloper/proxy": "^4.2",
        "fruitcake/laravel-cors": "^1.0",
        "guzzlehttp/guzzle": "^7.0.1",
        "intervention/image": "^2.5",
        "laravel/framework": "^8.0",
        "laravel/tinker": "^2.0",
        "laravel/ui": "^3.0",
        "maatwebsite/excel": "^3.1",
        "milon/barcode": "^9.0",
        "owen-it/laravel-auditing": "^13.0",
        "spatie/laravel-permission": "^3.11"
    },
    "require-dev": {
        "facade/ignition": "^2.3.6",
        "fzaninotto/faker": "^1.9.1",
        "mockery/mockery": "^1.3.1",
        "nunomaduro/collision": "^5.0",
        "phpunit/phpunit": "^9.0"
    },

# Laravel 7.0 como estaba antes de actualizar
    "require": {
        "php": "^7.2.5",
        "ext-json": "*",
        "barryvdh/laravel-dompdf": "^0.8.6",
        "doctrine/dbal": "^2.10",
        "fideloper/proxy": "^4.2",
        "fruitcake/laravel-cors": "^1.0",
        "guzzlehttp/guzzle": "^6.3",
        "intervention/image": "^2.5",
        "laravel/framework": "^7.0",
        "laravel/tinker": "^2.0",
        "laravel/ui": "^2.0",
        "maatwebsite/excel": "^3.1",
        "milon/barcode": "7.0",
        "owen-it/laravel-auditing": "^10.0",
        "spatie/laravel-permission": "^3.11"
    },
    "require-dev": {
        "facade/ignition": "^2.0",
        "fzaninotto/faker": "^1.9.1",
        "mockery/mockery": "^1.3.1",
        "nunomaduro/collision": "^4.1",
        "phpunit/phpunit": "^8.5"
    },