@extends('layouts.app')
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/css/informacion.css'])
    <title>Aeroweb</title>
</head>
<body>
@section('content')
<header class="p-3 text-white m-3 header">
    <h1 class="text-center">Aeroweb</h1>
</header>

<main class="container mt-4">
    <div>
    <section>
        <h2>Misión</h2>
        <p>Proporcionar una plataforma confiable y segura para conectar a aerolíneas que venden vuelos y usuarios pasajeros que buscan comprar billetes de avión. Nos esforzamos por ofrecer una experiencia intuitiva y conveniente que simplifique el proceso de reserva y brinde opciones de viaje asequibles a nuestros usuarios.</p>
    </section>

    <section>
        <h2>Visión</h2>
        <p>Convertirnos en la principal plataforma en línea para la compra y venta de billetes de avión, brindando una amplia selección de vuelos y servicios relacionados. Buscamos ser reconocidos por nuestra transparencia, eficiencia y atención al cliente, estableciendo asociaciones sólidas con aerolíneas y creando una comunidad confiable de usuarios.</p>
    </section>

    <section>
        <h2>Valores</h2>
        <ul>
            <li>Confianza: Nos comprometemos a mantener altos estándares de seguridad y protección de datos, garantizando la confidencialidad de la información de nuestros usuarios.</li>
            <li>Calidad: Buscamos ofrecer servicios de calidad, asegurando que los vuelos disponibles en nuestra plataforma cumplan con los estándares y regulaciones de la industria aérea.</li>
            <li>Innovación: Estamos comprometidos con la mejora continua y la adopción de nuevas tecnologías para optimizar la experiencia de reserva y facilitar la comunicación entre aerolíneas y pasajeros.</li>
            <li>Accesibilidad: Queremos brindar opciones de viaje accesibles y asequibles, permitiendo que una amplia gama de usuarios pueda encontrar y reservar vuelos según sus necesidades y presupuesto.</li>
            <li>Satisfacción del cliente: Nos esforzamos por ofrecer un excelente servicio al cliente, brindando asistencia oportuna y resolviendo cualquier duda o problema que puedan tener nuestros usuarios.</li>
        </ul>

    </section>
    </div>
</main>
<div style="width: 400px; height: 200px"></div>

@endsection
</body>
</html>
