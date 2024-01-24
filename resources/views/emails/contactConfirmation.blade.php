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
            color: #17265c;
            background-color: #fafafa;


        }

        .color {

            background-color: #17265c;
            color: #ffffff;
        }

        .header {
            min-height: 80px;
            height: 80px;
            max-height: 80px;
            min-width: 100%;
            width: 100%;
            max-width: 100%;
        }


        .center {

            justify-content: space-around;
            justify-items: center;
            justify-self: center;
            align-content: center;
            align-items: center;
            align-self: center;

        }

        .center {
            /* display: flex; */
            margin: 0 auto;
            justify-content: space-around;

        }

        .middle {
            /* display: flex; */
            vertical-align: middle;
        }

        .footer {
            display: flex;
            min-width: 100%;
            width: 100%;
            max-width: 100%;
        }
    </style>
    <title>{{ $dictionary['automatedResponse'] }}</title>
</head>

<body class="mail">
    <table cellspacing="0" cellpadding="0" class="mail">
        <tr class="header color">
            <th colspan="1" style="width: 9%;"></th>
            <th colspan="3" class="center middle" style="width: 40%;">
                {{ config('app.name') }}</th>
            <th colspan="1" style="width: 2%;"></th>
            <th colspan="3" class="center middle" style="width: 40%;"> Biit </th>
            <th colspan="1" style="width: 9%; ">
            </th>
        </tr>
        <tr>
            <td colspan="1" style="width: 9%;"></td>
            <td colspan="3" class="center" style="max-width: 40%; ">
                <img class="center" src="https://i.pinimg.com/736x/9d/1f/43/9d1f434700aea18dfd4b993cc8db7f40.jpg"
                    alt="biit" style="max-width: 50%;">
            </td>
            <td colspan="1" style="width:2%;"></td>
            <td colspan="3" class="center" style="max-width: 40%;  ">
                <img class="center" src="https://i.pinimg.com/736x/9d/1f/43/9d1f434700aea18dfd4b993cc8db7f40.jpg"
                    alt="pymesoft" style="max-width: 50%; ">
            </td>
            <td colspan="1" style="width: 9%;"></td>
        </tr>
        <tr>
            <td colspan="1" style="width: 9%;"></td>
            <td colspan="7" style="width:82%; text-align: center; ">
                <h2 class="mail">{{ $dictionary['thanksContact'] }}</h2>
            </td>
            <td colspan="1" style="width: 9%;"></td>
        </tr>
        <tr>
            <td colspan="1" style="width: 9%;"></td>
            <td colspan="7" style="width:82%;">
                <p class="cursiva"
                    style="font-family:'Bruno Ace', 'Courier New', Courier, monospace; text-align: center;">
                    {{ $dictionary['messageRecibed'] }}</p>
            </td>
            <td colspan="1" style="width: 9%;"></td>
        </tr>
        <tr>
            <td colspan="1" style="width: 9%;"></td>
            <td colspan="7" style="width:82%; text-align: center;">
                <p>{{ $dictionary['messageDetails'] }}</p>
            </td>
            <td colspan="1" style="width: 9%;"></td>
        </tr>
        <tr class="mail-header">
            <td colspan="1" style="width: 9%;"></td>
            <td colspan="3" style="width: 40%; text-align: right;">{{ $dictionary['subject'] }}</td>
            <td colspan="1" style="width: 2% text-align: left;;"></td>
            <td colspan="3" style="width: 40%;">{{ $messages->mailsubject }}</td>
            <td colspan="1" style="width: 9%;"></td>
        </tr>
        <tr class="mail" style="color: #17265c">
            <td colspan="1" style="width: 9%;"></td>
            <td colspan="3" style="width: 40%; text-align: right;">{{ $dictionary['name'] }}</td>
            <td colspan="1" style="width: 2%;"></td>
            <td colspan="3" style="width: 40%; text-align: left;">{{ $messages->name }}</td>
            <td colspan="1" style="width: 9%;"></td>
        </tr>
        <tr class="mail" style="color: #17265c">
            <td colspan="1" style="width: 9%;"></td>
            <td colspan="3" style="width: 40%; text-align: right;">{{ $dictionary['email'] }}</td>
            <td colspan="1" style="width: 2%;"></td>
            <td colspan="3" style="width: 40%; text-align: left;">
                <a href="mailto:{{ $messages->email }}" style="color: #17265c">&lt;{{ $messages->email }}&gt;</a>
            </td>
            <td colspan="1" style="width: 9%;"></td>
        </tr>
        <tr class="mail" style="color: #17265c">
            <td colspan="1" style="width: 9%;"></td>
            <td colspan="3" style="width: 40%; text-align: right;">{{ $dictionary['message'] }}</td>
            <td colspan="1" style="width: 2%; text-align: left;"></td>
            <td colspan="3" style="width: 40%;">{{ $messages->message }}</td>
            <td colspan="1" style="width: 9%;"></td>
        </tr>
        <!-- Agrega más filas según sea necesario -->
        <tr class="footer color">

            <th colspan="9" class="center middle" style="width: 100%; text-align: center; ">
                {{ $dictionary['corporativeName'] }}{{ date('Y') }}
            </th>

        </tr>
    </table>
</body>

</html>
