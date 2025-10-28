<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    /**
     * Display user profile.
     */
    public function show()
    {
        $user = Auth::user();
        
        return view('profile.show', compact('user'));
    }

    /**
     * Show the form for editing profile.
     */
    public function edit()
    {
        $user = Auth::user();
        
        return view('profile.edit', compact('user'));
    }

    /**
     * Update user profile.
     */
    public function update(Request $request)
    {
        $user = Auth::user();
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:20',
            'location' => 'required|string|max:255',
            'business_name' => 'nullable|string|max:255',
            'service_category_id' => 'nullable|exists:service_categories,id',
            'logo' => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
        ]);

        // Handle logo upload
        if ($request->hasFile('logo')) {
            // Delete old logo if exists
            if ($user->logo && Storage::disk('public')->exists($user->logo)) {
                Storage::disk('public')->delete($user->logo);
            }
            
            $validated['logo'] = $request->file('logo')->store('logos', 'public');
        }

        $user->update($validated);

        return redirect()->route('profile.show')
            ->with('success', 'Profile updated successfully!');
    }

    /**
     * Show password change form.
     */
    public function showPasswordForm()
    {
        return view('profile.password');
    }

    /**
     * Update password.
     */
    public function updatePassword(Request $request)
    {
        $user = Auth::user();
        
        $validated = $request->validate([
            'current_password' => 'required',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Check current password
        if (!Hash::check($validated['current_password'], $user->password)) {
            return back()->withErrors(['current_password' => 'Current password is incorrect.']);
        }

        $user->update([
            'password' => Hash::make($validated['password']),
        ]);

        return redirect()->route('profile.show')
            ->with('success', 'Password updated successfully!');
    }

    /**
     * Show verification status.
     */
    public function verification()
    {
        $user = Auth::user();
        
        return view('profile.verification', compact('user'));
    }

    /**
     * Submit verification documents.
     */
    public function submitVerification(Request $request)
    {
        $user = Auth::user();
        
        $validated = $request->validate([
            'verification_type' => 'required|in:individual,business',
            'document_type' => 'required|string|max:255',
            'document_number' => 'required|string|max:255',
            'document_image' => 'required|image|mimes:jpeg,jpg,png|max:5120',
            'additional_documents' => 'nullable|array|max:3',
            'additional_documents.*' => 'image|mimes:jpeg,jpg,png|max:5120',
        ]);

        // Handle document uploads
        $documentPath = $validated['document_image']->store('verification', 'public');
        
        $additionalPaths = [];
        if ($request->hasFile('additional_documents')) {
            foreach ($request->file('additional_documents') as $doc) {
                $additionalPaths[] = $doc->store('verification', 'public');
            }
        }

        // Update user verification status
        $user->update([
            'verification_status' => 'pending',
            'verification_type' => $validated['verification_type'],
            'document_type' => $validated['document_type'],
            'document_number' => $validated['document_number'],
            'document_image' => $documentPath,
            'additional_documents' => $additionalPaths,
            'verification_submitted_at' => now(),
        ]);

        return redirect()->route('profile.verification')
            ->with('success', 'Verification documents submitted successfully! We will review them within 2-3 business days.');
    }

    /**
     * Show support/help center.
     */
    public function support()
    {
        return view('support.index');
    }

    /**
     * Submit support ticket.
     */
    public function submitSupport(Request $request)
    {
        $validated = $request->validate([
            'subject' => 'required|string|max:255',
            'category' => 'required|in:technical,billing,general,feature_request',
            'priority' => 'required|in:low,medium,high,urgent',
            'message' => 'required|string|min:10|max:2000',
            'attachments' => 'nullable|array|max:3',
            'attachments.*' => 'file|mimes:pdf,jpg,jpeg,png,doc,docx|max:5120',
        ]);

        // Here you would typically save to a support_tickets table
        // For now, we'll just show a success message
        
        return redirect()->route('support')
            ->with('success', 'Support ticket submitted successfully! We will respond within 24 hours.');
    }
}