<?php

return [
    'date' => [
        /**
         * Carbon date format
         */
        'format'         => 'd-m-Y',
        /**
         * Due date for payment since invoice's date.
         */
        'pay_until_days' => 7,
    ],

    'serial_number' => [
        'series'           => '410',
        'sequence'         => 1,
        /**
         * Sequence will be padded accordingly, for ex. 00001
         */
        'sequence_padding' => 4,
        'delimiter'        => '-',
        /**
         * Supported tags {SERIES}, {DELIMITER}, {SEQUENCE}
         * Example: AA.00001
         */
        'format'           => '{SERIES}{DELIMITER}{SEQUENCE}',
    ],

    'currency' => [
        'code'                => 'eur',
        /**
         * Usually cents
         * Used when spelling out the amount and if your currency has decimals.
         *
         * Example: Amount in words: Eight hundred fifty thousand sixty-eight EUR and fifteen ct.
         */
        'fraction'            => 'ct.',
        'symbol'              => '€',
        /**
         * Example: 19.00
         */
        'decimals'            => 2,
        /**
         * Example: 1.99
         */
        'decimal_point'       => ',',
        /**
         * By default empty.
         * Example: 1,999.00
         */
        'thousands_separator' => '.',
        /**
         * Supported tags {VALUE}, {SYMBOL}, {CODE}
         * Example: 1.99 €
         */
        'format'              => '{VALUE} {SYMBOL}',
    ],

    'paper' => [
        // A4 = 210 mm x 297 mm = 595 pt x 842 pt
        'size'        => 'a4',
        'orientation' => 'portrait',
    ],

    'disk' => 'local',

    'seller' => [
        /**
         * Class used in templates via $invoice->seller
         *
         * Must implement LaravelDaily\Invoices\Contracts\PartyContract
         *      or extend LaravelDaily\Invoices\Classes\Party
         */
        'class' => \LaravelDaily\Invoices\Classes\Seller::class,

        /**
         * Default attributes for Seller::class
         */
        'attributes' => [
            'name'          => env('SELLER_NAME', 'Towne, Smith and Ebert'),
            'address'       => env('SELLER_ADDRESS', '89982 Pfeffer Falls Damianstad, CO 66972-8160'),
            'code'          => env('SELLER_CODE', '-'),
            'vat'           => env('SELLER_VAT', 'A123456789'),
            'phone'         => env('SELLER_PHONE', '555-6492'),
            'custom_fields' => [
                'IBAN' => env('SELLER_IBAN', 'ES7921000813610123456789'),
            ],
        ],
    ],
];
