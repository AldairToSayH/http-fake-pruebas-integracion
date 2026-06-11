@extends('layouts.app')

@section('title', 'Lista de alumnos')

@section('content')
    <h1>Lista de alumnos</h1>
    <p class="muted">
        Esta pantalla consulta la API para mostrar los registros almacenados.
    </p>

    <a class="button" href="{{ route('alumnos.create') }}">Nuevo alumno</a>
    <div id="mensaje"></div>

    <table>
        <thead>
            <tr>
                <th>Código</th>
                <th>Nombre</th>
                <th>Correo</th>
                <th>Estado</th>
            </tr>
        </thead>
        <tbody id="tabla-alumnos">
            <tr>
                <td colspan="4">Cargando alumnos...</td>
            </tr>
        </tbody>
    </table>

    <script>
        async function cargarAlumnos() {
            const response = await fetch('/api/alumnos', {
                headers: {
                    'Accept': 'application/json',
                }
            });

            const data = await response.json();
            const tbody = document.getElementById('tabla-alumnos');
            tbody.innerHTML = '';

            if (!data.data.length) {
                tbody.innerHTML = '<tr><td colspan="4">No hay alumnos registrados.</td></tr>';
                return;
            }

            data.data.forEach(alumno => {
                const fila = document.createElement('tr');
                fila.innerHTML = `
                    <td>${alumno.codigo}</td>
                    <td>${alumno.nombre}</td>
                    <td>${alumno.email}</td>
                    <td>${alumno.estado}</td>
                `;
                tbody.appendChild(fila);
            });
        }

        function mostrarMensaje() {
            const mensaje = sessionStorage.getItem('flash_success');
            
            if (!mensaje) {
                return;
            }

            const contenedor = document.getElementById('mensaje');
            contenedor.innerHTML = `<div class="alert-success">${mensaje}</div>`;
            sessionStorage.removeItem('flash_success');
        }

        mostrarMensaje();
        cargarAlumnos();
 </script>
@endsection
