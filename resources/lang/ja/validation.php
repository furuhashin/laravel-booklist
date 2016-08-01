<?php
return [
    /*
    |--------------------------------------------------------------------------
    | バリデーション言語行
    |--------------------------------------------------------------------------
    */

    "date" => ":attributeは正しい日付(yyyy-MM-ddの形式)ではありません。",
    "min" => [
        "string" => ":attributeは:min文字以上入力してください。",
    ],
    "required" => ":attributeを入力してください。",
    /*
    |--------------------------------------------------------------------------
    | カスタムバリデーション属性名
    |--------------------------------------------------------------------------
    */
    'attributes' => [
        'title' => 'タイトル',
        'body' => '本文',
        'deadline' => '期限',
        'keyword' => 'キーワード',

    ],
];
