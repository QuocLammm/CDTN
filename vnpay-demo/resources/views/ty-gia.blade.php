<!DOCTYPE html>
<html>
<head>
    <title>Tỷ giá ngoại tệ</title>
    <style>
        table {
            border-collapse: collapse;
            width: 60%;
            margin: 30px auto;
        }
        th, td {
            border: 1px solid #999;
            padding: 10px;
            text-align: center;
        }
        th {
            background: #eee;
        }
    </style>
</head>
<body>
<h2 style="text-align:center">Tỷ giá ngoại tệ</h2>
<table>
    <tr>
        <th>Ngoại tệ</th>
        <th>Giá mua</th>
        <th>Giá bán</th>
    </tr>
    @foreach ($data as $item)
        <tr>
            <td>{{ $item['ngoai-te'] }}</td>
            <td>{{ $item['gia-mua'] }}</td>
            <td>{{ $item['gia-ban'] }}</td>
        </tr>
    @endforeach
</table>
</body>
</html>
