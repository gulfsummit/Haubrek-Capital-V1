<?php

namespace App\Rules;

use App\Services\RecaptchaService;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class RecaptchaRule implements ValidationRule
{
    protected $recaptchaService;
    protected $action;
    protected $scoreThreshold;

    public function __construct(string $action = 'submit', float $scoreThreshold = null)
    {
        $this->recaptchaService = app(RecaptchaService::class);
        $this->action = $action;
        $this->scoreThreshold = $scoreThreshold ?? config('services.recaptcha.score_threshold', 0.5);
    }

    /**
     * Run the validation rule.
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        // Skip validation if reCAPTCHA is not configured (for development)
        if (!$this->recaptchaService->isConfigured()) {
            return;
        }

        if (!$this->recaptchaService->verify($value, null, $this->scoreThreshold, $this->action)) {
            $fail('The reCAPTCHA verification failed. Please try again.');
        }
    }
}
