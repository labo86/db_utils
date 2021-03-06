labo86\db_utils
========
Una nueva asombrosa biblioteca Composer.

[![Latest Stable Version](https://poser.pugx.org/labo86/db_utils/v/stable)](https://packagist.org/packages/labo86/db_utils)
[![Total Downloads](https://poser.pugx.org/labo86/db_utils/downloads)](https://packagist.org/packages/labo86/db_utils)
[![License](https://poser.pugx.org/labo86/db_utils/license)](https://github.com/labo86/db_utils/blob/master/LICENSE)
[![Build Status](https://travis-ci.org/labo86/db_utils.svg?branch=master)](https://travis-ci.org/labo86/db_utils)
[![codecov.io Code Coverage](https://codecov.io/gh/labo86/db_utils/branch/master/graph/badge.svg)](https://codecov.io/github/labo86/db_utils?branch=master)
[![Code Climate](https://codeclimate.com/github/labo86/db_utils/badges/gpa.svg)](https://codeclimate.com/github/labo86/db_utils)
![Hecho en Chile](https://img.shields.io/badge/country-Chile-red)




## Instalación
```
composer require labo86/db_utils
```

```
wget https://github.com/labo86/db_utils/releases/download/0.1.1/db_utils.phar;
wget https://raw.githubusercontent.com/labo86/db_utils/master/examples/script.php
```

## Información de mi máquina de desarrollo
Salida de [system_info.sh](https://github.com/labo86/db_utils/blob/master/scripts/system_info.sh)
```
+ hostnamectl
+ grep -e 'Operating System:' -e Kernel:
  Operating System: Ubuntu 20.04 LTS
            Kernel: Linux 5.4.0-33-generic
+ php --version
PHP 7.4.3 (cli) (built: May 26 2020 12:24:22) ( NTS )
Copyright (c) The PHP Group
Zend Engine v3.4.0, Copyright (c) Zend Technologies
    with Zend OPcache v7.4.3, Copyright (c), by Zend Technologies
    with Xdebug v2.9.2, Copyright (c) 2002-2020, by Derick Rethans
```

## Notas
  - El código se apega a las recomendaciones de estilo de [PSR-1](https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-1-basic-coding-standard.md).
  - Este proyecto esta pensado para ser trabajado usando [PhpStorm](https://www.jetbrains.com/phpstorm).
  - Se usa [PHPUnit](https://phpunit.de/) para las pruebas unitarias de código.
  - Para la documentación se utiliza el estilo de [phpDocumentor](http://docs.phpdoc.org/references/phpdoc/basic-syntax.html). 

