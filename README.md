Documentación
===================

Esta es una arquitectura MVC basada en Slim Framework v3.0. [documentación](http://www.slimframework.com/docs/v3/)

Las ventajas de esta arquitectura:

    * mejores manejo y validaciones de rutas.
    * puedes crear una aplicación escalable.
    * mejor manejo de vistas con twig.


* Atención *: SlimMVC puede funcionar correctamente solo si su máquina descargo la librerías de composer y tiene un entorno de PHP (XAMPP).

Indice
=================

  <!-- * [github-markdown-toc](#github-markdown-toc)
  * [Installation](#installation)
    * [Precompiled binaries](#precompiled-binaries)
    * [Compiling from source](#compiling-from-source)
    * [Homebew (Mac only)](#homebew-mac-only)
  * [Tests](#tests)
  * [Usage](#usage)
    * [STDIN](#stdin)
    * [Local files](#local-files)
    * [Remote files](#remote-files)
    * [Multiple files](#multiple-files)
    * [Combo](#combo)
    * [Depth](#depth)
    * [No Escape](#no-escape)
    * [Github token](#github-token)
  * [LICENSE](#license) -->

Instalación
============

Debe tener instalado composer en su maquina y ejecutar lo siguiente:

```bash
$ ruta-del-proyecto> composer install
```

USO
=====

Router
-----------

Para crear una nueva ruta solo deben ingresar al archivo Router.php en app/Core/Router.php.

Ejemplo 1: Ruta normal

```php
// $app->[metodo get, post, put o delete]('nombre-de-ruta', 'Controlador:funcion');
// http://localhost/mi-proyecto/public PD: el produccion con configuracion de su servidor o cpanel pueden dejar como carperta principal public asi no se vera en la url.
$app->get('/', 'HomeController:index');
```

Ejemplo 2: Ruta con nombre

```php
// $app->[metodo get, post, put o delete]('nombre-de-ruta', 'Controlador:funcion')->setName('Nombre');
// http://localhost/mi-proyecto/public/login PD: el produccion con configuracion de su servidor o cpanel pueden dejar como carperta principal public asi no se vera en la url.
// El nombre sirve para hacer redireccion en los controlador mas facil.
$app->get('/login', 'AuthController:login')->setName('Login');
```

Ejemplo 3: Grupo de rutas

```php
// $app->group('nombre-de-grupo', funcion agregando la variable $app)
// http://localhost/mi-proyecto/public/group/ruta1
// http://localhost/mi-proyecto/public/group/ruta2
$app->group('/group', function() use ($app) {
    $app->get('/ruta1', 'HomeController:testing1')->setName('Ruta1');
    $app->get('/ruta2', 'HomeController:testing2')->setName('Ruta2');
});
```


Container
-----------

Los container sirven para agregar funciones extras a la estructura de slim o agregar un nuevo controlador.

Ejemplo: La libreria de TWIG se agrega con una extension.

```php
$container['view'] = function($container) {

    $view = new \Slim\Views\Twig(dirname(__DIR__).'/Views', [
        'cache' => false
    ]);

    $view->addExtension(new \Slim\Views\TwigExtension(
        $container->router,
        $container->request->getUri()
    ));

    return $view;
};
```

se usa en los controladores.

Ejemplo:

```php
<?php

namespace Controllers;

class HomeController extends Controller {

    public function starter($request, $response) {
        // $this->view esa es nuestra extension con un container.
        return $this->view->render($response, '/Home/Starter.twig');
    }

}
```

Controller
-----------

Solo debes crear un archivo en la carpeta Controllers.
Debe tener namespace y terminar con la palabra Controller NombreController 

Ejemplo:

```php
namespace Controllers;

class HomeController extends Controller {
    //... CODE:
}
```

Ademas se debe agregar la referencia en los containers en el el archivo app/Core/Containers.php

Ejemplo:

```php
$container['NombreController'] = function($container) {
    return new \Controllers\NombreController($container);
};
```

Vistas
-----------

Solo debes crear un archivo en la carpeta View puede ser extension html o twig.
pueden usar la documentación de [twig](https://twig.symfony.com/). 

Ejemplo:

```html
// Se asocia a un layout
{% extends "Shared/Layout.twig" %}

// puedes agregar styles unicos para esa vista.
{% block style %}
<link href="styles.css" rel="stylesheet" type="text/css">
{% endblock %} 

// Contenedor principal
{% block content %}
<!-- YOUR CODE HTML -->
{% endblock %} 

// puedes agregar bloques script o agregar librerias js
{% block script %}
<script src="lib.js"></script>
<script src="assets\js\app.min.js">
    // YOUR CODE
</script>
{% endblock %} 
```
