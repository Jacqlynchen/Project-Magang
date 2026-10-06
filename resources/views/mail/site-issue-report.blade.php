<x-mail::message>
# Laporan Gangguan Net Site

Halo, berikut laporan gangguan baru yang perlu ditindaklanjuti:

<x-mail::panel>
**Net Site:** {{ $siteIssue->netSite->name }}<br>
**Cabang:** {{ $siteIssue->netSite->branch->name ?? '-' }}<br>
**Jenis Gangguan:** {{ $siteIssue->netIssue->name }}<br>
**Waktu Laporan:** {{ $siteIssue->created_at->translatedFormat('d M Y H:i') }}
</x-mail::panel>

**Dilaporkan oleh:**

- Nama: {{ $siteIssue->employee->name ?? '-' }}
- Jabatan: {{ $siteIssue->employee->position_title ?? '-' }}
- No. Telepon: {{ $siteIssue->employee->phone ?? '-' }}

**Catatan:** {{ $siteIssue->remark ?? '-' }}

<x-mail::button :url="url('/site-issues/' . $siteIssue->id . '/edit')">
Lihat Laporan
</x-mail::button>

Terima kasih,<br>
{{ config('app.name') }}
</x-mail::message>