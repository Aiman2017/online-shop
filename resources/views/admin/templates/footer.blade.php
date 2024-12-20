<!-- partial:partials/_footer.html -->
<footer
    class="footer d-flex flex-column flex-md-row align-items-center justify-content-between px-4 py-3 border-top small">
    <p class="text-muted mb-1 mb-md-0">Copyright © 2022 <a href="https://www.nobleui.com" target="_blank">NobleUI</a>.
    </p>
    <p class="text-muted">Handcrafted With <i class="mb-1 text-primary ms-1 icon-sm" data-feather="heart"></i></p>
</footer>
<!-- partial -->

</div>
</div>


<!-- core:js -->
<script src="{{asset('backend/assets/vendors/core/core.js')}}"></script>
<!-- endinject -->

<!-- Plugin js for this page -->
<script src="{{asset('backend/assets/vendors/flatpickr/flatpickr.min.js')}}"></script>
<script src="{{asset('backend/assets/vendors/apexcharts/apexcharts.min.js')}}"></script>
<!-- End plugin js for this page -->

<!-- inject:js -->
<script src="{{asset('backend/assets/vendors/feather-icons/feather.min.js')}}"></script>
<script src="{{asset('backend/assets/js/template.js')}}"></script>
<!-- endinject -->

<!-- Custom js for this page -->
<script src="{{asset('backend/assets/js/dashboard-dark.js')}}"></script>
<script src="https://cdn.tiny.cloud/1/miu8xeflur2rcg89pgk2c7r338m5w9bbgofw014lqqf5povn/tinymce/7/tinymce.min.js"
        referrerpolicy="origin"></script>
<script src="{{asset('jquery-ui.js')}}"></script>
<script>
    tinymce.init({
        selector: 'textarea#mytextarea',
        skin: 'oxide-dark',
        content_css: 'dark',
        height: 300,
        statusbar: false,
    });
</script>


<!-- End custom js for this page -->
@yield('script')
</body>
</html>
