<!DOCTYPE html>
<html lang="{{ session('language', 'en') }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
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
    <title>{{ $dictionary['automatedResponse'] }}</title>
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
        <tr class="mail footer" style="color: #17265c">
            <td colspan="1" style="width: 9%;"></td>
            <td colspan="3" style="width: 40%; text-align: right;">
                {{ $dictionary['subject'] }}
            </td>
            <td colspan="1" style="width: 2%;"></td>
            <td colspan="3" class="color-secondary" style="width: 40%; text-align: left;">
                {{ $dictionary['recived'] }}
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
        <tr class="mail" style="color: #17265c">
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
        <tr class="mail" style="color: #17265c">
            <td colspan="1" style="width: 9%;"></td>
            <td colspan="3" style="width: 40%; text-align: right;">
                {{ $dictionary['email'] }}
            </td>
            <td colspan="1" style="width: 2%;"></td>
            <td colspan="3" class="color-secondary" style="width: 40%; text-align: left;">
                <a href="mailto:{{ $messages->email }}">&lt;{{ $messages->email }}&gt;</a>
            </td>
            <td colspan="1" style="width: 9%;"></td>
        </tr>
        <tr class="mail header" style="color: #17265c">
            <td colspan="1" style="width: 9%;"></td>
            <td colspan="3" style="width: 40%; text-align: right;">
                {{ $dictionary['language'] }}
            </td>
            <td colspan="1" style="width: 2%;"></td>
            <td colspan="3" class="color-secondary" style="width: 40%; text-align: left;">
                {{ session('language', 'en') }}
            </td>
            <td colspan="1" style="width: 9%;"></td>
        </tr>
    </table>

</body>

</html>
