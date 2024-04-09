console.log('File::2_02_functions.js');

function db_select_switch() {
    var dbTypeSelect = document.getElementById('db_type');
    var mysqlFields = document.getElementById('mysql-fields');
    console.log(dbTypeSelect, mysqlFields);
    if (dbTypeSelect && mysqlFields) {
        function toggleMysqlFields() {
            mysqlFields.style.display = dbTypeSelect.value.toLowerCase() === 'mysql' ? 'block' : 'none';
        }
        dbTypeSelect.addEventListener('change', toggleMysqlFields);
        toggleMysqlFields();
    }
}