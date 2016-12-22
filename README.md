# slim3-api-skeleton
My Slim Framework 3 API Skeleton with Logging

Am using silalahi/slim-logger to log my requests and response.

## Install

```shell
$ composer require slim/slim "^3.0"

$ composer require silalahi/slim-logger --dev dev-master

$ composer dump-autoload -o

```

Create logs folder to store logs.

## Run

```
$ php -S 0.0.0.0:7010 -t public public/index.php
```

http://localhost:7010/getUser?mobno=2

http://localhost:7010/getAllCustomers

```
$ php -S 0.0.0.0:7010 
```

http://localhost:7010/public/getUser?mobno=2

http://localhost:7010/public/getAllCustomers

## References

https://github.com/akrabat/slim-api-skeleton

https://packagist.org/packages/silalahi/slim-logger
