class FormClass {
    constructor(form, config) {
        const self = this;
        this.config = config ?? [];
        this.formconfig = {
            ajax: true,
            success: _('forms.callbacks.success'),
            fail: _('forms.callbacks.fail'),
        };
        this.dom = document.createElement('div');
        this.dom.setAttribute('class', 'xform');
        this.form = null;
        this.formtag = null;
        //
        if (is_dom(form)) {
            this.form = form;
            this.formtag = this.form.closest('form');
            //
            if (typeof this.config['_'] == 'object') {
                let config_key, config_value;
                for (config_key in this.config['_']) {
                    config_value = this.config['_'][config_key];
                    this.formconfig[config_key] = config_value;
                }
            }
            //
            const formajax_url = (typeof this.formconfig.ajax == 'string' && this.formconfig.ajax.length ? this.formconfig.ajax.trim() : false);
            if (this.formconfig.ajax || formajax_url) {
                if (formajax_url) {
                    this.formtag.setAttribute('data-ajax', formajax_url);
                } else if (this.formconfig.ajax) {
                    this.formtag.setAttribute('data-ajax', 'TRUE');
                }
                this.formtag.addEventListener('submit', function (event) {
                    event.preventDefault();
                    if (formajax_url) {
                        fetch(formajax_url, {
                            method: 'POST',
                            body: new FormData(self.formtag)
                        })
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    if (typeof window[self.formconfig.success] == 'function') {
                                        window[self.formconfig.success](data);
                                    } else {
                                        alert(self.formconfig.success);
                                    }
                                } else {
                                    alert(self.formconfig.fail);
                                }
                            })
                            .catch(error => {
                                console.error('Error:', error);
                                alert(self.formconfig.fail);
                            });
                    } else {
                        alert('OK');
                    }
                });
            }
        } else {
            console.error('Form JS Class: form is not a dom-element.');
        }

    }

    generate() {
        let input_key, input_data;
        this.dom.innerHTML = '';
        for (input_key in this.config) {
            input_data = this.config[input_key];
            if (input_key == '_') {
                //General Form-Configuration
            } else {
                this.dom.append(this.generate_row(input_key, input_data));
            }
        }
    }

    generate_row(input_key, input_data) {
        const row = document.createElement('div');
        row.setAttribute('class', 'xform_row');
        let input_data_type = input_data.type ?? 'text';
        if (input_key == 'submitrow') {
            input_data_type = input_key;
        }
        switch (input_data_type) {
            case 'submitrow':
                this.generate_row_submitrow(row, input_data);
                break;
            //
            case 'text':
            case 'password':
            case 'number':
                this.generate_row_input(row, input_data, input_key, input_data_type);
                break;
            case 'email':
            case 'mail':
                this.generate_row_input(row, input_data, input_key, 'mail');
                break;
            //
            case 'select':
                this.generate_row_select(row, input_data, input_key);
                break;
            case 'date':
                this.generate_row_input(row, input_data, input_key, 'date');
                break;
            case 'time':
                this.generate_row_input(row, input_data, input_key, 'time');
                break;
            //
            case 'textarea':
                this.generate_row_textarea(row, input_data, input_key);
                break;
            //
            case 'captcha':
                this.generate_row_captcha(row, input_data, input_key);
                break;
            //
            case 'xgeo_address':
                this.generate_row_xgeo_address(row, input_data, input_key);
                break;
        }
        return row;
    }

    //

    generate_row_input(parent, data, key, type) {
        const input_id = 'input-' + generate_id(4);
        const input = document.createElement('input');
        const inputwrap = document.createElement('div');
        input.setAttributes({
            'class': 'xform_input',
            'id': input_id,
            'name': key ?? input_id,
            'type': type ?? 'text',
        });
        inputwrap.setAttributes({
            'class': 'xform_inputwrap',
        });
        inputwrap.append(input);
        //
        if (typeof data.label == 'string') {
            input.setAttribute('placeholder', _(data.label.trim(), true) ?? data.label.trim());
        }
        //
        parent.append(inputwrap);
        //
        const error = document.createElement('div');
        error.setAttributes({
            'class': 'xform_inputerror',
        });
        parent.append(error);
        //
        return parent;
    }

    generate_row_select(parent, data, key) {
        const input_id = 'input-' + generate_id(4);
        const select = document.createElement('select');
        const selectwrap = document.createElement('div');

        select.setAttributes({
            'class': 'xform_input xform_select',
            'id': input_id,
            'name': key ?? input_id,
        });
        //
        if (typeof data.label == 'string') {
            const option = document.createElement('option');
            option.setAttributes({
                'value': '',
                'selected': true,
            });
            option.textContent = _(data.label.trim(), true) ?? data.label.trim();
            select.append(option);
        }
        //
        if (data.options) {
            for (const [key, value] of Object.entries(data.options)) {
                const option = document.createElement('option');
                option.setAttributes({
                    'value': key,
                });
                option.textContent = value;
                select.append(option);
            }
        }
        //
        selectwrap.setAttributes({
            'class': 'xform_inputwrap',
        });
        selectwrap.append(select);
        //
        parent.append(selectwrap);
        //
        const error = document.createElement('div');
        error.setAttributes({
            'class': 'xform_inputerror',
        });
        parent.append(error);
        //
        return parent;
    }

    generate_row_submitrow(parent, buttons) {
        const button_wrap = document.createElement('div');
        button_wrap.setAttributes({
            'class': 'xform_buttonwrap',
        });
        //
        Object.entries(buttons).forEach(([button_type, button_label]) => {
            const button = document.createElement('button');
            const button_id = 'button-' + generate_id(4);
            button.setAttributes({
                'class': 'xform_button',
                'id': button_id,
                'type': button_type,
            });
            button.textContent = _(button_label, true) ?? button_label;
            button_wrap.append(button);
        });
        //
        parent.append(button_wrap);
        return parent;
    }

    generate_row_textarea(parent, data, key) {
        const textarea_id = 'textarea-' + generate_id(4);
        const textarea = document.createElement('textarea');
        const textareawrap = document.createElement('div');

        textarea.setAttributes({
            'class': 'xform_textarea',
            'id': textarea_id,
            'name': key ?? textarea_id,
            'rows': data.rows ?? 4,
        });
        textareawrap.setAttributes({
            'class': 'xform_inputwrap',
        });

        if (typeof data.label == 'string') {
            textarea.setAttribute('placeholder', _(data.label.trim(), true) ?? data.label.trim());
        }

        textareawrap.append(textarea);
        parent.append(textareawrap);

        const error = document.createElement('div');
        error.setAttributes({
            'class': 'xform_inputerror',
        });
        parent.append(error);

        return parent;
    }

    generate_row_captcha(parent, data, key) {
        const captcha_wrap = document.createElement('div');
        captcha_wrap.setAttributes({
            'class': 'xform_inputwrap xform_captcha_wrap',
        });

        const captcha_image = document.createElement('img');
        captcha_image.setAttributes({
            'class': 'xform_captcha_image',
            'src': BASEURL + 'captcha/image?' + new Date().getTime(),
            'alt': 'Captcha',
        });

        const refresh_button = document.createElement('button');
        refresh_button.setAttributes({
            'type': 'button',
            'class': 'xform_captcha_refresh',
        });
        refresh_button.textContent = _('forms.labels.refresh_captcha') ?? 'New Captcha';

        // Refresh captcha on button click
        refresh_button.addEventListener('click', function () {
            captcha_image.src = BASEURL + 'captcha/image?' + new Date().getTime();
        });

        const input = document.createElement('input');
        input.setAttributes({
            'class': 'xform_input xform_captcha_input',
            'name': key ?? 'captcha',
            'type': 'text',
            'placeholder': _(data.label, true) ?? data.label ?? 'Enter Captcha',
        });

        captcha_wrap.append(refresh_button, captcha_image, input);
        parent.append(captcha_wrap);

        const error = document.createElement('div');
        error.setAttributes({
            'class': 'xform_inputerror',
        });
        parent.append(error);

        return parent;
    }

    generate_row_xgeo_address(parent, data, key) {
        const Template_xgeo = new TemplateClass('xgeo');
        new XGeoClass(Template_xgeo);
        parent.append(Template_xgeo.dom);
        return parent;
    }


}
