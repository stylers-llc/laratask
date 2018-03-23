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

/**
 * @param $type
 * @param $id
 * @return null
 * @todo Do not return null: I know but I need null -> like as first() method
 */
private function getModel($type, $id)
{
    if (!$type) return null;

    return $type::findOrFail($id);
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
/**
 * @param Stylers\Laratask\Requests\StoreTaskTemplateRuntime $request
 */
public function store(StoreTaskTemplateRuntime $request)
{
    $input = $request->only('start_at', 'end_at', 'date_interval');

    $builder = new TaskTemplateRuntimeBuilder();
    $builder->setStartAt(new Carbon($input['start_at']));
    if ($input['end_at'] && $input['date_interval']) $builder->setEndAt(new Carbon($input['end_at']));
    if ($input['date_interval']) $builder->setDateInterval(new DateInterval($input['date_interval']));

    $builder->build();
    $taskTemplateRuntime = $builder->getTaskTemplateRuntime();
}
```

#### Update TaskTemplateRuntime
```php
/**
 * @param Stylers\Laratask\Requests\UpdateTaskTemplateRuntime $request
 * @param Stylers\Laratask\Models\TaskTemplateRuntime $taskTemplateRuntime
 */
public function update(UpdateTaskTemplateRuntime $request, TaskTemplateRuntime $taskTemplateRuntime)
{
    $input = $request->only('start_at', 'end_at', 'date_interval');

    $builder = new TaskTemplateRuntimeBuilder();
    $builder->setTaskTemplateRuntime($taskTemplateRuntime);
    $builder->setStartAt(new Carbon($input['start_at']));
    if ($input['end_at'] && $input['date_interval']) $builder->setEndAt(new Carbon($input['end_at']));
    if ($input['date_interval']) $builder->setDateInterval(new DateInterval($input['date_interval']));

    $builder->build();
    $taskTemplateRuntime = $builder->getTaskTemplateRuntime();
}
```

#### Sync (attach, detach) TaskTemplateRuntime to TaskTemplate with Task managing
```php
/**
 * @param Request $request
 * @param Stylers\Laratask\Models\TaskTemplate $taskTemplate
 */
public function addRuntime(Request $request, TaskTemplate $taskTemplate)
{
    $ids = (array)$request->input('task_template_runtime_id');
    $taskTemplate->syncTaskTemplateRuntimes($ids);

}
```

#### Create Task
The task is managing (create, delete - associate) in TaskTemplate::syncTaskTemplateRuntimes() method
```php
use Illuminate\Support\Facades\Artisan;

Artisan::call('task:generate');
```

#### Update Task
```php

```

#### Generate next Task
```bash
* * * * * php /path-to-your-project/artisan schedule:run >> /dev/null 2>&1
# OR manually 
php artisan task:generate
```

## TODO
- [ ] Release
- [ ] Publish on Packagist