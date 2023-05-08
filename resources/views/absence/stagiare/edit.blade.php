<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Modifier la preuve d'absence | création</title>
    @vite('resources/css/app.css')
</head>

<body>

    <h1 class="my-6 text-center text-3xl">Noté l'absence | création </h1>

    @if ($error)
        <h2>
            <strong>

                {{ $error }}
            </strong>
        </h2>
    @else
        {{-- <h2>Absense:</h2>
        <strong>
            <pre>{{ json_encode($absence, JSON_PRETTY_PRINT) }}</pre>
        </strong>

        <h2>Stagiaire:</h2>
        <strong>
            <pre>{{ json_encode($stagiaire, JSON_PRETTY_PRINT) }}</pre>
        </strong> --}}

        <form class="my-4 mx-auto w-fit border border-gray-400 bg-gray-300 p-4" method="POST"
            action="{{ url()->current() }}">
            @csrf
            @method('PUT')
            <input class="p-3 text-lg" value="1" id="absence_id" name="absence_id" type="text">
            <input class="p-3 text-lg" value="6" id="stagiaire_id" name="stagiaire_id" type="text">
            <button class="mx-auto mt-4 block rounded bg-green-500 px-6 py-2 capitalize">create</button>
        </form>

        <form class="my-4 mx-auto w-fit border border-gray-400 bg-gray-300 p-4" method="POST"
            action="{{ url()->current() }}">
            @csrf
            @method('DELETE')
            <input class="p-3 text-lg" value="1" id="absence_id" name="absence_id" type="text">
            <input class="p-3 text-lg" value="6" id="stagiaire_id" name="stagiaire_id" type="text">
            <button class="mx-auto mt-4 block rounded bg-red-500 px-6 py-2 capitalize">delete</button>
        </form>
    @endif

</body>

</html>
