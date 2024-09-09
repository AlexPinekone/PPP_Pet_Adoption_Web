	/*document.addEventListener("DOMContentLoaded", function() {
        var usuariosValidos = [
            { usuario: "juan", contraseña: "123" },
            { usuario: "maria", contraseña: "321" }
        ];

        var form = document.querySelector("form");
        form.addEventListener("submit", function(event) {
            event.preventDefault();

            var username = document.getElementById("username").value;
            var password = document.getElementById("password").value;

            var usuarioValido = usuariosValidos.find(function(usuario) {
                return usuario.usuario === username && usuario.contraseña === password;
            });

            if (usuarioValido) {
                alert("Inicio de sesión exitoso");
				localStorage.setItem('sesionIniciada', 'true');
				window.location.href = "../index.html";
            } else {
                alert("Usuario o contraseña incorrectos");
            }
        });
    });*/
	
	/*document.addEventListener("DOMContentLoaded", function() {
    var sesionIniciada = getCookie('sesionIniciada');
	
    if (sesionIniciada === 'true') {
        document.getElementById("botEscon1").style.display = "none";
        document.getElementById("botEscon2").style.display = "none";
        document.getElementById("perfilboton").style.display = "block"
        document.getElementById("creapostbot").style.display = "block";
    }
	});
	
	document.addEventListener("DOMContentLoaded", function() {
    var usuariosValidos = [
        { usuario: "juan", contraseña: "123" },
        { usuario: "maria", contraseña: "321" }
    ];

    var form = document.querySelector("form");
	
    form.addEventListener("submit", function(event) {
        event.preventDefault();

        var username = document.getElementById("username").value;
        var password = document.getElementById("password").value;

        var usuarioValido = usuariosValidos.find(function(usuario) {
            return usuario.usuario === username && usuario.contraseña === password;
        });

        if (usuarioValido) {
            alert("Inicio de sesión exitoso");
            setCookie('sesionIniciada', 'true', 1/(24*60)); // La cookie expira en 7 días
            window.location.href = "../index.html";
        } else {
            alert("Usuario o contraseña incorrectos");
        }
    });
	});
	
	function setCookie(cname, cvalue, exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
    var expires = "expires="+d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
	}

	function getCookie(cname) {
		var name = cname + "=";
		var decodedCookie = decodeURIComponent(document.cookie);
		var ca = decodedCookie.split(';');
		for(var i = 0; i <ca.length; i++) {
			var c = ca[i];
			while (c.charAt(0) == ' ') {
				c = c.substring(1);
			}
			if (c.indexOf(name) == 0) {
				return c.substring(name.length, c.length);
			}
		}
		return "";
	}*/