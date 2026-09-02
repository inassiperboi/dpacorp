<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HistoryTimeline;
use App\Models\LegalDocument;
use App\Models\KbliItem;
use App\Models\Vision;
use App\Models\MissionPoint;
use Illuminate\Http\Request;

class AboutContentController extends Controller
{
    // ─── History Timeline ───────────────────────────────────────────

    public function historyIndex()
    {
        $timelines = HistoryTimeline::orderBy('order')->get();
        return view('admin.about.history', compact('timelines'));
    }

    public function historyStore(Request $request)
    {
        $request->validate(['year' => 'required', 'title' => 'required']);
        HistoryTimeline::create($request->except('_token'));
        return redirect()->route('admin.about.history')->with('success', 'Timeline berhasil ditambahkan.');
    }

    public function historyUpdate(Request $request, HistoryTimeline $timeline)
    {
        $request->validate(['year' => 'required', 'title' => 'required']);
        $timeline->update($request->except(['_token', '_method']));
        return redirect()->route('admin.about.history')->with('success', 'Timeline berhasil diperbarui.');
    }

    public function historyDestroy(HistoryTimeline $timeline)
    {
        $timeline->delete();
        return redirect()->route('admin.about.history')->with('success', 'Timeline berhasil dihapus.');
    }

    // ─── Legal Documents ─────────────────────────────────────────────

    public function legalIndex()
    {
        $legals    = LegalDocument::orderBy('order')->get();
        $kbliItems = KbliItem::orderBy('order')->get();
        return view('admin.about.legal', compact('legals', 'kbliItems'));
    }

    public function legalStore(Request $request)
    {
        $request->validate(['jenis' => 'required', 'label' => 'required']);
        LegalDocument::create($request->except('_token'));
        return redirect()->route('admin.about.legal')->with('success', 'Dokumen berhasil ditambahkan.');
    }

    public function legalUpdate(Request $request, LegalDocument $legal)
    {
        $legal->update($request->except(['_token', '_method']));
        return redirect()->route('admin.about.legal')->with('success', 'Dokumen berhasil diperbarui.');
    }

    public function legalDestroy(LegalDocument $legal)
    {
        $legal->delete();
        return redirect()->route('admin.about.legal')->with('success', 'Dokumen berhasil dihapus.');
    }

    // ─── KBLI Items ──────────────────────────────────────────────────

    public function kbliStore(Request $request)
    {
        $request->validate(['kode_kbli' => 'required', 'judul_kbli' => 'required']);
        KbliItem::create($request->except('_token'));
        return redirect()->route('admin.about.legal')->with('success', 'KBLI berhasil ditambahkan.');
    }

    public function kbliUpdate(Request $request, KbliItem $kbli)
    {
        $kbli->update($request->except(['_token', '_method']));
        return redirect()->route('admin.about.legal')->with('success', 'KBLI berhasil diperbarui.');
    }

    public function kbliDestroy(KbliItem $kbli)
    {
        $kbli->delete();
        return redirect()->route('admin.about.legal')->with('success', 'KBLI berhasil dihapus.');
    }

    // ─── Vision & Mission ────────────────────────────────────────────

    public function visionMissionIndex()
    {
        $vision   = Vision::getInstance();
        $missions = MissionPoint::where('is_active', true)->orderBy('order')->get();
        return view('admin.about.vision-mission', compact('vision', 'missions'));
    }

    public function visionUpdate(Request $request)
    {
        $request->validate(['isi_visi' => 'required']);
        Vision::getInstance()->update(['isi_visi' => $request->isi_visi]);
        return redirect()->route('admin.about.vision-mission')->with('success', 'Visi berhasil diperbarui.');
    }

    public function missionStore(Request $request)
    {
        $request->validate(['isi_misi' => 'required']);
        $order = $request->order ?? (MissionPoint::max('order') + 1);
        MissionPoint::create(['isi_misi' => $request->isi_misi, 'order' => $order, 'is_active' => true]);
        return redirect()->route('admin.about.vision-mission')->with('success', 'Misi berhasil ditambahkan.');
    }

    public function missionUpdate(Request $request, MissionPoint $mission)
    {
        $mission->update($request->except(['_token', '_method']));
        return redirect()->route('admin.about.vision-mission')->with('success', 'Misi berhasil diperbarui.');
    }

    public function missionDestroy(MissionPoint $mission)
    {
        $mission->delete();
        return redirect()->route('admin.about.vision-mission')->with('success', 'Misi berhasil dihapus.');
    }
}
