@extends('layouts.layout_main')
@section('content')

<div class="container">


<h3><strong>Зураг оруулах</strong></h3>
@if (count($errors) > 0)
    <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif



{!! Form::open(array('route' => 'resizeImagePost','enctype' => 'multipart/form-data')) !!}
    <div class="row">
        <div class="col-md-4">
            <br/>
            {!! Form::text('title', null,array('class' => 'form-control','placeholder'=>'Add Title', 'multiple')) !!}

        </div>
        <div class="col-md-12">
            <br/>
            {!! Form::file('image', array('class' => 'image')) !!}
        </div>
        <div class="col-md-12">
            <br/>
            <div class="col-md-4"><p class="red-required">Таны зураг 2MB-аас бага байх шаардлагатайг анхаарна уу!!!</p></div>
            <div class="clearfix"></div>
            <button type="submit" class="btn btn-success">Зураг хадгалах</button>
        </div>
    </div>
{!! Form::close() !!}
</div>
@endsection
