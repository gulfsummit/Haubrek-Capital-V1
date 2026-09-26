@php
    $newsletter = \App\Models\Newsletter::where('is_active', true)->first();
    $locale = app()->getLocale();
@endphp

@if($newsletter)
<!-- Newsletter Popup Modal -->
<div id="newsletterModal" class="fixed inset-0 z-[9999] hidden items-center justify-center bg-black bg-opacity-50 px-4">
    <div class="relative w-full max-w-4xl mx-auto">
        <!-- Close Button -->
        <button 
            onclick="closeNewsletterModal()" 
            class="absolute -top-3 -right-3 z-10 w-8 h-8 bg-yellow-500 hover:bg-yellow-600 rounded-full flex items-center justify-center text-white font-bold transition-colors duration-200"
        >
            ✕
        </button>

        <!-- Modal Content -->
        <div class="bg-white rounded-2xl overflow-hidden shadow-2xl flex flex-col md:flex-row">
            <!-- Left Side - Image -->
            <div class="w-full md:w-1/2 h-64 md:h-auto relative">
                @if($newsletter->popup_image)
                    <img 
                        src="{{ asset('storage/' . $newsletter->popup_image) }}" 
                        alt="Newsletter" 
                        class="w-full h-full object-cover"
                    />
                @else
                    <div class="w-full h-full bg-gradient-to-br from-blue-900 to-blue-700 flex items-center justify-center">
                        <svg class="w-24 h-24 text-white opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                @endif
            </div>

            <!-- Right Side - Content -->
            <div class="w-full md:w-1/2 p-8 md:p-12 flex flex-col justify-center">
                @if($locale === 'ar' ? $newsletter->tag_ar : $newsletter->tag_en)
                    <p class="text-yellow-500 text-sm font-semibold mb-2 tracking-wide uppercase">
                        {{ $locale === 'ar' ? $newsletter->tag_ar : $newsletter->tag_en }}
                    </p>
                @endif

                <h2 class="text-2xl md:text-3xl font-bold text-gray-900 mb-4">
                    {{ $locale === 'ar' ? ($newsletter->title_ar ?? $newsletter->title_en) : $newsletter->title_en }}
                </h2>

                <p class="text-gray-600 mb-6 leading-relaxed">
                    {{ $locale === 'ar' ? ($newsletter->description_ar ?? $newsletter->description_en) : $newsletter->description_en }}
                </p>

                <!-- Newsletter Form -->
                <form id="newsletterForm" class="space-y-4">
                    @csrf
                    <div>
                        <input 
                            type="email" 
                            name="email" 
                            id="newsletterEmail"
                            placeholder="{{ $locale === 'ar' ? ($newsletter->placeholder_ar ?? $newsletter->placeholder_en) : $newsletter->placeholder_en }}"
                            required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-transparent outline-none transition-all duration-200"
                        />
                    </div>
                    
                    <div class="flex justify-center">
                        <x-recaptcha action="newsletter_subscription" manual="true" />
                    </div>
                    
                    <button 
                        type="submit"
                        class="w-full bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-3 px-6 rounded-lg transition-colors duration-200"
                    >
                        {{ $locale === 'ar' ? ($newsletter->button_text_ar ?? $newsletter->button_text_en) : $newsletter->button_text_en }}
                    </button>
                </form>

                <!-- Success/Error Messages -->
                <div id="newsletterMessage" class="mt-4 hidden">
                    <div id="newsletterMessageContent" class="p-3 rounded-lg text-sm"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Open newsletter modal
function openNewsletterModal() {
    const modal = document.getElementById('newsletterModal');
    if (modal) {
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        document.body.style.overflow = 'hidden';
    }
}

// Handle popup links without page refresh
document.addEventListener('DOMContentLoaded', function() {
    // Intercept all links that should trigger the newsletter popup
    document.addEventListener('click', function(e) {
        const link = e.target.closest('a');
        if (!link) {
            return;
        }

        const href = (link.getAttribute('href') || '').trim();
        const absoluteHref = link.href || '';

        const shouldOpenPopup =
            href === '#newsletter-popup' ||
            href === '/popup' ||
            absoluteHref.endsWith('/popup');

        if (shouldOpenPopup) {
            e.preventDefault();
            openNewsletterModal();
        }
    });
});

// Close newsletter modal
function closeNewsletterModal() {
    const modal = document.getElementById('newsletterModal');
    if (modal) {
        modal.classList.add('hidden');
        modal.classList.remove('flex');
        document.body.style.overflow = 'auto';
    }
}

// Handle form submission
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('newsletterForm');
    if (form) {
        form.addEventListener('submit', async function(e) {
            e.preventDefault();
            
            const email = document.getElementById('newsletterEmail').value;
            const messageDiv = document.getElementById('newsletterMessage');
            const messageContent = document.getElementById('newsletterMessageContent');
            
            try {
                // Get reCAPTCHA v3 token
                const siteKey = '{{ config("services.recaptcha.site_key") }}';
                if (!siteKey) {
                    throw new Error('reCAPTCHA not configured');
                }
                
                const recaptchaResponse = await new Promise((resolve, reject) => {
                    grecaptcha.ready(() => {
                        grecaptcha.execute(siteKey, { action: 'newsletter_subscription' })
                            .then(resolve)
                            .catch(reject);
                    });
                });
                
                console.log('Sending newsletter subscription request...', { email: email });
                
                const response = await fetch('{{ route("newsletter.subscribe") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({ 
                        email: email,
                        'g-recaptcha-response': recaptchaResponse
                    })
                });
                
                console.log('Response status:', response.status);
                console.log('Response headers:', response.headers);
                
                let data;
                try {
                    data = await response.json();
                    console.log('Response data:', data);
                } catch (jsonError) {
                    console.error('Failed to parse JSON response:', jsonError);
                    const textResponse = await response.text();
                    console.log('Raw response:', textResponse);
                    throw new Error('Invalid response format');
                }
                
                messageDiv.classList.remove('hidden');
                
                if (data.success) {
                    messageContent.className = 'p-3 rounded-lg text-sm bg-green-100 text-green-800';
                    messageContent.textContent = data.message;
                    form.reset();
                    
                    setTimeout(() => {
                        closeNewsletterModal();
                    }, 2000);
                } else {
                    messageContent.className = 'p-3 rounded-lg text-sm bg-red-100 text-red-800';
                    messageContent.textContent = data.message || 'An error occurred. Please try again.';
                }
            } catch (error) {
                console.error('Newsletter subscription error:', error);
                messageDiv.classList.remove('hidden');
                messageContent.className = 'p-3 rounded-lg text-sm bg-red-100 text-red-800';
                messageContent.textContent = error.message || 'An error occurred. Please try again.';
            }
        });
    }
});

// Close modal when clicking outside
document.getElementById('newsletterModal')?.addEventListener('click', function(e) {
    if (e.target === this) {
        closeNewsletterModal();
    }
});
</script>
@endif

