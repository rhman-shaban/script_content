
@php
$footer_contact=App\ContactUs::first();
$contact_info=App\ContactInformation::first();
$menus=App\Navigation::all();
$setting=App\Setting::first();
$isRtl=$setting->text_direction;
@endphp

    <!--==========================
         FOOTER PART START
    ===========================-->
    <footer>
        <div class="container">
            <div class="row text-white">
                <div class="col-xl-4 col-sm-12 col-md-6 col-lg-6">
                    <div class="footer_text">
                        <h3>{{ $websiteLang->where('id',271)->first()->custom_text }}</h3>
                        <p>{{ $contact_info->about }}</p>
                        <ul class="footer_icon">

                            @if ($footer_contact->facebook)
                                <li><a href="{{ $footer_contact->facebook }}"><i class="fab fa-facebook-f"></i></a></li>
                            @endif
                            @if ($footer_contact->twitter)
                                <li><a href="{{ $footer_contact->twitter }}"><i class="fab fa-twitter"></i></a></li>
                            @endif


                            @if ($footer_contact->linkedin)
                                <li>
                                    <a href="{{ $footer_contact->linkedin }}" class="fab fa-linkedin"></a>
                                </li>
                           @endif

                           @if ($footer_contact->youtube)
                           <li>
                               <a href="{{ $footer_contact->youtube }}" class="fab fa-youtube"></a>
                           </li>
                          @endif
                          @if ($footer_contact->instagram)
                           <li>
                               <a href="{{ $footer_contact->instagram }}" class="fab fa-instagram"></a>
                           </li>
                          @endif
                        </ul>
                    </div>
                </div>

                <div class="col-xl-4 col-sm-6 col-md-3 col-lg-3">
                    <div class="footer_text">
                        <h3>{{ $websiteLang->where('id',25)->first()->custom_text }}</h3>
                        <ul class="footer_link">

                            @php
                            $isHomePage=$menus->where('id',1)->first();
                            @endphp
                            @if ($isHomePage->status==1)
                                <li><a href="{{ route('home') }}"><i class="far fa-chevron-double-right"></i> {{ $isHomePage->navbar }}</a></li>
                            @endif


                            @php
                                $isListingCategory=$menus->where('id',6)->first();
                            @endphp
                            @if ($isListingCategory->status==1)
                            <li><a href="{{ route('listing.category') }}"><i class="far fa-chevron-double-right"></i> {{ $isListingCategory->navbar }}</a></li>
                            @endif


                            @php
                                $isListing=$menus->where('id',2)->first();
                            @endphp
                            @if ($isListing->status==1)
                                <li><a href="{{ route('listings',['page_type'=>'list_view']) }}"><i class="far fa-chevron-double-right"></i> {{ $isListing->navbar }}</a></li>
                            @endif


                            @php
                                $isBlog=$menus->where('id',7)->first();
                            @endphp
                            @if ($isBlog->status==1)
                            <li><a href="{{ route('blog') }}"><i class="far fa-chevron-double-right"></i> {{ $isBlog->navbar }}</a></li>
                            @endif


                            @php
                                $isPricing=$menus->where('id',5)->first();
                                $isNewListing=$menus->where('id',9)->first();
                            @endphp
                            @if ($isPricing->status==1)
                                <li><a href="{{ route('pricing.plan') }}"><i class="far fa-chevron-double-right"></i> {{ $isPricing->navbar }}</a></li>

                            @endif


                        </ul>
                    </div>
                </div>

                <div class="col-xl-4 col-sm-6 col-md-6 col-lg-6">
                    <div class="footer_text footer_contact">
                        <h3>{{ $websiteLang->where('id',26)->first()->custom_text }}</h3>
                        <ul class="footer_link">
                            <li><p><i class="far fa-map-marker-alt"></i> {{ $footer_contact->footer_address }}</p></li>
                            <li><a href="javascript::void"><a href="mailto:{{ $footer_contact->footer_email }}"><i class="fal fa-envelope"></i> {{ $footer_contact->footer_email }}</a></li>
                            <li><a href="javascript::void"><a href="callto:{{ $footer_contact->footer_phone }}"><i class="fal fa-phone-alt"></i> {{ $footer_contact->footer_phone }}</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer_bottom">
            <div class="container">
                <div class="row">
                    <div class="col-xl-6 col-md-5">
                        <p>{{ $contact_info->copyright }}</p>
                    </div>
                    <div class="col-xl-6 col-md-7">
                        <ul class="footer_bottom_link">

                            @php
                                $isTermsCondition=$menus->where('id',15)->first();
                            @endphp
                            @if ($isTermsCondition->status==1)
                            <li><a href="{{ route('terms.condition') }}">{{ $isTermsCondition->navbar }}</a></li>
                            @endif

                            @php
                                $isPrivacy=$menus->where('id',16)->first();
                            @endphp
                            @if ($isPrivacy->status==1)
                            <li><a href="{{ route('privacy-policy') }}">{{ $isPrivacy->navbar }}</a></li>
                            @endif

                            @php
                                $isContact=$menus->where('id',8)->first();
                            @endphp
                            @if ($isContact->status==1)
                            <li><a href="{{ route('contact.us') }}">{{ $isContact->navbar }}</a></li>
                            @endif

                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!--==========================
         FOOTER PART END
    ===========================-->


    <!--=============SCROLL BTN==============-->
    <div class="scroll_btn">
        <i class="fas fa-chevron-up"></i>
    </div>
    <!--=============SCROLL BTN==============-->




@php
$modalConsent=App\ModalConsent::first();

@endphp

@if ($modalConsent->status==1)
<script src="{{ asset('user/js/cookieconsent.min.js') }}"></script>

<script>
window.addEventListener("load",function(){window.wpcc.init({"border":"{{ $modalConsent->border }}","corners":"{{ $modalConsent->corners }}","colors":{"popup":{"background":"{{ $modalConsent->background_color }}","text":"{{ $modalConsent->text_color }}","border":"{{ $modalConsent->border_color }}"},"button":{"background":"{{ $modalConsent->btn_bg_color }}","text":"{{ $modalConsent->btn_text_color }}"}},"content":{"href":"{{ route('privacy-policy') }}","message":"{{ $modalConsent->message }}","link":"{{ $modalConsent->link_text }}","button":"{{ $modalConsent->btn_text }}"}})});
</script>
@endif




@if ($setting->live_chat == 1)
<script type="text/javascript">
    var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
    (function(){
        var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
        s1.async=true;
        s1.src='{{ $setting->livechat_script }}';
        s1.charset='UTF-8';
        s1.setAttribute('crossorigin','*');
        s0.parentNode.insertBefore(s1,s0);
    })();
</script>
@endif


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




// stripe

$(function() {
    var $form = $(".require-validation");
  $('form.require-validation').bind('submit', function(e) {
    var $form = $(".require-validation"),
        inputSelector = ['input[type=email]', 'input[type=password]',
                         'input[type=text]', 'input[type=file]',
                         'textarea'].join(', '),
        $inputs = $form.find('.required').find(inputSelector),
        $errorMessage = $form.find('div.error'),
        valid         = true;
        $errorMessage.removeClass('d-none');
        $('.has-error').removeClass('has-error');
        $inputs.each(function(i, el) {
        var $input = $(el);
            if ($input.val() === '') {
                $input.parent().addClass('has-error');
                $errorMessage.removeClass('d-none');
                e.preventDefault();
                console.log('err');

            }
        });

    if (!$form.data('cc-on-file')) {
      e.preventDefault();
      Stripe.setPublishableKey($form.data('stripe-publishable-key'));
      Stripe.createToken({
        number: $('.card-number').val(),
        cvc: $('.card-cvc').val(),
        exp_month: $('.card-expiry-month').val(),
        exp_year: $('.card-expiry-year').val()
      }, stripeResponseHandler);
    }

  });

  function stripeResponseHandler(status, response) {
        if (response.error) {
            $('.error')
                .removeClass('hide')
                .find('.alert')
                .text(response.error.message);
        } else {
            $('.stripe-card-error').addClass('d-none');
            var token = response['id'];
            $form.find('input[type=text]').empty();
            $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
            $form.get(0).submit();
        }
    }


});
</script>



<script>
    (function($) {
    "use strict";
    $(document).ready(function () {
        $('.select2').select2();
        $("#loginSubmitBtn").on('click',function(e) {
            e.preventDefault();
            $("#login-spinner").removeClass('d-none')
            $("#loginSubmitBtn").addClass('custom-opacity')
            $("#loginSubmitBtn").removeClass('site-btn-effect')
            $("#loginSubmitBtn").attr('disabled',true);
            $.ajax({
                url: "{{ route('login') }}",
                type:"post",
                data:$('#loginFormSubmit').serialize(),
                success:function(response){
                    if(response.success){
                        window.location.href = "{{ route('user.dashboard')}}";
                        toastr.success(response.success)

                    }
                    if(response.error){
                        $("#login-spinner").addClass('d-none')
                        $("#loginSubmitBtn").removeClass('custom-opacity')
                        $("#loginSubmitBtn").attr('disabled',false);
                        $("#loginSubmitBtn").addClass('site-btn-effect')
                        toastr.error(response.error)

                    }
                },
                error:function(response){
                    if(response.responseJSON.errors.email){
                        $("#login-spinner").addClass('d-none')
                        $("#loginSubmitBtn").removeClass('custom-opacity')
                        $("#loginSubmitBtn").attr('disabled',false);
                        $("#loginSubmitBtn").addClass('site-btn-effect')
                        toastr.error(response.responseJSON.errors.email[0])
                    }
                    if(response.responseJSON.errors.password){
                        $("#login-spinner").addClass('d-none')
                        $("#loginSubmitBtn").removeClass('custom-opacity')
                        $("#loginSubmitBtn").attr('disabled',false);
                        $("#loginSubmitBtn").addClass('site-btn-effect')
                        toastr.error(response.responseJSON.errors.password[0])
                    }
                    if(response.responseJSON.errors.email || response.responseJSON.errors.password){
                    }else{
                        toastr.error('Please Complete the recaptcha to submit the form')
                    }

                }

            });


        })

        $("#registerBtn").on('click',function(e) {

            // project demo mode check
            var isDemo="{{ env('PROJECT_MODE') }}"
            var demoNotify="{{ env('NOTIFY_TEXT') }}"
            if(isDemo==0){
                toastr.error(demoNotify);
                return;
            }
            // end

            e.preventDefault();
            $("#reg-spinner").removeClass('d-none')
            $("#registerBtn").addClass('custom-opacity')
            $("#registerBtn").removeClass('site-btn-effect')
            $("#registerBtn").attr('disabled',true);
            $.ajax({
                url: "{{ route('register') }}",
                type:"post",
                data:$('#registerFormSubmit').serialize(),
                success:function(response){
                    if(response.success){
                        $("#registerFormSubmit").trigger("reset");
                        $("#exampleModal").modal('hide');

                        $("#reg-spinner").addClass('d-none')
                        $("#registerBtn").removeClass('custom-opacity')
                        $("#registerBtn").attr('disabled',false);
                        $("#registerBtn").addClass('site-btn-effect')

                        toastr.success(response.success)
                    }
                    if(response.error){
                        toastr.error(response.error)
                    }
                },
                error:function(response){
                    if(response.responseJSON.errors.name){
                        $("#reg-spinner").addClass('d-none')
                        $("#registerBtn").removeClass('custom-opacity')
                        $("#registerBtn").attr('disabled',false);
                        $("#registerBtn").addClass('site-btn-effect')
                        toastr.error(response.responseJSON.errors.name[0])
                    }

                    if(response.responseJSON.errors.email){
                        $("#reg-spinner").addClass('d-none')
                        $("#registerBtn").removeClass('custom-opacity')
                        $("#registerBtn").attr('disabled',false);
                        $("#registerBtn").addClass('site-btn-effect')
                        toastr.error(response.responseJSON.errors.email[0])
                    }

                    if(response.responseJSON.errors.password){
                        $("#reg-spinner").addClass('d-none')
                        $("#registerBtn").removeClass('custom-opacity')
                        $("#registerBtn").attr('disabled',false);
                        $("#registerBtn").addClass('site-btn-effect')
                        toastr.error(response.responseJSON.errors.password[0])
                    }

                    if(response.responseJSON.errors.email || response.responseJSON.errors.name || response.responseJSON.errors.password){}else{
                        toastr.error('Please Complete the recaptcha to submit the form')
                        $("#reg-spinner").addClass('d-none')
                        $("#registerBtn").removeClass('custom-opacity')
                        $("#registerBtn").attr('disabled',false);
                        $("#registerBtn").addClass('site-btn-effect')
                    }



                }

            });


        })

        $("#forgetPassBtn").on('click',function(e) {

            // project demo mode check
            var isDemo="{{ env('PROJECT_MODE') }}"
            var demoNotify="{{ env('NOTIFY_TEXT') }}"
            if(isDemo==0){
                toastr.error(demoNotify);
                return;
            }
            // end


            e.preventDefault();

            $("#forget-spinner").removeClass('d-none')
            $("#forgetPassBtn").addClass('custom-opacity')
            $("#forgetPassBtn").removeClass('site-btn-effect')
            $("#forgetPassBtn").attr('disabled',true);

            $.ajax({
                url: "{{ route('send.forget.password') }}",
                type:"post",
                data:$('#forgetPassFormSubmit').serialize(),
                success:function(response){
                    if(response.success){
                        $("#exampleModal").modal('hide');
                        $("#forgetPassFormSubmit").trigger("reset");
                        toastr.success(response.success)
                    }
                    if(response.error){
                        toastr.error(response.error)
                    }
                },
                error:function(response){
                    if(response.responseJSON.errors.email){
                        $("#forget-spinner").addClass('d-none')
                        $("#forgetPassBtn").removeClass('custom-opacity')
                        $("#forgetPassBtn").attr('disabled',false);
                        toastr.error(response.responseJSON.errors.email[0])
                    }else{
                        $("#forget-spinner").addClass('d-none')
                        $("#forgetPassBtn").removeClass('custom-opacity')
                        $("#forgetPassBtn").attr('disabled',false);
                        toastr.error('Please Complete the recaptcha to submit the form')
                    }




                }

            });


        })


        $("#subscribeBtn").on('click',function(e) {

            // project demo mode check
            var isDemo="{{ env('PROJECT_MODE') }}"
            var demoNotify="{{ env('NOTIFY_TEXT') }}"
            if(isDemo==0){
                toastr.error(demoNotify);
                return;
            }
            // end

            e.preventDefault();

            $("#subscribe-spinner").removeClass('d-none')
            $("#subscribeBtn").addClass('custom-opacity')
            $("#subscribeBtn").attr('disabled',true);


            $.ajax({
                url: "{{ route('subscribe-us') }}",
                type:"get",
                data:$('#subscribeForm').serialize(),
                success:function(response){
                    if(response.success){
                        $("#subscribeForm").trigger("reset");
                        toastr.success(response.success)

                        $("#subscribe-spinner").addClass('d-none')
                        $("#subscribeBtn").removeClass('custom-opacity')
                        $("#subscribeBtn").attr('disabled',false);

                    }
                    if(response.error){
                        toastr.error(response.error)
                    }
                },
                error:function(response){
                    if(response.responseJSON.errors.email){

                        toastr.error(response.responseJSON.errors.email[0])

                        $("#subscribe-spinner").addClass('d-none')
                        $("#subscribeBtn").removeClass('custom-opacity')
                        $("#subscribeBtn").attr('disabled',false);

                    }
                }

            });


        })



    });

    })(jQuery);
</script>


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
