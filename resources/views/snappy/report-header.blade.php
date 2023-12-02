@extends('snappy')

@section('content')
    <div style="min-width: 100% !important; overflow: hidden;">
        {!! $letterhead["Cabecalho"] ?? '' !!}
        {!! $letterhead["FormCabecalho"] ?? '' !!}
    </div>
@stop
