<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    <div>
        <label for="tanggal" class="block text-xs font-medium text-gray-600 mb-1">Tanggal</label>
        <input type="date" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-black text-sm" id="tanggal" name="tanggal" value="{{ isset($pendapatanHarian) ? $pendapatanHarian->tanggal : old('tanggal') }}">
    </div>
    <div>
        <label for="karyawan_id" class="block text-xs font-medium text-gray-600 mb-1">Karyawan</label>
        <select class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-black text-sm" id="karyawan_id" name="karyawan_id">
            @foreach($karyawans as $karyawan)
                <option value="{{ $karyawan->id }}" {{ (isset($pendapatanHarian) && $pendapatanHarian->karyawan_id == $karyawan->id) ? 'selected' : '' }}>{{ $karyawan->name }}</option>
            @endforeach
        </select>
    </div>
    <div>
        <label for="jumlah_like" class="block text-xs font-medium text-gray-600 mb-1">Jumlah Like</label>
        <input type="number" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-black text-sm" id="jumlah_like" name="jumlah_like" value="{{ isset($pendapatanHarian) ? $pendapatanHarian->jumlah_like : old('jumlah_like') }}">
    </div>
    <div>
        <label for="jumlah_komentar" class="block text-xs font-medium text-gray-600 mb-1">Jumlah Komentar</label>
        <input type="number" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-black text-sm" id="jumlah_komentar" name="jumlah_komentar" value="{{ isset($pendapatanHarian) ? $pendapatanHarian->jumlah_komentar : old('jumlah_komentar') }}">
    </div>
    <div>
        <label for="jumlah_ditonton" class="block text-xs font-medium text-gray-600 mb-1">Jumlah Ditonton</label>
        <input type="number" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-black text-sm" id="jumlah_ditonton" name="jumlah_ditonton" value="{{ isset($pendapatanHarian) ? $pendapatanHarian->jumlah_ditonton : old('jumlah_ditonton') }}">
    </div>
    <div>
        <label for="jumlah_penjualan" class="block text-xs font-medium text-gray-600 mb-1">Jumlah Penjualan</label>
        <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-black text-sm" id="jumlah_penjualan" name="jumlah_penjualan" value="{{ isset($pendapatanHarian) ? number_format($pendapatanHarian->jumlah_penjualan, 0, ",", ".") : old('jumlah_penjualan') }}" onkeyup="formatRupiah(this)">
    </div>
    <div>
        <label for="sesi" class="block text-xs font-medium text-gray-600 mb-1">Sesi</label>
        <select class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-black text-sm" id="sesi" name="sesi">
            @for ($i = 1; $i <= 5; $i++)
                <option value="{{ $i }}" {{ (isset($pendapatanHarian) && $pendapatanHarian->sesi == $i) ? 'selected' : (old('sesi') == $i ? 'selected' : '') }}>Sesi {{ $i }}</option>
            @endfor
        </select>
    </div>
    <div>
        <label for="jam_mulai" class="block text-xs font-medium text-gray-600 mb-1">Jam Mulai</label>
        <input type="time" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-black text-sm" id="jam_mulai" name="jam_mulai" value="{{ isset($pendapatanHarian) ? \Carbon\Carbon::parse($pendapatanHarian->jam_mulai)->format('H:i') : old('jam_mulai') }}">
    </div>
    <div>
        <label for="jam_selesai" class="block text-xs font-medium text-gray-600 mb-1">Jam Selesai</label>
        <input type="time" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-black text-sm" id="jam_selesai" name="jam_selesai" value="{{ isset($pendapatanHarian) ? \Carbon\Carbon::parse($pendapatanHarian->jam_selesai)->format('H:i') : old('jam_selesai') }}">
    </div>
    <div>
        <label for="deskripsi" class="block text-xs font-medium text-gray-600 mb-1">Deskripsi</label>
        <textarea name="deskripsi" id="deskripsi" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-black text-sm h-[100px]">{{ isset($pendapatanHarian) ? $pendapatanHarian->deskripsi : old('deskripsi') }}</textarea>
    </div>
</div>
<div class="mt-6 border-t border-gray-200 pt-4 flex justify-end gap-3">
    <button type="submit" class="bg-black text-white px-5 py-2.5 rounded-md text-xs font-semibold hover:bg-gray-800">SIMPAN</button>
</div>

<script>
    function formatRupiah(angka, prefix) {
        var number_string = angka.value.replace(/[^,\d]/g, '').toString(),
            split = number_string.split(','),
            sisa = split[0].length % 3,
            rupiah = split[0].substr(0, sisa),
            ribuan = split[0].substr(sisa).match(/\d{3}/gi);

        if (ribuan) {
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        angka.value = prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
    }

    document.querySelector('form').addEventListener('submit', function() {
        var jumlahPenjualanInput = document.getElementById('jumlah_penjualan');
        jumlahPenjualanInput.value = jumlahPenjualanInput.value.replace(/[^0-9]/g, '');
    });

    // Initial formatting if value exists
    document.addEventListener('DOMContentLoaded', function() {
        var jumlahPenjualanInput = document.getElementById('jumlah_penjualan');
        if (jumlahPenjualanInput.value) {
            formatRupiah(jumlahPenjualanInput, 'Rp. ');
        }
    });
</script>