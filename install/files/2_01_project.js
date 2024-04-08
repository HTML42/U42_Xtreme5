console.log('File::2_01_project.js');
function __start_project__() {
    console.log('INIT');

    setTimeout(db_select_switch, 1);

    if(document.getElementById('installApp')) {
        document.getElementById('installApp').addEventListener('click', function() {
            var xhr = new XMLHttpRequest();
            xhr.open('POST', '?step=4&ajax', true);
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            xhr.onload = function() {
                if (xhr.status === 200 && parseInt(xhr.responseText) === 1) {
                    window.location.href = BASEURL_SCRIPT + '?step=9';
                } else {
                    document.getElementById('installResult').innerHTML = '<div class="alert alert-danger" role="alert">Error during the installation process.</div>';
                }
            };
            xhr.send();
        });
    }
}

window.onload = function() {
    setTimeout(__start_project__, 50);
};
