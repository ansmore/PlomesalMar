{{-- <body class="mail">
    <table width="100%" cellspacing="1" cellpadding="1" border="1" style="border: 1px solid #000; color:aqua">
        <tr class="mail-header bg-light">
            <td colspan="2">
                <img src="https://media.istockphoto.com/id/1156307040/es/vector/escudo-escolar-dise%C3%B1o-dise%C3%B1o-de-vectores-educativos-ilustraci%C3%B3n-del-emblema-de-la-universidad.jpg?s=612x612&w=0&k=20&c=GhuIqLPgZ71p1wCmZRuLROvTRYqQIYgM9NeqGYnVZAs="
                    alt="biit" style="max-width: 100%;">
            </td>
            <td colspan="2">
                <img src="https://i.pinimg.com/736x/9d/1f/43/9d1f434700aea18dfd4b993cc8db7f40.jpg" alt="pymesoft"
                    style="max-width: 100%;">
            </td>
            <td colspan="8" style="text-align: right;">
                {{ config('app.name') }}

</td>
</tr>
<tr class="mail-main">
<td colspan="12">
<h2>{{ $dictionary['thanksContact'] }}</h2>
<p class="cursiva">{{ $dictionary['messageRecibed'] }}</p>
<p>{{ $dictionary['messageDetails'] }}</p>
<table width="100%" cellspacing="0" cellpadding="0">
<tr>
<td>{{ $dictionary['subject'] }}</td>
<td colspan="3">{{ $messages->mailsubject }}</td>
</tr>
<tr>
<td>{{ $dictionary['name'] }}</td>
<td colspan="3">{{ $messages->name }}</td>
</tr>
<tr>
<td>{{ $dictionary['email'] }}</td>
<td colspan="3">
<a href="mailto:{{ $messages->email }}">&lt;{{ $messages->email }}&gt;</a>
</td>
</tr>
<tr>
<td>{{ $dictionary['message'] }}</td>
<td colspan="3">{{ $messages->message }}</td>
</tr>
</table>
<p>{{ $dictionary['interest'] }}{{ config('app.name') }}{{ $dictionary['answer'] }}</p>
<p>{{ $dictionary['additional'] }}</p>
</td>
</tr>
<tr class="mail-footer bg-light">
<td colspan="12">
<p>{{ $dictionary['corporativeName'] }}{{ date('Y') }}</p>
</td>
</tr>
</table>

</body> --}}

<body class="mail">
    <header class="mail row bg-light">
        <figure class="img-fluid col-2">
            <img src="https://media.istockphoto.com/id/1156307040/es/vector/escudo-escolar-dise%C3%B1o-dise%C3%B1o-de-vectores-educativos-ilustraci%C3%B3n-del-emblema-de-la-universidad.jpg?s=612x612&w=0&k=20&c=GhuIqLPgZ71p1wCmZRuLROvTRYqQIYgM9NeqGYnVZAs="
                alt="biit">
        </figure>
        <figure class="img-fluid col-2">
            <img src="https://i.pinimg.com/736x/9d/1f/43/9d1f434700aea18dfd4b993cc8db7f40.jpg" alt="pymesoft">
        </figure>
        <h1 class="col-10">{{ config('app.name') }}</h1>
    </header>
    <main class="mail">
        <h2>{{ $dictionary['thanksContact'] }}</h2>
        <p class="cursiva">{{ $dictionary['messageRecibed'] }}</p>
        <p>{{ $dictionary['messageDetails'] }}</p>
        <ul>
            <li>
                <span>{{ $dictionary['subject'] }}</span>
                <span>{{ $messages->mailsubject }}</span>
            </li>
            <li>
                <span>{{ $dictionary['name'] }}</span>
                <span>{{ $messages->name }}</span>
            </li>
            <li>
                <span>{{ $dictionary['email'] }}</span>
                <a href="mailto:{{ $messages->email }}">&lt;{{ $messages->email }}&gt;</a>
            </li>
            <li>
                <span>{{ $dictionary['message'] }}</span>
                <span>{{ $messages->message }}</span>
            </li>
        </ul>
        <p>{{ $dictionary['interest'] }}{{ config('app.name') }}{{ $dictionary['answer'] }}</p>
        <p>{{ $dictionary['additional'] }}</p>
    </main>
    <footer class="mail-footer bg-light">
        <p>{{ $dictionary['corporativeName'] }}{{ date('Y') }} </p>
    </footer>
</body>
