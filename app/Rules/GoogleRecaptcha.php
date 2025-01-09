<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\Http;

class GoogleRecaptcha implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $response = Http::get(env('RECAPTCHA_VERIFY_URL'),[
            'secret' => env('NOCAPTCHA_SECRET'),
            'response' => $value
        ]);

        if (!($response->json()["success"] ?? false)) {
            $fail('The google recaptcha is required.');
        }
    }
}
