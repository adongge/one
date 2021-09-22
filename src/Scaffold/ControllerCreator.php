<?php
namespace Adong\One\Scaffold;

use Dcat\Admin\Scaffold\ControllerCreator as BaseCreator;

class ControllerCreator extends BaseCreator
{
    use OneFormCreator;
     /**
     * ControllerCreator constructor.
     *
     * @param string $name
     * @param null   $files
     */
    public function __construct($name, $files = null)
    {
        parent::__construct($name,$files);
    }

      /**
     * Create a controller.
     *
     * @param string $model
     *
     * @throws \Exception
     *
     * @return string
     */
    public function create($models)
    {
        $model = $models['model'];
        $path = $this->getPath($this->name);
        $dir = dirname($path);

        if (! is_dir($dir)) {
            $this->files->makeDirectory($dir, 0755, true);
        }

        if ($this->files->exists($path)) {
            throw new \Exception("Controller [$this->name] already exists!");
        }

        $stub = $this->files->get($this->getStub());

        $slug = str_replace('Controller', '', class_basename($this->name));

        $model = $model ?: 'App\Admin\Repositories\\'.$slug;

        $this->files->put($path, $this->oneReplace($stub, $this->name, $model, $slug,$models));
        $this->files->chmod($path, 0777);

        return $path;
    }

    /**
     * @param string $stub
     * @param string $name
     * @param string $model
     *
     * @return string
     */
    protected function oneReplace($stub, $name, $model, $slug, $models)
    {
        $stub = $this->replaceClass($stub, $name);

        return str_replace(
            [
                'DummyModelNamespace',
                'DummyModel',
                'DummyTitle',
                '{controller}',
                '{grid}',
                '{form}',
                '{show}',
            ],
            [
                $model,
                class_basename($model),
                class_basename($model),
                $slug,
                $this->generateGrid($models['primary_key'], $models['fields'], $models['timestamps']),
                $this->oneGenerateForm($models['primary_key'], $models['fields'], $models['timestamps']),
                $this->generateShow($models['primary_key'], $models['fields'], $models['timestamps']),
            ],
            $stub
        );
    }
}