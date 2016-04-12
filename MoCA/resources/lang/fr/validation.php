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

    'accepted'             => ':attribute doit être accepté.',
    'active_url'           => ':attribute n\'est pas un lien valide.',
    'after'                => ':attribute doit être après :date.',
    'alpha'                => ':attribute doit contenir seulement des lettres.',
    'alpha_dash'           => ':attribute doit contenir seulement des lettres, des chiffres et des dashes.',
    'alpha_num'            => ':attribute doit contenir seulement des lettres et des chiffres.',
    'array'                => ':attribute doit être un tableau.',
    'before'               => ':attribute doit être avant :date.',
    'between'              => [
        'numeric' => ':attribute doit être entre :min et :max.',
        'file'    => ':attribute doit être entre :min et :max kilo octet.',
        'string'  => ':attribute doit être entre :min et :max caractères.',
        'array'   => ':attribute doit avoir entre :min and :max.',
    ],
    'boolean'              => ':attribute le champs doit être vrai ou faux.',
    'confirmed'            => ':attribute confirmation ne correspond pas.',
    'date'                 => ':attribute n\'est pas une date valide.',
    'date_format'          => ':attribute ne corresponds pas au format :format.',
    'different'            => ':attribute et :other doit être différent.',
    'digits'               => ':attribute doit être :digits chiffres.',
    'digits_between'       => ':attribute doit être entre :min et :max chiffres.',
    'distinct'             => ':attribute champs a une valeur duplicative.',
    'email'                => ':attribute doit être un adresse courriel valide.',
    'exists'               => ':attribute est invalide.',
    'filled'               => ':attribute est requis.',
    'image'                => ':attribute doit être une image.',
    'in'                   => ':attribute est invalide.',
    'in_array'             => ':attribute n\'existe pas dans :other.',
    'integer'              => ':attribute doit être un nombre.',
    'ip'                   => ':attribute doit être un adresse IP.',
    'json'                 => ':attribute doit être une chaine JSON.',
    'max'                  => [
        'numeric' => ':attribute ne doit pas être supérieur à :max.',
        'file'    => ':attribute ne doit pas être supérieur à :max kilo octets.',
        'string'  => ':attribute ne doit pas être supérieur à :max caractères.',
        'array'   => ':attribute ne doit pas être supérieur à :max.',
    ],
    'mimes'                => ':attribute doit être de type: :values.',
    'min'                  => [
        'numeric' => ':attribute doit être au minimum :min.',
        'file'    => ':attribute doit être au minimum :min kilo octets.',
        'string'  => ':attribute doit être au minimum :min caractères.',
        'array'   => ':attribute doit être au minimum :min.',
    ],
    'not_in'               => ':attribute est invalide.',
    'numeric'              => ':attribute doit être un chiffre.',
    'present'              => ':attribute doit être présent.',
    'regex'                => 'Le format de :attributeest invalide.',
    'required'             => ':attribute est requis.',
    'required_if'          => ':attribute est requis quand :other est :value.',
    'required_unless'      => ':attribute est requis sauf quand :other est dans :values.',
    'required_with'        => ':attribute est requis quand :values est present.',
    'required_with_all'    => ':attribute est requis quand :values est present.',
    'required_without'     => ':attribute est requis quand :values n\'est pas present.',
    'required_without_all' => ':attribute est requis quand aucun de :values est present.',
    'same'                 => ':attribute et :other doivent correspondre.',
    'size'                 => [
        'numeric' => ':attribute doit être :size.',
        'file'    => ':attribute doit être :size kilo octets.',
        'string'  => ':attribute doit être :size caractères.',
        'array'   => ':attribute doit contenir :size items.',
    ],
    'string'               => ':attribute doit être un string.',
    'timezone'             => ':attribute doit être une zone valide.',
    'unique'               => ':attribute est déjà pris.',
    'url'                  => 'Le format de :attribute est invalide.',

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
