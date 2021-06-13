<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title></title>
    <style>
        @font-face{
            font-family: On-I-Gothic;
            src: url("{{public_path('fonts/On-I-Gothic.ttf')}}");
        }
        *{
            font-family: On-I-Gothic !important;
        }
        h1, p, td{
            font-family: On-I-Gothic !important;
        }
        th,td{
            border: 1px solid rgb(153, 153, 153);
            padding: 4px;
        }
    </style>
</head>
<body>
    <h2 style="text-align: center">{{__('Statistical List')}}</h2>
    <table style="width: 100%; border-collapse: collapse">
        <thead>
            <tr style="background: #dee2e6">
                <th style="text-align: center">{{__('ID')}}</th>
                <th style="text-align: left">{{__('name')}}</th>
                <th style="text-align: center">View</th>
                @if(isset(request()->order))<th style="text-align: center"> Time </th>@endif
            </tr>
        </thead>
        <tbody>
            @foreach ($films as $film)
                <tr>
                    <td style="text-align: center">{{$film->id}}</td>
                    <td style="text-align: left">{{$film->name}}</td>
                    <td style="text-align: center">{{isset($film->view) ? $film->view : "0"}}</td>
                    @if(isset(request()->order)) <td style="text-align: center">{{isset($film->time) ? (isset(request()->order) ? $film->time : date('d-m-Y', strtotime($film->time))) : "--"}} </td>@endif
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
