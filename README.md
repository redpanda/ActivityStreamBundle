Redpanda ActivityStream Bundle
=================

Provides timeline activities for your Symfony2 application.

Requirements
------------

Symfony(https://github.com/symfony/symfony) obviously.

Installation
------------

### Add the deps for the needed bundles

``` php
[ActivityStreamBundle]
    git=https://github.com/redpanda/ActivityStreamBundle.git
    target=/bundles/Redpanda/Bundle/ActivityStreamBundle

```
Next, run the vendors script to download the bundles:

``` bash
$ php bin/vendors install
```

### Add to autoload.php

``` php
$loader->registerNamespaces(array(
    'Redpanda'             => __DIR__.'/../vendor/bundles',
    // ...
```

### Register ActivityStreamBundle to Kernel

``` php
<?php

    # app/AppKernel.php
    //...
    $bundles = array(
        //...
        new Redpanda\Bundle\ActivityStreamBundle\RedpandaActivityStreamBundle(),
    );
    //...
```

### Create database and schema

``` bash
$ php app/console doctrine:database:create
$ php app/console doctrine:schema:create
```

Credits
------------
django-activity-stream(https://github.com/justquick/django-activity-stream)
