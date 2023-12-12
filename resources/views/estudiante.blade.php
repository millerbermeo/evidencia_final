<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estudiante</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

</head>
<body>
    <h1>Vista Estudiante</h1>
<table class="min-w-full border border-gray-300">
    <thead>
        <tr>
            <th class="border border-gray-300 py-2 px-4">ID</th>
            <th class="border border-gray-300 py-2 px-4">Nombre</th>
            <th class="border border-gray-300 py-2 px-4">Apellido</th>
            <th class="border border-gray-300 py-2 px-4">Email</th>
            <th class="border border-gray-300 py-2 px-4">Fecha de Nacimiento</th>
        </tr>
    </thead>
    <tbody>
        @foreach($estudiantes as $estudiante)
            <tr>
                <td class="border border-gray-300 py-2 px-4">{{ $estudiante->idEstudiante }}</td>
                <td class="border border-gray-300 py-2 px-4">{{ $estudiante->nombre }}</td>
                <td class="border border-gray-300 py-2 px-4">{{ $estudiante->apellido }}</td>
                <td class="border border-gray-300 py-2 px-4">{{ $estudiante->email }}</td>
                <td class="border border-gray-300 py-2 px-4">{{ $estudiante->fechaNacimiento }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
</body>
</html>