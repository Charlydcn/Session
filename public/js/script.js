var rows = document.querySelectorAll('.row-link');

rows.forEach(function (row) {
    row.addEventListener('click', function () {
        var url = this.getAttribute('data-href');
        window.location.href = url;
    });
});