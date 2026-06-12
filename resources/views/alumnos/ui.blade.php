<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro de alumnos</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f8fafc; padding: 24px; }
        .box { max-width: 920px; margin: auto; background: white; padding: 24px; border-radius: 16px; border: 1px solid #cbd5e1; }
        input { width: 100%; padding: 10px; margin-top: 6px; margin-bottom: 12px; box-sizing: border-box; }
        button { padding: 10px 16px; background: #047857; color: white; border: none; border-radius: 8px; cursor: pointer; }
        .success { background: #ecfdf5; padding: 10px; margin: 12px 0; border-radius: 8px; }
        .error { color: #b91c1c; margin: 8px 0; }
        table { width: 100%; border-collapse: collapse; margin-top: 16px; }
        th, td { border: 1px solid #cbd5e1; padding: 10px; text-align: left; }
        th { background: #eff6ff; }
    </style>
</head>
<body>
<div class="box">
    <h1>Registro de alumnos</h1>
    <div data-cy="mensaje"></div>
    <div data-cy="errores"></div>
    <label for="codigo">Código</label>
    <input data-cy="codigo" id="codigo" type="text">
    <label for="nombre">Nombre</label>
    <input data-cy="nombre" id="nombre" type="text">
    <label for="email">Correo</label>
    <input data-cy="email" id="email" type="email">
    <button data-cy="btn-guardar" type="button">Registrar alumno</button>
    <table>
        <thead>
        <tr>
            <th>Código</th>
            <th>Nombre</th>
            <th>Correo</th>
            <th>Estado</th>
        </tr>
        </thead>
        <tbody data-cy="tabla-alumnos"></tbody>
    </table>
</div>
<script>
    async function cargarAlumnos() {
        const response = await fetch('/api/alumnos')
        const alumnos = await response.json()
        const tbody = document.querySelector('[data-cy="tabla-alumnos"]')
        tbody.innerHTML = ''
        alumnos.forEach(alumno => {
            const fila = document.createElement('tr')
            fila.innerHTML = `
                <td>${alumno.codigo}</td>
                <td>${alumno.nombre}</td>
                <td>${alumno.email}</td>
                <td>${alumno.estado}</td>
            `
            tbody.appendChild(fila)
        })
    }

    async function registrarAlumno() {
        const mensaje = document.querySelector('[data-cy="mensaje"]')
        const errores = document.querySelector('[data-cy="errores"]')
        mensaje.innerHTML = ''
        errores.innerHTML = ''
        const payload = {
            codigo: document.querySelector('[data-cy="codigo"]').value,
            nombre: document.querySelector('[data-cy="nombre"]').value,
            email: document.querySelector('[data-cy="email"]').value,
        }
        const response = await fetch('/api/alumnos', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            },
            body: JSON.stringify(payload)
        })
        const data = await response.json()
        if (response.ok) {
            mensaje.innerHTML = `<div class="success">${data.message}</div>`
            document.querySelector('[data-cy="codigo"]').value = ''
            document.querySelector('[data-cy="nombre"]').value = ''
            document.querySelector('[data-cy="email"]').value = ''
            await cargarAlumnos()
        } else {
            const lista = Object.values(data.errors || {})
            lista.forEach(grupo => {
                grupo.forEach(error => {
                    errores.innerHTML += `<div class="error">${error}</div>`
                })
            })
        }
    }

    document
        .querySelector('[data-cy="btn-guardar"]')
        .addEventListener('click', registrarAlumno)
    cargarAlumnos()
</script>
</body>
</html>