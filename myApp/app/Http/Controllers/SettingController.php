<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $settings = Setting::all();

        $generalSettings = $settings->filter(fn($item) => str_starts_with($item->key, 'site_'));

        $emailSettings = $settings->filter(fn($item) => str_starts_with($item->key, 'mail_'));

        $contactSettings = $settings->filter(fn($item) => str_starts_with($item->key, 'contact_'));

        return view('admin.setting.index', compact('generalSettings', 'emailSettings','contactSettings'));
    }


    public function update(Request $request)
    {
        $data = $request->input('settings');

        foreach ($data as $key => $value) {
            Setting::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
        }

        // Lưu site_logo nếu có
        if ($request->hasFile('site_logo')) {
            $file = $request->file('site_logo');
            $fileName = 'logo_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images/website'), $fileName);

            Setting::updateOrCreate(
                ['key' => 'site_logo'],
                ['value' => 'images/website/' . $fileName]
            );
        }

        // Lưu site_favicon nếu có
        if ($request->hasFile('site_favicon')) {
            $file = $request->file('site_favicon');
            $fileName = 'favicon_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images/website'), $fileName);

            Setting::updateOrCreate(
                ['key' => 'site_favicon'],
                ['value' => 'images/website/' . $fileName]
            );
        }


        return redirect()->route('admin.setting.index')->with('success', 'Cập nhật thành công!');
    }


}
