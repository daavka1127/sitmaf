@extends('layouts.layout_main')
@section('content')

<div class="container">


<h1>Зураг оруулах</h1>
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
            {!! Form::text('title', null,array('class' => 'form-control','placeholder'=>'Add Title')) !!}
        </div>
        <div class="col-md-12">
            <br/>
            {!! Form::file('image', array('class' => 'image')) !!}
        </div>
        <div class="col-md-12">
            <br/>
            <button type="submit" class="btn btn-success">Зураг хадгалах</button>
        </div>
    </div>
{!! Form::close() !!}
</div>
@endsection
