
PHP Dom document manipulator
============================

This library provides a rule based dom document manipulator.

Install
---------------------------

This library can be installed using composer

```
$ php composer.phar require netzmacht/php-dom-manipulator:~1.0
$ php composer.phar update
```

Usage
----------------------------

```php
<?php 

$manipulator = Netzmacht\DomManipulator\DomManipulator::forNewDocument();

$query = new Netzmacht\DomManipulator\Query\XPathQuery('xpath query');
$rule  = new Netzmacht\DomManipulator\Rule\AttributeRule($query, 'class');

$result = $manipulator
    ->addRule($rule)
    ->loadHtml('<html>   </html>')
    ->manipulate();
```

Credits
----------------------------

This library initial was extracted from the [toflar/contao-css-class-replacer](https://github.com/Toflar/contao-css-class-replacer)
which is maintained by Yanick Witschi alias [@Toflar](https://github.com/Toflar).
