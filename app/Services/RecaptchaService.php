<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class RecaptchaService
{
    protected $secretKey;
    protected $verifyUrl;

    public function __construct()
    {
        $this->secretKey = config('services.recaptcha.secret_key');
        $this->verifyUrl = config('services.recaptcha.verify_url');
    }

    /**
     * Verify reCAPTCHA v3 response
     *
     * @param string $response
     * @param string $remoteIp
     * @param float $scoreThreshold
     * @param string $expectedAction
     * @return bool
     */
    public function verify(string $response, string $remoteIp = null, float $scoreThreshold = 0.5, string $expectedAction = 'submit'): bool
    {
        if (empty($response)) {
            Log::warning('reCAPTCHA: Empty response provided');
            return false;
        }

        if (empty($this->secretKey)) {
            Log::error('reCAPTCHA: Secret key not configured');
            return false;
        }

        try {
            $response = Http::asForm()->post($this->verifyUrl, [
                'secret' => $this->secretKey,
                'response' => $response,
                'remoteip' => $remoteIp ?? request()->ip(),
            ]);

            if ($response->successful()) {
                $data = $response->json();
                
                Log::info('reCAPTCHA v3 verification result', [
                    'success' => $data['success'] ?? false,
                    'score' => $data['score'] ?? null,
                    'action' => $data['action'] ?? null,
                    'challenge_ts' => $data['challenge_ts'] ?? null,
                    'hostname' => $data['hostname'] ?? null,
                    'score_threshold' => $scoreThreshold,
                    'expected_action' => $expectedAction,
                ]);

                // Check if verification was successful
                if (!($data['success'] ?? false)) {
                    return false;
                }

                // Check score threshold (v3 specific)
                $score = $data['score'] ?? 0;
                if ($score < $scoreThreshold) {
                    Log::warning('reCAPTCHA v3: Score below threshold', [
                        'score' => $score,
                        'threshold' => $scoreThreshold,
                    ]);
                    return false;
                }

                // Check action (v3 specific)
                $action = $data['action'] ?? '';
                if ($action !== $expectedAction) {
                    Log::warning('reCAPTCHA v3: Action mismatch', [
                        'expected' => $expectedAction,
                        'received' => $action,
                    ]);
                    return false;
                }

                return true;
            }

            Log::error('reCAPTCHA: Failed to verify response', [
                'status' => $response->status(),
                'body' => $response->body(),
            ]);

            return false;
        } catch (\Exception $e) {
            Log::error('reCAPTCHA verification error: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Get the site key for frontend
     *
     * @return string|null
     */
    public function getSiteKey(): ?string
    {
        return config('services.recaptcha.site_key');
    }

    /**
     * Check if reCAPTCHA is properly configured
     *
     * @return bool
     */
    public function isConfigured(): bool
    {
        return !empty($this->secretKey) && !empty(config('services.recaptcha.site_key'));
    }
}
