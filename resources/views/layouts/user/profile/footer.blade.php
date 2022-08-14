

  <!--=============SCROLL BTN==============-->
  <div class="scroll_btn">
    <i class="fas fa-chevron-up"></i>
</div>
<!--=============SCROLL BTN==============-->





  <!--bootstrap js-->
  <script src="{{ asset('user/js/bootstrap.bundle.min.js') }}"></script>
  <!--font-awesome js-->
  <script src="{{ asset('user/js/Font-Awesome.js') }}"></script>
  <!--slick js-->
  <script src="{{ asset('user/js/slick.min.js') }}"></script>
  <!--venobox js-->
  <script src="{{ asset('user/js/venobox.min.js') }}"></script>
  <!--counter js-->
  <script src="{{ asset('user/js/jquery.waypoints.min.js') }}"></script>
  <script src="{{ asset('user/js/jquery.countup.min.js') }}"></script>
  <!--nice select js-->
  <script src="{{ asset('user/js/select2.min.js') }}"></script>
  <!--isotope js-->
  <script src="{{ asset('user/js/isotope.pkgd.min.js') }}"></script>
  <!--summer_note js-->
  <script src="{{ asset('user/js/summernote.min.js') }}"></script>
  <script src="{{ asset('backend/js/bootstrap4-toggle.min.js') }}"></script>
  <script src="{{ asset('backend/timepicker/jquery.timepicker.min.js') }}"></script>
  <!--main/custom js-->
  <script src="{{ asset('user/js/main.js') }}"></script>


  <script src="{{ asset('toastr/toastr.min.js') }}"></script>

<script>
    @if(Session::has('messege'))
      var type="{{Session::get('alert-type','info')}}"
      switch(type){
          case 'info':
               toastr.info("{{ Session::get('messege') }}");
               break;
          case 'success':
              toastr.success("{{ Session::get('messege') }}");
              break;
          case 'warning':
             toastr.warning("{{ Session::get('messege') }}");
              break;
          case 'error':
              toastr.error("{{ Session::get('messege') }}");
              break;
      }
    @endif
</script>

@if ($errors->any())
    @foreach ($errors->all() as $error)
        <script>
            toastr.error('{{ $error }}');
        </script>
    @endforeach
@endif



<script>
    $(function() {

        $(document).ready(function () {
            $('.EnrollBtn').on('click', function () {
                console.log('hello');


                Swal.fire({
                    title: "{{ $websiteLang->where('id',493)->first()->custom_text }}",
                    text: "{{ $websiteLang->where('id',494)->first()->custom_text }}",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    cancelButtonText: "{{ $websiteLang->where('id',496)->first()->custom_text }}",
                    confirmButtonText: "{{ $websiteLang->where('id',495)->first()->custom_text }}"
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire(
                            "{{ $websiteLang->where('id',497)->first()->custom_text }}",
                            "{{ $websiteLang->where('id',498)->first()->custom_text }}",
                            'success'
                        )
                        location.href = "{{ url('user/purchase-package') }}"+ '/' + $(this).data('id');
                    }
                })
            });
        })
    });
</script>



</body>

</html>
