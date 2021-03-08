<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class ImageMaliciousDetectionRule implements Rule
{
    protected $malicious_keywords = [
        '\\/bin\\/bash',
        '__HALT_COMPILER',
        'Guzzle',
        'Laravel',
        'Monolog',
        'PendingRequest',
        '\\<script',
        'ThinkPHP',
        'phar',
        'phpinfo',
        '\\<\\?php',
        '\\$_GET',
        'whoami'
    ];

    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param string $attribute
     * @param mixed $value
     * @return bool
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function passes($attribute, $value)
    {
        if (!request()->hasFile($attribute)) {
            return true;
        }

        return !preg_match("/(".join("|", $this->malicious_keywords).")/im", request()->file($attribute)->get());
    }

    public function message(): string
    {
        return 'There is malicious content in the file';
    }
}
