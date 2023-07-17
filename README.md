# AntoineDly\Logger

This really simple logger allow you to log in stream or in local arrays. It follows the [PSR-3](https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-3-logger-interface.md) standards.

## Usage

```php
<?php

use AntoineDly\Logger\Logger;

$logger = new Logger();
$logger->debug('test');
```


### Requirements

- AntoineDly\Logger `^1.0` works with PHP 8.2 or above.

### Author

Antoine Delaunay - <antoine.delaunay333@gmail.com> - [Twitter](http://twitter.com/AntDlny)<br />

### License

Monolog is licensed under the MIT License - see the [LICENSE](LICENSE) file for details

### Acknowledgements

This library is heavily inspired by Jordi Boggiano's [Monolog](https://logbook.readthedocs.io/en/stable/)
library, although it is a lot lighter than it.
### Contributing

If you want to contribute, make sure to run those 3 steps before submitting a PR : 

- Run static tests :
```php
tools/phpstan/vendor/bin/phpstan analyse src tests --level=9
```

- Run fixer :
```php
tools/php-cs-fixer/vendor/bin/php-cs-fixer fix src
```

- Run tests :
```php
vendor/bin/phpunit tests
```