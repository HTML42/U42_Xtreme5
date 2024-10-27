setTimeout(function() {
    setInterval(check_login_logout, 500);
    //
    document.querySelectorAll('[data-scroll]').forEach(function(element) {
        element.addEventListener('click', function(event) {
            event.preventDefault();
            scroll_to(element.getAttribute('data-scroll'));
            if(element.getAttribute('href').substring(0, 2) == '#!') {
                location.hash = element.getAttribute('href').substring(1);
            }
        });
    });
    //
    window.addEventListener('scroll', () => {
        let target_ids = [];
        document.querySelectorAll('[data-scroll]').forEach(nav_item => {
            let target_id = nav_item.getAttribute('data-scroll'),
                target_element = document.getElementById(target_id),
                target_top = target_element ? target_element.getBoundingClientRect().top + window.scrollY : null;
            
            if (target_top !== null) {
                target_ids.push({ id: target_id, top: target_top });
            }
        });
        target_ids.sort((a, b) => a.top - b.top);
        let scroll_position = window.scrollY + 100;
        //
        if(scroll_position <= 350) {
            location.hash = '!index/index/intro';
            document.querySelectorAll('.menu_main li').forEach(item => item.classList.remove('menu_item--current'));
            return;
        }
        let vr_section = document.getElementById('vr');
        if (vr_section) {
            let vr_top = vr_section.getBoundingClientRect().top + window.scrollY;
            if (scroll_position >= vr_top) {
                document.querySelectorAll('.menu_main li').forEach(item => item.classList.remove('menu_item--current'));
                location.hash = '!index/index';
                return;
            }
        }
        //
        for (let i = 0; i < target_ids.length; i++) {
            if (scroll_position >= target_ids[i].top && (!target_ids[i + 1] || scroll_position < target_ids[i + 1].top)) {
                let li = document.querySelector(`[data-scroll="${target_ids[i].id}"]`).parentElement;
                if (!li.classList.contains('menu_item--current')) {
                    document.querySelectorAll('.menu_main li').forEach(item => item.classList.remove('menu_item--current'));
                    li.classList.add('menu_item--current');
                    location.hash = li.querySelector('a').getAttribute('href').substring(1);
                    break;
                }
            }
        }
    });
}, 10);
setTimeout(function() {
    document.querySelector('#intro').classList.add('hd');
}, 500);

setTimeout(check_login_logout, 1);

function check_login_logout() {
    if (window.ME.is_login && (window.ME.is_admin || window.ME.is_root)) {
        document.body.classList.add('is-admin');
    } else {
        document.body.classList.remove('is-admin');
    }
    if (window.ME.is_login) {
        document.querySelectorAll('[data-status="loggedout"]').forEach(function (element) {
            element.classList.add('d-none');
        });
        document.querySelectorAll('[data-status="loggedin"]').forEach(function (element) {
            element.classList.remove('d-none');
        });
    } else {
        document.querySelectorAll('[data-status="loggedout"]').forEach(function (element) {
            element.classList.remove('d-none');
        });
        document.querySelectorAll('[data-status="loggedin"]').forEach(function (element) {
            element.classList.add('d-none');
        });
    }
}
function callback_login_success() {
    (new RouterClass()).redirect('index/index');
    setTimeout('location.reload(true)', 100);
}
function callback_user_registration_success() {
    (new RouterClass()).redirect('users/login');
    setTimeout('location.reload(true)', 100);
}

let HOSTNAME = location.hostname.toLowerCase().trim();
let IS_LOCAL = HOSTNAME == 'localhost' || HOSTNAME.search('.local') != -1 || HOSTNAME.search('.projects') != -1;

//Helpers:
function generate_table(columns, rows, config = {}) {
    let table = document.createElement('table');
    let thead = document.createElement('thead');
    let tbody = document.createElement('tbody');

    // Setze CSS-Klasse und Attribute
    if (config.cssclass) {
        table.className = config.cssclass;
    }
    if (config.attr) {
        Object.keys(config.attr).forEach(key => {
            table.setAttribute(key, config.attr[key]);
        });
    }

    // Erzeuge Tabellenkopf
    let headRow = document.createElement('tr');
    columns.forEach(column => {
        let th = document.createElement('th');
        th.textContent = column;
        headRow.appendChild(th);
    });
    thead.appendChild(headRow);

    // Füge Sonderzeilen hinzu, falls vorhanden
    if (typeof rows === 'string') {
        tbody.innerHTML = rows;
        rows = Array.prototype.slice.call(arguments, 2); // Übernehme die Datenreihen
    }

    // Erzeuge Tabellenzeilen
    rows.forEach(row => {
        let tr = document.createElement('tr');
        row.forEach((cell, index) => {
            let td = document.createElement('td');
            td.innerHTML = cell || '';
            tr.appendChild(td);
        });
        tbody.appendChild(tr);
    });

    table.appendChild(thead);
    table.appendChild(tbody);
    return table;
}
function get_object_cached(cache_ttl = 60, object_path, callback, parse_json = true, debug = false, data = [], method = 'GET') {
    const cache_key = `cache_${object_path}`;
    const cache_timestamp_key = `${cache_key}_timestamp`;
    const current_time = new Date().getTime();

    const cached_data = localStorage.getItem(cache_key);
    const cache_timestamp = localStorage.getItem(cache_timestamp_key);

    if (cached_data && cache_timestamp && (current_time - cache_timestamp) < cache_ttl * 1000) {
        const response = parse_json ? JSON.parse(cached_data) : cached_data;
        if (debug) {
            console.log(`Cache hit for ${object_path}`);
        }
        callback(response);
    } else {
        App.get_object(object_path, function(response) {
            if (response) {
                localStorage.setItem(cache_key, parse_json ? JSON.stringify(response) : response);
                localStorage.setItem(cache_timestamp_key, current_time);
                if (debug) {
                    console.log(`Cache updated for ${object_path}`);
                }
            }
            callback(response);
        }, parse_json, debug, data, method);
    }
}

function scroll_to(target) {
    var targetElement = document.getElementById(target);
    if (targetElement) {
        var targetPosition = targetElement.getBoundingClientRect().top + window.scrollY;
        var offsetPosition = targetPosition - 60;
        window.scrollTo({
            top: offsetPosition,
            behavior: 'smooth'
        });
    }
}