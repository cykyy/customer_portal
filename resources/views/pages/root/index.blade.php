@extends('layouts.root')
@section('content')
<style nonce="{{ csp_nonce() }}">
   @media only screen and (max-width: 768px) {
      .center-sm {
         display: flex !important;
         flex-direction: column !important;
         justify-content: center !important;
         align-items: center !important;
      }
   }
   .mt-0 {
      margin-top: 0px !important;
   }
</style>
<body class="page-login">
   <div class="wrapper">
      <section id="main" class="section content animated fadeInDown delayed_02s">
         <img class="logo-form" src="/assets/img/logo.png">
         @if($systemSetting->login_page_message)
            <div>
               {!! html_entity_decode($systemSetting->login_page_message) !!}
            </div>
         @endif
         <h1 class="fake-half">{{trans('actions.loginMessage', ['ispName' => config("customer_portal.company_name")],$language)}}</h1>
         {!! Form::open(['action' => '\App\Http\Controllers\AuthenticationController@authenticate']) !!}
	     <input type="hidden" name="language" value="{{$language ?? 'en'}}">
         <div class="label label-text">
            <label for="input-email">{{trans("root.username",[],$language)}}</label>
            {!! Form::text("username",null,['placeholder' => trans("root.username",[],$language), 'id' => 'username']) !!}
         </div>
         <div class="label label-text">
            <label for="input-password">{{trans("root.password",[],$language)}}</label>
            {!! Form::password("password",['placeholder' => trans("root.password",[],$language), 'id' => 'password']) !!}
         </div>
         <div class="half vcenter label center-sm">
            <div>
               <button type="submit">
                  {{trans("actions.login",[],$language)}}
               </button>
            </div>
            <div class="right"><a href="/reset" class="forgot">{{trans("headers.forgotUsernameOrPassword",[],$language)}}</a></div>
         </div>
         <small class="right center-sm mt-0"><a href="{{action([\App\Http\Controllers\AuthenticationController::class, 'showRegistrationForm'])}}">{{trans("root.register",[],$language)}}</a></small>
         <div class="half-two vcenter label center-sm" style="margin-top: 25px;">
            <div>
               <a href="https://www.directv.com/my-community" class="btn_tv">
                  DIRECTV for Sedona Residents
               </a>
            </div>
            <div>
               <a href="https://www.directv.com/affiliates/qflix/" class="btn_tv">
                  DIRECTV for Cambridge Residents
               </a>
            </div>
         </div>
         {!! Form::close() !!}
         {{-- <small class="d-sm-none"><a href="{{action([\App\Http\Controllers\AuthenticationController::class, 'showRegistrationForm'])}}">{{trans("root.register",[],$language)}}</a></small> --}}
         <form class="form-group">
            <select id="language" name="language" class="form-control languageSelector">
            @foreach(getAvailableLanguages($language) as $key => $value)
            <option value="{{$key}}" @if($language == $key) selected @endif>{{$value}}</option>
            @endforeach
            </select>
         </form>
      </section>
   </div>
</body>
<script nonce="{{ csp_nonce() }}">
window.onbeforeunload = function(e){
    document.getElementById('main').className = 'section content animated fadeOutUp';
}
</script>
@endsection
@section('additionalJS')
<script type="text/javascript" src="/assets/libs/js-validation/jsvalidation.min.js"></script>
{!! JsValidator::formRequest('App\Http\Requests\AuthenticationRequest') !!}
@endsection
