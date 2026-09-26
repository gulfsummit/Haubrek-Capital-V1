# Google reCAPTCHA v3 Setup Instructions

## Overview
Google reCAPTCHA v3 has been successfully implemented across all forms in your company portfolio dashboard. This document provides setup instructions and configuration details.

## Forms Protected
The following forms now include reCAPTCHA v3 protection:
1. Contact Us form (`/contact-us`) - Action: `contact_form`
2. Risk Assessment/Tools form (`/tools`) - Action: `risk_assessment`
3. Meeting Request form (`/request-meeting`) - Action: `meeting_request`
4. Careers Application form (`/careers`) - Action: `career_application`
5. Appointment Booking form (`/appointment`) - Action: `appointment_booking`
6. Newsletter Subscription popup - Action: `newsletter_subscription`

## Setup Instructions

### 1. Get reCAPTCHA v3 Keys
1. Go to [Google reCAPTCHA Admin Console](https://www.google.com/recaptcha/admin)
2. Click "Create" to add a new site
3. Choose **reCAPTCHA v3** (Invisible reCAPTCHA with score-based verification)
4. Add your domain(s) to the domain list
5. Copy the Site Key and Secret Key

### 2. Configure Environment Variables
Add the following variables to your `.env` file:

```env
# Google reCAPTCHA v3 Configuration
RECAPTCHA_SITE_KEY=your_recaptcha_site_key_here
RECAPTCHA_SECRET_KEY=your_recaptcha_secret_key_here
RECAPTCHA_VERSION=v3
RECAPTCHA_SCORE_THRESHOLD=0.5
```

**Score Threshold Explanation:**
- `0.5` (default): Balanced protection, blocks most bots while allowing legitimate users
- `0.7`: More strict, may block some legitimate users but provides stronger bot protection
- `0.3`: More lenient, allows more users but may let some bots through

### 3. Clear Configuration Cache
After adding the environment variables, run:
```bash
php artisan config:clear
php artisan cache:clear
```

## Features Implemented

### Backend Validation
- Custom `RecaptchaService` class for server-side verification with score-based validation
- Custom `RecaptchaRule` validation rule with configurable score thresholds
- Action-specific validation for different form types
- Integrated into all form controllers
- Proper error handling and logging

### Frontend Integration
- Invisible reCAPTCHA v3 widget component (`<x-recaptcha />`)
- Action-specific token generation for each form type
- Automatic script loading in main layout
- JavaScript integration for AJAX forms (newsletter)
- No user interaction required (invisible)

### Security Features
- Server-side verification of reCAPTCHA v3 responses with score validation
- Action verification to prevent token reuse
- Configurable score thresholds for different security levels
- IP address validation
- Proper error messages for failed verification
- Graceful fallback when reCAPTCHA is not configured

## Testing

### Development Testing
- If reCAPTCHA keys are not configured, forms will work without validation (for development)
- Check logs for reCAPTCHA verification results
- Test with both valid and invalid responses

### Production Testing
1. Configure your reCAPTCHA keys
2. Test each form to ensure reCAPTCHA appears
3. Verify that forms reject submissions without reCAPTCHA
4. Test successful submissions with valid reCAPTCHA

## Troubleshooting

### reCAPTCHA Not Working
- Check that `RECAPTCHA_SITE_KEY` is set in `.env`
- Verify the site key is correct and for reCAPTCHA v3
- Check browser console for JavaScript errors
- Ensure the domain is added to your reCAPTCHA site settings
- Verify you selected reCAPTCHA v3 when creating the site

### Validation Failures
- Check that `RECAPTCHA_SECRET_KEY` is set in `.env`
- Verify the secret key is correct and for reCAPTCHA v3
- Check Laravel logs for reCAPTCHA verification errors and scores
- Ensure your server can make outbound HTTPS requests to Google
- Adjust `RECAPTCHA_SCORE_THRESHOLD` if legitimate users are being blocked

### Score Issues
- Monitor your reCAPTCHA admin console for score analytics
- Adjust the score threshold based on your traffic patterns
- Lower threshold (0.3) for more lenient protection
- Higher threshold (0.7) for stricter protection
- Check logs to see actual scores being received

## Files Modified

### New Files Created
- `app/Services/RecaptchaService.php` - Main reCAPTCHA service
- `app/Rules/RecaptchaRule.php` - Validation rule
- `resources/views/components/recaptcha.blade.php` - reCAPTCHA widget component

### Files Modified
- `config/services.php` - Added reCAPTCHA configuration
- `resources/views/app.blade.php` - Added reCAPTCHA script
- `resources/views/contact.blade.php` - Added reCAPTCHA widget
- `resources/views/tools/index.blade.php` - Added reCAPTCHA widget
- `resources/views/meeting/requestmeeting.blade.php` - Added reCAPTCHA widget
- `resources/views/careers/careers.blade.php` - Added reCAPTCHA widget
- `resources/views/calendar/calendar.blade.php` - Added reCAPTCHA widget
- `resources/views/components/newsletter-popup.blade.php` - Added reCAPTCHA widget and JS
- `app/Http/Controllers/Admin/FrontendController.php` - Added validation to all form methods
- `app/Http/Controllers/NewsletterController.php` - Added validation to newsletter

## Support
If you encounter any issues with the reCAPTCHA implementation, check the Laravel logs first, then verify your configuration matches the instructions above.
