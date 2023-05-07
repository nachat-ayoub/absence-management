<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>L'absence</title>
    @vite('resources/css/app.css')
</head>

<body class="container px-10">

    <h1 class="my-6 text-center text-3xl">L'absence</h1>

    @if ($error)
        <h2>
            <strong>
                {{ $error }}
            </strong>
        </h2>
    @else
        <h3 class="text-xl">Les stagiaire qui est absent on "{{ $absence->date }}" :</h3>
        <ol>
            @foreach ($absence->absencesStagiaires as $st)
                <li class="my-2 bg-gray-300 p-4 hover:bg-gray-400 hover:underline">
                    <a href="/absence/{{ $absence->id }}/stagiaire/{{ $st->stagiaire->id }}">
                        {{ $st->stagiaire->nom . '  ' . $st->stagiaire->prenom }}</a>
                </li>
            @endforeach
        </ol>
    @endif

</body>

</html>
