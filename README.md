# Laravel Nova Switcher Field
Replace default Boolean with switcher. \
Work on Index/Detail view with xhr, on Form like checkbox.

![](https://user-images.githubusercontent.com/839633/209843810-d656e6db-025f-4221-9c6c-9b238227706f.gif)

## Installation
```bash
composer require trin4ik/nova-switcher
```

## Usage
```php
use Trin4ik\NovaSwitcher\NovaSwitcher;
```
```php
NovaSwitcher::make('Active')
    ->trueLabel('On')
    ->falseLabel('Off');
```
or
```php
NovaSwitcher::make('Active')
    ->withLabels(true: 'On', false: 'Off');
```
Also, you can use reverse value (if switcher checked, value is false and vice versa)
```php
NovaSwitcher::make('Active')
    ->reverse();
```

## Thanks to...
- [David Piesse](https://github.com/davidpiesse), based on https://github.com/davidpiesse/nova-toggle
- [Thomas Lombart](https://dev.to/thomaslombart/how-to-build-a-reusable-and-accessible-toggle-switch-with-vue-3hh7) for the switcher css