<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PDF Color</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
        }
        h1, h2 {
            color: #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }
        th, td {
            border: 1px solid #666;
            padding: 8px;
            text-align: left;
        }
        thead {
            background-color: #f2f2f2;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        .color-box {
            width: 50px;
            height: 20px;
            border: 1px solid #333;
            display: inline-block;
        }
    </style>
</head>
<body>
    <h1>{{ $title }}</h1>
    <p>Date: {{ $date }}</p>
    <h2>Color List</h2>
    <table>
        <thead>
            <tr>
                <th style="text-align: center;">#</th>
                <th style="text-align: center;">Color Name</th>
                <th style="text-align: center;">Color Result</th>
                <th style="text-align: center;">Color Hex</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($color as $index => $c)
                <tr>
                    <td style="text-align: center;">{{ $index + 1 }}</td>
                    <td style="text-align: center;">{{ $c->color_name }}</td>
                    <td style="text-align: center;">
                        <div class="color-box" style="background-color: {{ $c->hex }}"></div>
                    </td>
                    <td style="text-align: center;">
                        {{ $c->hex }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    
</body>
</html>
