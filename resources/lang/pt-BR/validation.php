<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted'             => 'O campo :attribute deve ser aceito.',
    'active_url'           => 'O campo :attribute não é uma URL válida.',
    'after'                => 'O campo :attribute deve ser depois de :date.',
    'after_or_equal'       => 'O campo :attribute deve ser maior ou igual a :date.',
    'alpha'                => 'O campo :attribute deve conter somente letras.',
    'alpha_dash'           => 'O campo :attribute deve conter somente letras e números e traços.',
    'alpha_num'            => 'O campo :attribute deve conter somente letras e números.',
    'array'                => 'O campo :attribute deve ser um array.',
    'before'               => 'O campo :attribute deve ser uma data anterior a :date.',
    'before_or_equal'      => 'O campo :attribute deve ser uma data igual ou menor que :date.',
    'between'              => [
        'numeric' => 'O campo :attribute precisa estar entre :min e :max.',
        'file'    => 'O campo :attribute precisa estar entre :min e :max kb.',
        'string'  => 'O campo :attribute precisa estar entre :min e :max caracteres.',
        'array'   => 'O campo :attribute precisa have entre :min e :max itens.',
    ],
    'boolean'              => 'O campo :attribute precisa ser true ou false.',
    'confirmed'            => 'O campo :attribute não confere com a cofirmação.',
    'date'                 => 'O campo :attribute não é uma data válida.',
    'date_format'          => 'O campo :attribute não bate com o formato :format.',
    'different'            => 'O campo :attribute e :other precisam ser diferentes.',
    'digits'               => 'O campo :attribute precisa ter :digits digitos.',
    'digits_between'       => 'O campo :attribute precisa ter entre :min e :max digitos.',
    'dimensions'           => 'O campo :attribute tem dimensões inválidas de imagem.',
    'distinct'             => 'O campo :attribute tem um valor duplicado.',
    'email'                => 'O campo :attribute precisa ser em e-mail válido',
    'exists'               => 'O campo :attribute é inválido.',
    'file'                 => 'O campo :attribute precisa ser um arquivo.',
    'filled'               => 'O campo :attribute precisa ter um valor.',
    'image'                => 'O campo :attribute precisa ser uma imagem.',
    'in'                   => 'O campo :attribute é inválido.',
    'in_array'             => 'O campo :attribute não existe em :other.',
    'integer'              => 'O campo :attribute precisa ser um inteiro.',
    'ip'                   => 'O campo :attribute precisa ser um endereço IP válido.',
    'ipv4'                 => 'O campo :attribute precisa ser um endereço IPv4 válido.',
    'ipv6'                 => 'O campo :attribute precisa ser um endereço IPv6 válido.',
    'json'                 => 'O campo :attribute precisa ser um arquivo JSON válido.',
    'max'                  => [
        'numeric' => 'O campo :attribute não pode ser maior que :max.',
        'file'    => 'O campo :attribute não pode ser maior que :max kb.',
        'string'  => 'O campo :attribute não pode ser maior que :max caracteres.',
        'array'   => 'O campo :attribute não pode ter mais que :max itens.',
    ],
    'mimes'                => 'O campo :attribute precisa ser um arquivo do tipo: :values.',
    'mimetypes'            => 'O campo :attribute precisa ser um arquivo do tipo: :values.',
    'min'                  => [
        'numeric' => 'O campo :attribute precisa ser no mínimo :min.',
        'file'    => 'O campo :attribute precisa ter no mínimo :min kb.',
        'string'  => 'O campo :attribute precisa ter no mínimo :min caracteres.',
        'array'   => 'O campo :attribute precisa ter no mínimo :min itens.',
    ],
    'not_in'               => 'O campo :attribute é inválido.',
    'not_regex'            => 'O campo :attribute está com formato inválido.',
    'numeric'              => 'O campo :attribute precisa ser um número.',
    'present'              => 'O campo :attribute precisa estar presente.',
    'regex'                => 'O campo :attribute é inválido.',
    'required'             => 'O campo :attribute é obrigatório.',
    'required_if'          => 'O campo :attribute é obrigatório quando :other é :value.',
    'required_unless'      => 'O campo :attribute é obrigatório a menos que :other esteja em :values.',
    'required_with'        => 'O campo :attribute é obrigatório quando :values está presente.',
    'required_with_all'    => 'O campo :attribute é obrigatório quando :values está presente.',
    'required_without'     => 'O campo :attribute é obrigatório quando :values não está presente.',
    'required_without_all' => 'O campo :attribute é obrigatório quando nenhum dos :values estiver presente.',
    'same'                 => 'Os campos :attribute e :other precisam combinar.',
    'size'                 => [
        'numeric' => 'O campo :attribute precisa ser :size.',
        'file'    => 'O campo :attribute precisa ter :size kb.',
        'string'  => 'O campo :attribute precisa ter :size caracteres.',
        'array'   => 'O campo :attribute precisa ter :size itens.',
    ],
    'string'               => 'O campo :attribute precisa ser uma string.',
    'timezone'             => 'O campo :attribute precisa ser uma zona válida.',
    'unique'               => 'O campo :attribute já está em uso.',
    'uploaded'             => 'O upload do campo :attribute falhou.',
    'url'                  => 'O formato de :attribute é inválido.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */

    'attributes' => [],

];
