@extends('layouts.layout_main')

@section('content')
<script type="text/javascript">
  $(document).ready(function(){
    $("#adminType").change(function(){


      if($(this).val() == 5)
      {
        $("#edit").prop('checked',true);
        $("#edit").attr('disabled',true);
        $("#hideCheck").val("on");
      }
      else if($(this).val() == 4)
      {
        $("#edit").prop('checked',false);
        $("#edit").attr('disabled',true);
        $("#hideCheck").val("off");
      }
      else {
        $("#edit").prop('checked',false);
        $("#edit").attr('disabled',false);
      }

    });
    $('#edit').change(function() {
        if(this.checked) {
            $("#hideCheck").val("on");
        }
        else {
            $("#hideCheck").val("off");
        }
    });

  });
</script>
  <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-right">Нэр:</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-right">Цахим хаяг:</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-right">Админ төрөл:</label>

                            <div class="col-md-6">
                                <select class="form-control" name="heseg" id="adminType">
                                  <option value="1">Зүүнбаян чиглэл I хэсэг</option>
                                  <option value="2">Мандах чиглэл II хэсэг</option>
                                  <option value="3">Цогтцэций чиглэл III чиглэл</option>
                                    <option value="4">Зөвхөн хардаг</option>
                                    <option value="5">Мастер</option>
                                </select>
                                <input type="hidden" name="edit" id="hideCheck" value="off"/>
                                <label class="checkbox-inline" style="padding-top: 10px;"><input type="checkbox" id="edit"> Өгөгдөл нэмэх </label>

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-right">Нууц үг:</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>



                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-right">Нууц үгээ давтана уу:</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 col-md-offset-5">
                                <button type="submit" class="btn btn-primary">
                                    Бүртгэх
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
  </div>
@endsection
