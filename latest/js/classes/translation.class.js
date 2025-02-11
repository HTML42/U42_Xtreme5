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
