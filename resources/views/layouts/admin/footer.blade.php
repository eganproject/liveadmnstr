<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<!-- SweetAlert2 JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- jQuery Validation Plugin -->
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>
<!-- Select2 JS -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    $(document).ready(function() {
        // Inisialisasi ikon di seluruh halaman
        lucide.createIcons();

        // --- GLOBAL SCRIPTS ---

        // --- RESPONSIVE SIDEBAR LOGIC ---
        $('#sidebar-toggle').on('click', function() {
            $('#app-container').toggleClass('sidebar-collapsed');
            $(this).find('i').attr('data-lucide', $('#app-container').hasClass('sidebar-collapsed') ? 'panel-right-close' : 'panel-left-close');
            lucide.createIcons();
        });

        $('#menu-button').on('click', function() {
            $('aside').removeClass('-translate-x-full');
            $('#sidebar-backdrop').removeClass('hidden');
        });

        $('#sidebar-backdrop').on('click', function() {
            $('aside').addClass('-translate-x-full');
            $(this).addClass('hidden');
        });

        // --- HEADER USER DROPDOWN LOGIC ---
        $('#user-menu-button').on('click', function(event) {
            event.stopPropagation();
            $('#user-menu').toggleClass('hidden');
        });

        $(document).on('click', function(event) {
            if (!$(event.target).closest('#user-menu-button').length && !$(event.target).closest('#user-menu').length) {
                $('#user-menu').addClass('hidden');
            }
        });

        // --- SIDEBAR DROPDOWN ---
        $('#master-data-toggle').on('click', function(e) {
            e.preventDefault();
            if ($('#app-container').hasClass('sidebar-collapsed')) return;
            $('#master-data-submenu').slideToggle('fast');
            $(this).find('i[data-lucide^="chevron"]').toggleClass('rotate-180');
        });
    });
</script>
