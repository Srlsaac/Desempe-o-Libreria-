@extends('layouts.bootstrap')

@section('title', 'Política de privacidad · LibreApp')

@php
    $responsable = 'Sneider Isaac Pérez Rodríguez';
    $correoContacto = 'perezsneider3008@gmail.com';
@endphp

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-9">
            <div class="mb-4">
                <h1 class="section-title">Política de tratamiento de datos personales</h1>
                <p class="text-muted mb-0">
                    Versión {{ \App\Models\User::PRIVACY_POLICY_VERSION }} &middot; Actualizada el 8 de noviembre de 2026
                </p>
            </div>

            <div class="card shadow-sm">
                <div class="card-body p-4">

                    <p>
                        Esta política explica cómo LibreApp trata los datos personales de sus usuarios, conforme a la
                        Ley 1581 de 2012, sus decretos reglamentarios y el derecho de habeas data de la Constitución
                        Política de Colombia (artículo 15). LibreApp es un proyecto académico de una biblioteca virtual.
                    </p>

                    <h2 class="h5 mt-4">1. Responsable del tratamiento</h2>
                    <ul class="list-unstyled mb-0">
                        <li><strong>Responsable:</strong> {{ $responsable }}</li>
                        <li><strong>Aplicación:</strong> LibreApp &middot; https://libre.boats</li>
                        <li><strong>Correo de contacto:</strong> <a href="mailto:{{ $correoContacto }}">{{ $correoContacto }}</a></li>
                    </ul>

                    <h2 class="h5 mt-4">2. Datos que recolectamos</h2>
                    <ul>
                        <li><strong>Datos de la cuenta:</strong> nombre, correo electrónico y contraseña (se guarda cifrada, de forma que nadie puede leerla).</li>
                        <li><strong>Datos de uso:</strong> las solicitudes de préstamo que realizas y sus fechas.</li>
                        <li><strong>Constancia de autorización:</strong> fecha, hora y versión de esta política que aceptaste al registrarte.</li>
                        <li><strong>Datos técnicos:</strong> registros de errores y de disponibilidad del sitio, necesarios para mantenerlo en funcionamiento.</li>
                    </ul>
                    <p class="mb-0">No solicitamos datos sensibles ni datos de niños, niñas y adolescentes.</p>

                    <h2 class="h5 mt-4">3. Finalidades del tratamiento</h2>
                    <ul class="mb-0">
                        <li>Crear y administrar tu cuenta de usuario.</li>
                        <li>Gestionar las solicitudes, los préstamos y las devoluciones de libros.</li>
                        <li>Enviarte mensajes del servicio, como la recuperación de tu contraseña y las notificaciones de tus préstamos.</li>
                        <li>Mantener la seguridad del sitio y detectar y corregir errores.</li>
                        <li>Cumplir las obligaciones legales que apliquen.</li>
                    </ul>
                    <p class="mt-2 mb-0">No vendemos tus datos ni los usamos con fines comerciales o publicitarios.</p>

                    <h2 class="h5 mt-4">4. Autorización</h2>
                    <p class="mb-0">
                        Al marcar la casilla del formulario de registro, otorgas tu autorización previa, expresa e
                        informada para el tratamiento de tus datos con las finalidades descritas. Guardamos la fecha, la
                        hora y la versión de esta política que aceptaste. Si no la aceptas, no podrás crear una cuenta,
                        pero sí consultar el catálogo.
                    </p>

                    <h2 class="h5 mt-4">5. Tus derechos como titular</h2>
                    <ul class="mb-0">
                        <li>Conocer, actualizar y rectificar tus datos personales.</li>
                        <li>Solicitar prueba de la autorización que otorgaste.</li>
                        <li>Ser informado sobre el uso que se ha dado a tus datos.</li>
                        <li>Presentar quejas ante la Superintendencia de Industria y Comercio (SIC).</li>
                        <li>Revocar la autorización y solicitar la supresión de tus datos.</li>
                        <li>Acceder de forma gratuita a tus datos personales.</li>
                    </ul>

                    <h2 class="h5 mt-4">6. Cómo ejercer tus derechos</h2>
                    <p class="mb-0">
                        Puedes actualizar tu nombre y tu correo desde <strong>Mi perfil</strong>. Para cualquier otra
                        consulta o reclamo, escribe a
                        <a href="mailto:{{ $correoContacto }}">{{ $correoContacto }}</a>.
                        Las consultas se atienden en un máximo de 10 días hábiles y los reclamos en un máximo de 15 días
                        hábiles, plazos que la ley permite prorrogar de forma excepcional.
                    </p>

                    <h2 class="h5 mt-4">7. Eliminación de la cuenta</h2>
                    <p>
                        Puedes eliminar tu cuenta en cualquier momento desde <strong>Mi perfil</strong>, confirmando con tu
                        contraseña. Al hacerlo:
                    </p>
                    <ul class="mb-0">
                        <li>Tu nombre y tu correo se reemplazan por datos genéricos y tu contraseña se invalida: tus datos personales dejan de ser identificables.</li>
                        <li>Se cierran tus sesiones y las solicitudes pendientes se rechazan.</li>
                        <li>El historial de préstamos se conserva sin tus datos personales, para mantener el control del inventario.</li>
                        <li>Se conserva la constancia de la autorización que otorgaste, porque la norma exige poder probarla.</li>
                        <li>No puedes eliminar la cuenta mientras tengas libros prestados sin devolver.</li>
                    </ul>

                    <h2 class="h5 mt-4">8. Encargados del tratamiento</h2>
                    <p>
                        Para operar el servicio usamos proveedores externos que tratan datos por nuestra cuenta. Algunos
                        tienen servidores fuera de Colombia, y al aceptar esta política autorizas esa transmisión.
                    </p>
                    <ul class="mb-0">
                        <li><strong>Render:</strong> alojamiento de la aplicación y de la base de datos.</li>
                        <li><strong>Resend:</strong> envío de correos del servicio.</li>
                        <li><strong>Backblaze B2:</strong> almacenamiento de las imágenes de portada de los libros.</li>
                        <li><strong>Sentry:</strong> registro y análisis de errores.</li>
                        <li><strong>Better Stack:</strong> monitoreo de la disponibilidad del sitio.</li>
                    </ul>

                    <h2 class="h5 mt-4">9. Seguridad de la información</h2>
                    <ul class="mb-0">
                        <li>La comunicación con el sitio está protegida con HTTPS.</li>
                        <li>Las contraseñas se almacenan cifradas con un algoritmo de un solo sentido.</li>
                        <li>El acceso a las funciones de administración está restringido por roles.</li>
                        <li>Las claves de los servicios externos se guardan como variables de entorno y no en el código.</li>
                    </ul>

                    <h2 class="h5 mt-4">10. Vigencia y cambios</h2>
                    <p class="mb-0">
                        Tus datos se conservan mientras tu cuenta esté activa. Si modificamos esta política, publicaremos
                        la nueva versión en esta página y, si el cambio es sustancial, te pediremos de nuevo tu autorización.
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
