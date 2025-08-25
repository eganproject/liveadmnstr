<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    <div>
        <label for="tanggal" class="block text-xs font-medium text-gray-600 mb-1">Tanggal</label>
        <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-black text-sm flatpickr-date" id="tanggal" name="tanggal" value="{{ isset($pendapatanHarian) ? $pendapatanHarian->tanggal : old('tanggal') }}">
        @error('tanggal')
            <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
        @enderror
    </div>
    <div>
        <label for="karyawan_id" class="block text-xs font-medium text-gray-600 mb-1">Karyawan</label>
        <select class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-black text-sm select2-karyawan" id="karyawan_id" name="karyawan_id">
            <option disabled selected>Pilih Karyawan</option>
            @foreach($karyawans as $karyawan)
                <option value="{{ $karyawan->id }}" {{ (isset($pendapatanHarian) && $pendapatanHarian->karyawan_id == $karyawan->id) ? 'selected' : (old('karyawan_id') == $karyawan->id ? 'selected' : '') }}>{{ $karyawan->name }}</option>
            @endforeach
        </select>
        @error('karyawan_id')
            <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
        @enderror
    </div>
    <div>
        <label for="toko_id" class="block text-xs font-medium text-gray-600 mb-1">Toko</label>
        <select class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-black text-sm select2-toko" id="toko_id" name="toko_id">
            <option disabled selected>Pilih Toko</option>
            @foreach($tokos as $toko)
                <option value="{{ $toko->id }}" {{ (isset($pendapatanHarian) && $pendapatanHarian->toko_id == $toko->id) ? 'selected' : (old('toko_id') == $toko->id ? 'selected' : '') }}>{{ $toko->name }}</option>
            @endforeach
        </select>
        @error('toko_id')
            <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
        @enderror
    </div>
    <div>
        <label for="jumlah_like" class="block text-xs font-medium text-gray-600 mb-1">Jumlah Like</label>
        <input type="number" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-black text-sm" id="jumlah_like" name="jumlah_like" value="{{ isset($pendapatanHarian) ? $pendapatanHarian->jumlah_like : old('jumlah_like') }}">
        @error('jumlah_like')
            <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
        @enderror
    </div>
    <div>
        <label for="jumlah_komentar" class="block text-xs font-medium text-gray-600 mb-1">Jumlah Komentar</label>
        <input type="number" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-black text-sm" id="jumlah_komentar" name="jumlah_komentar" value="{{ isset($pendapatanHarian) ? $pendapatanHarian->jumlah_komentar : old('jumlah_komentar') }}">
        @error('jumlah_komentar')
            <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
        @enderror
    </div>
    <div>
        <label for="jumlah_ditonton" class="block text-xs font-medium text-gray-600 mb-1">Jumlah Ditonton</label>
        <input type="number" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-black text-sm" id="jumlah_ditonton" name="jumlah_ditonton" value="{{ isset($pendapatanHarian) ? $pendapatanHarian->jumlah_ditonton : old('jumlah_ditonton') }}">
        @error('jumlah_ditonton')
            <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
        @enderror
    </div>
    <div>
        <label for="jumlah_penjualan" class="block text-xs font-medium text-gray-600 mb-1">Jumlah Penjualan</label>
        <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-black text-sm" id="jumlah_penjualan" name="jumlah_penjualan" value="{{ isset($pendapatanHarian) ? number_format($pendapatanHarian->jumlah_penjualan, 0, ",", ".") : old('jumlah_penjualan') }}" onkeyup="formatRupiah(this)">
        @error('jumlah_penjualan')
            <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
        @enderror
    </div>
    <div>
        <label for="sesi" class="block text-xs font-medium text-gray-600 mb-1">Sesi</label>
        <select class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-black text-sm" id="sesi" name="sesi">
            @for ($i = 1; $i <= 5; $i++)
                <option value="{{ $i }}" {{ (isset($pendapatanHarian) && $pendapatanHarian->sesi == $i) ? 'selected' : (old('sesi') == $i ? 'selected' : '') }}>Sesi {{ $i }}</option>
            @endfor
        </select>
        @error('sesi')
            <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
        @enderror
    </div>
    <div>
        <label for="jam_mulai" class="block text-xs font-medium text-gray-600 mb-1">Jam Mulai</label>
        <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-black text-sm flatpickr-time" id="jam_mulai" name="jam_mulai" value="{{ isset($pendapatanHarian) ? \Carbon\Carbon::parse($pendapatanHarian->jam_mulai)->format('H:i') : old('jam_mulai') }}">
        @error('jam_mulai')
            <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
        @enderror
    </div>
    <div>
        <label for="jam_selesai" class="block text-xs font-medium text-gray-600 mb-1">Jam Selesai</label>
        <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-black text-sm flatpickr-time" id="jam_selesai" name="jam_selesai" value="{{ isset($pendapatanHarian) ? \Carbon\Carbon::parse($pendapatanHarian->jam_selesai)->format('H:i') : old('jam_selesai') }}">
        @error('jam_selesai')
            <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
        @enderror
    </div>
    <div>
        <label for="deskripsi" class="block text-xs font-medium text-gray-600 mb-1">Deskripsi</label>
        <textarea name="deskripsi" id="deskripsi" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-black text-sm h-[100px]">{{ isset($pendapatanHarian) ? $pendapatanHarian->deskripsi : old('deskripsi') }}</textarea>
        @error('deskripsi')
            <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
        @enderror
    </div>
</div>
<div class="mt-6 border-t border-gray-200 pt-4 flex justify-end gap-3">
    <button type="submit" class="bg-black text-white px-5 py-2.5 rounded-md text-xs font-semibold hover:bg-gray-800">SIMPAN</button>
</div>

<script>
    // Move formatRupiah function outside DOMContentLoaded to make it globally accessible
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

    document.addEventListener('DOMContentLoaded', function() {
        // Flatpickr initialization
        flatpickr(".flatpickr-date", {
            dateFormat: "Y-m-d",
        });

        flatpickr(".flatpickr-time", {
            enableTime: true,
            noCalendar: true,
            dateFormat: "H:i",
            time_24hr: true
        });

        // Select2 initialization
        $('.select2-karyawan').select2();
        $('.select2-toko').select2();

        // AJAX to get toko by karyawan
        $('#karyawan_id').on('change', function() {
            var karyawanId = $(this).val();
            if (karyawanId) {
                $.ajax({
                    url: '{{ route("admin.karyawan.get-toko", ['karyawan' => ':karyawanId']) }}'.replace(':karyawanId', karyawanId),
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        if (data.toko_id) {
                            $('#toko_id').val(data.toko_id).trigger('change');
                        }
                    }
                });
            }
        });

        // Ensure the form exists before adding event listener
        var formElement = document.querySelector('form');
        if (formElement) {
            formElement.addEventListener('submit', function() {
                var jumlahPenjualanInput = document.getElementById('jumlah_penjualan');
                if (jumlahPenjualanInput) { // Check if element exists
                    jumlahPenjualanInput.value = jumlahPenjualanInput.value.replace(/[^0-9]/g, '');
                }
            });
        }

        // Initial formatting if value exists
        var jumlahPenjualanInput = document.getElementById('jumlah_penjualan');
        if (jumlahPenjualanInput && jumlahPenjualanInput.value) {
            formatRupiah(jumlahPenjualanInput, 'Rp. ');
        }
    });
</script>