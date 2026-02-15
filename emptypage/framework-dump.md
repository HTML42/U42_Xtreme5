# Latest framework dump
Erzeugt am 2025-12-25T01:08:57+00:00

## project/css/xtabs.less
- Kurzbeschreibung: xTabs-Komponente (horizontal/vertikal)

```text
.xtabs {
    display: flex;
    gap: @distance_small;
}
...
```

## project/js/xtabs.class.js
- Kurzbeschreibung: Initialisiert `[data-xtabs]`, erzeugt Refs, Accessibility und Hash-Sync (`tab--<ref>`).

```text
class XTabsClass {
    static SELECTOR = '[data-xtabs]';
    ...
}
```

## latest/css/xtreme/basics.less
- Kurzbeschreibung: html, body {

```text
html, body {
    padding: 0;
    margin: 0;
}
html, input, select, button {
    font-family: Helvetica, sans-serif;
    font-size: 14px;
}
a {
    color: @color_main_normal;
    cursor: pointer;
    &:hover {
        color: @color_main_dark;
    }
}
.clean_list {
    .clean_list();
}
[data-name="header"] > header {
    
}
[data-name="main"] > main {
    padding-top: @header_height;
    height: calc(~"100vh - @{footer_min_height}");
    > article {

    }
}
[data-name="footer"] > footer {
    min-height: @footer_min_height;
    background-color: @color_grey_light;
}
```

## latest/css/xtreme/header.less
- Kurzbeschreibung: header#page_header {

```text
header#page_header {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    height: @header_height;
    border-bottom: 1px solid @color_grey_normal;
    background-color: #EEE;
    .logo {
        .h_p(@header_height, @distance_normal);
        display: block;
        position: absolute;
        top: 0;
        left: 0;
        font-size: @header_height * 0.5;
        text-decoration: none;
    }
    nav.menu_main {
        position: absolute;
        top: 0;
        right: 0;
        ul {
            li {

            }
        }
    }
    .menu_trigger {
        position: absolute;
        top: 0;
        right: 0;
        height: @header_height;
        width: @header_height;
        cursor: pointer;
        &:hover {
            background-color: rgba(0, 0, 0, 0.2);
        }
    }
    @media @xbp_big {
        .menu_trigger {
            display: none;
        }
    }
    @media @xbp_non_big {
        nav.menu_main {
            top: @header_height;
            overflow: hidden;
            max-height: 0;
            &.active {
                max-height: 500px;
            }
        }
    }
}
```

## latest/css/xtreme/mixins.less
- Kurzbeschreibung: .h(@height) {

```text
.h(@height) {
    height: @height;
    line-height: @height;
}
.h_p(@height, @padding) {
    .h(@height);
    padding: 0 @padding;
}
.clean_list() {
    list-style: none;
    padding: 0;
    margin: 0;
}
.clear() {
    clear: both;
    display: table;
    height: 0;
    width: 0;
    overflow: hidden;
}
.clear_after() {
    &:after {
        .clear();
        content: '';
    }
}
```

## latest/css/xtreme/xbutton.less
- Kurzbeschreibung: .xbutton, .xbutton--grey {

```text
.xbutton, .xbutton--grey {
    ._xbutton();
}
.xbutton--main {
    ._xbutton();
    background-color: @color_main_dark;
    &:hover {
        background-color: @color_main_darker;
    }
}
.xbutton--secondary {
    ._xbutton();
    background-color: @color_secondary_dark;
    &:hover {
        background-color: @color_secondary_darker;
    }
}
._xbutton() {
    .h(@distance_normal * 2);
    display: inline-block;
    position: relative;
    padding: 0 @distance_big;
    border-radius: 2px;
    border: 0 none;
    text-align: center;
    min-width: 200px;
    transition: 0.2s linear background-color, 0.2s linear color;
    color: #EEE;
    font-weight: 700;
    &:hover {
        color: #FFF;
    }
}
```

## latest/css/xtreme/xform.less
- Kurzbeschreibung: .xform {

```text
.xform {
    @input_padding: @distance_normal;
    @input_size: @input_padding * 2;
    &_row {
        position: relative;
    }
    &_row + &_row {
        margin-top: @distance_normal * 1.5;
    }
    &_input, &_textarea {
        display: block;
        width: 100%;
        border: 0 none;
        border-radius: 2px;
        outline: none;
        padding: 0 @input_padding;
        .h(@input_size);
    }
    &_textarea {
        height: @input_size * 3.5;
        line-height: 1.1em;
        padding: @distance_tiny @input_padding;
        resize: vertical;
    }
    &_select {
        option {
        }
    }
    &_inputwrap {
    }
    &_captcha {
        &_wrap {
            display: flex;
            flex-direction: row;
            img, button {
                width: auto;
                height: @input_size;
            }
            button {
                width: 100px;
            }
            input {
                width: 100%;
            }
        }
        &_image {
        }
    }
    &_inputerror {
        color: rgba(255, 0, 0, 0.5);
        position: absolute;
        top: @input_size;
        line-height: @distance_normal;
    }
    &_buttonwrap {
        .clear_after();
    }
    &_button {
        &[type="submit"] {
            .xbutton--main;
            float: right;
        }
        &[type="reset"] {
            .xbutton;
            float: left;
        }
    }
}
```

## latest/css/xtreme/xgeo.less
- Kurzbeschreibung: .xgeo {

```text
.xgeo {
    display: flex;
    flex-direction: column;

    .xgeo_country {
        margin-bottom: 10px;
    }

    .xgeo_search {
        display: flex;
        gap: 10px;

        .xform_xgeo_address {
            flex: 1;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .xgeo_search_button {
            padding: 8px 12px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            
            &:hover {
                background-color: #0056b3;
            }
        }
    }

    .xgeo_results {
        .xgeo_results_list {
            margin: 0;
            padding: 0;
            list-style: none;
            max-height: 150px;
            overflow-y: auto;
            border: 1px solid #ccc;
            border-radius: 4px;
            background: #fff;

            li {
                padding: 8px;
                cursor: pointer;
                
                &:hover {
                    background-color: #f0f0f0;
                }
            }
        }

        .xgeo_results_msg {
            display: none;
            padding: 8px;
            color: #999;

            &.xgeo_results_msg--active {
                display: block;
            }
        }
    }

    .xgeo_result {
        margin-top: 10px;

        .xgeo_selected_address {
            display: block;
            padding: 8px;
            background-color: #f5f5f5;
            border-radius: 4px;
            color: #333;
        }
    }
}

```

## latest/css/xtreme/xpopup.less
- Kurzbeschreibung: .xpopup {

```text
.xpopup {
    @xpopup_header_height: @distance_huge;
    @xpopup_z_index: 9999;
    @xpopup_border_radius_size: @distance_small;
    display: none;
    position: fixed;
    .xpopup_size_position(80%);
    background-color: #EEE;
    border: 2px solid #CCC;
    border-radius: @xpopup_border_radius_size;
    z-index: @xpopup_z_index;
    &.xpopup_visible {
        display: block;
        /* Animation hinzufügen */
    }

    &_fadeout {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        z-index: @xpopup_z_index - 1;
        &.xpopup_visible {
            display: block;
        }
    }
    &_header {
        .h(@xpopup_header_height);
        border-bottom: 1px solid #CCC;
        margin-left: @distance_normal / 2;
        margin-right: @distance_normal / 2;
    }

    &_title {
        .h(@xpopup_header_height);
        font-size: @font_size_big;
        font-weight: 700;
        text-align: center;
        color: #666;
        border-radius: @xpopup_border_radius_size @xpopup_border_radius_size 0 0;
        padding-left: @distance_normal / 2;
        padding-right: @distance_normal;
    }

    &_close {
        position: absolute;
        top: 0;
        right: 0;
        border-radius: 0 @xpopup_border_radius_size 0 0;
        cursor: pointer;
        height: @xpopup_header_height;
        width: @xpopup_header_height;
        display: flex;
        align-items: center;
        justify-content: center;
        &:before,
        &:after {
            content: '';
            position: absolute;
            height: 70%;
            width: 2px;
            background-color: black; /* Farbe des „X“ */
        }
        &:before {
            transform: rotate(45deg);
        }
        &:after {
            transform: rotate(-45deg);
        }
        &:hover {
            background-color: rgba(0, 0, 0, 0.1);
        }
    }

    &_content {
        position: absolute;
        top: @xpopup_header_height;
        left: 0;
        right: 0;
        bottom: 0;
        padding: @distance_normal;
        color: #333;
        min-height: calc(~"100% - @{xpopup_header_height}");
    }

    &[data-size="s"] {
        .xpopup_size_position(50%);
    }

    &[data-size="m"] {
        .xpopup_size_position(80%);
    }

    &[data-size="l"] {
        .xpopup_size_position(90%);
    }
}
.xpopup_size_position(@size: 80%) {
    @margin: (100% - @size) / 2;
    top: @margin;
    right: @margin;
    bottom: @margin;
    left: @margin;
}

```

## latest/css/xtreme/xslideshow.less
- Kurzbeschreibung: [data-xslideshow] {

```text
[data-xslideshow] {
    position: relative;
    overflow: hidden;

    > .xslide {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        opacity: 0;
        visibility: hidden;
        transition: opacity 0.5s ease-in-out, visibility 0.5s ease-in-out;

        &.xslide--active {
            opacity: 1;
            visibility: visible;
            z-index: 2;
        }

        &.xslide--first {
            z-index: 1;
        }

        &.xslide--last {
            z-index: 0;
        }
    }
}

```

## latest/js/bootstrap.js
- Kurzbeschreibung: class XTemplate extends HTMLElement {

```javascript
class XTemplate extends HTMLElement {
  constructor() {
    super();
  }
}
class XPartial extends HTMLElement {
  constructor() {
    super();
  }
}
class XTranslation extends HTMLElement {
  constructor() {
    super();
  }
}
customElements.define("x-template", XTemplate);
customElements.define("x-partial", XPartial);
customElements.define("x-translation", XTranslation);

setTimeout(App.render, 1);

//

HTMLElement.prototype.setAttributes = function(attributes) {
  for (let key in attributes) {
      if (attributes.hasOwnProperty(key)) {
          this.setAttribute(key, attributes[key]);
      }
  }
};

```

## latest/js/classes/app.class.js
- Kurzbeschreibung: class AppClass {

```javascript
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
                    if(typeof Page === 'object' && Page !== null) {
                        if(typeof Page.Template === 'object' && Page.Template !== null) {
                            if(typeof Page.Template.dom === 'object' && Page.Template.dom) {
                                document.querySelector('body main#page_main > article').append(Page.Template.dom);
                            }
                        }
                    }
                    document.querySelector('head title').innerHTML = Page.title;
                }
            }
        }
        setTimeout(function() {
            document.querySelectorAll('[data-form]').forEach(element => {
                const form_config = FORMS[element.dataset.form] ?? null;
                const Form_login = new FormClass(element, form_config);
                Form_login.generate();
                element.append(Form_login.dom);
            });
        }, 10);
    }

    get_object(object_path, callback, parse_json = true, debug = false, data = [], method = 'GET') {
        if(debug) {
            console.log('X5::get_object() - Call: ' + object_path);
        }
        let fetch_meta = {method: method.toUpperCase()};
        if(length(data) > 0) {
            fetch_meta.body = JSON.stringify(data);
        }
        fetch(object_path, fetch_meta)
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

    post_object(object_path, data, callback, parse_json = true, debug = false) {
        this.get_object(object_path, callback, parse_json, debug, data, 'POST');
    }

}

var App = new AppClass();

```

## latest/js/classes/cache.class.js
- Kurzbeschreibung: class CacheClass {

```javascript
class CacheClass {
    constructor() {
        this.storage = localStorage;
    }

    set(key, data) {
        const json_key = JSON.stringify(key);
        const value = {
            timestamp: Date.now(),
            data: data
        };
        this.storage.setItem(json_key, JSON.stringify(value));
    }

    get(key, ttl) {
        const json_key = JSON.stringify(key);
        const value = this.storage.getItem(json_key);

        if (!value) {
            return null;
        }

        const parsed_value = JSON.parse(value);

        if (this.is_expired(parsed_value.timestamp, ttl)) {
            this.storage.removeItem(json_key);
            return null;
        }

        return parsed_value.data;
    }

    check(key, ttl) {
        const json_key = JSON.stringify(key);
        const value = this.storage.getItem(json_key);

        if (!value) {
            return false;
        }

        const parsed_value = JSON.parse(value);
        return !this.is_expired(parsed_value.timestamp, ttl);
    }

    is_expired(timestamp, ttl) {
        return (Date.now() - timestamp) > (ttl * 1000);
    }
}

var XCache = new CacheClass();

```

## latest/js/classes/controller.class.js
- Kurzbeschreibung: class ControllerClass {

```javascript
class ControllerClass {
    constructor() {
    }
}
  
```

## latest/js/classes/form.class.js
- Kurzbeschreibung: class FormClass {

```javascript
class FormClass {
  constructor(form, config) {
    const self = this;

    this.config = config ?? [];
    this.formconfig = {
      ajax: true,
      success: this.maybe_translate('forms.callbacks.success'),
      fail: this.maybe_translate('forms.callbacks.fail')
    };

    this.dom = document.createElement('div');
    this.dom.setAttribute('class', 'xform');
    this.form = null;
    this.formtag = null;

    if (is_dom(form)) {
      this.form = form;
      this.formtag = this.form.closest('form');

      if (typeof this.config['_'] === 'object') {
        for (let config_key in this.config['_']) {
          if (Object.prototype.hasOwnProperty.call(this.config['_'], config_key)) {
            this.formconfig[config_key] = this.config['_'][config_key];
          }
        }
      }

      const formajax_url =
        (typeof this.formconfig.ajax === 'string' && this.formconfig.ajax.length)
          ? this.formconfig.ajax.trim()
          : false;

      if (this.formconfig.ajax || formajax_url) {
        if (formajax_url) {
          this.formtag.setAttribute('data-ajax', formajax_url);
        } else if (this.formconfig.ajax) {
          this.formtag.setAttribute('data-ajax', 'TRUE');
        }

        this.formtag.addEventListener('submit', function (event) {
          event.preventDefault();

          // clear previous error state
          self.clear_errors();

          if (formajax_url) {
            fetch(formajax_url, {
              method: 'POST',
              body: new FormData(self.formtag)
            })
              .then(response => response.json())
              .then(data => {
                const has_errors_obj =
                  data &&
                  data.errors &&
                  typeof data.errors === 'object' &&
                  !Array.isArray(data.errors) &&
                  Object.keys(data.errors).length > 0;

                // if we have an errors-object AND success != true → show field errors
                if (has_errors_obj && data.success !== true) {
                  self.apply_errors(data.errors);
                }

                const is_success =
                  data &&
                  data.success === true &&
                  (!has_errors_obj);

                if (is_success) {
                  if (typeof window[self.formconfig.success] === 'function') {
                    window[self.formconfig.success](data);
                  } else {
                    alert(self.formconfig.success);
                  }
                } else if (!has_errors_obj) {
                  // no field errors, but not "success" either → generic fail
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

  // -------- translation helper --------
  maybe_translate(value) {
    if (typeof value !== 'string') {
      return value;
    }
    const key = value.trim();
    if (!key.length) {
      return value;
    }

    try {
      if (typeof _ === 'function') {
        const translated = _(key, true);
        if (translated !== null && translated !== false && typeof translated !== 'undefined') {
          return translated;
        }
      }
    } catch (e) {
      // ignore translation errors and fall back
    }

    return value;
  }

  generate() {
    let input_key, input_data;
    this.dom.innerHTML = '';
    for (input_key in this.config) {
      if (!Object.prototype.hasOwnProperty.call(this.config, input_key)) continue;
      input_data = this.config[input_key];
      if (input_key === '_') {
        // general form config
      } else {
        this.dom.append(this.generate_row(input_key, input_data));
      }
    }
  }

  generate_row(input_key, input_data) {
    const row = document.createElement('div');
    row.setAttribute('class', 'xform_row');

    let input_data_type = input_data.type ?? 'text';
    if (input_key === 'submitrow') {
      input_data_type = input_key;
    }

    switch (input_data_type) {
      case 'submitrow':
        this.generate_row_submitrow(row, input_data);
        break;

      case 'text':
      case 'password':
      case 'number':
        this.generate_row_input(row, input_data, input_key, input_data_type);
        break;

      case 'email':
      case 'mail':
        this.generate_row_input(row, input_data, input_key, 'mail');
        break;

      case 'select':
        this.generate_row_select(row, input_data, input_key);
        break;

      case 'date':
        this.generate_row_input(row, input_data, input_key, 'date');
        break;

      case 'time':
        this.generate_row_input(row, input_data, input_key, 'time');
        break;

      case 'textarea':
        this.generate_row_textarea(row, input_data, input_key);
        break;

      case 'captcha':
        this.generate_row_captcha(row, input_data, input_key);
        break;

      case 'xgeo_address':
        this.generate_row_xgeo_address(row, input_data, input_key);
        break;
    }

    return row;
  }

  // -------- row generators --------

  generate_row_input(parent, data, key, type) {
    const input_id = 'input-' + generate_id(4);
    const input = document.createElement('input');
    const inputwrap = document.createElement('div');

    input.setAttributes({
      'class': 'xform_input',
      'id': input_id,
      'name': key ?? input_id,
      'type': type ?? 'text'
    });

    inputwrap.setAttributes({
      'class': 'xform_inputwrap'
    });
    inputwrap.append(input);

    if (typeof data.label === 'string') {
      const ph = this.maybe_translate(data.label.trim());
      input.setAttribute('placeholder', ph);
    }

    parent.append(inputwrap);

    const error = document.createElement('div');
    error.setAttributes({
      'class': 'xform_inputerror'
    });
    parent.append(error);

    return parent;
  }

  generate_row_select(parent, data, key) {
    const input_id = 'input-' + generate_id(4);
    const select = document.createElement('select');
    const selectwrap = document.createElement('div');

    select.setAttributes({
      'class': 'xform_input xform_select',
      'id': input_id,
      'name': key ?? input_id
    });

    if (typeof data.label === 'string') {
      const option = document.createElement('option');
      option.setAttributes({
        'value': '',
        'selected': true
      });
      option.textContent = this.maybe_translate(data.label.trim());
      select.append(option);
    }

    if (data.options) {
      for (const [opt_key, opt_value] of Object.entries(data.options)) {
        const option = document.createElement('option');
        option.setAttributes({
          'value': opt_key
        });
        option.textContent = this.maybe_translate(opt_value);
        select.append(option);
      }
    }

    selectwrap.setAttributes({
      'class': 'xform_inputwrap'
    });
    selectwrap.append(select);
    parent.append(selectwrap);

    const error = document.createElement('div');
    error.setAttributes({
      'class': 'xform_inputerror'
    });
    parent.append(error);

    return parent;
  }

  generate_row_submitrow(parent, buttons) {
    const button_wrap = document.createElement('div');
    button_wrap.setAttributes({
      'class': 'xform_buttonwrap'
    });

    const self = this;
    Object.entries(buttons).forEach(([button_type, button_label]) => {
      const button = document.createElement('button');
      const button_id = 'button-' + generate_id(4);
      button.setAttributes({
        'class': 'xform_button',
        'id': button_id,
        'type': button_type
      });
      button.textContent = self.maybe_translate(button_label);
      button_wrap.append(button);
    });

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
      'rows': data.rows ?? 4
    });

    textareawrap.setAttributes({
      'class': 'xform_inputwrap'
    });

    if (typeof data.label === 'string') {
      const ph = this.maybe_translate(data.label.trim());
      textarea.setAttribute('placeholder', ph);
    }

    textareawrap.append(textarea);
    parent.append(textareawrap);

    const error = document.createElement('div');
    error.setAttributes({
      'class': 'xform_inputerror'
    });
    parent.append(error);

    return parent;
  }

  generate_row_captcha(parent, data, key) {
    const captcha_wrap = document.createElement('div');
    captcha_wrap.setAttributes({
      'class': 'xform_inputwrap xform_captcha_wrap'
    });

    const captcha_image = document.createElement('img');
    captcha_image.setAttributes({
      'class': 'xform_captcha_image',
      'src': BASEURL + 'captcha/image?' + new Date().getTime(),
      'alt': 'Captcha'
    });

    const refresh_button = document.createElement('button');
    refresh_button.setAttributes({
      'type': 'button',
      'class': 'xform_captcha_refresh'
    });
    refresh_button.textContent =
      this.maybe_translate('forms.labels.refresh_captcha') || 'New Captcha';

    refresh_button.addEventListener('click', function () {
      captcha_image.src = BASEURL + 'captcha/image?' + new Date().getTime();
    });

    const input = document.createElement('input');
    let placeholder_raw = null;
    if (typeof data.label === 'string') {
      placeholder_raw = data.label;
    } else {
      placeholder_raw = 'forms.labels.captcha';
    }

    input.setAttributes({
      'class': 'xform_input xform_captcha_input',
      'name': key ?? 'captcha',
      'type': 'text',
      'placeholder':
        this.maybe_translate(placeholder_raw) || 'Enter Captcha'
    });

    captcha_wrap.append(refresh_button, captcha_image, input);
    parent.append(captcha_wrap);

    const error = document.createElement('div');
    error.setAttributes({
      'class': 'xform_inputerror'
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

  // -------- error helpers --------

  clear_errors() {
    if (!this.formtag) return;
    this.formtag.querySelectorAll('.xform_row').forEach(function (row) {
      row.classList.remove('has-error');
      const err = row.querySelector('.xform_inputerror');
      if (err) err.textContent = '';
    });
  }

  apply_errors(errors) {
    if (!this.formtag || !errors) return;

    const self = this;

    Object.keys(errors).forEach(function (key) {
      const msg_key = errors[key];
      const input = self.formtag.querySelector('[name="' + key + '"]');
      if (!input) return;

      const row =
        input.closest('.xform_row') ||
        input.closest('.xform_inputwrap') ||
        input.parentElement;

      if (!row) return;

      const err =
        row.querySelector('.xform_inputerror') ||
        row.querySelector('.xform_error');

      if (!err) return;

      err.textContent = self.maybe_translate(msg_key);
      row.classList.add('has-error');
    });
  }
}

```

## latest/js/classes/page.class.js
- Kurzbeschreibung: class PageClass {

```javascript
class PageClass {
    constructor() {
        this.title = 'Website';
    }
}
  
```

## latest/js/classes/router.class.js
- Kurzbeschreibung: class RouterClass {

```javascript
class RouterClass {
    route() {
        let location_hash = location.hash;
        if(location_hash.length <= 2) {
            return null;
        }
        location_hash = location_hash.trim();
        let route_match = location_hash.match(/\#\!([^\/]+)\/*([^\/]*)\/*([^\/]*)\/*([^\/]*)\/*([^\/]*)/i);
        let route_path = ['index', 'index', null, null, null];
        for(let i = 1 ; i <= 5 ; i++) {
            if((route_match[i] && route_match[i].length) || typeof route_match[i] == 'number' || route_match[i] === '0' || route_match[i] === 'false' || route_match[i] === 'null') {
                route_path[i - 1] = route_match[i];
                if(route_path[i - 1] == parseInt(route_path[i - 1])) {
                    route_path[i - 1] = parseInt(route_path[i - 1]);
                }
            }
        }
        return route_path;
    }

    redirect(path) {
        if(typeof path == 'string' && path.length) {
            path = path.split('/');
        }
        if(typeof path == 'object' && path.length) {
            let _hash = '#!';
            for(let i = 0 ; i < path.length ; i++) {
                _hash += path[i] + '/';
            }
            location.hash = _hash.substring(0, _hash.length - 1);
        }
        setTimeout(App.render, 1);
    }
}
function get_route() {
    return (new RouterClass).route();
}
```

## latest/js/classes/template.class.js
- Kurzbeschreibung: class TemplateClass {

```javascript
class TemplateClass {
    constructor(template_key) {
        this.content = null;
        this.dom = null;
        this.tag_stack = [];
        //
        if (typeof TEMPLATES[template_key] != "undefined") {
            this.content = TEMPLATES[template_key];
            this.dom = this.parse(this.content);
            this.dom.setAttribute('data-name', template_key);
        } else {
            this.content = false;
        }
    }

    parse(code) {
        if (typeof code === "string") {
            code = code.trim();
        }
        code = this.parse_prepare(code);
        code = this.parse_lines(code);
        return code;
    }
    parse_prepare(code) {
        // Verarbeite Punkte (Klassen) außerhalb von Attributen
        code = code.replace(/(?<!\[[^\]]*)(\.)([\w\d_-]+)/g, '[class="$2"]');
    
        // Verarbeite IDs
        code = code.replace(/(\#)([\w\d_-]+)/g, '[id="$2"]');
    
        // Verarbeite Attribute mit Punkten korrekt
        code = code.replace(/(\[.*?=.*?")([\w\d:/?&._-]+)(".*?\])/g, (match, start, value, end) => {
            // Punkte innerhalb von Attributwerten unangetastet lassen
            return `${start}${value}${end}`;
        });
    
        // Verarbeite mehrere Klassen für das gleiche Element korrekt
        code = code.replace(/\[class="([^"]+)"\]\[class="([^"]+)"\]/g, '[class="$1 $2"]');
    
        let lines = code.split("\n");
        let previousIndents = [0];
    
        for (let i = 0; i < lines.length; i++) {
            let currentIndent = lines[i].search(/\S|$/);
            lines[i] = lines[i].trim();
    
            if (currentIndent > previousIndents[previousIndents.length - 1]) {
                previousIndents.push(currentIndent);
            } else {
                while (
                    previousIndents.length > 1 &&
                    currentIndent < previousIndents[previousIndents.length - 1]
                ) {
                    previousIndents.pop();
                }
            }
            lines[i] = ">".repeat(previousIndents.length - 1) + lines[i];
        }
        return lines.join("\n");
    }
    
    
    parse_lines(code) {
        let lines = code.split("\n");
        let last_indent = -1;
        let dom = document.createElement("x-template");
        let parents = [];
        const tag_regex = /^(\w+[\w\d_:-]*)/;
        const partial_regex = /^(partial):(.+)/;
        lines.forEach((line) => {
            let current_indent = (line.match(/^>+/) || [""])[0].length;
            let new_element = null;
            line = line.replace(/^>+/, "");
            if (line.trim() === "") {
                return;
            }
            const is_partial = line.trim().startsWith("partial:");
            const is_translation =
                    line.trim().startsWith("translate:") ||
                    line.trim().startsWith("translation:");
            const is_tag = !is_partial && !is_translation;
            //
            if (is_tag) {
                const tag_match = line.match(tag_regex);
                if (tag_match) {
                    const tag = tag_match[1];
                    if (tag) {
                        let element = document.createElement(tag);
                        this.attach_element_atttributes(element, line);
                        new_element = element;
                    }
                }
            } else {
                let has_class = false;
                if(is_partial || is_translation) {
                    has_class = /\[class="/.test(line);
                    line = line.replace(/\[class="([^"]+)"\]/g, ".$1");
                    line = line.replace(/translat[e|ion]\:/, '');
                    line = line.trim();
                    if(has_class) {
                        line = line.replace(/\s+/, '.');
                    }
                }
                if (is_partial) {
                    const partial_key = line.replace(/^(partial):/, "").trim();
                    let Partial = new TemplateClass(partial_key);
                    new_element = Partial.dom;
                } else if (is_translation) {
                    const translation_key = line.replace(/^(partial):/, "").trim();
                    const Translation = new TranslationClass(translation_key);
                    new_element = document.createElement('x-translation');
                    new_element.translation_key = translation_key;
                    new_element.innerHTML = Translation.result;
                }
            }
            //
            if(typeof parents[current_indent] != 'object') {
                parents[current_indent] = [];
            }
            parents[current_indent].push(new_element);
            //
            if (current_indent <= 0) {
                dom.append(new_element);
            } else {
                __last_of_array(parents, current_indent - 1).append(new_element);
            }
            last_indent = current_indent;
        });
        
        function __last_of_array(_array, _index) {
            if(typeof _array[_index] == 'object') {
                if(_array[_index].length && _array[_index].length > 0) {
                    return _array[_index][_array[_index].length - 1];
                }
            }
            return {append:function(a){console.log('Append on NULL Element: ', a);}};
        }

        return dom;
    }

    attach_element_atttributes(element, attributes_string) {
        let regex = /\[([^\]]+)\]/g;
        let match;
        while ((match = regex.exec(attributes_string)) !== null) {
            let attr = match[1].split("=");
            let key = attr[0];
            let value = attr[1] ? attr[1].replace(/["']/g, "") : "";
            element.setAttribute(key, value || true);
        }
    }
}

```

## latest/js/classes/translation.class.js
- Kurzbeschreibung: class TranslationClass {

```javascript
class TranslationClass {
    constructor(translation_key, as_bool = false) {
        this.key_raw = translation_key;
        this.translation = null;
        this.keys = [];
        if (typeof this.key_raw == 'string') {
            this.key_raw = this.key_raw.trim();
            let result = this.fetch_translation();
            if(as_bool) {
                this.result = result ? result : null;
            } else {
                this.result = result ? result : '[Missing Translation::' + this.key_raw + ']';
            }
        } else {
            this.result = '[TranslationError::KeyIsNotString]';
        }
        if (this.result === null || this.result === false ||
                /\[Missing\s*Translation\:\:/.test(this.result) || /\[TranslationError\:\:/.test(this.result)) {
            if (!window.MISSING_TRANSLATIONS.includes(this.key_raw)) {
                window.MISSING_TRANSLATIONS.push(this.key_raw);
            }
        }
    }

    fetch_translation() {
        this.keys = this.key_raw.split('.');
        let current = TRANSLATIONS;
        for (let i in this.keys) {
            if (typeof current[this.keys[i]] != 'undefined' && this.keys[i] !== null) {
                current = current[this.keys[i]];
            } else {
                return false;
            }
        }
        return current;
    }

}

function set_language(lang) {
    window.LANG = lang.trim().toLowerCase();
}
function _(translation_key, as_bool = false) {
    if(typeof translation_key === 'string') {
        return (new TranslationClass(translation_key, as_bool)).result;
    }
    return null;
}

window.LANG = LANG || 'en';
window.MISSING_TRANSLATIONS = [];

```

## latest/js/classes/xgeo.class.js
- Kurzbeschreibung: class XGeoClass {

```javascript
class XGeoClass {
    static INACTIVITY_INTERVAL = 3000;
    static DEFAULT_COUNTRY = ['country.germany'];
    static CACHE_EXPIRATION = 7 * 24 * 60 * 60 * 1000;

    constructor(Template_xgeo, country = XGeoClass.DEFAULT_COUNTRY) {
        this.dom = Template_xgeo.dom;
        
        if (!this.dom) {
            console.error("Template DOM not found:", Template_xgeo);
            return;
        }

        this.input = this.dom.querySelector('.xform_xgeo_address');
        this.results_container = this.dom.querySelector('.xgeo_results_list');
        this.message_container = this.dom.querySelector('.xgeo_results_msg');
        this.result_display_container = this.dom.querySelector('.xgeo_result');
        this.selected_address_display = this.dom.querySelector('.xgeo_selected_address');

        if (!this.input || !this.results_container || !this.message_container || !this.result_display_container) {
            console.error("One or more essential elements are missing in the template DOM:", this.dom);
            return;
        }

        this.country = Array.isArray(country) ? country : [country];
        this.country_container = this.dom.querySelector('.xgeo_country');
        this.country_field = null;
        this.setup_country_field();

        this.inactivity_timeout = null;

        this.input.addEventListener('change', () => this.fetch_suggestions());
        this.input.addEventListener('focus', () => this.start_inactivity_timer());
        this.input.addEventListener('input', () => this.reset_inactivity_timer());
        this.results_container.addEventListener('click', (e) => this.select_suggestion(e));
    }

    setup_country_field() {
        if (this.country.length === 1) {
            const country_key = this.country[0];

            const country_text = document.createElement('div');
            country_text.className = 'xgeo_country_display';
            country_text.innerText = _(country_key);

            const hidden_input = document.createElement('input');
            hidden_input.setAttributes({
                'type': 'hidden',
                'name': 'country',
                'value': country_key
            });

            const container = document.createElement('div');
            container.append(country_text, hidden_input);
            this.country_container.append(container);
            this.country_field = hidden_input;
            this.country_field.value = country_key;

        } else {
            const select = document.createElement('select');
            select.setAttributes({
                'name': 'country',
                'class': 'xgeo_country_select'
            });

            this.country.forEach(country_key => {
                const option = document.createElement('option');
                option.value = country_key;
                option.textContent = _(country_key);
                select.append(option);
            });

            this.country_container.append(select);
            this.country_field = select;
        }
    }

    start_inactivity_timer() {
        this.reset_inactivity_timer();
        this.inactivity_timeout = setTimeout(() => this.fetch_suggestions(), XGeoClass.INACTIVITY_INTERVAL);
    }

    reset_inactivity_timer() {
        clearTimeout(this.inactivity_timeout);
        this.inactivity_timeout = setTimeout(() => this.fetch_suggestions(), XGeoClass.INACTIVITY_INTERVAL);
    }

    fetch_suggestions() {
        const query = this.input.value.trim();
        if (query.length < 3) return;

        const selected_country = this.country_field && this.country_field.value ? _(this.country_field.value) : '';
        const cache_key = this.clean_cache_key(query + selected_country);

        const cached_data = this.get_from_cache(cache_key);
        if (cached_data) {
            this.show_suggestions(cached_data.result);
            return;
        }

        fetch(`${BASEURL}geolocation/address_complete?input=${encodeURIComponent(query)}, ${encodeURIComponent(selected_country)}`)
            .then(response => response.json())
            .then(data => {
                this.store_in_cache(cache_key, data.response);
                this.show_suggestions(data.response);
            })
            .catch(error => console.error("Error fetching address suggestions:", error));
    }

    show_suggestions(suggestions) {
        this.results_container.innerHTML = '';
        if (suggestions.length === 0) {
            this.message_container.classList.add('xgeo_results_msg--active');
        } else {
            this.message_container.classList.remove('xgeo_results_msg--active');
            suggestions.forEach(suggestion => {
                const item = document.createElement('li');
                const suggestion_array = suggestion.display_name.split(',').map(item => item.trim());
                item.textContent = suggestion.display_name;
                item.dataset.country = suggestion_array[suggestion_array.length - 1];
                item.dataset.zip = suggestion_array[suggestion_array.length - 2];
                item.dataset.city = suggestion_array[3];
                item.dataset.street = suggestion_array[1];
                item.dataset.housenumber = suggestion_array[0];
                item.dataset.lat = suggestion.lat;
                item.dataset.lng = suggestion.lng;
                this.results_container.appendChild(item);
            });
        }
        this.results_container.style.display = suggestions.length ? 'block' : 'none';
    }

    select_suggestion(event) {
        const item = event.target;
        if (item.tagName.toLowerCase() === 'li') {
            this.input.value = ''; 
            this.selected_address_display.textContent = item.textContent; 
            this.selected_address_display.dataset.lat = item.dataset.lat;
            this.selected_address_display.dataset.lng = item.dataset.lng;
            this.results_container.style.display = 'none';

            const lat_field = this.result_display_container.querySelector('input[name="latitude"]');
            const lng_field = this.result_display_container.querySelector('input[name="longitude"]');
            if (lat_field && lng_field) {
                lat_field.value = item.dataset.lat;
                lng_field.value = item.dataset.lng;
            }
            ['country', 'zip', 'city', 'street', 'housenumber'].forEach(field => {
                const input = this.result_display_container.querySelector(`input[name="${field}"][type="hidden"]`);
                if (input) {
                    input.value = item.dataset[field] || '';
                }
            });
    
            console.log('item.dataset', item.dataset);
        }
    }

    clean_cache_key(key) {
        return key
            .toLowerCase()
            .replace(/[ ,._?!#-]/g, '')
            .trim();
    }

    get_from_cache(cache_key) {
        const cleaned_key = this.clean_cache_key(cache_key);
        const cached_entry = localStorage.getItem('xgeo_' + cleaned_key);
        if (cached_entry) {
            const { timestamp, result } = JSON.parse(cached_entry);
            if ((Date.now() - timestamp) < XGeoClass.CACHE_EXPIRATION) {
                return { result };
            } else {
                localStorage.removeItem('xgeo_' + cleaned_key); 
            }
        }
        return null;
    }

    store_in_cache(cache_key, result) {
        const cleaned_key = this.clean_cache_key(cache_key);
        const cache_entry = JSON.stringify({ timestamp: Date.now(), result });
        localStorage.setItem('xgeo_' + cleaned_key, cache_entry);
    }
}

setTimeout(function() {
    Object.keys(localStorage).forEach(key => {
        if (key.startsWith('xgeo_')) {
            const cache_data = JSON.parse(localStorage.getItem(key));
            if (cache_data && (Date.now() - cache_data.timestamp) > XGeoClass.CACHE_EXPIRATION) {
                localStorage.removeItem(key);
            }
        }
    });
}, 500);

```

## latest/js/classes/xpopup.class.js
- Kurzbeschreibung: class XPopup {

```javascript
class XPopup {
    constructor(options = {}) {
        this.title = options.title || _('popup.title');
        this.content = options.content || '';
        this.size = this.validate_size(options.size);
        this.popup_element = null;
        this.fadeout_element = null;
        this.init();
    }

    validate_size(size) {
        const supported_sizes = ['s', 'm', 'l'];
        return supported_sizes.includes(size) ? size : 'm';
    }

    init() {
        this.load_popup_template();
        this.append_fadeout_element();
        this.apply_size();
    }

    load_popup_template() {
        let self = this;
        this.popup_element = (new TemplateClass('xpopup')).dom.querySelector(".xpopup");
        document.body.append(this.popup_element);
        this.popup_element.querySelector('.xpopup_close').addEventListener('click', function() {
            self.destroy();
        });
        this.set_content(this.content);
        this.set_title(this.title);
    }

    append_fadeout_element() {
        if (!document.querySelector('.xpopup_fadeout')) {
            const fadeout_html = `<div class="xpopup_fadeout"></div>`;
            document.body.insertAdjacentHTML('beforeend', fadeout_html);
        }
        this.fadeout_element = document.querySelector('.xpopup_fadeout');
    }

    apply_size() {
        if (this.popup_element) {
            this.popup_element.setAttribute('data-size', this.size);
        }
    }

    open() {
        if (this.fadeout_element) {
            this.fadeout_element.classList.add('xpopup_visible');
        }
        if (this.popup_element) {
            this.popup_element.classList.add('xpopup_visible');
        }
    }

    close() {
        if (this.popup_element) {
            this.popup_element.classList.remove('xpopup_visible');
        }
        if (this.fadeout_element) {
            this.fadeout_element.classList.remove('xpopup_visible');
        }
    }

    set_content(content) {
        if (is_dom(content)) {
            this.popup_element.querySelector('.xpopup_content').append(content);
        } else if (typeof content === 'string') {
            this.popup_element.querySelector('.xpopup_content').innerHTML = content;
        }
    }

    set_title(new_title) {
        let title = this.popup_element.querySelector('.xpopup_title');
        if (title) {
            title.innerHTML = new_title;
        }
    }

    destroy() {
        this.close();
        if (this.popup_element) {
            this.popup_element.remove();
        }
    }
}

```

## latest/js/classes/xscroll.class.js
- Kurzbeschreibung: class XScrollClass {

```javascript
class XScrollClass {
    constructor() {
        this.init_scroll_handler();
    }

    // Init Scroll Handler
    init_scroll_handler() {
        window.addEventListener('scroll', () => this.scroll_handler());
        this.scroll_handler(); // Initial call to handle the scroll status on page load
    }

    // Main Scroll Handler to manage data-onscroll attribute
    scroll_handler() {
        const top = window.scrollY || document.documentElement.scrollTop;

        if (top >= 1) {
            document.body.setAttribute('data-onscroll', `${top}px`);
        } else {
            document.body.removeAttribute('data-onscroll');
        }
    }

    // Method to observe when an element is at least 50% visible and its bottom is still in view
    observe_element_visibility(element, callback) {
        const observer = new IntersectionObserver((entries) => {
            entries.forEach((entry) => {
                const rect = entry.target.getBoundingClientRect();
                const viewportHeight = window.innerHeight;
    
                // Check if the element's top is in the viewport and its bottom is still visible
                const isVisible = rect.top <= viewportHeight && rect.bottom >= 0;
    
                // Trigger the callback if the element is in view
                if (isVisible) {
                    callback(entry.target, entry);
                }
            });
        }, { threshold: [0] });

        // Observe the passed element
        if (is_dom(element)) {
            observer.observe(element);
        }
    }
}

window.XScroll = new XScrollClass();

```

## latest/js/classes/xslideshow.class.js
- Kurzbeschreibung: class XSlideshowClass {

```javascript
class XSlideshowClass {
    constructor(slideshow_element) {
        this.dom = is_dom(slideshow_element) ? slideshow_element : document.querySelector(slideshow_element);

        if (!this.dom) {
            console.error("Slideshow DOM not found:", slideshow_element);
            return;
        }

        this.slides = Array.from(this.dom.querySelectorAll('.xslide'));
        this.interval = parseInt(this.dom.getAttribute('data-xs-interval')) || 5000;
        this.height = this.dom.getAttribute('data-xs-height') || 'auto';
        this.active_index = 0;
        this.interval_id = null;

        this.init();
    }

    init() {
        this.set_height();
        this.update_classes();
        this.start_auto_slideshow();

        // Event listeners for hover pause
        this.dom.addEventListener('mouseenter', () => this.stop_auto_slideshow());
        this.dom.addEventListener('mouseleave', () => this.start_auto_slideshow());
    }

    set_height() {
        if (this.height !== 'auto') {
            this.dom.style.height = this.height;
        }
    }

    update_classes() {
        this.slides.forEach((slide, index) => {
            slide.classList.remove('xslide--active', 'xslide--first', 'xslide--last');

            if (index === this.active_index) {
                slide.classList.add('xslide--active');
            }
            if (index === 0) {
                slide.classList.add('xslide--first');
            }
            if (index === this.slides.length - 1) {
                slide.classList.add('xslide--last');
            }
        });
    }

    next_slide() {
        this.active_index = (this.active_index + 1) % this.slides.length;
        this.update_classes();
    }

    start_auto_slideshow() {
        if (this.interval_id) return;
        this.interval_id = setInterval(() => this.next_slide(), this.interval);
    }

    stop_auto_slideshow() {
        if (this.interval_id) {
            clearInterval(this.interval_id);
            this.interval_id = null;
        }
    }

    destroy() {
        this.stop_auto_slideshow();
        this.slides.forEach(slide => slide.classList.remove('xslide--active', 'xslide--first', 'xslide--last'));
    }
}
```

## latest/js/classes/xuser.class.js
- Kurzbeschreibung: class UserClass {

```javascript
class UserClass {
    constructor() {
        this.id = 0;
        this.name = 'Unknown';
        this.email = '';
        this.is_login = null;
        this.is_active = null;
        this.is_admin = null;
        this.is_root = null;
    }
    setData(data) {
        let key, value;
        for(key in data) {
            value = data[key];
            this[key] = value;
        }
    }
};
```

## latest/js/functions.js
- Kurzbeschreibung: function uc_first(string) {

```javascript
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
```

## latest/php/autoload.php
- Kurzbeschreibung: spl_autoload_register(function ($classname) {

```php
<?php
spl_autoload_register(function ($classname) {
    $class_filename = strtolower($classname) . '.class.php';
    $class_filepath = DIR_PROJECT_PHP_CLASSES . $class_filename;
    if(!is_file($class_filepath)) {
        $class_filepath = DIR_X5_PHP_CLASSES . $class_filename;
    }
    if(is_file($class_filepath)) {
        require_once $class_filepath;
    }
});
```

## latest/php/classes/app.class.php
- Kurzbeschreibung: class App

```php
<?php

class App
{
    public static $mime = 'text/html';
    public static $encoding = 'UTF-8';

    public static $object = null;
    public static $action = null;
    
    public static $config = [];
    public static $images = [];
    
    public static function config($key, $default = null) {
        return isset(self::$config[$key]) && !is_null(self::$config[$key]) ? self::$config[$key] : $default;
    }
}


```

## latest/php/classes/cache.class.php
- Kurzbeschreibung: class Cache

```php
<?php

class Cache
{
    static $dir = 'cache/';
    static $_CACHE = [];

    public static function init()
    {
        self::$dir = DIR_CACHE . 'cache/';
        if (!is_dir(DIR_CACHE)) {
            @mkdir(DIR_CACHE);
        }
        if (!is_dir(self::$dir)) {
            @mkdir(self::$dir);
        }
    }
    public static function get($key, $ttl = 3600)
    {
        if (isset(self::$_CACHE[$key])) {
            return self::$_CACHE[$key];
        }
        $File_cache = File::instance(self::$dir . sha1($key) . '.cache');
        if ($File_cache->exists && (filemtime($File_cache->path) + $ttl) > time()) {
            self::$_CACHE[$key] = $File_cache->get_json();
            return self::$_CACHE[$key];
        }
        return null;
    }
    public static function set($key, $value)
    {
        file_put_contents(self::$dir . sha1($key) . '.cache', json_encode($value));
        self::$_CACHE[$key] = $value;
        return self::$_CACHE[$key];
    }

}
Cache::init();

```

## latest/php/classes/css.class.php
- Kurzbeschreibung: class Css

```php
<?php

class Css
{

    public $files = [];
    public $latest_time = -1;
    public $cache_key = 'nocache.css';
    public $code = '';
    public static $lib_dir = 'phplibs/';

    public function __construct($files = [], $variables = [])
    {
        self::_libs();
        if (is_array($files)) {
            $this->files = $files;
        }
        $this->latest_time = File::_latest_time($this->files);
        $this->cache_key = json_encode(array($this->files, $this->latest_time));
        $this->code = Cache::get($this->cache_key, DAY * 31);
        if (!is_string($this->code) || empty($this->code)) {
            $this->code = Cache::set($this->cache_key, self::concat($this->files, $variables));
        }
    }

    public static function _libs()
    {
        $lib_files = [
            'less.class.php' => 'https://raw.githubusercontent.com/leafo/lessphp/master/lessc.inc.php',
        ];
        foreach ($lib_files as $filepath => $src) {
            $lib_filedir = str_replace('//', '/', DIR_CACHE . self::$lib_dir);
            $lib_filepath = $lib_filedir . $filepath;
            if (!is_file($lib_filepath)) {
                if (!is_dir($lib_filedir)) {
                    @mkdir($lib_filedir);
                }
                if (substr($src, 0, 18) == 'https://github.com') {
                    $file_content = self::__concat_from_github($src);
                } else {
                    $file_content = Curl::get_cached($src, 1);
                }
                foreach (['$subProp[1]{0}' => '$subProp[1][0]', '$name{0}' => '$name[0]', '$tag{0}' => '$tag[0]',] as $replace_before => $replace_after) {
                    while (strstr($file_content, $replace_before)) {
                        $file_content = str_replace($replace_before, $replace_after, $file_content);
                    }
                }
                file_put_contents($lib_filepath, $file_content);
                sleep(0.1);
            }
            include $lib_filepath;
        }
    }
    public static function concat($files_input = [], $variables = [])
    {
        $files = ['css' => [], 'less' => [], 'scss' => []];
        foreach ($files_input as $filepath) {
            $ext = strtolower(File::_ext($filepath));
            $css_code = '';
            if (substr($filepath, 0, 6) == 'https:' || substr($filepath, 0, 6) == 'https:') {
                $css_code = Curl::get_cached($filepath, DAY) . "\n";
                $css_code = preg_replace('/--[^\:]+\:\s*;/isU', '', $css_code);
            } else {
                $File = File::instance($filepath);
                $css_code = $File->get_content() . "\n";
            }
            $css_code = trim($css_code);
            if (!empty($css_code)) {
                if (!isset($files[$ext]) || $ext == 'css') {
                    array_push($files['css'], $css_code);
                } else {
                    array_push($files[$ext], $css_code);
                }
            }
        }
        //
        $variables_string = '';
        if (is_array($variables) && !empty($variables)) {
            foreach ($variables as $variable_name => $variable_value) {
                $variables_string .= "\n" . '#$#' . $variable_name . '#=#' . $variable_value . ';';
            }
            $variables_string = trim($variables_string);
        }
        //
        $css_code = ':root {' . str_replace('#$#', '--', str_replace('#=#', ':', $variables_string)) . '}';
        if (!empty($files['css'])) {
            foreach ($files['css'] as $code) {
                $css_code .= "\n" . $code;
            }
        }
        if (!empty($files['less'])) {
            $less_code = str_replace('#$#', '@', str_replace('#=#', ':', $variables_string));
            foreach ($files['less'] as $code) {
                $less_code .= "\n" . $code;
            }
            $less = new lessc;
            $css_code .= "\n" . $less->compile($less_code);
        }
        if (!empty($files['scss'])) {
            $scss_code = str_replace('#$#', '$', str_replace('#=#', ':', $variables_string));
            ;
            foreach ($files['scss'] as $code) {
                $scss_code .= "\n" . $code;
            }
            $scss = new ScssPhp\ScssPhp\Compiler();
            $css_code .= "\n" . $scss->compile($scss_code);
        }
        //
        foreach (['/*!
 * Bootstrap  v5.3.2 (https://getbootstrap.com/)
 * Copyright 2011-2023 The Bootstrap Authors
 * Licensed under MIT (https://github.com/twbs/bootstrap/blob/main/LICENSE)
 */', '@charset "UTF-8";'] as $search_string) {
                   $css_code = str_replace($search_string, '', $css_code);
               }
               $css_code = trim($css_code);
               $minifier = new MatthiasMullie\Minify\CSS();
               $minifier->add($css_code);
               $css_code = $minifier->minify();
        //
        return $css_code;
    }

}

```

## latest/php/classes/curl.class.php
- Kurzbeschreibung: class Curl

```php
<?php

class Curl
{
    public static function get($url)
    {
        if (is_string($url) && strlen($url) > 5) {
            $url = trim($url);
            ob_start();
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_HEADER, false);
            $ch_exec = curl_exec($ch);
            //
            if (!$ch_exec && !App::config('offline_able'))
                self::error($ch, $url);
            //
            curl_close($ch);
            usleep(1);
            return ob_get_clean();
        }
        return '';
    }

    public static function get_cached($url, $ttl = 3600)
    {
        if (Cache::get($url, $ttl)) {
            return Cache::get($url, $ttl);
        } else {
            return Cache::set($url, self::get($url));
        }
    }

    public static function get_json($url)
    {
        $response = self::get($url);
        return @json_decode($response, true);
    }

    public static function get_json_cached($url)
    {
        $response = self::get_cached($url);
        return @json_decode($response, true);
    }

    public static function special($url, $options)
    {
        if (is_string($url) && strlen($url) > 5) {
            $url = trim($url);
            ob_start();
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt_array($ch, $options);
            $ch_exec = curl_exec($ch);
            //
            if (!$ch_exec && !App::config('offline_able'))
                self::error($ch, $url);
            //
            curl_close($ch);
            return ob_get_clean();
        }
        return '';
    }

    public static function special_json($url, $options)
    {
        $response = self::special($url, $options);
        return @json_decode($response, true);
    }

    public static function error($ch, $url = null)
    {
        $ch_header = curl_getinfo($ch);
        debug('Curl-Error | URL: ' . $url);
        debug($ch_header);
        debug(curl_error($ch));
        die;
    }
}

```

## latest/php/classes/db.class.php
- Kurzbeschreibung: class DB

```php
<?php

class DB
{
    public static $dir = '_db/';
    public static $dir_tables = '_db/tables/';
    public static $dir_cache = '_db/cache/';
    public static $dir_meta = '_db/meta/';
    public static $table_meta_defaults = [
        'id' => 1,
        'amount' => 0,
    ];

    public static $_CACHE = [
        'tables' => null,
        'table' => [],
    ];

    public static function init()
    {
        self::$dir = DIR_PROJECT . '_db/';
        self::$dir_tables = self::$dir . 'tables/';
        self::$dir_cache = self::$dir . 'cache/';
        self::$dir_meta = self::$dir . 'meta/';
        foreach ([self::$dir, self::$dir_tables, self::$dir_cache, self::$dir_meta] as $d) {
            if (!is_dir($d)) {
                @mkdir($d);
            }
        }
        App::$config['db'] = isset(App::$config['db']) && is_array(App::$config['db']) ? App::$config['db'] : [];
        foreach (App::$config['db'] as $table => $columns) {
            $table = trim(strtolower($table));
            $table_file = self::$dir_tables . $table . '.json';
            $meta_file = self::$dir_meta . $table . '.json';
            if (!file_exists($meta_file)) {
                file_put_contents($meta_file, json_encode(self::$table_meta_defaults));
            }
            if (!file_exists($table_file)) {
                file_put_contents($table_file, json_encode([]));
                self::$_CACHE['tables'] = null;
                usleep(666);
                if (isset($columns['_']['default']) && is_array($columns['_']['default'])) {
                    foreach ($columns['_']['default'] as $default_entry) {
                        self::insert($table, $default_entry);
                    }
                }
            }
        }
    }
    public static function get_tables()
    {
        if (is_null(self::$_CACHE['tables'])) {
            self::$_CACHE['tables'] = File::ls(self::$dir_tables, false, true);
            foreach (self::$_CACHE['tables'] as $i => $tablename) {
                self::$_CACHE['tables'][$i] = strtolower(str_replace('.json', '', $tablename));
            }
        }
        return self::$_CACHE['tables'];
    }
    public static function get_table($tablename)
    {
        $tablename = self::_is_valid_tablename($tablename);
        if (!$tablename) {
            return null;
        }
        //
        if (isset(self::$_CACHE['table'][$tablename]) && is_array(self::$_CACHE['table'][$tablename]) && !empty(self::$_CACHE['table'][$tablename])) {
            return self::$_CACHE['table'][$tablename];
        }
        //
        $File_table = File::instance(self::$dir_tables . $tablename . '.json');
        if (!$File_table->exists) {
            return false;
        }
        //
        $tabledata = [
            'meta' => self::get_table_meta($tablename),
            'data' => $File_table->get_json(),
        ];
        self::$_CACHE['table'][$tablename] = $tabledata;
        return $tabledata;
    }
    public static function get_table_meta($tablename)
    {
        $tablename = self::_is_valid_tablename($tablename);
        if (!$tablename) {
            return null;
        }
        //
        $File_table_meta = File::instance(self::$dir_meta . $tablename . '.json');
        if (!$File_table_meta->exists) {
            return self::$table_meta_defaults;
        }
        //
        return $File_table_meta->get_json();
    }
    public static function _is_valid_tablename($tablename)
    {
        if (!is_string($tablename)) {
            return null;
        }
        $tablename = trim(strtolower($tablename));
        if (empty($tablename)) {
            return null;
        }
        if (!in_array($tablename, self::get_tables())) {
            return false;
        }
        return $tablename;
    }
    public static function insert($table, $data)
    {
        $table = self::_is_valid_tablename($table);
        if (!$table) {
            return false;
        }
        $meta_file = self::$dir_meta . $table . '.json';
        $File_meta = File::instance($meta_file);
        $meta = $File_meta->exists ? $File_meta->get_json() : self::$table_meta_defaults;
        $data['id'] = $meta['id']++;
        $data['insert_date'] = time();
        $data['update_date'] = null;
        $data['delete_date'] = null;
        //
        $table_file = self::$dir_tables . $table . '.json';
        $File_table = File::instance($table_file);
        $table_data = $File_table->exists ? $File_table->get_json() : [];
        $table_data[] = $data;
        $meta['amount'] = count($table_data);
        //
        file_put_contents($File_table->path, json_encode($table_data));
        self::$_CACHE['table'][$table] = null;
        file_put_contents($File_meta->path, json_encode($meta));
        usleep(999);
        return $data['id'];
    }

    public static function update($table, $data, $id_or_condition)
    {
        $table = self::_is_valid_tablename($table);
        if (!$table) {
            return false;
        }
        $table_file = self::$dir_tables . $table . '.json';
        $File_table = File::instance($table_file);
        $table_data = $File_table->exists ? $File_table->get_json() : [];
        $updated = false;
        foreach ($table_data as &$row) {
            if (
                (is_int($id_or_condition) && $row['id'] == $id_or_condition) ||
                (is_array($id_or_condition) && self::matches_condition($row, $id_or_condition))
            ) {
                $row = array_merge($row, $data);
                $row['update_date'] = time();
                $updated = true;
            }
        }
        if ($updated) {
            file_put_contents($File_table->path, json_encode($table_data));
            self::$_CACHE['table'][$table] = null;
        }
        return $updated;
    }

    public static function delete($table, $id_or_condition, $soft = true)
    {
        $table = self::_is_valid_tablename($table);
        if (!$table) {
            return false;
        }
        $table_file = self::$dir_tables . $table . '.json';
        $File_table = File::instance($table_file);
        $table_data = $File_table->exists ? $File_table->get_json() : [];
        $deleted = false;
        foreach ($table_data as &$row) {
            if (
                (is_int($id_or_condition) && $row['id'] == $id_or_condition) ||
                (is_array($id_or_condition) && self::matches_condition($row, $id_or_condition))
            ) {
                if ($soft) {
                    $row['delete_date'] = time();
                } else {
                    $row = null;
                }
                $deleted = true;
            }
        }
        if (!$soft) {
            $table_data = array_filter($table_data);
        }
        if ($deleted) {
            file_put_contents($File_table->path, json_encode($table_data));
            // Update the meta amount
            $meta_file = self::$dir_meta . $table . '.json';
            $File_meta = File::instance($meta_file);
            $meta = $File_meta->exists ? $File_meta->get_json() : self::$table_meta_defaults;
            $meta['amount'] = count($table_data);
            file_put_contents($File_meta->path, json_encode($meta));
            self::$_CACHE['table'][$table] = null;
        }
        return $deleted;
    }
    public static function select($table, $condition = [], $with_relations = true, $only_first = false)
    {
        $table = self::_is_valid_tablename($table);
        if (!$table) {
            return false;
        }
        $table_data = self::get_table($table);
        if (!$table_data) {
            return false;
        }
        $rows = $table_data['data'];
        if (is_numeric($condition)) {
            $condition = ['id' => intval($condition)];
        }
        if(!isset($condition['delete_date'])) {
            $condition['delete_date'] = null;
        }
        $results = [];
        foreach ($rows as $row) {
            if (self::matches_condition($row, $condition)) {
                $results[] = $row;
                if ($only_first) {
                    break;
                }
            }
        }
        if ($with_relations && isset(App::$config['db'][$table]['_']['relations'])) {
            foreach ($results as &$row) {
                foreach (App::$config['db'][$table]['_']['relations'] as $field => $relation) {
                    if (isset($row[$field])) {
                        list($related_table, $related_field) = $relation;
                        $related_data = self::select($related_table, [$related_field => $row[$field]]);
                        $row[$related_table] = $related_data;
                    }
                }
            }
        }
        return $only_first ? (isset($results[0]) ? $results[0] : null) : $results;
    }

    public static function select_first($table, $condition, $with_relations = true)
    {
        return self::select($table, $condition, $with_relations, true);
    }

    public static function matches_condition($row, $condition)
    {
        foreach ($condition as $key => $value) {
            $operator = '=';
            if (is_array($value) && isset($value['operator'])) {
                $operator = strtolower($value['operator']);
                $value = $value[0];
            }
            if (!isset($row[$key]) && !is_null($row[$key])) {
                return false;
            }
            $row_value = $row[$key];
            switch ($operator) {
                case 'like':
                case 'LIKE':
                    if (strtolower($row_value) != strtolower($value)) {
                        return false;
                    }
                    break;
                case '>':
                    if ($row_value <= $value) {
                        return false;
                    }
                    break;
                case '<':
                    if ($row_value >= $value) {
                        return false;
                    }
                    break;
                case '>=':
                    if ($row_value < $value) {
                        return false;
                    }
                    break;
                case '<=':
                    if ($row_value > $value) {
                        return false;
                    }
                    break;
                case '!=':
                case '<>':
                    if ($row_value == $value) {
                        return false;
                    }
                    break;
                case 'in':
                case 'IN':
                    if (!in_array($row_value, (array) $value)) {
                        return false;
                    }
                    break;
                case '=':
                default:
                    if ($row_value != $value) {
                        return false;
                    }
                    break;
            }
        }
        return true;
    }

}

DB::init();

```

## latest/php/classes/file.class.php
- Kurzbeschreibung: class File

```php
<?php

class File
{
    public $path = null;
    public $exists = false;
    private static $_CACHE = array('instances' => array(), 'filenames' => array(), 'filefolders' => array(), 'fileext' => array());

    public function __construct($file_path = null)
    {
        if (is_string($file_path)) {
            $this->path = $file_path;
            $this->load_meta();
        }
    }

    public static function _create_folder($folderpath)
    {
        $folderpath = str_replace('/', DIRECTORY_SEPARATOR, $folderpath);
        mkdir($folderpath);
    }

    public static function _create_try_list($filename, $extensions = array(), $prepathes = false)
    {
        $list = array();
        $base_pathes = array(DIR_PROJECT, DIR_PROJECT_PHP, DIR_X5, DIR_X5_PHP);
        
        if (!in_array('', $extensions)) {
            array_push($extensions, '');
        }
        if (is_string($prepathes) && strlen($prepathes) > 0) {
            $prepathes = array($prepathes);
        }
        if (!is_array($prepathes)) {
            $prepathes = array('');
        }
        if (!in_array('', $prepathes)) {
            array_push($prepathes, '');
        }
        foreach ($base_pathes as $base_path) {
            foreach ($extensions as $extension) {
                if (strlen($extension) > 0 && !strstr($extension, '.')) {
                    $extension = '.' . $extension;
                }
                if (is_array($prepathes)) {
                    foreach ($prepathes as $prepath) {
                        array_push($list, $base_path . $prepath . $filename . $extension);
                    }
                }
            }
        }
        return $list;
    }

    public static function _latest_time($files = [])
    {
        $latest = -1;
        foreach ($files as $filepath) {
            if(is_object($filepath) && get_class($filepath) == 'File') {
                $filepath = $filepath->path;
            }
            if (!is_url($filepath) && is_file($filepath)) {
                $latest = max(array($latest, filemtime($filepath)));
            }
        }
        return $latest;
    }

    public static function _save_file($filepath, $content)
    {
        $filepath = str_replace('/', DIRECTORY_SEPARATOR, $filepath);
        file_put_contents($filepath, $content);
        @chmod($filepath, 0777);
    }

    public function ext()
    {
        return self::_ext($this->path);
    }

    public static function _ext($filepath)
    {
        if (!isset(self::$_CACHE['fileext'][$filepath])) {
            if (strstr($filepath, '.')) {
                $file_exts = explode('.', $filepath);
                self::$_CACHE['fileext'][$filepath] = end($file_exts);
            } else {
                self::$_CACHE['fileext'][$filepath] = false;
            }
        }
        return self::$_CACHE['fileext'][$filepath];
    }

    public function folder()
    {
        return self::_folder($this->path);
    }

    public static function _folder($filepath)
    {
        if (!isset(self::$_CACHE['filefolders'][$filepath])) {
            $filename = self::_name($filepath);
            $filefolder = str_replace($filename, '', $filepath);
            self::$_CACHE['filefolders'][$filepath] = $filefolder;
        }
        return self::$_CACHE['filefolders'][$filepath];
    }

    public function get_content()
    {
        if ($this->exists) {
            if ($this->ext() == 'php') {
                ob_start();
                include $this->path;
                return ob_get_clean();
            } else {
                $content = file_get_contents($this->path);
                if ($this->ext() == 'xtpl') {
                    $content = self::_trim_empty_lines($content);
                }
                return $content;
            }
        } else {
            return '';
        }
    }

    public function get_json() {
        if ($this->exists) {
            $content = $this->get_content();
            // HJSON Support
            $content = preg_replace('|/\*.*\*/|Us', '', $content);
            return @json_decode($content, true);
        } else {
            return null;
        }
    }

    public static function i($file_path) {
        $try_list = self::_create_try_list($file_path);
        return self::instance_of_first_existing_file($try_list);
    }

    public static function instance_of_first_existing_file($file_pathes) {
        foreach ((array) $file_pathes as $file_path) {
            if (is_file($file_path)) {
                return self::instance($file_path);
            }
        }
        return new self();
    }

    public static function instance($file_path) {
        if (!isset(self::$_CACHE['instances'][$file_path])) {
            self::$_CACHE['instances'][$file_path] = new self($file_path);
        }
        return self::$_CACHE['instances'][$file_path];
    }

    public function load_meta() {
        if (is_string($this->path)) {
            $this->exists = is_file($this->path);
        }
    }

    public static function ls($source, $fullpath = false, $only_files = false) {
        if (is_dir($source)) {
            $source = self::n($source);
            $folder = scandir($source);
            $folder = array_filter($folder, function($filename) {
                return $filename != '.' && $filename != '..';
            });
            if ($only_files) {
                $folder = array_filter($folder, function($filename) use ($source) {
                    return is_file($source . $filename);
                });
            }
            if ($fullpath) {
                foreach ($folder as &$filename) {
                    $filename = $source . $filename;
                }
            }
            return $folder;
        } else {
            return array();
        }
    }

    public function name() {
        return self::_name($this->path);
    }

    public static function _name($filepath) {
        if (!isset(self::$_CACHE['filenames'][$filepath])) {
            $filename = explode('/', $filepath);
            $filename = end($filename);
            self::$_CACHE['filenames'][$filepath] = $filename;
        }
        return self::$_CACHE['filenames'][$filepath];
    }

    public static function _trim_empty_lines($content) {
        if (!is_string($content)) {
            return $content;
        }
        $content = preg_replace('/\A(?:[ \t]*\r?\n)+/', '', $content);
        $content = preg_replace('/(?:\r?\n[ \t]*)+\z/', '', $content);
        return $content;
    }

    public static function normalize_folder($source) {
        if (is_string($source)) {
            $source = trim($source);
            if (substr($source, -1) != '/') {
                $source .= '/';
            }
        }
        return $source;
    }

    public static function n($p) {
        return self::normalize_folder($p);
    }

    public static function path($source) {
        $path = explode('/', $source);
        $path = array_slice($path, 0, count($path) - 1);
        $path = implode('/', $path);
        return $path . '/';
    }
}

```

## latest/php/classes/image.class.php
- Kurzbeschreibung: class Image

```php
<?php
class Image
{
    public static function x_2_webp($image)
    {
        $image_type = self::get_image_type($image);

        switch ($image_type) {
            case 'png':
                return file_get_contents(self::png_2_webp($image));
            case 'jpg':
                return file_get_contents(self::jpg_2_webp($image));
            case 'gif':
                return file_get_contents(self::gif_2_webp($image));
            default:
                throw new Exception("Unsupported image type: " . $image_type);
        }
    }
    public static function png_2_webp($image)
    {
        $im = imagecreatefrompng($image);
        if (!$im) {
            throw new Exception("Could not create image from PNG");
        }

        $output = tempnam(sys_get_temp_dir(), 'webp');
        imagewebp($im, $output, 90);
        imagedestroy($im);

        return $output;
    }
    public static function jpg_2_webp($image)
    {
        $im = imagecreatefromjpeg($image);
        if (!$im) {
            throw new Exception("Could not create image from JPG");
        }

        $output = tempnam(sys_get_temp_dir(), 'webp');
        imagewebp($im, $output, 90);
        imagedestroy($im);

        return $output;
    }
    public static function gif_2_webp($image)
    {
        $im = imagecreatefromgif($image);
        if (!$im) {
            throw new Exception("Could not create image from GIF");
        }

        $output = tempnam(sys_get_temp_dir(), 'webp');
        imagewebp($im, $output, 90);
        imagedestroy($im);

        return $output;
    }
    public static function get_image_type($image)
    {
        $ext = strtolower(pathinfo($image, PATHINFO_EXTENSION));
        return $ext;
    }
    public static function resize_to_max_width($imageContent, $max_width)
    {
        $source_image = imagecreatefromstring($imageContent);
        list($width, $height) = getimagesizefromstring($imageContent);

        if ($width <= $max_width) {
            return $imageContent;
        }

        $ratio = $max_width / $width;
        $new_height = $height * $ratio;

        $new_image = imagecreatetruecolor($max_width, $new_height);
        imagealphablending($new_image, false);
        imagesavealpha($new_image, true);

        $transparent = imagecolorallocatealpha($new_image, 0, 0, 0, 127);
        imagefill($new_image, 0, 0, $transparent);

        imagecopyresampled($new_image, $source_image, 0, 0, 0, 0, $max_width, $new_height, $width, $height);

        ob_start();
        imagewebp($new_image, null, 90);
        $resized_image = ob_get_clean();

        imagedestroy($new_image);
        imagedestroy($source_image);

        return $resized_image;
    }
    public static function resize_to_max_height($imageContent, $max_height)
    {
        $source_image = imagecreatefromstring($imageContent);
        list($width, $height) = getimagesizefromstring($imageContent);

        if ($height <= $max_height) {
            return $imageContent;
        }

        $ratio = $max_height / $height;
        $new_width = $width * $ratio;

        $new_image = imagecreatetruecolor($new_width, $max_height);
        imagealphablending($new_image, false);
        imagesavealpha($new_image, true);

        $transparent = imagecolorallocatealpha($new_image, 0, 0, 0, 127);
        imagefill($new_image, 0, 0, $transparent);

        imagecopyresampled($new_image, $source_image, 0, 0, 0, 0, $new_width, $max_height, $width, $height);

        ob_start();
        imagewebp($new_image, null, 90);
        $resized_image = ob_get_clean();

        imagedestroy($new_image);
        imagedestroy($source_image);

        return $resized_image;
    }

}
```

## latest/php/classes/js.class.php
- Kurzbeschreibung: class Js

```php
<?php

class Js
{

    public $files = [];
    public $templates = [];
    public $translations = [];
    public $forms = [];
    public $all_files = [];
    public $latest_time = -1;
    public $cache_key = 'nocache.js';
    public $code = '';

    public function __construct($files = [], $templates = [], $translations = [], $forms = [])
    {
        if (is_array($files)) {
            $this->files = $files;
        }
        if (is_array($templates)) {
            $this->templates = $templates;
        }
        if (is_array($translations)) {
            $this->translations = $translations;
        }
        if (is_array($forms)) {
            $this->forms = $forms;
        }
        $this->all_files = array_merge($this->files, $this->templates);
        $this->latest_time = File::_latest_time($this->all_files);
        $this->cache_key = json_encode(array($this->all_files, $this->latest_time, $this->translations));
        $this->code = Cache::get($this->cache_key, DAY * 31);
        if (!is_string($this->code) || empty($this->code)) {
            $js_code = self::concat($this->files, $this->templates);
            $js_code .= 'TRANSLATIONS=' . json_encode($this->translations) . ';';
            $js_code .= 'FORMS=' . json_encode($this->forms) . ';';
            $this->code = Cache::set($this->cache_key, $js_code);
        }
    }

    public static function concat($files = [], $templates = [])
    {
        $js = '';
        foreach ($files as $file) {
            if(is_object($file) && get_class($file) == 'File') {
                $file = $file->path;
            }
            if (substr($file, 0, 6) == 'https:' || substr($file, 0, 6) == 'https:') {
                $js .= Curl::get_cached($file, DAY) . "\n";
            } else {
                $File = File::instance($file);
                $js .= $File->get_content() . "\n";
            }
        }
        if (is_array($templates)) {
            $jsTemplates = 'var TEMPLATES = {';
            foreach ($templates as $template) {
                $content = trim(File::instance($template)->get_content());
                $jsTemplates .= '"' . basename($template, '.xtpl') . '":' . json_encode($content) . ',';
            }
            $jsTemplates = rtrim($jsTemplates, ',') . '};';

            $js .= $jsTemplates;
        }

        foreach (['/*!
  * Bootstrap v5.3.2 (https://getbootstrap.com/)
  * Copyright 2011-2023 The Bootstrap Authors (https://github.com/twbs/bootstrap/graphs/contributors)
  * Licensed under MIT (https://github.com/twbs/bootstrap/blob/main/LICENSE)
  */'] as $search_string) {
            $js = str_replace($search_string, '', $js);
        }
        $js = trim($js);

        return $js;
    }
}

```

## latest/php/classes/request.class.php
- Kurzbeschreibung: class Request

```php
<?php

class Request
{
    public static $url_path_to_script, $requested_path, $requested_path_array, $requested_clean_path, $requested_clean_path_array;

    public static function init()
    {
        $path_to_script = str_replace(basename($_SERVER["SCRIPT_NAME"]), '', $_SERVER["SCRIPT_NAME"]);
        if (substr($path_to_script, 0, 1) == '/') {
            $path_to_script = substr($path_to_script, 1);
        }
        if (substr($path_to_script, -4) == 'php/') {
            $path_to_script = substr($path_to_script, 0, -4);
        }
        if (strstr($_SERVER['REQUEST_URI'], 'dist/') && !strstr($path_to_script, 'dist/')) {
            $path_to_script .= 'dist/';
        }
        self::$url_path_to_script = $path_to_script;
        preg_match('/\/*(.*)\/*/', $_SERVER['REQUEST_URI'], $match);
        if (strstr($match[1], '?')) {
            $match[1] = preg_replace('/\?.*/', '', $match[1]);
        }
        self::$requested_path = $match[1];
        self::$requested_path_array = array_filter(explode('/', Request::$requested_path), 'strlen');
        self::$requested_clean_path = str_replace(self::$url_path_to_script, '', self::$requested_path);
        self::$requested_clean_path_array = array_filter(explode('/', Request::$requested_clean_path), 'strlen');
    }

    public static function param($key, $order = ['post', 'get', 'param', 'server'], $default = null, $as = null)
    {
        if (!is_string($key)) {
            return $default;
        }
        $key = trim($key);
        if (is_string($order)) {
            $order = [$order];
        }
        //
        $from_json_body = file_get_contents('php://input');
        if(is_string($from_json_body) && strlen($from_json_body) > 2 && is_json($from_json_body)) {
            foreach(json($from_json_body) as $k => $v) {         
                $_POST[$k] = $v;       
            }
        }
        //
        $sources = [
            'post' => $_POST,
            'get' => $_GET,
            'param' => $_REQUEST,
            'server' => $_SERVER,
        ];
        foreach ($order as $source) {
            if (isset($sources[$source]) && array_key_exists($key, $sources[$source])) {
                $value = $sources[$source][$key];
                if (is_string($as)) {
                    switch (strtolower($as)) {
                        case 'int':
                        case 'integer':
                        case 'number':
                            return intval($value);
                        case 'float':
                        case 'double':
                            return floatval($value);
                        case 'bool':
                        case 'boolean':
                            return filter_var($value, FILTER_VALIDATE_BOOLEAN);
                        case 'json':
                            $json = json_decode($value, true);
                            return json_last_error() === JSON_ERROR_NONE ? $json : $default;
                        case 'string':
                        default:
                            return strval($value);
                    }
                }

                return $value;
            }
        }
        return $default;
    }

}

Request::init();

```

## latest/php/classes/response.class.php
- Kurzbeschreibung: class Response

```php
<?php

class Response
{
    public static function header($set = null, $status = null)
    {
        if (is_string($set)) {
            $set = trim($set);
            if (!headers_sent()) {
                if (is_int($status)) {
                    header($set, true, $status);
                } else {
                    header($set);
                }
            }
        }
    }
    public static function redirect($url = '/', $status = 200)
    {
        while (ob_get_level() > 1) {
            ob_end_clean();
        }
        Response::header('Location: ' . $url, $status);
        Response::header('Refresh:0; url=' . $url);
        die();
    }
    public static function deliver($content)
    {
        $current_output = trim(ob_get_clean());
        if (strlen($current_output) > 0) {
            $content = $current_output . $content;
        }

        if (ENV != 'dev') {
            self::header('Cache-Control: public');
            self::header('Pragma: cache');
            self::header('Expires: ' . gmdate('D, d M Y H:i:s \G\M\T', time() + (HOUR * 6)));
        }

        self::header('Content-length: ' . strlen($content));
        self::header('Content-Type: ' . App::$mime . '; charset=' . App::$encoding, 200);

        echo $content;
    }
    public static function ajax($response, $status, $errors = [], $success = true)
    {
        if (!is_int($status)) {
            $status = 500;
        }
        if (!is_array($errors)) {
            $errors = [];
        }

        $output = [
            'response' => $response,
            'status' => $status,
            'errors' => $errors,
            'success' => $success
        ];

        self::header('Content-Type: application/json; charset=' . App::$encoding, 200);
        echo json_encode($output);
    }
}


```

## latest/php/classes/translation.class.php
- Kurzbeschreibung: class Translation {

```php
<?php

class Translation {
    
    public static $LANG = 'en';
    public static $_CACHE = [];
    public static $default_translations = 'i18n.json';
    
    public static function get($key = null) {
        $dir = DIR_TRANSLATIONS . self::$LANG . '/';
        $direct = $dir . $key . '.html';
        $default_file = $dir . self::$default_translations;
        $cache_key = md5($key);
        if (!isset(self::$_CACHE[$cache_key]) || is_null(self::$_CACHE[$cache_key])) {
            if (is_file($direct)) {
                self::$_CACHE[$cache_key] = file_get_contents($direct);
            } else if (is_file($default_file)) {
                if(!isset(self::$_CACHE['default']) || is_null(self::$_CACHE['default'])) {
                    self::$_CACHE['default'] = @json_decode(file_get_contents($default_file), true);
                }
                if(is_array(self::$_CACHE['default'])) {
                    if(isset(self::$_CACHE['default'][$key])) {
                        self::$_CACHE[$cache_key] = self::$_CACHE['default'][$key];
                    }
                }
            }
        }
        return isset(self::$_CACHE[$cache_key]) ? self::$_CACHE[$cache_key] : null;
    }

    public static function get_all() {
        $dir = DIR_PROJECT . 'translations/' . self::$LANG . '/';
        $default_file = $dir . self::$default_translations;
        if (!isset(self::$_CACHE['#all#']) || is_null(self::$_CACHE['#all#'])) {
            if(is_file($default_file)) {
                if(!isset(self::$_CACHE['default']) || is_null(self::$_CACHE['default'])) {
                    self::$_CACHE['default'] = @json_decode(file_get_contents($default_file), true);
                    self::$_CACHE['#all#'] = self::$_CACHE['default'];
                }
            }
            foreach(glob($dir . '*') as $translation_file) {
                if(is_file($translation_file) && $translation_file != $default_file) {
                    $translation_path = str_replace($dir, '', $translation_file);
                    $translation_path = str_replace('.html', '', $translation_path);
                    $translation_path = str_replace('/', '.', $translation_path);
                    $translation_path = trim($translation_path);
                    if(!empty($translation_path)) {
                        self::$_CACHE['#all#'][$translation_path] = file_get_contents($translation_file);
                    }
                }
            }
        }
        return isset(self::$_CACHE['#all#']) ? self::$_CACHE['#all#'] : null;
    }

    public static function set_lang($lang) {
        if(is_string($lang)) {
            $lang = strtolower(trim($lang));
            if(!empty($lang)) {
                self::$LANG = $lang;
            }
        }
    }
}

if(!function_exists('_')) {
    function _($key = null) {
        return Translation::get($key);
    }
}

```

## latest/php/classes/xgeo.class.php
- Kurzbeschreibung: class XGeo {

```php
<?php

class XGeo {

    // Base URL for the geolocation API (e.g., OpenStreetMap Nominatim)
    private static $baseurl = "https://nominatim.openstreetmap.org/";

    // Convert an address to longitude and latitude coordinates
    public static function address_to_lnglat($address, $ttl = 84000) {
        $params = ['format' => 'json'];
        
        // Check if address is a string or an array with components
        if (is_string($address)) {
            $params['q'] = $address;
        } elseif (is_array($address)) {
            $params = array_merge($params, array_filter([
                'street' => $address['street'] ?? null,
                'housenumber' => $address['housenumber'] ?? null,
                'city' => $address['city'] ?? null,
                'postcode' => $address['postcode'] ?? null,
                'country' => $address['country'] ?? null
            ]));
        } else {
            return null;  // Return null if input format is invalid
        }

        $result = self::_cache_curl('search', $params, $ttl);
        return !empty($result) && isset($result[0]['lat'], $result[0]['lon']) ? [
            'lat' => floatval($result[0]['lat']),
            'lng' => floatval($result[0]['lon'])
        ] : null;
    }

    // Convert longitude and latitude coordinates to an address
    public static function lnglat_to_address($lng, $lat, $ttl = 84000) {
        if (!self::is_valid_coordinate($lng) || !self::is_valid_coordinate($lat)) {
            return null;
        }

        $params = [
            'format' => 'json',
            'lat' => $lat,
            'lng' => $lng
        ];

        $result = self::_cache_curl('reverse', $params, $ttl);
        return $result['display_name'] ?? null;
    }

    // Search for multiple address suggestions based on input
    public static function address_search($input, $ttl = 84000) {
        if (!is_string($input) || empty(trim($input))) {
            return null;
        }

        $params = [
            'format' => 'json',
            'q' => trim($input),
            'addressdetails' => 1,
            'limit' => 5
        ];

        $results = self::_cache_curl('search', $params, $ttl);

        // Map results to ensure latitude and longitude are consistently returned
        return array_map(function($location) {
            return [
                'display_name' => $location['display_name'] ?? '',
                'lat' => $location['lat'] ? floatval($location['lat']) : null,
                'lng' => $location['lon'] ? floatval($location['lon']) : null
            ];
        }, $results ?? []);
    }

    // Helper method: Validate coordinates
    private static function is_valid_coordinate($value) {
        return is_numeric($value) && ($value = floatval($value)) >= -180 && $value <= 180;
    }

    // Helper method: Send cURL request without caching
    private static function _curl($endpoint, $params = []) {
        $url = self::$baseurl . $endpoint . '?' . http_build_query($params);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_USERAGENT, "XGeo/1.0");
        $result = curl_exec($ch);
        curl_close($ch);
        return json_decode($result, true);
    }

    // Helper method: Send cURL request with caching
    private static function _cache_curl($endpoint, $params = [], $ttl = 60) {
        if (!is_numeric($ttl) || $ttl <= 0) {
            return self::_curl($endpoint, $params);
        }

        $cache_key = md5($endpoint . serialize($params));
        $cached_result = Cache::get($cache_key);
        if ($cached_result) {
            return $cached_result;
        }

        $result = self::_curl($endpoint, $params);
        Cache::set($cache_key, $result, intval($ttl));
        return $result;
    }
}

```

## latest/php/classes/xobject.class.php
- Kurzbeschreibung: class XObject

```php
<?php

class XObject
{
    public $id = 0;
    public $db_row = [];

    public static $db_table = null;

    public static $_CACHE = [
        'instances' => []
    ];

    public function __construct($id = 0)
    {
        if (is_numeric($id) && $id > 0) {
            $class = get_called_class();
            if ($class::$db_table) {
                $data = DB::select_first($class::$db_table, $id);
                if ($data) {
                    $this->db_row = $data;
                    $this->id = $data['id'];
                    foreach ($data as $key => $value) {
                        if (property_exists($this, $key)) {
                            $this->$key = $value;
                        }
                    }
                }
            }
        }
    }

    public static function load($id)
    {
        $class = get_called_class();
        if (!isset($class::$_CACHE['instances'][$id])) {
            $class::$_CACHE['instances'][$id] = new $class($id);
        }
        return $class::$_CACHE['instances'][$id];
    }

    public static function create($data)
    {
        $class = get_called_class();
        if ($class::$db_table) {
            $id = DB::insert($class::$db_table, $data);
            return $class::load($id);
        }
        return null;
    }
}

```

## latest/php/classes/xuser.class.php
- Kurzbeschreibung: class XUser extends XObject {

```php
<?php

class XUser extends XObject {
    public static $db_table = 'users';
    public $name, $email;
    public $insert_date, $update_date, $delete_date;
    public $is_admin, $is_root, $is_active, $is_login;
    public $groups = [];
    public $groups_names = [];

    public static $_CACHE = [
        'instances' => [],
        'name_to_id' => [],
        'email_to_id' => []
    ];

    public function __construct($id = 0) {
        parent::__construct($id);
        if ($this->id > 0) {
            $this->is_admin = $this->db_row['is_admin'] ?? false;
            $this->is_root = $this->db_row['is_root'] ?? false;
            $this->is_active = !$this->db_row['delete_date'];
            $this->is_login = isset($GLOBALS['ME_id']) && $GLOBALS['ME_id'] === $this->id;
            $this->groups = DB::select('users_groups', ['users_id' => $this->id], false);
            foreach($this->groups as $index => $groups_assign) {
                $this->groups[$index] = DB::select_first('groups', $groups_assign['groups_id'], false);
            }
            foreach($this->groups as $group) {
                array_push($this->groups_names, $group['name']);
            }
        }
    }

    public static function load_by_name($name) {
        if (!isset(self::$_CACHE['name_to_id'][$name])) {
            $user = DB::select('users', ['name' => $name], false, true);
            if ($user) {
                self::$_CACHE['name_to_id'][$name] = $user['id'];
            } else {
                return null;
            }
        }
        return self::load(self::$_CACHE['name_to_id'][$name]);
    }

    public static function load_by_email($email) {
        if (!isset(self::$_CACHE['email_to_id'][$email])) {
            $user = DB::select('users', ['email' => $email], false, true);
            if ($user) {
                self::$_CACHE['email_to_id'][$email] = $user['id'];
            } else {
                return null;
            }
        }
        return self::load(self::$_CACHE['email_to_id'][$email]);
    }

    public function login() {
        if ($this->is_active) {
            $cookie_data = base64_encode(json_encode([
                'userid' => $this->id,
                'fingerprint' => fingerprint()
            ]));
            setcookie('X5_login', $cookie_data, time() + (86400 * 30), "/");
            return true;
        }
        return false;
    }

    public function export_js() {
        $user_data = @(array) $this;
        unset($user_data['db_row']);
        unset($user_data['password']);
        return json_encode($user_data);
    }
}

```

## latest/php/lib/bootstrap.php
- Kurzbeschreibung: ini_set('short_open_tag', 1);

```php
<?php

ini_set('short_open_tag', 1);
ini_set('magic_quotes_gpc', 1);
ini_set("memory_limit", "512M");

@session_start();

//CLI-Special
foreach (array('REQUEST_URI' => '', 'HTTPS' => 'off', 'SERVER_PORT' => 0, 'SERVER_NAME' => 'localhost',) as $_SERVER_KEY => $_SERVER_VALUE) {
    if (!isset($_SERVER[$_SERVER_KEY])) {
        $_SERVER[$_SERVER_KEY] = $_SERVER_VALUE;
    }
}
define('IS_CLI', ($_SERVER['REQUEST_URI'] === '' && $_SERVER['SERVER_NAME'] === 'localhost' && $_SERVER['SERVER_PORT'] === 0));

$dir = str_replace(DIRECTORY_SEPARATOR, '/', __DIR__) . '/';
$dir = str_replace('/php/lib/', '/', $dir);
if (substr($dir, -5) == 'dist/') {
    $dir = substr($dir, 0, -5);
}
if (substr($dir, -4) == 'php/') {
    $dir = substr($dir, 0, -4);
}
define('DIR_X5', $dir);

$dir_project = str_replace('\\', '/', dirname($_SERVER['SCRIPT_FILENAME']));
if(substr($dir_project, -1) != '/') {
    $dir_project .= '/';
}
if(substr($dir_project, -5) == 'dist/') {
    $dir_project = substr($dir_project, 0, -5);
}

include DIR_X5 . 'php/lib/variables.php';
include DIR_X5_PHP . 'autoload.php';
include DIR_X5_PHP_LIB . 'functions.php';
include DIR_X5_PHP_CLASSES . 'app.class.php';
include DIR_X5_PHP_CLASSES . 'request.class.php';
include DIR_X5_PHP_CLASSES . 'xobject.class.php';
include DIR_X5_PHP_CLASSES . 'translation.class.php';

define('BASEURL', 'http' . (is_https() ? 's' : '') . '://' . $_SERVER['SERVER_NAME'] . '/' . Request::$url_path_to_script);

$GLOBALS['ASSET_PREFIX'] = '';
for ($i = 0; $i < count(Request::$requested_clean_path_array) - 1; $i++) {
    $GLOBALS['ASSET_PREFIX'] .= '../';
}
define('ASSET_PREFIX', $GLOBALS['ASSET_PREFIX']);
```

## latest/php/lib/functions.php
- Kurzbeschreibung: function is_https() {

```php
<?php

function is_https() {
    return (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') || $_SERVER['SERVER_PORT'] == 443 || (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https');
}
function is_url($string) {
    if(!is_string($string)) {
        return false;
    }
    return substr($string, 0, 5) == 'http:' || substr($string, 0, 6) == 'https:';
}
function is_json($input) {
    if(!is_string($input) || strlen($input) <= 1) {
        return false;
    }
    if((strstr($input, '{') && strstr($input, '}')) || (strstr($input, '[') && strstr($input, ']'))) {
        return $input;
    }
    return false;
}
function json($input) {
    return is_json($input) ? @json_decode($input, true) : [];
}

function debug($var, $height = 'auto', $width = 'auto') {
    $backtrace = debug_backtrace();
    $file = 'Unknown';
    $line = 'Unknown';
    if (count($backtrace) > 1 && isset($backtrace[1]['function']) && in_array($backtrace[1]['function'], array('debug'))) {
        $file = '<span title="Through a debug from: ' . $backtrace[0]['file'] . '">' . $backtrace[1]['file'] . '</span>';
        $line = $backtrace[1]['line'];
    } else if (isset($backtrace[0]['file']) && isset($backtrace[0]['line'])) {
        $file = $backtrace[0]['file'];
        $line = $backtrace[0]['line'];
    }
    echo '<pre style="' .
    'word-break:break-word;border: 1px dashed #BBB;background-color: #CCC;padding:10px;color:#333;' . ($height == 'auto' ? '' : 'overflow-y:scroll;') .
    'height:' . ($height == 'auto' ? 'auto' : $height . 'px') . ';width:' . (strstr($width, '%') || strstr($width, 'px') ? $width : (strstr($width, 'auto') ? 'auto' : $width . 'px')) .
    ';' . ($width != '100%' ? 'margin: 0 auto 10px;' : '') . '">';
    echo '<span style="display: block; margin-bottom: 5px; font-weight: 700;">' . $file . ' (line ' . $line . '):</span>';
    ob_start();
    var_dump($var);
    echo htmlspecialchars(ob_get_clean());
    echo '</pre>';
}
function xhash($input) {
    if(!is_string($input)) {
        $input = @json_encode($input);
    }
    if(!is_string($input)) {
        return null;
    }
    $hash = sha1($input . 'X5!') . md5($input . 'X5!');
    $hash = strtoupper($hash);
    return $hash;
}
function xhash_check($input, $hash) {
    $hash = strtoupper($hash);
    return $hash == xhash($input);
}
function remote_ip() {
    if (isset($_SERVER["HTTP_CF_CONNECTING_IP"])) {
        return $_SERVER["HTTP_CF_CONNECTING_IP"];
    } else if (isset($_SERVER["HTTP_X_FORWARDED_FOR"])) {
        return $_SERVER["HTTP_X_FORWARDED_FOR"];
    } else if (isset($_SERVER['REMOTE_ADDR'])) {
        return $_SERVER['REMOTE_ADDR'];
    } else {
        return null;
    }
}
function fingerprint() {
    return md5($_SERVER['HTTP_USER_AGENT'] . remote_ip());
}
function darken_color($color, $factor = 0.25) {
    // Entferne Leerzeichen und mache den Farbwert einheitlich
    $color = trim(strtolower($color));

    // Funktion zur Anpassung der Helligkeit von RGB-Werten
    $adjust_color = function($r, $g, $b, $factor) {
        $r = max(0, min(255, round($r * (1 - $factor))));
        $g = max(0, min(255, round($g * (1 - $factor))));
        $b = max(0, min(255, round($b * (1 - $factor))));
        return [$r, $g, $b];
    };

    // Falls es sich um Hex handelt
    if (preg_match('/^#?([a-f\d]{3}|[a-f\d]{6})$/', $color, $matches)) {
        $hex = ltrim($matches[1], '#');

        // Expandiere kurze Hex-Codes (z. B. f60 -> ff6600)
        if (strlen($hex) === 3) {
            $hex = $hex[0] . $hex[0] . $hex[1] . $hex[1] . $hex[2] . $hex[2];
        }

        // Extrahiere die RGB-Werte
        $r = hexdec(substr($hex, 0, 2));
        $g = hexdec(substr($hex, 2, 2));
        $b = hexdec(substr($hex, 4, 2));

        // Passe die Helligkeit an
        [$r, $g, $b] = $adjust_color($r, $g, $b, $factor);

        // Gib den neuen Hex-Code zurück
        return sprintf('#%02x%02x%02x', $r, $g, $b);
    }

    // Falls es sich um RGB oder RGBA handelt
    if (preg_match('/^rgba?\\((\\d+),\\s*(\\d+),\\s*(\\d+)(?:,\\s*([0-9.]+))?\\)$/', $color, $matches)) {
        $r = (int)$matches[1];
        $g = (int)$matches[2];
        $b = (int)$matches[3];
        $a = isset($matches[4]) ? (float)$matches[4] : null;

        // Passe die Helligkeit an
        [$r, $g, $b] = $adjust_color($r, $g, $b, $factor);

        // Gib den neuen Farbwert zurück
        return isset($a)
            ? sprintf('rgba(%d, %d, %d, %.2f)', $r, $g, $b, $a)
            : sprintf('rgb(%d, %d, %d)', $r, $g, $b);
    }

    // Falls das Format unbekannt ist, gib die Originalfarbe zurück
    return $color;
}

```

## latest/php/lib/variables.php
- Kurzbeschreibung: define('DIR_X5_PHP', DIR_X5 . 'php/');

```php
<?php

define('DIR_X5_PHP', DIR_X5 . 'php/');
define('DIR_X5_PHP_LIB', DIR_X5_PHP . 'lib/');
define('DIR_X5_PHP_CLASSES', DIR_X5_PHP . 'classes/');
define('DIR_X5_OBJECTS', DIR_X5_PHP . 'objects/');
define('DIR_X5_TEMPLATES', DIR_X5 . 'templates/');
define('DIR_PROJECT', $dir_project);
define('DIR_PROJECT_PHP', DIR_PROJECT . 'php/');
define('DIR_PROJECT_PHP_LIB', DIR_PROJECT_PHP . 'lib/');
define('DIR_PROJECT_PHP_CLASSES', DIR_PROJECT_PHP . 'classes/');
define('DIR_PROJECT_OBJECTS', DIR_PROJECT_PHP . 'objects/');
define('DIR_PROJECT_TEMPLATES', DIR_PROJECT . 'templates/');
define('DIR_DIST', DIR_PROJECT . 'dist/');
define('DIR_VENDOR', DIR_PROJECT . 'vendor/');
define('DIR_PROJECT_CONFIG', DIR_PROJECT . 'config/');
define('DIR_CACHE', DIR_X5 . '_cache/');
define('DIR_TRANSLATIONS', DIR_PROJECT . 'translations/');


define('FILE_ENVIRONMENT', DIR_PROJECT . 'environment');

define('HOUR', 3600);
define('DAY', HOUR * 24);
define('WEEK', DAY * 7);

define('ENV', is_file(FILE_ENVIRONMENT) ? strtolower(trim(file_get_contents(FILE_ENVIRONMENT))) : 'dev');

```

## latest/php/modes/image.php
- Kurzbeschreibung: $img = null;

```php
<?php


$img = null;
$img_content = '';
$img_type = 'plain';
$action_clean = str_replace(['.jpg', '.jpeg', '.png', '.gif'], '', App::$action);
$cache_key = json_encode(array(App::$action, $_GET));
//
if(Cache::get($cache_key, DAY))  {
    $img_type = Cache::get($cache_key . 'mime', DAY + 100);
    $img_content = Cache::get($cache_key, DAY);
} else {
    if(isset(App::$images[App::$action])) {
        $img = isset(App::$images[App::$action]) ? App::$images[App::$action] : false;
    }
    if(!$img && isset(App::$images[$action_clean])) {
        $img = isset(App::$images[$action_clean]) ? App::$images[$action_clean] : null;
    }
    //
    if(isset($img) && is_array($img)) {
        if(isset($img['src'])) {
            $File_img = File::i($img['src']);
            if($File_img->exists) {
                $img_content = $File_img->get_content();
                $img_type = @end(explode('/', mime_content_type($File_img->path)));
                if(!isset($img['raw']) || !$img['raw']) {
                    $img_content = Image::x_2_webp($File_img->path);
                    $img_type = 'webp';
                }
            }
        }
    }
    //
    if (isset($_GET['max-width']) && is_numeric($_GET['max-width'])  && $_GET['max-width'] > 0) {
        $img_content = Image::resize_to_max_width($img_content, intval($_GET['max-width']));
    }
    if (isset($_GET['max-height']) && is_numeric($_GET['max-height'])  && $_GET['max-height'] > 0) {
        $img_content = Image::resize_to_max_height($img_content, intval($_GET['max-height']));
    }
    //
    Cache::set($cache_key, $img_content, true);
    Cache::set($cache_key .  'mime', $img_type);
}
//
App::$mime = 'image/' . $img_type;
Response::deliver($img_content);
```

## latest/php/objects/captcha/image.php
- Kurzbeschreibung: Generate a 4-character Captcha code (uppercase letters and numbers)

```php
<?php

// Generate a 4-character Captcha code (uppercase letters and numbers)
$captcha_code = '';
$characters = 'ABCDEFGHJKLMNPQRSTUVWXYZ23456789';
for ($i = 0; $i < 6; $i++) {
    $captcha_code .= $characters[rand(0, strlen($characters) - 1)];
}
$_SESSION['captcha_code'] = $captcha_code;

// Set image dimensions and colors
$width = 58;
$height = 20;
$image = imagecreate($width, $height);
$background_color = imagecolorallocate($image, 255, 255, 255);
$text_color = imagecolorallocate($image, 0, 0, 0);

imagestring($image, 5, 3, 2, $captcha_code, $text_color);

// Capture the image output and clean up resources
ob_start();
imagepng($image);
$image_data = ob_get_clean();
imagedestroy($image);

// Send image data as response through the framework
App::$mime = 'image/png';
Response::deliver($image_data);

```

## latest/php/objects/css/third_party.php
- Kurzbeschreibung: $files = array(

```php
<?php

$files = array(
    'https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css'
);
$Css = new Css($files);

App::$mime = 'text/css';
App::$encoding = 'UTF-8';

Response::deliver($Css->code);

```

## latest/php/objects/css/xtreme.php
- Kurzbeschreibung: $files = array(

```php
<?php

$files = array(
    File::i('css/xtreme/mixins.less')->path,
    File::i('css/xtreme/basics.less')->path,
    File::i('css/xtreme/header.less')->path,
);
$Css = new Css($files, App::config('xcss', []));

App::$mime = 'text/css';
App::$encoding = 'UTF-8';

Response::deliver($Css->code);

```

## latest/php/objects/error/404.php
- Kurzbeschreibung: PHP-Quelldatei des Frameworks.

```php
<?php

```

## latest/php/objects/geolocation/address_complete.php
- Kurzbeschreibung: $errors = [];

```php
<?php

$errors = [];
$response = [];

// Abrufen des Eingabestrings aus den Request-Parametern
$input = Request::param('input');

// Validierung des Eingabestrings
if (empty($input) || !is_string($input)) {
    $errors[] = _('errors.geo.missing_input');
} else {
    // Nutzung der neuen XGeo-Klasse für die Adresssuche
    try {
        $suggestions = XGeo::address_search($input);
        if (!empty($suggestions)) {
            foreach ($suggestions as $location) {
                $response[] = [
                    'display_name' => $location['display_name'],
                    'lat' => $location['lat'] ?? null,
                    'lng' => $location['lng'] ?? null
                ];
            }
        } else {
            $errors[] = _('errors.geo.no_results');
        }
    } catch (Exception $e) {
        $errors[] = _('errors.geo.api_failed');
    }
}

// Antwort zurücksenden
Response::ajax($response, empty($errors) ? 200 : 400, $errors);

```

## latest/php/objects/geolocation/address_to_geo.php
- Kurzbeschreibung: $errors = [];

```php
<?php

$errors = [];
$response = [];

// Abrufen der Adresse aus dem Request-Parameter `address`
$address = Request::param('address');

// Prüfen, ob eine Adresse übergeben wurde
if (empty($address)) {
    $errors[] = _('errors.geo.missing_address');
} else {
    // Verwenden der XGeo-Klasse zur Geokodierung
    $coordinates = XGeo::address_to_lnglat($address);
    
    if ($coordinates) {
        $response['lat'] = $coordinates['lat'];
        $response['lng'] = $coordinates['lng'];
    } else {
        $errors[] = _('errors.geo.no_results');
    }
}

// Antwort zurücksenden
Response::ajax($response, empty($errors) ? 200 : 400, $errors);

```

## latest/php/objects/geolocation/geo_to_address.php
- Kurzbeschreibung: $errors = [];

```php
<?php

$errors = [];
$response = [];

// Längen- und Breitengrad aus den Request-Parametern abrufen
$lat = Request::param('lat');
$lng = Request::param('lng');

// Überprüfen, ob die erforderlichen Parameter vorhanden sind
if (empty($lat) || empty($lng)) {
    $errors[] = _('errors.geo.missing_coordinates');
} else {
    // Verwenden der XGeo-Klasse für Reverse-Geocoding
    $address = XGeo::lnglat_to_address($lng, $lat);
    
    if ($address) {
        $response['address'] = $address;
    } else {
        $errors[] = _('errors.geo.no_results');
    }
}

// Antwort zurücksenden
Response::ajax($response, empty($errors) ? 200 : 400, $errors);

```

## latest/php/objects/js/xtreme.php
- Kurzbeschreibung: $files = array(

```php
<?php

$files = array(
    'https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js',
    File::i('js/classes/app.class.js')->path,
    File::i('js/classes/controller.class.js')->path,
    File::i('js/classes/page.class.js')->path,
    File::i('js/classes/router.class.js')->path,
    File::i('js/classes/template.class.js')->path,
    File::i('js/classes/translation.class.js')->path,
    File::i('js/classes/form.class.js')->path,
    File::i('js/classes/xscroll.class.js')->path,
    File::i('js/functions.js')->path,
);
$files = array_merge($files, glob(DIR_PROJECT . 'js/controller/*.controller.js'));
$files[] = File::i('js/bootstrap.js');
$templates = array_merge(File::ls(DIR_X5_TEMPLATES, true, true), File::ls(DIR_PROJECT_TEMPLATES, true, true));
$translations = Translation::get_all();
$Js = new Js($files, $templates, $translations, App::$config['forms']);
App::$mime = 'application/javascript';
App::$encoding = 'UTF-8';

Response::deliver($Js->code);

```

## latest/php/objects/users/login.php
- Kurzbeschreibung: $errors = [];

```php
<?php
$errors = [];
$response = null;
$username = Request::param('username');
$password = Request::param('password');

$db_check = DB::select_first('users', [
    'name' => [$username, 'operator' => 'LIKE'],
    'password' => xhash($password),
]);

if($db_check) {
    if(isset($db_check['id']) && $db_check['id'] > 0) {
        if(!$db_check['delete_date']) {
            $User = XUser::load($db_check['id']);
            $User->login();
            $response = [
                'id' => $db_check['id'],
                'name' => $db_check['name'],
                'insert_date' => $db_check['insert_date'],
                'update_date' => $db_check['update_date'],
            ];
        } else {
            $errors[] = _('errors.login.deleted');
        }
    } else {
        $errors[] = _('errors.login.id');
    }
} else {
    $errors[] = _('errors.login.notfound');
}

Response::ajax($response, empty($errors) ? 200 : 400, $errors);
```

## latest/php/objects/users/logout.php
- Kurzbeschreibung: setcookie('X5_login', '', time() + 7, "/");

```php
<?php

setcookie('X5_login', '', time() + 7, "/");

Response::ajax(true, 200, []);
```

## latest/php/objects/users/registration.php
- Kurzbeschreibung: $errors = [];

```php
<?php

$errors = [];
$response = [];

// Load form configuration for validation
$form_config = App::$config['forms']['registration'];
$username_min_length = $form_config['username']['min-length'] ?? 2;
$password_min_length = $form_config['password']['min-length'] ?? 4;

// Retrieve input values
$username = Request::param('username');
$email = Request::param('email');
$password = Request::param('password');
$password2 = Request::param('password2');
$captcha_input = Request::param('captcha');

// Validate required fields
if (empty($username) || strlen($username) < $username_min_length) {
    $errors[] = _('errors.users.invalid_username');
}
if (empty($email)) {
    $errors[] = _('errors.users.missing_email');
}
if (empty($password) || strlen($password) < $password_min_length) {
    $errors[] = sprintf(_('errors.users.password_too_short'), $password_min_length);
}
if ($password !== $password2) {
    $errors[] = _('errors.users.passwords_do_not_match');
}

// Validate captcha
if (strtoupper($captcha_input) !== $_SESSION['captcha_code']) {
    $errors[] = _('errors.captcha.invalid');
}

// Check for unique email
if (empty($errors)) {
    $existing_user = DB::select_first('users', ['email' => $email]);
    if ($existing_user) {
        $errors[] = _('errors.users.email_exists');
    }
}

// Create user if no errors
if (empty($errors)) {
    $user_data = [
        'name' => $username,
        'email' => $email,
        'password' => xhash($password),
    ];

    $new_user_id = DB::insert('users', $user_data);
    if ($new_user_id) {
        $response['success'] = true;
        $response['user_id'] = $new_user_id;
    } else {
        $errors[] = _('errors.users.creation_failed');
    }
}

// Send JSON response
Response::ajax($response, empty($errors) ? 200 : 400, $errors);

```

## latest/templates/body.xtpl
- Kurzbeschreibung: div#body

```text
div#body
    partial:header
    partial:main
    partial:footer
```

## latest/templates/footer.xtpl
- Kurzbeschreibung: footer#page_footer

```text
footer#page_footer
```

## latest/templates/head.xtpl
- Kurzbeschreibung: title

```text
title
link[href="css/third_party"][rel="stylesheet"][type="text/css"]
link[href="css/xtreme"][rel="stylesheet"][type="text/css"]
```

## latest/templates/header.xtpl
- Kurzbeschreibung: header#page_header

```text
header#page_header
    a[data-href="index/index"].logo
        translate:app.name
    nav.menu_main
        ul.clean_list
            li
                a[data-href="index/index"]
                    translate:menu.home
            li
                a[data-href="index/login"]
                    translate:menu.login
    div.menu_trigger
```

## latest/templates/main.xtpl
- Kurzbeschreibung: main#page_main

```text
main#page_main
    aside.aside_left
    article
    aside.aside_right
```

## latest/templates/view.index.index.xtpl
- Kurzbeschreibung: h1

```text
h1
    translate:words.welcome
div.page_element
    translate:index_welcome
```

## latest/templates/view.users.login.xtpl
- Kurzbeschreibung: h1.page_caption

```text
h1.page_caption
    translate:captions.users.login
div.page_formbox
    form[data-form="login"]
```

## latest/templates/xgeo.xtpl
- Kurzbeschreibung: div.xgeo

```text
div.xgeo
    div.xgeo_country
    div.xgeo_search
        input[class="xform_input xform_xgeo_address"][type="text"]
        button.xgeo_search_button[type="button"]
            translate:forms.labels.search_button
    div.xgeo_results
        ul.xgeo_results_list
        div.xgeo_results_msg
            translate:forms.labels.no_results
    div.xgeo_result
        span.xgeo_selected_address
        input[type="hidden"][name="latitude"]
        input[type="hidden"][name="longitude"]
        input[type="hidden"][name="city"]
        input[type="hidden"][name="zip"]
        input[type="hidden"][name="street"]
        input[type="hidden"][name="housenumber"]
```

## latest/templates/xpopup.xtpl
- Kurzbeschreibung: div.xpopup[data-size="m"]

```text
div.xpopup[data-size="m"]
    div.xpopup_header
        div.xpopup_title
        div.xpopup_close
    div.xpopup_content
```

## latest/x5_start.php
- Kurzbeschreibung: include 'php/lib/bootstrap.php';

```php
<?php

include 'php/lib/bootstrap.php';
if (isset(Request::$requested_clean_path_array[0]) && !empty(Request::$requested_clean_path_array[0])) {
    App::$object = strtolower(trim(Request::$requested_clean_path_array[0]));
    if (isset(Request::$requested_clean_path_array[1]) && !empty(Request::$requested_clean_path_array[1])) {
        App::$action = strtolower(trim(Request::$requested_clean_path_array[1]));
    }
}
//
foreach (glob(DIR_PROJECT_CONFIG . '*.php') as $configfile) {
    if (is_file($configfile)) {
        include_once $configfile;
    }
}
include DIR_X5_PHP_CLASSES . 'db.class.php';
include DIR_X5_PHP_CLASSES . 'xuser.class.php';
$GLOBALS['login'] = null;
$GLOBALS['ME_id'] = 0;
$GLOBALS['ME'] = XUser::load(0);
if(isset($_COOKIE['X5_login'])) {
    $GLOBALS['login'] = @json_decode(base64_decode($_COOKIE['X5_login']), true) ?? null;
    if(isset($GLOBALS['login']['userid']) && $GLOBALS['login']['userid'] > 0 && isset($GLOBALS['login']['fingerprint']) && $GLOBALS['login']['fingerprint'] == fingerprint()) {
        $GLOBALS['ME_id'] = intval($GLOBALS['login']['userid']);
        $GLOBALS['ME'] = XUser::load($GLOBALS['ME_id']);
    }
}
//
if (App::config('composer') && is_file(DIR_VENDOR . 'autoload.php')) {
    include_once DIR_VENDOR . 'autoload.php';
}
//
if (is_null(App::$object) && is_null(App::$action)) {
    Response::deliver('<!DOCTYPE html><html lang><head>' .
        '<meta name="viewport" content="width=device-width, initial-scale=1" />' .
        '<script>window.BASEURL="' . BASEURL . '";window.LANG="' . Translation::$LANG . '";window.ME=' . $GLOBALS['ME']->export_js() . ';</script>' .
        '<script src="js/xtreme" async></script>' .
        '</head></html>');
} else {
    if (App::$object == 'images') {
        $File_object = File::i('modes/image.php');
    } else {
        $object_path = 'objects/' . (is_string(App::$object) && is_string(App::$action) ? App::$object . '/' . App::$action : 'error/404');
        if (is_file(DIR_PROJECT . $object_path)) {
            $File_object = File::instance(DIR_PROJECT . $object_path);
        } else {
            $object_trylist = File::_create_try_list($object_path, array('.php', '.html', '.css', '.js', ''), array(DIR_PROJECT, DIR_X5));
            $File_object = File::instance_of_first_existing_file($object_trylist);
        }
        if (!$File_object->exists) {
            $File_object = File::instance(DIR_X5_OBJECTS . 'error/404');
        }
    }
    //
    include $File_object->path;
}
```

