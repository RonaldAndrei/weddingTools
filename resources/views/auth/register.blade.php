@extends('layouts.app')

@section('content')
@if (Auth::guest())
<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="panel panel-default">
                <div class="panel-heading" align="center">Necessário efetuar o login!</div>
            </div>
        </div>
    </div>
</div>
@else
<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="panel panel-default">
                <div class="panel-heading">Register</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('register') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <div class="col-md-12">
                                <input id="name" type="text" class="form-control" name="name" placeholder="Name" value="CONVIDADO" onkeyup="this.value = this.value.toUpperCase();" autocomplete="off" required>
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('family') ? ' has-error' : '' }}">
                            <div class="col-md-12">
                                <input id="family" type="text" class="form-control" name="family" placeholder="Family" value="{{ old('name') }}" onkeyup="this.value = this.value.toUpperCase();preenchePassword();" autocomplete="off" required>
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <div class="col-md-12">
                                <input id="password" type="password" class="form-control" name="password" placeholder="Password" autocomplete="off" style="display: none;">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-12">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password" autocomplete="off" style="display: none;">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-12 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Register
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endif
<script>

    function preenchePassword() {
        var password = document.getElementById("family");
        $("#password").val(password.value);
        $("#password-confirm").val(password.value);
    };

</script>
@endsection
