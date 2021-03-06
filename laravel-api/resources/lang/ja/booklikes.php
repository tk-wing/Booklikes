<?php

return [
    'blade' => [
        'signup' => '新規会員登録'
    ],
    'validation' => [
        'alpha_num' => ':attributeは、半角英数字(混在)で入力してください。',
        'required' =>[
            'selected' => ':attributeは、必ず選択してください。',
        ],
        'bookshelf' => [
            'exists' => 'この本は既に:attributeに登録されています。',
        ],
        'exists' => '入力された:attributeは、登録されていません。'
    ]
];
