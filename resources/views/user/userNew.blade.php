@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="panel panel-default">
                <div class="panel-heading">Novo convidado</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="/usernew">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <div class="col-md-12">
                                <input id="name" type="text" class="form-control" name="name" placeholder="Name" value="CONVIDADO" onkeyup="this.value = this.value.toUpperCase();" autocomplete="off" required>
                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('family') ? ' has-error' : '' }}">
                            <div class="col-md-12">
                                <input id="family" type="text" class="form-control" name="family" placeholder="Family" value="{{ old('family') }}" onkeyup="this.value = this.value.toUpperCase();preenchePassword();" autocomplete="off" required>
                                @if ($errors->has('family'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('family') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <div class="col-md-12">
                                <input id="password" type="password" class="form-control" name="password" placeholder="Password" autocomplete="off" /*style="display: none;"*/>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password" autocomplete="off" /*style="display: none;"*/>
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

<script>

    function preenchePassword() {
        var password = document.getElementById("family");
        $("#password").val(password.value);
        $("#password-confirm").val(password.value);
    };

</script>
@endsection
