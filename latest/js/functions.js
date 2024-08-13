function uc_first(string) {
    return string.charAt(0).toUpperCase() + string.slice(1);
}
function is_dom(element) {
    return typeof element === 'object' && element !== null && typeof element.tagName != 'undefined';
}
function is_json(input) {
    if (typeof input != 'string') {
        return false;
    }
    if (input.search(/\[/) == -1 && input.search(/\{/) == -1) {
        return false;
    }
    if (input.search(/\]/) == -1 && input.search(/\}/) == -1) {
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
    if (typeof element !== 'object' || element === null) {
        element = document.querySelector('body');
    }
    if (is_dom(element)) {
        const Router = new RouterClass();
        element.querySelectorAll('[data-href]:not([data-linked])').forEach(function (link) {
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
            input.forEach(function (value, key) {
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
function rand(input, callback, amount = 1) {
    if (typeof callback === 'function') {
        let hits = 0;
        let selectedItems = {};
        let totalItems = Object.keys(input).length;

        while (hits < amount) {
            loop(input, function (item, key) {
                if (hits < amount && !selectedItems.hasOwnProperty(key) && Math.random() <= (amount / totalItems)) {
                    selectedItems[key] = item;
                    hits++;
                }
            });
        }

        if (amount === 1) {
            let firstKey = Object.keys(selectedItems)[0];
            callback(selectedItems[firstKey], firstKey);
        } else {
            callback(selectedItems);
        }
    }
}
//
function generate_html(config, as_string = false) {
    if (typeof config.cssclass != 'string' || config.cssclass.length <= 0) {
        config.cssclass = generate_id(4);
    }
    if (typeof config.tag != 'string' || config.tag.length <= 0) {
        config.tag = 'div';
    }
    if (typeof config.itemstag != 'string' || config.itemstag.length <= 0) {
        config.itemstag = 'div';
    }
    if (typeof config.data != 'object' || config.data.length <= 0) {
        config.data = [];
    }
    if (typeof config.attr != 'object' || config.attr.length <= 0) {
        config.attr = [];
    }
    let wrap = document.createElement(config.tag);
    wrap.className = config.cssclass;
    loop(config.items, function (html, key) {
        if(is_dom(html)) {
            wrap.appendChild(html);
        } else {
            let item = document.createElement(config.itemstag);
            item.className = config.cssclass + '_' + key;
            item.innerHTML = html;
            wrap.appendChild(item);
        }
    });
    if(!config.items && config.innerHTML) {
        wrap.innerHTML = config.innerHTML;
    }
    loop(config.data, function(value, key) {
        wrap.setAttribute('data-' + key, value);
    });
    loop(config.attr, function(value, key) {
        wrap.setAttribute(key, value);
    });
    return as_string === true ? wrap.outerHTML : wrap;
}

function length(input) {
    if(typeof input == 'string') {
        return input.trim().length;
    }
    if(typeof input == 'number') {
        return input.toString().length;
    }
    if(typeof input == 'object') {
        if(typeof input.length != 'undefined') {
            return input.length;
        }
        let i, count = 0;
        for(i in input) {
            count++;
        }
        return count;
    }
    return null;
}