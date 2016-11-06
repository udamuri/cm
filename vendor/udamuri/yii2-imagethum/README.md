README
======
Yii2 imagethum

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist udamuri/yii2-imagethum "*"
composer global require "udamuri/yii2-imagethum:^1.0"
```

or add

```
"udamuri/yii2-imagethum": "*"
```
to the require section of your `composer.json` file.


Usage
-----

Once the extension is installed, simply use it in your code by  :

```php
<?= \udamuri\imagethum\ImageThum::widget(); ?>```