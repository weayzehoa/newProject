<!DOCTYPE html>
<html lang="zh-Hant-TW">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{!! env('APP_ENV') == 'local' ? '開發團隊測試用' : '' !!}後台管理系統 | OTP驗證</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ asset('vendor/Font-Awesome/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin.custom.css') }}">
</head>

<body class="hold-transition login-page bg-navy" style="background-image: url({{ asset('img/icarry-index-cover-20191210.jpg') }});">
    {{-- alert訊息 --}}
    @include('admin.layouts.alert_message')
    <div class="login-box">
        <div class="login-logo">
            <a href="javascript:" class="text-yellow"><b>{!! env('APP_ENV') == 'local' ? '開發團隊測試用<br>' : '' !!}後台管理系統</b></a>
        </div>
        <div class="card">
            <div class="card-title p-2">
                <span class="text-primary text-left">OTP驗證</span>
            </div>
            <div class="card-body login-card-body">
                <span class="text-left">手機末三碼 {{ old('last3Code') ? old('last3Code') : $last3Code }}</span>
                <form id="otpForm" action="{{ route('admin.otp.submit') }}" method="post">
                    @csrf
                    <div class="input-group mb-3">
                        <input id="id" type="hidden" name="id" value="{{ old('id') ? old('id') : $id }}">
                        <input id="id" type="hidden" name="last3Code" value="{{ old('last3Code') ? old('last3Code') : $last3Code }}">
                        <input id="otpcode" type="text" placeholder="請輸入簡訊驗證" class="form-control {{ $errors->has('otp') ? ' is-invalid' : '' }}" name="otp" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                        @if ($errors->has('otp'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('otp') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="input-group mb-3">
                        <span>有效時間5分鐘 至 {{ $otpTime }}</span><br>
                        <span class="text-danger">請勿重新整理!</span>
                    </div>
                    <div class="row">
                        <div class="col-4">

                        </div>
                        <div class="col-4">
                            @if($errors->first('return'))
                            <a href="{{ url('login') }}" class="btn btn-danger">返回登入</a>
                            @endif
                        </div>
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block btn-submit">驗證</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- 背景動畫使用區塊 --}}
    <div id="particles-js"></div>
    {{-- REQUIRED SCRIPTS --}}
    <script src="{{ asset('vendor/jquery/dist/jquery.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script src="{{ asset('js/adminlte.min.js') }}"></script>
    {{-- VincentGarreau/particles.js --}}
    <script src="{{ asset('vendor/particles.js/particles.min.js') }}"></script>
    <script src="{{ asset('js/admin.common.js') }}"></script>
    {{-- 背景動畫 --}}
    <script>
        particlesJS.load('particles-js', "{{ asset('./js/particles.json') }}");
    </script>
</body>

</html>
