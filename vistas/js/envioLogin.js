window.onload = function () {

    // Listener para el botón de volver
    let botonVolver = document.getElementById("botonVolver");
    botonVolver.addEventListener("click", function () {
        window.location.href = "../index.php";

    });

    // Ponemos un listener al botón de enviar formulario
    let botonLogin = document.getElementById("botonLogin");
    botonLogin.addEventListener("click", function () {

        // Si se ha pulsado el botón, enviamos datos del formulario  

        // Construimos un objeto con los datos    
        let login = new Object();
        login.email = document.getElementById("email").value;
        login.pass = document.getElementById("pass").value;

        let loginJSON = JSON.stringify(login);


        // Llamada AJAX, enviando nuestro Objeto transformado
        // en JSON.        
        fetch('../controllers/validarLogin.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },

            body: loginJSON
        })

            // si hay error, recibimos valor como "data.error"
            .then(response => response.json())
            .then(data => {

                if (data.error) {
                    console.error('Error:', data.error);
                    // Error de login
                    // Incorporamos librería SweetAlert para las alertas
                    // https://sweetalert.js.org/guides/#getting-started

                    swal({
                        title: "¡Error!",
                        text: data.error,
                        icon: "error",
                    })

                }
                else {
                    // Login exitoso
                    window.location.href = "../vistas/home.php";
                }

            })

    });



}

