
$(document).ready(function(){

    
});

$(document).on("click", "#btnrecuperar", function(){

    var usu_correo = $('#usu_correo').val();

    if (usu_correo === "") {
        Swal.fire({ 
            title: "Recuperar", 
            text: "El campo está vacío", 
            icon: "error", 
            confirmButtonColor: "#5156be" 
          });
    }else{

        $.ajax({
            url: "../../controller/email.php?op=recuperar",
            type: "POST",
            data: {usu_correo : usu_correo, rol_id : 2},
            success: function(datos){

                if (datos == 1) {

                    Swal.fire({ 
                        title: "Recuperar", 
                        text: "Se cambió la contraseña y se envió a su correo electrónico", 
                        icon: "success", 
                        confirmButtonColor: "#5156be" 
                        });

                    $('#btnrecuperar').prop("disabled", false);
                    $('#btnrecuperar').html('Recuperar');
                    
                }else{
        
                    Swal.fire({ 
                        title: "Recuperar", 
                        text: "El correo electrónico no existe", 
                        icon: "error", 
                        confirmButtonColor: "#5156be" 
                      });
                }
            },beforeSend: function(){
                $('#btnrecuperar').prop("disabled", true);
                $('#btnrecuperar').html('<i class="bx bx-hourglass bx-spin font-size-16 align-middle me-2"></i>Espere...');
            },
        });
        
    }

    
});