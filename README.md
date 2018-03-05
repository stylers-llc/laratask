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
php artisan db:seed --class="Stylers\Laratask\Database\Seeds\LarataskTaxonomiesTableSeeder"
```

## Usage
* How to add User to Assignable, Delegatable, Executable
```php
use Stylers\Laratask\Interfaces\AssignableInterface;
use Stylers\Laratask\Interfaces\DelegatableInterface;
use Stylers\Laratask\Interfaces\ExecutableInterface;
use Stylers\Laratask\Models\Traits\Assignable;
use Stylers\Laratask\Models\Traits\Delegatable;
use Stylers\Laratask\Models\Traits\Executable;

class User extends Authenticatable implements AssignableInterface, DelegatableInterface, ExecutableInterface
{
    use Notifiable;
    use SoftDeletes;

    use Assignable;
    use Delegatable;
    use Executable;
}
```

#### Create TaskTemplate
```php
/**
 * @param Stylers\Laratask\Requests\StoreTaskTemplate $request
 */
public function store(StoreTaskTemplate $request)
{
    $assignable = $this->getModel($request->input('assignable_type'), $request->input('assignable_id'));
    $taskable = $this->getModel($request->input('taskable_type'), $request->input('taskable_id'));

    $builder = new TaskTemplateBuilder($request->input('name'));
    $builder->setDelegator(auth()->user());
    $builder->setAssigned($assignable);
    if ($taskable) $builder->setSubject($taskable);
    $builder->build();

    $taskTemplate = $builder->getTaskTemplate();
}
```

#### Update TaskTemplate
```php
/**
 * @param Stylers\Laratask\Requests\UpdateTaskTemplate $request
 * @param Stylers\Laratask\Models\TaskTemplate $taskTemplate
 */
public function update(UpdateTaskTemplate $request, TaskTemplate $taskTemplate)
{
    $assignable = $this->getModel($request->input('assignable_type'), $request->input('assignable_id'));
    $taskable = $this->getModel($request->input('taskable_type'), $request->input('taskable_id'));

    $builder = new TaskTemplateBuilder($request->input('name'));
    $builder->setTaskTemplate($taskTemplate);
    // $builder->setDelegator(auth()->user());
    $builder->setAssigned($assignable);
    if ($taskable) $builder->setSubject($taskable);
    $builder->build();

    $taskTemplate = $builder->getTaskTemplate();
}
```

#### Create TaskTemplateRuntime
```php

```

#### Update TaskTemplateRuntime
```php

```

#### Attach TaskTemplateRuntime to TaskTemplate
```php

```

#### Create Task
```php

```

#### Update Task
```php

```

#### Attach Task to TaskTemplate, TaskTemplateRuntime
```php

```
