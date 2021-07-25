var keyword = document.getElementById('katakunci');
var tombolcari = document.getElementById('tombolcari');
var container = document.getElementById('containerid');

keyword.addEventListener('keyup', function () {
    var xhr = new XMLHttpRequest();

    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            container.innerHTML = xhr.responseText;
        }
    }

    xhr.open('GET', 'modul/dosen/dosenajax.php?katakunci=' + katakunci.value, true);
    xhr.send();

});