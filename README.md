# Desarrollo 1 #

## Objetivo ##

El objeto de este desarrollo es saber qué repositorios se han visto afectados por un commit/cambio en cualquiera de los repositorios que incluye. Está enfocado a un sistema de CI/CD (no es necesario que hayas trabajado con CI/CD) que, básicamente, necesita entender dependencias declaradas usando composer entre códigos ubicados en repositorios distintos.

Para ello, plantea la solución como un comando de consola que es llamado cuando hay un commit en cualquier repositorio y que recibe por parámetros una ruta a un git, un commit Id y la branch donde se ha hecho el commit.

Crea una o varias clases que, dado una lista de directorios locales donde en cada directorio hay un repositorio git con un fichero composer.json, debe crear en memoria una representación en forma de árbol de las dependencias entre repositorios. Ten presente que al haber varios repositorios pueden generarse árboles distintos, es decir, no todos los repositorios forman parte de un mismo árbol.

Sólo debes fijarte en los repositorios incluidos en la lista de directorios, es decir, si un repositorio hace referencia a otros repositorios que no están listados, entonces puedes ignorar los repositorios no listados (en el ejemplo dado más abajo se tratan como repositorio desarrollado por terceras partes).

Incorpora métodos/funciones para preguntar al sistema, dado un nombre de un composer.json ( https://getcomposer.org/doc/04-schema.md#name ), qué otros composer.json lo incluyen, tanto de forma directa como indirecta.

Entrégame una URL de github donde pueda ver el resultado del desarrollo, y el historial de commits.

Te pongo un ejemplo con tres niveles de anidación, pero no hay límites en el nivel de anidación:
- Proyecto 1, depende de varios repositorios:
    - Librería 1 (desarrollada in-house)
    - Librería 2 (desarrollada in-house), que a su vez depende de otra librería:
       - Librería 4 (desarrollada in-house)
       - Librería 5 (desarrollada por terceras partes)
    - Librería 3 (desarrollada por terceras partes)

- Proyecto 2, depende de varios repositorios:
    - Librería 2 (desarrollada in-house), que a su vez depende de otra librería:
       - Librería 4 (desarrollada in-house)
       - Librería 5 (desarrollada por terceras partes)
    - Librería 6 (desarrollada por terceras partes)

Con el desarrollo 1, has de detectar que, si se hace un commit en la Librería 4, se ha de lanzar el Pipeline CI/CD asociado al Proyecto 1 y el Pipeline CI/CD asociado al Proyecto 2. En cambio, si se hace un commit en la Librería 1, entonces sólo debe lanzar el Pipeline CI/CD asociado al Proyecto 1.

## Solución ##

### Ejecución containers ###
```
composer update
```
```
doker-compose up -d
```

### Lanzamiento de hooks ###
Se han creado hooks post-commit en cada repositorio de los proyectos, cuando hay un commit, se ejecutará
```
./bin/dependency $hooker_dir_project $commit_id $branch
```
y devolvería el resultado de un comando de consola por cada uno de los proyectos afectados, por ejemplo, un git pull


### Comprobación del arbol de directorios ###

Desde el root del proyecto
```
./bin/tree
```

### Comprobación de dependencias ###

Desde el root del proyecto
```
./bin/secuence repositories/Libreria4
```
```
./bin/secuence repositories/Libreria1
```

### Tests ###
Desde el root del proyecto, ejecutar:
```
php vendor/bin/phpunit --bootstrap src/config.php tests
```
o
```
composer tests
```

# Desarrollo 2 #

## Objetivo ##
El objeto de este desarrollo es evaluar tu manejo de estructuras de Base de Datos. Para ello, plantea qué estructura de Base de Datos usarías para almacenar toda la información manejada en el Desarrollo 1, es decir, guardar y mantener la estructura en árbol dentro de una Base de Datos Mysql 8.
Entrégame una URL de github donde pueda ver el código y el SQL con el resultado del desarrollo, por ejemplo, de un mysqldump del esquema de Base de Datos.

## Solución ##
en ./etc/docker/mysql/dump.sql podemos ver una tabla principal de proyectos y una secundaria donde vinculamos cada proyecto a quien lo incluye como dependencia, o un valor 0 si es un proyecto principal
