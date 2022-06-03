<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ORDEN DE SERVICIO {{$orden->varConsecutivo}}</title>
</head>
<body>
    <div class="col-sm-12 text-center">
        <h1>VALSAN NETWORKING SAS</h1>
            <p class="text-muted">NIT: 901168711-9</p><
            <p class="text-muted">CL 76 45A 94BG 301</p>
            <p class="text-muted">5037685 ITAGUI</p>
            <p class="text-muted">Email: santiago.valsan@gmail.com</p>
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Producto</th>
                <th scope="col">Cantidad</th>
                <th scope="col">Precio</th>
                <th scope="col">Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orden->ordenDetalles as $item)
                <tr>
                    <td>{{$item->id}}</td>
                    <td>{{$item->producto->varDescripcion}}</td>
                    <td>{{$item->cantidad}}</td>
                    <td>{{$item->varPrecio}}</td>
                    <td>Precio Total</td>
                </tr>
            @endforeach
        </tbody>
            
    </table>
        </div>
</body>
</html>