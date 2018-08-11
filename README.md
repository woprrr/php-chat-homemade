# PHP CHAT HOMEMADE
That a demonstration repository for IAD france test.

## Overview

1. [Install prerequisites](#install-prerequisites)

    Before installing project make sure the following prerequisites have been met.

2. [Clone the project](#clone-the-project)

    We’ll download the code from its repository on GitHub.

3. [Run the application](#run-the-application)

    All will works well now.
___

## Install prerequisites

For now, this project has been mainly created for Unix `(Linux/MacOS)`. Perhaps it could work on Windows.

All requisites should be available for your distribution. The most important are :

* [Git](https://git-scm.com/downloads)
* [Docker](https://docs.docker.com/engine/installation/)
* [Docker Compose](https://docs.docker.com/compose/install/)

Check if `docker-compose` is already installed by entering the following command : 

```sh
which docker-compose
```

Check Docker Compose compatibility :

* [Compose file version 3 reference](https://docs.docker.com/compose/compose-file/)

The following is optional but makes life better :

```sh
which make
```

### Images to use

* Nginx
* Varnish
* Postgres
* Adminer

You should be careful when installing third party web servers such as MySQL or Nginx.

This project use the following ports :

| Server     | Port |
|------------|------|
| Postgres      | 5432 |
| Adminer | 2000 |
| Nginx      | 8080 |
| Varnish      | 8081 |
|  H2-Proxy (SSL) | 80 |

___

## Clone the project

To install [Git](http://git-scm.com/book/en/v2/Getting-Started-Installing-Git), download it and install following the instructions :

```sh
git clone git@github.com:woprrr/php-chat-homemade.git
```

Go to the project directory :

```sh
cd php-chat
```

### Project tree

```sh
.
├── LICENSE
├── Makefile
├── README.md
├── app1
│   ├── Dockerfile
│   ├── Dockerfile.nginx
│   ├── Dockerfile.varnish
│   ├── bin
│   ├── composer.json
│   ├── composer.lock
│   ├── docker
│   ├── phpunit.xml.dist
│   ├── public
│   │   └── index.php
│   ├── src
│   │   ├── AppKernel.php
│   │   ├── Config.php
│   │   ├── Controllers
│   │   ├── Database.php
│   │   ├── Models
│   │   ├── View.php
│   │   └── Views
│   ├── tests
│   └── vendor
├── docker-compose.yml
└── h2-proxy
    ├── Dockerfile
    └── conf.d
        └── default.conf
```
___

## Run the application

1. Initialize/Install project dependencies :

    ```sh
    make docker-start
    ```

2. Import the SQL dump :

    ```sh
    make import-db-project
    ```

3. Open your favorite browser :

    * [http://localhost:8080](http://localhost:8080/)  (Web Front).
    * [http://localhost:8081](http://localhost:8081/) (Web Front Varnished).
    * [https://localhost](https://localhost) (Web Front HTTPS).
    * [http://localhost:2000](http://localhost:2000/?pgsql=db&username=chat&db=chat_app&ns=public) Adminer (username: chat, password: chat)

Enjoy !!
```
 /\     /\
{  `---'  }
{  O   O  }
~~>  V  <~~
 \  \|/  /
  `-----'____
  /     \    \_
 {       }\  )_\_   _
 |  \_/  |/ /  \_\_/ )
  \__/  /(_/     \__/
    (__/
`