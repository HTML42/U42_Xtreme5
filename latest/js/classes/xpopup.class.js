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
