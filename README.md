# Laravel Task Manager

## Installation
```bash
composer require stylers-llc/laratask
```

After updating composer, add the ServiceProvider to the providers array in `config/app.php`
```php
Stylers\Laratask\Providers\LarataskServiceProvider::class,
```

You need publish to the config.
```bash
php artisan vendor:publish --provider="Stylers\Laratask\Providers\LarataskServiceProvider"
```

You need to run the migrations for this package.
```bash
php artisan migrate
```

## Usage
```php

```

#### Create Task
```php

```

#### Update Task
```php

```

#### Delete Task
```php

```
