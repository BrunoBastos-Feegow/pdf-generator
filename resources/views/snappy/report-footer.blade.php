@extends('snappy')

@section('content')
    <div class="divFooter">
        <div class="divFooter-signature">
            @if(isset($letterhead["Assinatura"]))
                <div style="text-align: center !important">
                    {!! $letterhead["Assinatura"] !!}
                </div>
            @endif
        </div>
        <br><br>
        <div class="rodape">
            {!! $letterhead["Rodape"] ?? '' !!}
        </div>
    </div>
@stop
