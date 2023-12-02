@extends('snappy')

@section('content')

    <div class="content">
        {!! @$default !!}
    </div>
    @if( (isset($configOpcoes["AssociarPorGrupos"]) && $configOpcoes["AssociarPorGrupos"] != 1) || (empty($pedidos) && !empty($body)))
        <div class="content">
            {!! $body !!}
        </div>
    @endif
    @if(!empty($medicalReportImages))
        <div class='content'>
            @foreach($medicalReportImages as $key => $imagem)
                @if($key % 4==0 and $key>0)
        </div>
        <div class='content'>
            @endif
            <div style="text-align: center;" class="col-md-6">
                @if (strtolower( array_slice(explode(".",$imagem["NomeArquivo"]), -1)[0]??false) == "pdf")
                    <input type="text"
                           value="{{$imagem["DT"]." - ". $imagem["NomeProfissional"]}}"
                           class="form-control no-print input-sm mn imgpac">
                @else
                    <img class="border" style="margin-top: 100px"
                         src="{{$imagem["NomeArquivo"]}}" height="300" width="100%">
                    <input type="text"
                           value="{{$imagem["DT"]." - ". $imagem["NomeProfissional"]}}"
                           class="form-control input-sm mn imgpac">
                @endif
            </div>
            @endforeach
        </div>
    @endif

    @if(!empty($pedidos))
        @if(isset($configOpcoes["AssociarPorGrupos"]) && $configOpcoes["AssociarPorGrupos"] != 1)
            <div class="content">
                <ul>
                    @foreach($pedidos as $pedido)
                        @if(!empty($pedido['NomeProcedimento']))
                            <li>
                                {{ $pedido['NomeProcedimento'] }}
                                @if(!empty(trim($pedido['Observacoes'])))
                                    <ul>
                                        <li><strong>Obs.:</strong> {{ $pedido['Observacoes'] }}</li>
                                    </ul>
                                @endif
                            </li>
                        @endif
                    @endforeach
                </ul>
            </div>
        @else
            @php $grupoId = ""; @endphp
            @foreach($pedidos as $pedido)
                @if( $grupoId != $pedido["GrupoID"] || $loop->first )
                    @if(!$loop->first )
                        <div class="content" style="page-break-before: always">
                            {!! @$default !!}
                        </div>
                    @endif
                    <div class="content">
                        {!! $body !!}
                    </div>
                @endif
                <div class="content">
                    <ul>
                        @if(!empty($pedido['NomeProcedimento']))
                            <li>
                                {{ $pedido['NomeProcedimento'] }}
                                @if(!empty(trim($pedido['Observacoes'])))
                                    <ul>
                                        <li><strong>Obs.:</strong> {{ $pedido['Observacoes'] }}</li>
                                    </ul>
                                @endif
                            </li>
                        @endif
                    </ul>
                </div>
                @php $grupoId = $pedido["GrupoID"] @endphp
            @endforeach
        @endif
    @endif

@stop
