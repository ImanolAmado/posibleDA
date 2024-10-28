window.onload = function () {

/* 
    let url = window.location.href;
    let corte = url.split("=");
    let id = corte[1];
 */

    //let idJSON = JSON.stringify(id);

    fetch('../controllers/controller_editarUsuario.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },

        body: JSON.stringify({})
    })


        // si no hay error, recibimos valor como objeto "data"
        .then(response => response.json())
        .then(data => {
            pintarDatos(data);
            console.log(data);
        })


    function pintarDatos(usuario) {

        console.log(usuario);

        /* let nombre = document.getElementById("nombre");
        nombre.innerHTML = nombre; */

        let nombre = document.getElementById("nombre");
        if (usuario.nombre == null) {
            nombre.value = "";
        } else nombre.value = usuario.nombre;

        let apellido = document.getElementById("apellido");
        if (usuario.apellido == null) {
            apellido.value = "por leer";
        } else apellido.value = usuario.apellido;

        let email = document.getElementById("email");
        if (usuario.email == null) {
            email.value = 1;
        } else email.value = usuario.email;

        let password = document.getElementById("pass");
        if (usuario.password == null) {
            password.value = "";
        } else password.value = usuario.password;

        let rol = document.getElementById("rol");
        if (usuario.rol == null) {
            rol.value = "";
        } else rol.value = usuario.rol;

        let guardar = document.getElementById("guardar");
        guardar.addEventListener('click', actualizarUsuario);

        function actualizarUsuario() {
            let usuarioActualizar = new Object();
            usuarioActualizar.nombre = nombre.value;
            usuarioActualizar.apellido = apellido.value;
            usuarioActualizar.email = email.value;
            usuarioActualizar.password = password.value;
            usuarioActualizar.rol = rol.value;

            console.log(nombre.value);
            console.log(apellido.value);
            console.log(email.value);
            console.log(password.value);
            console.log(rol.value);

            let usuarioActualizarJSON = JSON.stringify(usuarioActualizar);

            fetch('../controllers/controller_actualizar.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },

                body: usuarioActualizarJSON
            })

                // si no hay error, recibimos valor como objeto "data"
                .then(response => response.json())
                .then(data => {
                    //window.location.href = "home.php";
                    
                })

        }

        let cancelar = document.getElementById("cancelar");
        cancelar.addEventListener('click', function () {
            window.location.href = "home.php";
        });


    }

}

