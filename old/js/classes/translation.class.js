class TranslationClass {
    constructor(translation_key) {
        this.key_raw = translation_key;
        this.translation = null;
        this.keys = [];
        if (typeof this.key_raw == 'string') {
            this.key_raw = this.key_raw.trim();
            let result = this.fetch_translation();
            this.result = result ? result : '[Missing Translation::' + this.key_raw + ']';
        } else {
            this.result = '[TranslationError::KeyIsNotString]';
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

window.LANG = LANG || 'en';
    