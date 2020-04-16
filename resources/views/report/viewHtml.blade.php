@extends('layouts.layout_main')

@section('content')

@if(Auth::user()->heseg_id > 0 && Auth::user()->heseg_id < 4)
  <?php include 'heseg' . Auth::user()->heseg_id . '.html'; ?>
@else
  <?php include 'all.html'; ?>
@endif
@endsection
