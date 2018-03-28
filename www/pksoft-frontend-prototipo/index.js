function toggleMenu(e) {
	e = e || window.event;
	e.preventDefault();
	var html = document.documentElement;	
	html.className = (html.className === 'menu-active') ? '' : 'menu-active';
}