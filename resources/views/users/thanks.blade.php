<link rel="stylesheet" href="{{ asset('css/app.css') }}">
<link rel="stylesheet" href="{{ mix('css/custom.css') }}" defer>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<html class="dark">
<main class="w-screen h-screen flex justify-center items-center bg-gray-800">

    <div class="max-w-2xl mx-auto">

        <h1 class="uppercase text-white text-xl lg:text-2xl font-bold text-center my-2">Nos pondremos en contacto contigo
            tan pronto nos sea posible</h1>
        <h1  class="uppercase  text-white text-lg lg:text-xl font-bold text-center my-2">
            Puedes cerrar esta pestaña</h1>

    </div>
</main>
<script>
    window.addEventListener('load', function() {
        Swal.fire('Gracias por tu solicitud');

        
    })
</script>

</html>
