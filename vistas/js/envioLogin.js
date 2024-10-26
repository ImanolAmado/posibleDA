window.onload = function() {

// Ponemos un listener al botón del formulario

let botonLogin = document.getElementById("botonLogin");
botonLogin.addEventListener("click", function(){

    // Si se ha pulsado el botón, enviamos datos del formulario  
   
    // Construimos un objeto con los datos    
    let login = new Object();
    login.email = document.getElementById("email").value;
    login.pass = document.getElementById("pass").value;
    
    let loginJSON = JSON.stringify(login);
       
        
    // Llamada AJAX, enviando nuestro Objeto transformado
    // en JSON.        
    fetch('../controllers/validarLogin2.php', {
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
    // Insertamos el mensaje recibido del servidor en el dom.
    let mensajeError = document.getElementById("mensajeError");
    mensajeError.innerHTML=data.error; 
    } 
    else {
    // Login exitoso
    window.location.href = "../vistas/home.php";
    }

})  

});


}

