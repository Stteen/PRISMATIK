<div>
    <div class="content-page">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12 col-lg-12">
                    <div class="card">

                        <div class="card-header d-flex justify-content-between row"
                            style="margin-left:0px; margin-right:0px;">
                            <div class="header-title">
                                <h4 class="card-title">Ordenes en Proceso</h4>
                            </div>
                        </div>
                        <div class="card-body">
                            <table class='table text-center'>
                                <thead>
                                    <tr>
                                        <th>Consecutivo</th>
                                        <th>Fecha de la Orden</th>
                                        <th>Fecha de Entrega</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($ordenes as $item)
                                        <tr>
                                            <td>{{$item->varConsecutivo}}</td>
                                            <td>{{$item->dtFecha}}</td>
                                            <td>{{$item->dtFechaEntrega}}</td>
                                            <td>
                                    @if($item->Estado == "ENVIADO")
                                        <button wire:click="recibeProveedor({{$item->IdOrdenServicio}})" class="btn btn-sm btn-info">Recibir</button>
                                    @elseif($item->Estado == "RECIBIDO")
                                        <button wire:click="Diligenciar({{$item->IdOrdenServicio}})" class="btn btn-sm btn-warning">Diligenciar</button>
                                        @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>