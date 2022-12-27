<!-- Bootstrap core JavaScript-->
<script src="{{asset("package/jquery/jquery.min.js")}}"></script>
<script src="{{asset("package/bootstrap/js/bootstrap.bundle.min.js")}}"></script>

<!-- Core plugin JavaScript-->
<script src="{{asset("package/jquery-easing/jquery.easing.min.js")}}"></script>

<!-- Custom scripts for all pages-->
<script src="{{asset("js/sb-admin-2.min.js")}}"></script>

<!-- Page level plugins -->
@stack('page-script')

<!-- Page level custom scripts -->
@stack('data-script')
