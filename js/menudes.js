document.getElementById('menu-btn').addEventListener('click', function() {
    var nav = document.getElementById('menu');
	var menu = document.getElementsByClassName("Menu")[0];
    if (nav.style.display == 'block') {
        nav.style.display = 'none';
		menu.style.height = "120px";
    } else {
        nav.style.display = 'block';
		menu.style.height = "380px"
    }
});