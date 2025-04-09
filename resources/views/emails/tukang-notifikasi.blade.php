<h2>Hai {{ $tukang->nama }},</h2>

<p>Kamu diundang untuk bergabung dalam proyek <strong>{{ $proyek->nama_proyek }}</strong>.</p>

<p>Klik tombol di bawah ini untuk menerima proyek ini dan langsung login:</p>

<a href="{{ $linkTerima }}" style="display: inline-block; background-color: #3490dc; color: white; padding: 10px 20px; border-radius: 5px; text-decoration: none;">
    Terima Proyek
</a>

<p>Link ini akan kadaluarsa dalam 60 menit.</p>
