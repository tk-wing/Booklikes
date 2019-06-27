<?php

return [
    'blade' => [
        'signup' => 'Signup'
    ],
    'validation' => [
        'alpha_num' => 'Password must be input with numeric and small characters',
        'required' => [
            'selected' => ':attribute must be select',
        ],
        'bookshelf' => [
            'exists' => 'This book has been already added to :attribute.',
        ],
        'exists' => 'The input :attribute is not registered',
    ]
];
