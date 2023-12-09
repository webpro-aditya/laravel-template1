<?php

namespace App\Http\Controllers;

use App\Models\Settings;
use Exception;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function index()
    {
        $settings = Settings::select([
            'id',
            'setting_value'
        ])
        ->where('setting_name', 'Shipper Email')
        ->first();

        return view('admin.settings.settings', ['settings' => $settings]);
    }

    public function update(Request $request) {
       try{
            $shipper_email = $request->shipper_email;
            
            $valiate = $request->validate([
                'shipper_email' => 'required|email'
            ]);

            $shipper_email_id = Settings::select('id')
            ->where('setting_name', 'Shipper Email')
            ->first();

            $settingObj = Settings::findOrFail($shipper_email_id->id);

            $settingObj->setting_value = $shipper_email;
            $settingObj->update();

            return redirect()->back()->with('success', 'Email successfully Added');
       } catch(Exception $e) {
            return redirect()->route('dashboard.index')->with('error', 'Something went wrong');
       } 
    }
}
