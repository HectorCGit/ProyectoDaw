<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Aeroweb</title>
  {{--  @vite('/resources/js/Winwheel.js','http://cdnjs.cloudflare.com/ajax/libs/gsap/latest/TweenMax.min.js')
    @vite('/resources/css/ruleta.css')--}}
    <link rel="stylesheet" href="{{ mix('/resources/css/ruleta.css') }}">


</head>
<body class="min-vh-100 position-relative pb-xxl-5">

@extends('layouts.app')
@section('content')
    <div align="center">
        <h1>RULETA DE PREMIOS</h1>

        <br />
        <!-- Always set canvas to largest desired size, i.e. desktop PC size, it will be scaled down for smaller devices but never scaled up -->
        <canvas id="canvas" width="500" height="500" style="background-color: silver;" data-responsiveMinWidth="180" data-responsiveScaleHeight="true">
            <p style="{color: white}" align="center">Sorry, your browser doesn't support canvas. Please try another.</p>
        </canvas>
        <br /><br />
        <p align="center">Tap the wheel to spin.</p>
    </div>

@endsection
<script src="{{ mix('/resources/js/Winwheel.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/latest/TweenMax.min.js"></script>
<script>
    let theWheel;
    // -----------------------------------------------------------------
    // Called by the onClick of the canvas, starts the spinning.
    function startSpin() {
        // Stop any current animation.
        theWheel.stopAnimation(false);

        // Reset the rotation angle to less than or equal to 360 so spinning again
        // works as expected. Setting to modulus (%) 360 keeps the current position.
        theWheel.rotationAngle = theWheel.rotationAngle % 360;

        // Start animation.
        theWheel.startAnimation();
    }
    document.addEventListener('DOMContentLoaded', function() {
         theWheel = new Winwheel({
            'numSegments': 8,     // Specify number of segments.
            'textFontSize': 28,    // Set font size as desired.
            'responsive': true,  // This wheel is responsive!
            'segments':        // Define segments including colour and text.
                [
                    {'fillStyle': '#eae56f', 'text': 'DESCUENTO'},
                    {'fillStyle': '#e7706f', 'text': 'SIN PREMIO'},
                    {'fillStyle': '#7de6ef', 'text': 'BILLETE'},
                    {'fillStyle': '#e7706f', 'text': 'SIN PREMIO'},
                    {'fillStyle': '#89f26e', 'text': 'PUNTOS'},
                    {'fillStyle': '#eae56f', 'text': 'DESCUENTO'},
                    {'fillStyle': '#7de6ef', 'text': 'BILLETE'},
                    {'fillStyle': '#e7706f', 'text': 'SIN PREMIO'}
                ],
            'pins':
                {
                    'outerRadius': 6,
                    'responsive': true, // This must be set to true if pin size is to be responsive, if not just location is.
                },
            'animation':           // Specify the animation to use.
                {
                    'type': 'spinToStop',
                    'duration': 5,     // Duration in seconds.
                    'spins': 8,     // Number of complete spins.
                }
        });

        document.getElementById('canvas').onclick = startSpin;
    });
</script>
</body>
</html>
