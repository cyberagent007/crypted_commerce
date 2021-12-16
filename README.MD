# BTC E-COMMERCE PLATFORM

[![standard-readme compliant](https://img.shields.io/badge/readme%20style-standard-brightgreen.svg?style=flat-square)](https://github.com/RichardLitt/standard-readme)

A standard style for README files

Your README file is normally the first entry point to your code. It should tell people why they should use your module, how they can install it, and how they can use it. Standardizing how you write your README makes creating and maintaining your READMEs easier. Great documentation takes work!

This repository contains:

1. [The specification](spec.md) for how a standard README should look.
2. A link to [a linter](https://github.com/RichardLitt/standard-readme-preset) you can use to keep your README maintained ([work in progress](https://github.com/RichardLitt/standard-readme/issues/5)).
3. A link to [a generator](https://github.com/RichardLitt/generator-standard-readme) you can use to create standard READMEs.
4. [A badge](#badge) to point to this spec.
5. [Examples of standard READMEs](example-readmes/) - such as this file you are reading.

Standard Readme is designed for open source libraries. Although it’s [historically](#background) made for Node and npm projects, it also applies to libraries in other languages and package managers.


## Table of Contents

- [Background](#background)
- [Install](#install)
- [Usage](#usage)
    - [Generator](#generator)
- [Badge](#badge)
- [Example Readmes](#example-readmes)
- [Related Efforts](#related-efforts)
- [Maintainers](#maintainers)
- [Contributing](#contributing)
- [License](#license)

## Что это?

Это веб-платформа для создания и управлению магазина с цифровыми товарами без
взаимодействия со внешними API. Обеспечивая доступ до управлению процессами, 
анализом, и состоит из различных приложений/сервисами состоящей внутри приватной
сети и все сервисы, кроме зеркала магазина в вебе, и его панели управления(см. конфигруацию.)


~ ["Анонимус" с 2ch.hk ]()

### Цель проекта

1. Создать self-hosted окружения для организации магазина с цифровыми товарами.
2. Обеспечить качество этого окружения и гарантировать безошибочную работу, уведомления
о сбоях, проблемах, и прочих уведомлений.
3. Обеспечить этот проект всей необходимой документацией и интерфейсом для удобного использования.

## Установка

### Локальное окружение, требования:

- Git
- Docker, Docker Compose. 
- Linux OS(should work on Windows and OS X, but not tested)

### Внутри Docker-а, Основные технологические решения(в разр.):

- Linux/BSD based OS/VirtualBased Solution
- PHP 7.4 <
- Composer
- Postgres
- NodeJS and NPM
- Symfony CLI 
- Nginx
- Do


## Установка

1. Склоинруйте репозиторий основного проекта. https://github.com/cyberagent007/crypted_commerce

```sybase
git clone git@github.com:cyberagent007/crypted_commerce.git
```

2. Склоинруйте репозиторий с инфраструкторой: https://github.com/cyberagent007/symfony-docker
```sybase
cd crypted_commerce
git clone git@github.com:cyberagent007/symfony-docker.git
mv -R symfony-docker ./docker
```

3. Запустите команду для старта виртуального окружения.
Примечание: полный список команд: см. репозиторий инфраструктуры, файл readme.md
```sybase
./bin/start.bash
```

4. Запуск миграций, фикстур, прочее.

```sybase
./bin/login-php-fpm.bash
composer install
php bin/console doctrine:migrations:execute
php bin/console doctrine:fixtures:load
php bin/console assets:install
php bin/console cache:clear
```



## Maintainers

  [@vmvbox](https://github.com/vmvbox).


## License

[MIT](LICENSE)