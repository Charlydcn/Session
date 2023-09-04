// make <tr> of classes 'row-link' clickable instead of the <a> inside of them
var rows = document.querySelectorAll('.row-link');

rows.forEach(function (row) {
    row.addEventListener('click', function () {
        var url = this.getAttribute('data-href');
        window.location.href = url;
    });
});

// responsive nav opening/closing
var openBtn = document.getElementById("openBtn");
var overlay = document.getElementById("nav-menu");
openBtn.addEventListener("click", function () {
    console.log('test')
	this.classList.toggle("close");
	overlay.classList.toggle("overlay");
});
