<?php

namespace App\Http\Controllers;

use App\Models\AppSetting;
use Illuminate\Http\Request;

class AppSettingController extends Controller
{
    public function index()
    {
        $settings = AppSetting::findOrFail(1);

        return view('pages.admin.settings', compact('settings'));
    }

    public function update(Request $request)
    {
        $settings = AppSetting::findOrFail(1);

        if ($request->loket_length) {
            $settings->update([
                // 'site_name' => $request->site_name,
                'loket_is_enabled' => $request->loket_is_enabled,
                'loket_length' => $request->loket_length
            ]);
        } else {
            $settings->update([
                // 'site_name' => $request->site_name,
                'loket_is_enabled' => $request->loket_is_enabled,
            ]);
        }

        return redirect()->route('app-settings')->with('success', 'Pengaturan berhasil disimpan');
        // return dd($settings);
    }
}
