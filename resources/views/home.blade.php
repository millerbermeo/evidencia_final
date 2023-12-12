<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="font-sans bg-gray-100">

    <div class="container mx-auto my-8">
        <h1 class="text-2xl font-bold mb-4">Welcome to the Home View</h1>
  
  @if(session('response'))
  @php
      $response = ('response');
  @endphp

  {{ $response->email }}
  {{ $response->token }}
  {{ $response->rol }}
@endif

  


        @if (isset($matriculas))
        <h2 class="text-xl font-semibold mb-2">Matriculas Data:</h2>
        <table class="min-w-full bg-white border border-gray-300 shadow-md rounded">
            <thead>
                <tr>
                    <th class="py-2 px-4 border-b">ID</th>
                    <th class="py-2 px-4 border-b">Estudiante</th>
                    <th class="py-2 px-4 border-b">Curso</th>
                    <th class="py-2 px-4 border-b">Fecha Matriculacion</th>
                    <th class="py-2 px-4 border-b">Calificacion</th>
                    <th class="py-2 px-4 border-b">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($matriculas as $matricula)
                <tr>
                    <td class="py-2 px-4 border-b">{{ $matricula->idMatricula }}</td>
                    <td class="py-2 px-4 border-b">{{ $matricula->nombreEstudiante }}</td>
                    <td class="py-2 px-4 border-b">{{ $matricula->nombreCurso }}</td>
                    <td class="py-2 px-4 border-b">{{ $matricula->fechaMatriculacion }}</td>
                    <td class="py-2 px-4 border-b">{{ $matricula->calificacion }}</td>
                    <td class="py-2 px-4 border-b flex gap-2">
                        <a href="" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            editar
                        </a>
                        <a href="{{ route('matriculas.destroy', ['idMatricula' => $matricula->idMatricula]) }}"
                            class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded"
                            onclick="event.preventDefault(); document.getElementById('delete-form-{{ $matricula->idMatricula }}').submit();">
                            Eliminar
                        </a>

                        <form id="delete-form-{{ $matricula->idMatricula }}"
                            action="{{ route('matriculas.destroy', ['idMatricula' => $matricula->idMatricula]) }}"
                            method="POST" style="display: none;">
                            @csrf
                            @method('DELETE')
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @endif

        <!-- Display other data from the login response if needed -->
        @if (isset($response))
        <h2 class="text-xl font-semibold mt-4">Login Response:</h2>
        <pre class="bg-gray-200 p-4 rounded">{{ $response }}</pre>
        @endif
    </div>

</body>

</html>