<!DOCTYPE html>
<html lang="{{ session('language', 'en') }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bruno+Ace&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    {{-- <link rel="stylesheet" href="../../../public/css/app.css"> --}}

    <script src="https://kit.fontawesome.com/811a7316ca.js" crossorigin="anonymous"></script>
    <style>
        @import url("https://fonts.googleapis.com/css2?family=Bruno+Ace&display=swap");

        .mail {
            display: flex;
            flex-direction: column;
            justify-content: space-around;
            justify-items: center;
            justify-self: center;
            align-content: center;
            align-items: center;
            align-self: center;
            padding: 0;
            margin: 0;
            font-family: 'Bruno Ace', sans-serif;
            color: pink;
            background-color: #fafafa;
            border: 1px solid purple;

        }

        .mail-header {
            background-color: #17265c;
            color: #ffffff;
            border: 1px solid orange;
            min-height: 50px;
            align-items: left;
            align-self: left;
        }
    </style>
    <title>{{ $dictionary['automatedResponse'] }}</title>
</head>

<body class="mail">
    <table cellspacing="1" cellpadding="1" class="mail" style="border: 1px solid black">
        <tr class="mail-header">
            <th colspan="1" style="width: 10%;"></th>
            <th colspan="3" style="width: 35%; text-align: right; font-family: 'Bruno Ace', sans-serif;">
                {{ config('app.name') }}</th>
            <th colspan="1" style="width: 10%;"></th>
            <th colspan="3" style="width: 35%; text-align: left;"> Biit </th>
            <th colspan="1" style="width: 10%; ">
            </th>
        </tr>
        <tr style="border: 1px solid red; align-items: right;
            align-self: right;  align-content: right;">
            <td colspan="1" style="width: 10%;"></td>
            <td colspan="3"
                style="max-width: 35%;  align-items: right;
            align-self: right;  align-content: center; border: 1px solid red;">
                <img src="https://media.istockphoto.com/id/1156307040/es/vector/escudo-escolar-dise%C3%B1o-dise%C3%B1o-de-vectores-educativos-ilustraci%C3%B3n-del-emblema-de-la-universidad.jpg?s=612x612&w=0&k=20&c=GhuIqLPgZ71p1wCmZRuLROvTRYqQIYgM9NeqGYnVZAs="
                    alt="biit"
                    style="max-width: 50%;   align-items: right;  align-content: right;
            align-self: right; float: center; border: 1px solid red;">
            </td>
            <td colspan="1" style="width:10%;"></td>
            <td colspan="3"
                style="max-width: 35%; align-items: right;
            align-self: right;  align-content: right; float: center; border: 1px solid red;">
                <img src="https://i.pinimg.com/736x/9d/1f/43/9d1f434700aea18dfd4b993cc8db7f40.jpg" alt="pymesoft"
                    style="max-width: 50%;  align-items: right;  align-content: right;
            align-self: right; border: 1px solid red;">
            </td>
            <td colspan="1" style="width: 10%;"></td>
        </tr>
        <tr>
            <td colspan="1" style="width: 10%;"></td>
            <td colspan="7" style="width:80%;">
                <h2 class="mail">{{ $dictionary['thanksContact'] }}</h2>
            </td>
            <td colspan="1" style="width: 10%;"></td>
        </tr>
        <tr>
            <td colspan="1" style="width: 10%;"></td>
            <td colspan="7" style="width:80%;">
                <p class="cursiva" style="font-family:'Bruno Ace', 'Courier New', Courier, monospace ">
                    {{ $dictionary['messageRecibed'] }}</p>
            </td>
            <td colspan="1" style="width: 10%;"></td>
        </tr>
        <tr>
            <td colspan="1" style="width: 10%;"></td>
            <td colspan="7" style="width:80%;">
                <p>{{ $dictionary['messageDetails'] }}</p>
            </td>
            <td colspan="1" style="width: 10%;"></td>
        </tr>
        <tr class="mail-header">
            <td colspan="1" style="width: 10%;"></td>
            <td colspan="3" style="width: 35%; text-align: right;">{{ $dictionary['subject'] }}</td>
            <td colspan="1" style="width: 10% text-align: left;;"></td>
            <td colspan="3" style="width: 35%;">{{ $messages->mailsubject }}</td>
            <td colspan="1" style="width: 10%;"></td>
        </tr>
        <tr class="mail" style="color: #17265c">
            <td colspan="1" style="width: 10%;"></td>
            <td colspan="3" style="width: 35%; text-align: right;">{{ $dictionary['name'] }}</td>
            <td colspan="1" style="width: 10%;"></td>
            <td colspan="3" style="width: 35%; text-align: left;">{{ $messages->name }}</td>
            <td colspan="1" style="width: 10%;"></td>
        </tr>
        <tr class="mail" style="color: #17265c">
            <td colspan="1" style="width: 10%;"></td>
            <td colspan="3" style="width: 35%; text-align: right;">{{ $dictionary['email'] }}</td>
            <td colspan="1" style="width: 10%;"></td>
            <td colspan="3" style="width: 35%; text-align: left;">
                <a href="mailto:{{ $messages->email }}" style="color: #17265c">&lt;{{ $messages->email }}&gt;</a>
            </td>
            <td colspan="1" style="width: 10%;"></td>
        </tr>
        <tr class="mail" style="color: #17265c">
            <td colspan="1" style="width: 10%;"></td>
            <td colspan="3" style="width: 35%; text-align: right;">{{ $dictionary['message'] }}</td>
            <td colspan="1" style="width: 10%; text-align: left;"></td>
            <td colspan="3" style="width: 35%;">{{ $messages->message }}</td>
            <td colspan="1" style="width: 10%;"></td>
        </tr>
        <!-- Agrega más filas según sea necesario -->
        <tr class="mail" style="background-color: red; color: #17265c">
            <td colspan="1" style="width: 10%;"></td>
            <td colspan="7" style="width: 70%;">{{ $dictionary['corporativeName'] }}</td>
            <td colspan="1" style="width: 10%;"></td>
        </tr>
    </table>
</body>

</html>
