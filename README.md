# RowColRenderer

This package dynamically renders Bootstrap rows and cols depending on the number of items a model has.

You can set a maximum per row

Examples:


## Install

```bash
$ composer require taylornetwork/row-col-renderer
```

## Usage

To generate a new Renderer run 

```bash
$ php artisan make:renderer ModelName
```

Where `ModelName` is the name of the model you want to use for this renderer.

This would generate a `App\Renderers\ModelNameRenderer` class

```php
use Illuminate\Database\Eloquent\Model;
use TaylorNetwork\RowColRenderer\Renderer;

class ModelNameRenderer extends Renderer
{
    protected $model = \App\ModelName::class;

    public function getView(Model $item): string
    {
        return view('someview', ['someModel' => $item]);
    }
}
```

To use all you need is to create a view or string to output the item data.

### Example

Let's say you have a landing page that you want to display some of the services you offer to clients.

You have a model `App\Service`

You would create a view `resources/views/partials/service.blade.php`

```php
<div class="col-md">
    <span class="fa-stack fa-4x">
        <i class="fas fa-circle fa-stack-2x text-primary"></i>
        <i class="fas fa-{{ $service->icon }} fa-stack-1x fa-inverse"></i>
    </span>
    <h4 class="service-heading">{{ $service->title }}</h4>
</div>
```

Run the artisan command

```bash
$ php artisan make:renderer Service
```

In your `app/Renderers/ServiceRenderer.php`


```php
use Illuminate\Database\Eloquent\Model;
use TaylorNetwork\RowColRenderer\Renderer;

class ServiceRenderer extends Renderer
{
    protected $model = \App\Service::class;

    public function getView(Model $item): string
    {
        return view('partials.service', ['service' => $item]);
    }
}
```

Then where ever you want to render the services:

```
{!! Renderer::service()->render() !!}
```

**9 Services**

|           | Col 1 | Col 2 | Col 3 | Col 4 |
|-----------|--------|--------|--------|--------|
| **Row 1** | Service 1 | Service 2 | Service 3 | - |
| **Row 2** | Service 4 | Service 5 | Service 6 | - |
| **Row 3** | Service 7 | Service 8 | Service 9 | - |

**8 Services**

|           | Col 1 | Col 2 | Col 3 | Col 4 |
|-----------|--------|--------|--------|--------|
| **Row 1** | Service 1 | Service 2 | Service 3 | Service 4 |
| **Row 2** | Service 5 | Service 6 | Service 7 | Service 8 |

**7 Services**

|           | Col 1 | Col 2 | Col 3 | Col 4 |
|-----------|--------|--------|--------|--------|
| **Row 1** | Service 1 | Service 2 | Service 3 | Service 4 |
| **Row 2** | Service 5 | Service 6 | Service 7 | - |
