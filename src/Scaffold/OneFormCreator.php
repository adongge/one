<?php

namespace Adong\One\Scaffold;

use Illuminate\Support\Facades\Log;

trait OneFormCreator
{
    /**
     * @param string $primaryKey
     * @param array  $fields
     * @param bool   $timestamps
     *
     * @return string
     */
    protected function oneGenerateForm(string $primaryKey = null, array $fields = [], $timestamps = null)
    {
        $primaryKey = $primaryKey ?: request('primary_key', 'id');
        $fields = $fields ?: request('fields', []);
        $timestamps = $timestamps === null ? request('timestamps') : $timestamps;

        $rows = [
            <<<EOF
\$form->display('{$primaryKey}');
EOF

        ];

        foreach ($fields as $field) {
            if (empty($field['name'])) {
                continue;
            }

            if ($field['name'] == $primaryKey) {
                continue;
            }
            if(isset($field['form'])){
                $rows[] = "            \$form->{$field['form']}('{$field['name']}');";
            }else{
                $rows[] = "            \$form->text('{$field['name']}');";
            }
            
        }
        if ($timestamps) {
            $rows[] = <<<'EOF'
        
            $form->display('created_at');
            $form->display('updated_at');
EOF;
        }

        return implode("\n", $rows);
    }
}
