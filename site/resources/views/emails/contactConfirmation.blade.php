<!DOCTYPE html>
<html lang="{{ session('language', 'en') }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <style>
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
            background-color: #fafafa;
        }

        .color {
            background-color: #17265c;
            color: #ffffff;
        }

        .color-invert {
            color: #17265c;
            background-color: #fafafa;
        }

        .color-secondary {
            background-color: #fafafa;
            color: #0097b2;
        }

        .height {
            min-height: 80px;
            height: 80px;
            max-height: 80px;
        }

        .footer {
            margin-top: 50px;
        }

        .header {
            margin-bottom: 50px;
        }

        .center {
            display: flex;
            justify-content: space-around;
            justify-items: center;
            justify-self: center;
            align-content: center;
            align-items: center;
            align-self: center;
            margin: 0 auto;
        }

        .middle {
            vertical-align: middle;
        }
    </style>
    <title>{{ $dictionary['automatedResponse'] }}-{{ $dictionary['automatedResponse2'] }}</title>
</head>

<body class="mail">
    <table cellspacing="0" cellpadding="0" class="mail">
        <tr class="center height header">
            <th colspan="9" class="color" style="width: 100%; text-align: center; ">
                <h1 class="middle">
                    {{ config('app.name') }}
                </h1>
            </th>
        </tr>
        <tr class="center middle mail">
            <td colspan="1" style="width: 9%;"></td>
            <td colspan="3" class="center" style="width: 40%; ">
                <img class="center" src="https://i.pinimg.com/736x/9d/1f/43/9d1f434700aea18dfd4b993cc8db7f40.jpg"
                    alt="birds" style="max-width: 50%;">
            </td>
            <td colspan="1" style="width:2%;"></td>
            <td colspan="3" class="center" style="width: 40%;  ">
                <img class="center" src="https://i.pinimg.com/736x/9d/1f/43/9d1f434700aea18dfd4b993cc8db7f40.jpg"
                    alt="plomesalamar" style="max-width: 50%; ">
            </td>
            <td colspan="1" style="width: 9%;"></td>
        </tr>
        <tr class="center">
            <td colspan="1" style="width: 9%;"></td>
            <td colspan="7" style="width:82%; text-align: center; ">
                <h2 class="color-invert">
                    {{ $dictionary['thanksContact'] }}
                </h2>
            </td>
            <td colspan="1" style="width: 9%;"></td>
        </tr>
        <tr class="center">
            <td colspan="1" style="width: 9%;"></td>
            <td colspan="7" style="width:82%; text-align: center;">
                <p class="color-secondary">
                    {{ $dictionary['messageRecibed'] }}
                </p>
            </td>
            <td colspan="1" style="width: 9%;"></td>
        </tr>
        <tr class="center">
            <td colspan="1" style="width: 9%;"></td>
            <td colspan="7" style="width:82%; text-align: center;">
                <h3>
                    {{ $dictionary['messageDetails'] }}
                </h3>
            </td>
            <td colspan="1" style="width: 9%;"></td>
        </tr>
        <tr class="mail" style="color: #17265c">
            <td colspan="1" style="width: 9%;"></td>
            <td colspan="3" style="width: 40%; text-align: right;">
                {{ $dictionary['subject'] }}
            </td>
            <td colspan="1" style="width: 2%;"></td>
            <td colspan="3" class="color-secondary" style="width: 40%; text-align: left;">
                {{ $messages->mailsubject }}</td>
            <td colspan="1" style="width: 9%;"></td>
        </tr>
        <tr class="mail" style="color: #17265c">
            <td colspan="1" style="width: 9%;"></td>
            <td colspan="3" style="width: 40%; text-align: right;">
                {{ $dictionary['name'] }}
            </td>
            <td colspan="1" style="width: 2%;"></td>
            <td colspan="3" class="color-secondary" style="width: 40%; text-align: left;">
                {{ $messages->name }}
            </td>
            <td colspan="1" style="width: 9%;"></td>
        </tr>
        <tr class="mail header" style="color: #17265c">
            <td colspan="1" style="width: 9%;"></td>
            <td colspan="3" style="width: 40%; text-align: right;">
                {{ $dictionary['message'] }}
            </td>
            <td colspan="1" style="width: 2%;"></td>
            <td colspan="3" class="color-secondary" style="width: 40%; text-align: left;">
                {{ $messages->message }}
            </td>
            <td colspan="1" style="width: 9%;"></td>
        </tr>
        <tr class="center">
            <td colspan="1" style="width: 9%;"></td>
            <td colspan="7" style="width:82%; text-align: center; ">
                <p>
                    {{ $dictionary['interest'] }}{{ config('app.name') }}{{ $dictionary['answer'] }}
                </p>
                <p>
                    {{ $dictionary['additional'] }}
                </p>
            </td>
            <td colspan="1" style="width: 9%;"></td>
        </tr>
        <tr class="center height">
            <th colspan="9" class="color" style="width: 100%; text-align: center; ">
                <p class="middle">
                    {{ $dictionary['corporativeName'] }}{{ date('Y') }}
                </p>
            </th>
        </tr>
    </table>
</body>

</html>
