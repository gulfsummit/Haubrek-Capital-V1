@php
    $recaptchaService = app(\App\Services\RecaptchaService::class);
    $siteKey = $recaptchaService->getSiteKey();
    $action = $action ?? 'submit';
    $recaptchaId = 'g-recaptcha-response-' . uniqid();
    $manual = $manual ?? false;
@endphp

@if($siteKey)
    <input type="hidden" name="g-recaptcha-response" id="{{ $recaptchaId }}" data-recaptcha-action="{{ $action }}" />
    @unless($manual)
        <script>
        (function() {
            const recaptchaId = '{{ $recaptchaId }}';
            const action = '{{ $action }}';
            const siteKey = '{{ $siteKey }}';
            const tokenValidityMs = 110000; // ~110s to stay within 2 minute expiry
            let pendingTokenRequest = null;

            const getInput = () => document.getElementById(recaptchaId);

            function ensureGrecaptchaLoaded() {
                return new Promise((resolve, reject) => {
                    let attempts = 0;
                    const maxAttempts = 60; // ~6 seconds

                    function check() {
                        if (typeof grecaptcha !== 'undefined' && typeof grecaptcha.ready === 'function') {
                            resolve();
                            return;
                        }

                        if (attempts++ >= maxAttempts) {
                            reject(new Error('reCAPTCHA script failed to load.'));
                            return;
                        }

                        setTimeout(check, 100);
                    }

                    check();
                });
            }

            function setToken(token) {
                const input = getInput();
                if (!input) {
                    return;
                }

                input.value = token;
                input.dataset.recaptchaTimestamp = Date.now().toString();
                input.dispatchEvent(new Event('change', { bubbles: true }));
            }

            function refreshToken() {
                if (pendingTokenRequest) {
                    return pendingTokenRequest;
                }

                pendingTokenRequest = ensureGrecaptchaLoaded()
                    .then(() => new Promise((resolve, reject) => {
                        grecaptcha.ready(() => {
                            grecaptcha.execute(siteKey, { action })
                                .then(token => {
                                    if (!token) {
                                        reject(new Error('Empty reCAPTCHA token.'));
                                        return;
                                    }
                                    setToken(token);
                                    resolve(token);
                                })
                                .catch(reject);
                        });
                    }))
                    .finally(() => {
                        pendingTokenRequest = null;
                    });

                return pendingTokenRequest;
            }

            function isTokenFresh() {
                const input = getInput();
                if (!input || !input.value) {
                    return false;
                }

                const timestamp = parseInt(input.dataset.recaptchaTimestamp || '0', 10);
                if (!timestamp) {
                    return false;
                }

                return (Date.now() - timestamp) < tokenValidityMs;
            }

            function initRecaptcha() {
                const input = getInput();
                if (!input) {
                    return;
                }

                const form = input.closest('form');
                if (!form) {
                    console.warn('reCAPTCHA: Unable to locate parent form for', recaptchaId);
                    return;
                }

                if (form.dataset.recaptchaInitialized === 'true') {
                    return;
                }
                form.dataset.recaptchaInitialized = 'true';

                // Attempt to prepare a token immediately so the first submit is quick.
                refreshToken().catch(error => {
                    console.warn('reCAPTCHA: Initial token fetch failed', error);
                });

                form.addEventListener('submit', function(e) {
                    const input = getInput();
                    if (!input) {
                        return;
                    }

                    if (isTokenFresh()) {
                        return; // Token already present and fresh, allow normal submission.
                    }

                    e.preventDefault();
                    e.stopPropagation();

                    const submitButton = form.querySelector('button[type="submit"], input[type="submit"]');
                    const originalState = submitButton ? {
                        disabled: submitButton.disabled,
                        text: submitButton.tagName === 'BUTTON' ? submitButton.innerHTML : submitButton.value,
                        opacity: submitButton.style.opacity,
                        cursor: submitButton.style.cursor,
                    } : null;

                    if (submitButton) {
                        submitButton.disabled = true;
                        submitButton.style.opacity = '0.6';
                        submitButton.style.cursor = 'not-allowed';
                    }

                    refreshToken()
                        .then(() => {
                            if (!isTokenFresh()) {
                                throw new Error('reCAPTCHA token could not be refreshed.');
                            }
                            form.submit();
                        })
                        .catch(error => {
                            console.error('reCAPTCHA error:', error);
                            alert('reCAPTCHA verification failed. Please try again.');
                            if (submitButton && originalState) {
                                submitButton.disabled = originalState.disabled;
                                submitButton.style.opacity = originalState.opacity || '';
                                submitButton.style.cursor = originalState.cursor || '';
                                if (submitButton.tagName === 'BUTTON') {
                                    submitButton.innerHTML = originalState.text;
                                } else {
                                    submitButton.value = originalState.text;
                                }
                            }
                        });
                }, true);

                // Periodically refresh the token while the form remains on the page.
                const refreshInterval = setInterval(() => {
                    const input = getInput();
                    if (!input || !document.body.contains(input)) {
                        clearInterval(refreshInterval);
                        return;
                    }

                    if (!isTokenFresh()) {
                        refreshToken().catch(() => { /* Ignore background refresh failures */ });
                    }
                }, tokenValidityMs - 10000);
            }

            if (document.readyState === 'loading') {
                document.addEventListener('DOMContentLoaded', initRecaptcha);
            } else {
                initRecaptcha();
            }
        })();
        </script>
    @endunless
@else
    <div class="text-red-500 text-sm">
        reCAPTCHA is not configured. Please contact the administrator.
    </div>
@endif
