<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-eqpiv="X-UA-Compatible" content="ie=edge">
    <title>Solicitud</title>
    <!-- Styles -->
    <style type="text/css">

        p{
            margin: 0.3rem;
        }
        .t0 {
            border-radius: 0.5rem;
            background: #e7edf0;
            border: 0rem solid;
            width: 100%;
            margin: 0rem auto;
            text-align: center;
        }

        .t1 {
            border-radius: 0.5rem;
            background: #e7edf0;
            border: 0rem 6rem solid;
            width: 100%;
            margin: 1rem auto;
            table-layout: fixed;
        }

        .t1 p {
            background: #FFF;
            border-radius: 0.3rem;
            border: 0.1rem solid;
        }

        .t4 {
            border-radius: 0.5rem;
            background: #e7edf0;
            border: 0rem 6rem solid;
            width: 100%;
            margin: 1rem auto;
            table-layout: fixed;
        }

        .t4 td{
            width: 75%;
            word-wrap: break-word;
        }

        .t4 p {
            background: #FFF;
            border-radius: 0.3rem;
            border: 0.1rem solid;
        }

        .t2 {
            background: #eee;
            width: 100%;
            border-spacing: 0;
            border-collapse: collapse;
        }

        .t2 th {
            background-color: #3a6070;
            color: #FFF;
        }

        .t2 tr:nth-child(odd) {
            background-color: #FFF;
        }

        .t2 tr:nth-child(even) {
            background: #e7edf0
        }

        .t3 {
            width: 100%;
            position: absolute;
            bottom: 0;
            height: 200px;
            border-collapse: collapse;
            margin: 0px;
        }

        .t3 th {
            text-align: center;
        }

        .t3 p{
            color: #3a6070;
        }
    </style>

</head>

<body>
    <table class="t0">
        <tbody>
            <tr>
                <td>
                    <img src="{{ asset('images/logo/sipro.png') }}" width="150" height="40">
                </td>
                <td>
                    <h2>Solicitud</h2>
                    <p>Almacén: {{ $sol->w_name }}</p>
                </td>
                <td>
                    <img src="{{ asset('images/logo/sipro.png')  }}" width="150" height="40">
                </td>
            </tr>
        </tbody>
    </table>

    <table class="t1">
        <tbody>
            <tr>
                <th>Solicitante:</th>
                <td>
                    <p> {{ $sol->u_name }} </p>
                </td>
                <th>Fecha de solicitud:</th>
                <td>
                    <p> {{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $sol->created_at )->format('d/m/Y') }} </p>
                </td>
            </tr>
            <tr>
                <th>Encargado del almacén:</th>
                <td>
                    <p>{{ $sol->u2_name }}</p>
                </td>
                <th>Fecha de aprobación:</th>
                <td>
                    <p> {{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $sol->date_to_approved )->format('d/m/Y')}} </p>
                </td>
            </tr>
        </tbody>
    </table>

    <table class="t4">
        <tbody>
            <tr>
                <th>Justificación:</th>
                <td>
                    @foreach($justifications as $justification)
                    <input type="checkbox" checked>
                    <label for="">{{ $justification->name }}</label> @endforeach
                </td>
            </tr>
            <tr>
                <th>Detalle:</th>
                <td>
                    <p>{{ $sol->description_j }}</p>
                </td>
            </tr>
        </tbody>
    </table>

    <table class="t2">
        <thead>
            <tr>
                <th>#</th>
                <th>Producto</th>
                <th>Categoría</th>
                <th>Cantidad</th>
                <th>Medida</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $key=>$product)
            <tr>
                <td>{{ $key+1 }}</td>
                <td>{{ $product->p_name }}</td>
                <td>{{ $product->c_name }}</td>
                <td>{{ $product->quantity }}</td>
                <td>{{ $product->u_name }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <table class="t3">
        <tr>
            <th>
                <p>....................................</p>
                <p>Encargado del Almacén</p>
                <p>(Firma y Sello)</p>
            </th>
            <th>
                <p>....................................</p>
                <p>Solicitante</p>
                <p>(Firma y Sello)</p>
            </th>
        </tr>
    </table>
</body>

</html>