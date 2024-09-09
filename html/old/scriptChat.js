/*
function loadMessages() {
    $.ajax({
        url: 'get_messages.php',
        type: 'GET',
        success: function(response) {
            $('#chat-box').html(response);
            // Desplazar el scroll hacia abajo para mostrar el último mensaje
            $('#chat-box').scrollTop($('#chat-box')[0].scrollHeight);
        }
    });
}
*/
function loadMessages() {
    $.ajax({
        type: "GET",
        url: "get_messages.php",
        success: function(response) {
            $("#chat-box").html(response);
			var idU = <?php echo isset($_SESSION['idU']) ? $_SESSION['idU'] : 'null'; ?>;
			console.log("AYUDA "+idU);
        }
    });
}

/*
function sendMessage() {
    var message = $('#message').val();
    if (message != '') {
        $.ajax({
            url: 'send_message.php',
            type: 'POST',
            data: { message: message },
            success: function(response) {
                loadMessages(); // Cargar mensajes después de enviar el mensaje
                $('#message').val(''); // Limpiar el campo de entrada
            }
        });
    }
}*/

function sendMessage() {
    var message = document.getElementById("message").value;
    if (message !== "") {
        $.ajax({
            type: "POST",
            url: "set_messages.php",
            data: { message: message },
            success: function(response) {
                document.getElementById("message").value = "";
            }
        });
    }
}

//setInterval(recibirMensajes, 1000);

// Cargar mensajes al cargar la página


$(document).ready(function() {
    loadMessages();
    setInterval(loadMessages, 1000);
});