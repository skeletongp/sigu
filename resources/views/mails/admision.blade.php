<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <title>Email</title>
</head>

<body>
    <main class="container">
        <div class="body">
            <h2>Solicitud de ingreso</h2>

            <p> A través del Portal de Gestión, se ha solicitado el registro de un nuevo estudiante. Los datos del mismo
                son los siguientes:</p>
            <table>
                <tr>
                    <td>
                        <h3>Nombre:</h3>
                    </td>
                    <td>{{$data->name}} </td>
                </tr>
                <tr>
                    <td>
                        <h3>Apellidos:</h3>
                    </td>
                    <td>{{$data->lastname}} </td>
                </tr>
                <tr>
                    <td>
                        <h3>Correo:</h3>
                    </td>
                    <td>{{$data->email}}</td>
                </tr>
                <tr>
                    <td>
                        <h3>Teléfono:</h3>
                    </td>
                    <td>{{$data->phone}}</td>
                </tr>
                <tr>
                    <td>
                        <h3>Fecha de Nacimiento:</h3>
                    </td>
                    <td>{{$data->birthday}}</td>
                </tr>
                <tr>
                    <td>
                        <h3>Carerra:</h3>
                    </td>
                    <td>{{$career}}</td>
                </tr>
            </table>
           
            <x-dropdown-link class="button" href="{{route('users.create', ['role'=>'student','name'=>$data->name,'lastname'=>$data->lastname,'birthday'=>$data->birthday,'career_id'=>$data->career_id])}}">Admitir</x-dropdown-link>
        </div>

    </main>


    </div>


</body>

</html>
<style>
    body {
        background-color: #e1e1e1;
        font-family: Arial, Helvetica, sans-serif;
    }

    * {
        margin: 0;
        padding: 0;
    }

    .container {
        max-width: 680px;
        width: 100%;
        margin: auto;
    }

    main {
        margin: 0 auto;
        display: flex;
        flex-direction: column;
        color: #555555;
    }

    h2 {
        font-weight: bold;
        margin-bottom: 30px;
        text-transform: uppercase;
        text-align: center;
    }

    p {
        font-size: large;
        text-align: justify;
        line-height: 25px;
    }

    hr {
        font-weight: 300;
        color: #000;
        margin-bottom: 15px;
    }

    table {
        width: 100%;
        margin-top: 20px;
        margin-bottom: 20px;
    }

    tr {
        padding-top: 15px !important;
    }

    a {
        text-decoration: underline;
        color: #0c99d5;
    }


    .body {
        padding: 20px;
        padding-top: 40px;
        background-color: white;
        font-family: Geneva, Tahoma, Verdana, sans-serif;
        font-size: 16px;
        line-height: 22px;
        color: #555555;
    }

    .button {
        background-color: #0c99d5;
        border: none;
        color: white;
        border-radius: 2px;
        height: 50px;
        max-width: 250px;
        padding: 10px 30px;
        font-weight: 500;
        font-family: Geneva, Tahoma, Verdana, sans-serif;
        font-size: 16px;
        margin: 10px 0px 30px 0px;
    }

</style>
