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

        let confirmPassword = document.getElementById("confirm-pass");
        if (usuario.password == null) {
            confirmPassword.value = "";
        } else confirmPassword.value = usuario.password;



        let rol = document.getElementById("rol");
        if (usuario.rol == null) {
            rol.value = "";
        } else rol.value = usuario.rol;

        let guardar = document.getElementById("guardar");
        guardar.addEventListener('click', actualizarUsuario);

        function actualizarUsuario(e) {
            if (!validarPassword()) {
                e.preventDefault();
                return;
            };

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

            fetch('../controllers/controller_actualizarUsuario.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },

                body: usuarioActualizarJSON
            })

                // si no hay error, recibimos valor como objeto "data"
                // .then(response => response.json())
                .then(response => response.json())
                .then(data => {
                    if (data.error) {
                        console.error('Error:', data.error);
                    }

                    
                    if(data.length == 26){
                        swal({
                            title: "Éxito",
                            text: data,
                            icon: "success",
                        })
                    } 

                    console.log(data.length);
                    if(data.length == 22){
                        swal({
                            title: "¡Error!",
                            text: data,
                            icon: "error",
                        })
                    }


                })

        }

        let cancelar = document.getElementById("cancelar");
        cancelar.addEventListener('click', function () {
            window.location.href = "home.php";
        });


    }

    function validarPassword() {
        var caract_longitud = 6;
        var pass1 = document.getElementById("pass").value;
        var pass2 = document.getElementById("confirm-pass").value;

        if (pass1 === '' && pass2 === '') {
            swal({
                title: "¡Error!",
                text: "No se ha ingresado nada en ninguno de los campos.",
                icon: "warning"
            });
            return false;
        }

        if (pass1.trim() !== pass1 || pass2.trim() != pass2) {
            swal({
                title: "¡Error!",
                text: "Las claves no pueden contener espacios.",
                icon: "warning"
            });
            return false;
        }

        if (pass1.length < caract_longitud || pass2.length < caract_longitud) {
            swal({
                title: "¡Error!",
                text: "Las claves no pueden tener menos de 6 caracteres.",
                icon: "warning"
            });
            return false;
        }

        if (pass1 !== pass2) {
            swal({
                title: "¡Error!",
                text: "Las claves no coinciden.",
                icon: "warning"
            });
            return false;
        }
        return true;
    }

}

