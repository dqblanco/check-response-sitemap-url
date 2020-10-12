# Cómo verificar el código de respuesta de las urls de un sitemap
[![License: GPL v3](https://img.shields.io/badge/License-GPLv3-blue.svg)](https://www.gnu.org/licenses/gpl-3.0)

El siguiente script nos ayuda a conocer el código de repuestas de las urls de un mapa del sitio. 

Con el código http de repuesta podemos saber si la url esta disponible o si presenta algún error de ejecución. Conocer si código de respuesta 
de nuestras urls publicadas en el mapa del sitio responden correctamente es muy importante, ya que puede afectar nuestro SEO. Muchas urls sin respuesta, puede ser un problema serio de SEO. 

## Requerimientos técnicos

* Versión de php usada: `php -v` - **PHP 7.3.11**
* Curl

## Instalación
* Clonar proyecto
* Ejecutar: `php bin/composer install`
* Permisos necesarios: `chmod +x bin/console`

## Cómo ejecutar el script

`bin/console check-url-sitemap:check urlSiteMap`

:gift: [David Quinones]( https://github.com/dqblanco).
