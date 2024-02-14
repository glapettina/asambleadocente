
var timerInterval;

function init(){

   /*  TODO: Escucha el evento submit del formulario */

    $("#mnt_form").on("submit", function(e){

        /* TODO: Evita que el formulario se envíe automáticamente */
        e.preventDefault();

        /* TODO: Validar el formulario antes de enviarlo */

        if (isFormValid()) {

            /* TODO: Si es válido, enviar datos */
            registrar(e);

        }else{

            /* TODO: Si no es válido, muestra mensajes de error */

            displayValidationMessage();
        }

        
    });
}

function isFormValid(){

    return validateEmail() && validateText("usu_nomape") && validatePassword() && validatePasswordMatch();
}

function validateEmail(){
    var email = $("#usu_correo").val();
    var isValid = validator.isEmail(email);
    displayErrorMessage("#usu_correo", isValid, "Ingrese Correo Electrónico");

    return isValid;
}

function validateText(fieldId){

    var value = $("#" + fieldId).val();
    var isValid = validator.isLength(value, {min:1});
    displayErrorMessage("#" + fieldId, isValid, "Este campo es obligatorio");

    return isValid;

}

function validatePassword(){

    var password = $("#usu_pass").val();
    var isValid = validator.isLength(password, {min:8});
    displayErrorMessage("#usu_pass", isValid, "La contraseña debe tener 8 caracteres como mínimo");

    return isValid;

}

function validatePasswordMatch(){

    var password = $("#usu_pass").val();
    var confirmPassword = $("#usu_pass_confir").val();
    var isValid = validator.equals(password, confirmPassword);
    displayErrorMessage("#usu_pass_confir", isValid, "Las contraseñas no coinciden");

    return isValid;

}

function displayErrorMessage(fieldSelector, isValid, message){

    var erroField = $(fieldSelector).next(".validation-error");
    erroField.text(isValid ? "" : message);
    erroField.toggleClass("text-danger", !isValid);

}

function displayValidationMessage(){

    validateEmail();
    validateText("usu_nomape");
    validatePassword();
    validatePasswordMatch();

}

function registrar(){
    
    var formData = new FormData($("#mnt_form")[0]);
    $.ajax({
        url: "../../controller/usuario.php?op=registrar",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function(datos){

            if (datos == 1) {
                Swal.fire({ 
                title: "Registro", 
                text: "Se registró correctamente. Por favor iniciar sesión. Redireccionando en 10 segundos.", 
                icon: "success", 
                confirmButtonColor: "#5156be",
                 timer: 5000,
                 timerProgressBar: true,
                 didOpen: function() {
                    Swal.showLoading();
                    timerInterval = setInterval(function(){
                        var content = Swal.getHtmlContainer();
                        if (!content) return;
                        var countdownElement = content.querySelector("b");
                        if (countdownElement) {
                            countdownElement.textContent = (Swal.getTimerLeft() / 1000).toFixed(0);
                        }
                    }, 100);
                 },
                 didClose: function(){
                    clearInterval(timerInterval);
                    window.location.href = "../../index.php";
                 },

              }).then(function(result){

                 if(result.dismiss === Swal.DismissReason.timer){

                    /* console.log("I was closed by the timer"); */

                 }
              });

            }else if(datos == 0){
                Swal.fire({ 
                    title: "Registro", 
                    text: "El correo electrónico ya existe", 
                    icon: "error", 
                    confirmButtonColor: "#5156be" 
                  });

            }
            /* console.log(datos); */
        }
    });
}

function startGoogleSignIn(){

    // TODO: Obtener la instancia de autenticación de Google
    const auth = gapi.auth2.getAuthInstance();

    // TODO: Iniciar sesión con Google
    auth.signIn();
}

function handleCredentialResponse(response){

    $.ajax({
        type: 'POST',
        url: '../../controller/usuario.php?op=registrargoogle',
        contentType: 'application/json',
        headers: {"Content-Type": "application/json"},
        data: JSON.stringify({
            request_type: 'user_auth',
            credential: response.credential
        }),

        success: function(data){

            var data = JSON.parse(data);

            

            if (data == "0") {
                console.log(data);
                window.location.href = '../home/'

            }else if(data == "1"){

                window.location.href = '../home/'
            }
        }
    })

    if (response && response.credential) {
        
        const credentialToken = response.credential;

        // TODO: Decodificar el token manualmente para obtener datos del usuario
        const decodedToken = JSON.parse(atob(credentialToken.split('.')[1]));

        /* console.log(decodedToken); */
    }
}

init();

