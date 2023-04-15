<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<style>
    body{
        width: 50%;
        margin: 0 auto;
    }
    table {
        width: 100%;
        border-collapse: collapse;
        background: #f9f9f9;
    }
</style>
<body>
    <table>
        <tr>
            <td style="width: 30%">Name</td>
            <td style="width: 10%">:</td>
            <td style="width: 60%">{{$member->first_name}}</td>
        </tr>
        <tr>
            <td style="width: 30%">Father's Name</td>
            <td style="width: 10%">:</td>
            <td style="width: 60%">{{$member->fathers_name}}</td>
        </tr>
        <tr>
            <td style="width: 30%">Mother's Name</td>
            <td style="width: 10%">:</td>
            <td style="width: 60%">{{$member->mothers_name}}</td>
        </tr>
        <tr>
            <td style="width: 30%">Batch</td>
            <td style="width: 10%">:</td>
            <td style="width: 60%">{{$member->passing_year}}</td>
        </tr>
        <tr>
            <td style="width: 30%">Email</td>
            <td style="width: 10%">:</td>
            <td style="width: 60%">{{$member->email}}</td>
        </tr>
        <tr>
            <td style="width: 30%">Phone</td>
            <td style="width: 10%">:</td>
            <td style="width: 60%">{{$member->mobile_number}}</td>
        </tr>
        <tr>
            <td style="width: 30%">Address</td>
            <td style="width: 10%">:</td>
            <td style="width: 60%">{{$member->present_address}}</td>
        </tr>
        <tr>
            <td style="width: 30%">Occupation</td>
            <td style="width: 10%">:</td>
            <td style="width: 60%">{{$member->occupation}}</td>
        </tr>
    </table>
</body>
</html>
