<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ORDEN DE SERVICIO {{$orden->varConsecutivo}}</title>
</head>

<body>
    <div class="col-sm-12 text-center">
        <table class="table table-bordered ">
            <thead>
                <tr>
                    <th>
                        <img src="{{ public_path('images/prisma.png') }}" class="img-fluid"
                            style="widht: 25px; height: 25px;" />
                    </th>
                    <th>
                        <h4>VALSAN NETWORKING SAS</h4>
                        <small>
                            <b>NIT: 901168711-9</b><br />
                            <b>CL 76 45A 94BG 301</b><br />
                            <b>5037685 ITAGUI</b><br />
                            <b>Email: santiago.valsan@gmail.com</b>
                        </small>
                    </th>
                    <th>
                        {{$orden->varConsecutivo}}
                    </th>
                </tr>
            </thead>
        </table>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">Proveedor</th>
                    <th scope="col">Telefono</th>
                    <th scope="col">Correo</th>
                    <th scope="col">Plazo de Entrega</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{$orden->proveedor->varNombreRazon}}</td>
                    <td>{{$orden->proveedor->varTelefono}}</td>
                    <td>{{$orden->proveedor->varCorreo}}</td>
                    <td>{{$orden->proveedor->intPlazoEntr}} - Días</td>
                </tr>
        </table>
        <table class="table table-striped mt-5">
            <thead>
                <tr>
                    <th scope="col">Categoria</th>
                    <th scope="col">Producto Salida</th>
                    <th scope="col">Producto Entrada</th>
                    <th scope="col">Cantidad</th>
                    <th scope="col">Precio</th>
                    <th scope="col">Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orden->ordenDetalles as $item)
                <tr>
                    <td>{{$item->varTipoProducto}}</td>
                    <td>
                        <small>
                            <b>REF:&nbsp;</b> {{$item->productoSale->varDescripcion}}<br />
                            <b class="mt-1">Color:&nbsp;{{ $item->productoSale->varColor}}</b>
                        </small>
                    </td>
                    <td>
                        <small>
                            <b>REF:&nbsp;</b> {{$item->producto->varDescripcion}} <br />
                            <b class="mt-2">Color:&nbsp;{{ $item->producto->varColor}}</b><br />
                        </small>
                    </td>
                    <td>{{$item->cantidad}}</td>
                    <td>{{$item->varPrecio}}</td>
                    <td>  
                    @php
                       $subTotal = $item->varPrecio * $item->cantidad;
                       
                    @endphp
                    {{ number_format($subTotal, 2) }}$</td>
                </tr>
                @endforeach
            </tbody>

        </table>
    </div>

    @if($orden->Estado == "FINALIZADO")
    <table class="table table-striped mt-5">
            <thead>
                <tr>
                    <th style="width: 30%">Producto Salida</th>
                    <th style="width: 30%">Producto Entrada</th>
                    <th scope="col">Cantidad Total</th>
                    <th scope="col">Cantidad Buenas</th>
                    <th scope="col">Cantidad Malas</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orden->ordenDetalles as $item)
                <tr>
                    <td>
                        <small>
                            <b>REF:&nbsp;</b> {{$item->productoSale->varDescripcion}}
                            <b class="mt-1">Color:&nbsp;{{ $item->productoSale->varColor}}</b>
                        </small>
                    </td>
                    <td>
                    <small>
                            <b>REF:&nbsp;</b> {{$item->producto->varDescripcion}} <br />
                            <b class="mt-2">Color:&nbsp;{{ $item->producto->varColor}}</b><br />
                        </small>
                    </td>
                    <td>{{$item->cantidad}}</td>
                    <td>
                    
                    @php
                       $buenas = $item->enviadas - $item->malas;
                    @endphp

                        {{$buenas}}
                        
                    </td>
                    <td>{{$item->malas?$item->malas:'0'}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    
    @endif

</body>

</html>
