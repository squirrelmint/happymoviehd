// Navbar Menu
	$(document).ready(function () {
	    $('#navbarActive ul li').click(function () {
	        $(this).parent().parent().find('.active').removeClass('active');
	        $(this).addClass('active');
	    });
	});