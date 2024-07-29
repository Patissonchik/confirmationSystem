<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\SettingChangeService;
use Illuminate\Support\Facades\Auth;

class SettingController extends Controller {
    protected $settingChangeService;

    public function __construct(SettingChangeService $settingChangeService) {
        $this->settingChangeService = $settingChangeService;
    }

    public function edit() {
        $user = Auth::user();
        return view('settings.edit', compact('user'));
    }

    public function requestChange(Request $request) {
        $request->validate([
            'setting_key' => 'required|string',
            'setting_value' => 'required|string',
            'method' => 'required|in:sms,email,telegram'
        ]);

        $user = Auth::user();
        $this->settingChangeService->requestSettingChange(1, $request->setting_key, $request->setting_value, $request->method);

        return redirect()->route('settings.edit')->with('status', 'Verification code sent via ' . $request->method);
    }

    public function confirmChange(Request $request) {
        $request->validate([
            'setting_key' => 'required|string',
            'token' => 'required|string'
        ]);

        $user = Auth::user();
        try {
            $this->settingChangeService->confirmSettingChange($user->id, $request->setting_key, $request->token);
            return redirect()->route('settings.edit')->with('status', 'Setting updated successfully');
        } catch (\Exception $e) {
            return redirect()->route('settings.edit')->withErrors(['token' => 'Invalid or expired token']);
        }
    }
}
