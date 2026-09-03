<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CompanyProfile;
use App\Models\SeoSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CompanyProfileController extends Controller
{
    public function edit()
    {
        $company = CompanyProfile::getInstance();
        $seo     = SeoSetting::getInstance();
        return view('admin.company-profile.edit', compact('company', 'seo'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'nama_resmi' => 'required|string|max:255',
            'email'      => 'required|email',
            'telepon'    => 'nullable|string|max:30',
            'logo'       => 'nullable|image|max:2048',
            'favicon'    => 'nullable|image|max:512',
        ]);

        $company = CompanyProfile::getInstance();
        $data    = $request->except(['_token', '_method', 'logo', 'favicon']);

        if ($request->hasFile('logo')) {
            if ($company->logo) Storage::disk('public')->delete($company->logo);
            $data['logo'] = $request->file('logo')->store('company', 'public');
        }
        if ($request->hasFile('favicon')) {
            if ($company->favicon) Storage::disk('public')->delete($company->favicon);
            $data['favicon'] = $request->file('favicon')->store('company', 'public');
        }

        $company->update($data);

        return redirect()->route('admin.company-profile.edit')
            ->with('success', 'Profil perusahaan berhasil diperbarui.');
    }

    public function updateSeo(Request $request)
    {
        $seo = SeoSetting::getInstance();
        $seo->update($request->except(['_token', '_method']));

        return redirect()->route('admin.company-profile.edit')
            ->with('success', 'Pengaturan SEO berhasil diperbarui.');
    }
}
