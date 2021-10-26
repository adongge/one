<?php

namespace Adong\One\Scaffold;

use Dcat\Admin\Support\Helper;
use Dcat\Admin\Scaffold\LangCreator;
use Illuminate\Support\Facades\App;

class OneLangCreator extends LangCreator
{
    protected $fields = [];
    protected $config = [];

    public function __construct(array $config)
    {
        $this->config = $config; 
        $this->fields = $config['fields'];
    }

    /**
     * 生成语言包.
     *
     * @param string $controller
     *
     * @return string
     */
    public function create(string $controller)
    {
        $controller = str_replace('Controller', '', class_basename($controller));

        $filename = $this->getLangPath($controller);
        if (is_file($filename)) {
            return;
        }

        $content = [
            'labels' => [
                $controller => $this->config['comment'],
                $this->config['table'] => $this->config['comment']
            ],
            'fields'  => [],
            'options' => [],
        ];
        foreach ($this->fields as $field) {
            if (empty($field['name'])) {
                continue;
            }

            $content['fields'][$field['name']] = $field['translation'] ?: $field['name'];
        }

        $files = app('files');
        if ($files->put($filename, Helper::exportArrayPhp($content))) {
            $files->chmod($filename, 0777);

            return $filename;
        }
    }
}
