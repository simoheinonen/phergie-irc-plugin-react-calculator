# Calculator plugin for [Phergie](http://github.com/phergie/phergie-irc-bot-react/)

## Installation

```
composer require simoheinonen/phergie-irc-plugin-react-calculator
```

## Configuration

```php
return [
    'plugins' => [
        new \Phergie\Irc\Plugin\React\Command\Plugin(['prefix' => '!']), // dependency
        new \SimoHeinonen\Phergie\Plugin\Calculator\Plugin(new \ChrisKonnertz\StringCalc\StringCalc()),
    ]
];
```

