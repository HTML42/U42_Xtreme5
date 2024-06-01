class AppClass {
    constructor() {
        this.mime = 'text/html';
        this.encoding = 'UTF-8';
        this.dom_created = false;
    }

    set_mime(mime) {
        this.mime = mime;
    }

    get_mime() {
        return this.mime;
    }

    set_encoding(encoding) {
        this.encoding = encoding;
    }

    get_encoding() {
        return this.encoding;
    }

    render() {
        if (!this.dom_created) {
            this.dom_created = true;
            let Template_body = new TemplateClass('body');
            let Template_head = new TemplateClass('head');
            document.head.append(Template_head.dom);
            document.body.append(Template_body.dom);
            transform_datahref();
        }
        document.querySelector('html').setAttribute('lang', window.LANG);
        document.querySelector('body main#page_main > article').innerHTML = '';
        const Router = new RouterClass();
        const current_route = Router.route();
        if (!current_route) {
            Router.redirect(['index', 'index']);
        } else {
            const controller_name = uc_first(current_route[0]) + 'Controller';
            if (window[controller_name] && typeof window[controller_name] === 'function') {
                let Controller = new window[controller_name]();
                const view_name = 'view_' + current_route[1];
                if (Controller[view_name] && typeof Controller[view_name] === 'function') {
                    let Page = Controller[view_name]();
                    if(typeof Page.Template === 'object' && Page.Template !== null && typeof Page.Template.dom === 'object' && Page.Template.dom) {
                        document.querySelector('body main#page_main > article').append(Page.Template.dom);
                    }
                    document.querySelector('head title').innerHTML = Page.title;
                }
            }
        }
        setTimeout(function() {
            document.querySelectorAll('[data-form="login"]').forEach(element => {
                const form_config = FORMS[element.dataset.form] ?? null;
                const Form_login = new FormClass(element, form_config);
                Form_login.generate();
                element.append(Form_login.dom);
            });
        }, 10);
    }

    get_object(object_path, callback, parse_json = true, debug = false) {
        if(debug) {
            console.log('X5::get_object() - Call: ' + object_path);
        }
        fetch(object_path)
            .then(response => {
                if (!response.ok) {
                    throw new Error('X5::Error - Object not found (' + object_path + ')');
                }
                return response.text();
            })
            .then(data => {
                if(typeof callback == 'function') {
                    callback(is_json(data) ? JSON.parse(data) : data);
                } else if(typeof window[callback] == 'function') {
                    window[callback](is_json(data) ? JSON.parse(data) : data);
                }
                if(debug) {
                    console.log('X5::get_object() - ' + object_path, is_json(data) ? JSON.parse(data) : data);
                }
            });
    }

}

var App = new AppClass();
