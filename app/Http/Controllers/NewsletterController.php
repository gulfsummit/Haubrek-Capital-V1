<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NewsletterSubscription;

class NewsletterController extends Controller
{
    public function subscribe(Request $request)
    {
        \Log::info('Newsletter subscription attempt', ['request' => $request->all()]);
        
        try {
            $validated = $request->validate([
                'email' => 'required|email|max:255',
                'g-recaptcha-response' => ['required', new \App\Rules\RecaptchaRule('newsletter_subscription')],
            ]);

            \Log::info('Newsletter validation passed', ['email' => $validated['email']]);

            NewsletterSubscription::updateOrCreate(
                ['email' => $validated['email']],
                ['status' => 'subscribed']
            );

            \Log::info('Newsletter subscription successful', ['email' => $validated['email']]);

            return response()->json([
                'success' => true,
                'message' => 'Thank you for subscribing to our newsletter!',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            \Log::error('Newsletter validation error', ['errors' => $e->errors()]);
            return response()->json([
                'success' => false,
                'message' => 'Please enter a valid email address.',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            \Log::error('Newsletter subscription error: ' . $e->getMessage(), ['trace' => $e->getTraceAsString()]);
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong. Please try again.',
            ], 500);
        }
    }
}
