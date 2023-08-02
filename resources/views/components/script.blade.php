<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="{{ url('#page-top') }}">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Bootstrap core JavaScript-->
<script src="{{ asset('/admin/vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('/admin/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

<!-- Core plugin JavaScript-->
<script src="{{ asset('/admin/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

<!-- Custom scripts for all pages-->
<script src="{{ asset('/admin/js/sb-admin-2.min.js') }}"></script>

{{-- Swal --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@yield('script')
