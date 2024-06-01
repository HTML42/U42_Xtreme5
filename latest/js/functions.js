function uc_first(string) {
    return string.charAt(0).toUpperCase() + string.slice(1);
}
function is_dom(element) {
    return typeof element === 'object' && element !== null && typeof element.tagName != 'undefined';
}
function is_json(input) {
    if(typeof input != 'string') {
        return false;
    }
    if(input.search(/\[/) == -1 && input.search(/\{/) == -1 ) {
        return false;
    }
    if(input.search(/\]/) == -1 && input.search(/\}/) == -1 ) {
        return false;
    }
    return true;
}
function generate_id(length = 8) {
    const characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    const characters_length = characters.length;
    let result = '';
    for (let i = 0; i < length; i++) {
        const random_index = Math.floor(Math.random() * characters_length);
        result += characters[random_index];
    }
    return result;
}
//
function transform_datahref(element) {
    if(typeof element !== 'object' || element ===  null) {
        element = document.querySelector('body');
    }
    if(is_dom(element)) {
        const Router = new RouterClass();
        element.querySelectorAll('[data-href]:not([data-linked])').forEach(function(link) {
            link.dataset.linked = true;
            link.onclick = function () {
                Router.redirect(link.dataset.href);
            };
        });
    }
}
//
function loop(input, callback) {
    if (typeof callback === 'function') {
        if (typeof input === 'object' && typeof input.forEach === 'function') {
            input.forEach(function(value, key) {
                callback(value, key);
            });
        } else if (typeof input === 'object') {
            for (let key in input) {
                if (input.hasOwnProperty(key)) {
                    callback(input[key], key);
                }
            }
        } else if (typeof input === 'string' || typeof input === 'number') {
            callback(input, 0);
        }
    }
}
//
function generate_html(config) {
    if(typeof config.cssclass != 'string' || config.cssclass.length <= 0) {
        config.cssclass = generate_id(4);
    }
    let wrap = document.createElement('div');
    wrap.className = config.cssclass;
    loop(config.items, function(html, key) {
        let item = document.createElement('div');
        item.className = config.cssclass + '_' + key;
        item.innerHTML = html;
        wrap.appendChild(item);
    });
    return wrap;
}