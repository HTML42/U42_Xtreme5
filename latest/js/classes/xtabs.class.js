class XTabsClass {
    static SELECTOR = '[data-xtabs]';

    static init_all(root = document) {
        if (!root || typeof root.querySelectorAll !== 'function') {
            return [];
        }
        return Array.from(root.querySelectorAll(XTabsClass.SELECTOR))
            .map((element) => XTabsClass.init(element))
            .filter(Boolean);
    }

    static init(element) {
        if (!element || element.getAttribute('data-xtabs-init') === 'true') {
            return null;
        }

        const instance = new XTabsClass(element);
        if (!instance.ready) {
            return null;
        }

        element.setAttribute('data-xtabs-init', 'true');
        element.xtabs = instance;
        return instance;
    }

    constructor(element) {
        this.element = element;
        this.tabsList = element.querySelector(':scope > .xtabs_tabs, :scope > ul:first-of-type');
        this.contentsList = element.querySelector(':scope > .xtabs_contents, :scope > ul:nth-of-type(2)');
        this.ready = Boolean(this.tabsList && this.contentsList);

        if (!this.ready) {
            return;
        }

        this.configure_layout();
        this.normalize_list_structure();
        this.collect_items();
        this.ensure_references();
        this.decorate_accessibility();
        this.bind_events();
        this.activate(this.resolve_initial_ref(), false);
    }

    normalize_list_structure() {
        this.normalize_children_to_list_items(this.tabsList);
        this.normalize_children_to_list_items(this.contentsList);
    }

    normalize_children_to_list_items(listElement) {
        Array.from(listElement.children).forEach((child) => {
            if (child.tagName === 'LI') {
                return;
            }

            const item = document.createElement('li');

            Array.from(child.attributes).forEach((attribute) => {
                item.setAttribute(attribute.name, attribute.value);
            });

            while (child.firstChild) {
                item.appendChild(child.firstChild);
            }

            child.replaceWith(item);
        });
    }

    configure_layout() {
        const rawMode = (this.element.getAttribute('data-xtabs') || '').trim().toLowerCase();
        const modeMap = {
            '': 'horizontal-top',
            horizontal: 'horizontal-top',
            vertical: 'vertical-left',
            'horizontal-top': 'horizontal-top',
            'horizontal-bottom': 'horizontal-bottom',
            'vertical-left': 'vertical-left',
            'vertical-right': 'vertical-right'
        };
        this.mode = modeMap[rawMode] || modeMap[''];

        this.element.classList.add('xtabs');
        this.element.setAttribute('data-xtabs-mode', this.mode);
        this.tabsList.classList.add('xtabs_tabs');
        this.contentsList.classList.add('xtabs_contents');
    }

    collect_items() {
        this.tabItems = Array.from(this.tabsList.querySelectorAll(':scope > li, :scope > [data-xtabs-ref]'));
        this.contentItems = Array.from(this.contentsList.querySelectorAll(':scope > li, :scope > div, :scope > [data-xtabs-ref]'));
    }

    ensure_references() {
        const usedRefs = new Set();

        this.tabItems.forEach((tab, index) => {
            let ref = (tab.getAttribute('data-xtabs-ref') || '').trim();
            if (!ref) {
                ref = this.create_ref(tab.textContent || '', index);
            }
            ref = this.make_unique_ref(ref, usedRefs, `tab-${index + 1}`);
            tab.setAttribute('data-xtabs-ref', ref);
            usedRefs.add(ref);

            const content = this.contentItems[index];
            if (content && !(content.getAttribute('data-xtabs-ref') || '').trim()) {
                content.setAttribute('data-xtabs-ref', ref);
            }
        });

        this.contentItems.forEach((content, index) => {
            if ((content.getAttribute('data-xtabs-ref') || '').trim()) {
                return;
            }
            const fallback = `tab-${index + 1}`;
            const ref = this.make_unique_ref(fallback, usedRefs, fallback);
            content.setAttribute('data-xtabs-ref', ref);
            usedRefs.add(ref);
        });
    }

    create_ref(text, index) {
        const slug = String(text)
            .trim()
            .toLowerCase()
            .replace(/[^a-z0-9\s_-]/g, '')
            .replace(/[\s_]+/g, '-')
            .replace(/-+/g, '-')
            .replace(/^-|-$/g, '');
        return slug || `tab-${index + 1}`;
    }

    make_unique_ref(ref, usedRefs, fallback) {
        let value = String(ref || '').trim() || fallback;
        if (!usedRefs.has(value)) {
            return value;
        }

        let suffix = 2;
        while (usedRefs.has(`${value}-${suffix}`)) {
            suffix += 1;
        }
        return `${value}-${suffix}`;
    }

    decorate_accessibility() {
        this.tabsList.setAttribute('role', 'tablist');

        this.tabItems.forEach((tab) => {
            const ref = tab.getAttribute('data-xtabs-ref');
            const trigger = tab.querySelector(':scope > div, :scope > button, :scope > span') || tab;
            trigger.classList.add('xtabs_trigger');
            trigger.setAttribute('role', 'tab');
            trigger.setAttribute('tabindex', '0');
            trigger.setAttribute('aria-selected', 'false');
            trigger.setAttribute('data-xtabs-trigger', ref);
            tab.setAttribute('data-xtabs-wrapper', ref);
        });

        this.contentItems.forEach((content) => {
            const ref = content.getAttribute('data-xtabs-ref');
            content.classList.add('xtabs_content');
            content.setAttribute('role', 'tabpanel');
            content.setAttribute('data-xtabs-content', ref);
            content.hidden = true;
        });
    }

    bind_events() {
        this.tabsList.addEventListener('click', (event) => {
            const trigger = event.target.closest('[data-xtabs-trigger]');
            if (!trigger || !this.tabsList.contains(trigger)) {
                return;
            }
            this.activate(trigger.getAttribute('data-xtabs-trigger'));
        });

        this.tabsList.addEventListener('keydown', (event) => {
            const trigger = event.target.closest('[data-xtabs-trigger]');
            if (!trigger) {
                return;
            }
            if (event.key === 'Enter' || event.key === ' ') {
                event.preventDefault();
                this.activate(trigger.getAttribute('data-xtabs-trigger'));
            }
        });
    }

    resolve_initial_ref() {
        const hashRef = this.extract_ref_from_hash();
        if (hashRef && this.has_ref(hashRef)) {
            return hashRef;
        }
        return this.tabItems[0]?.getAttribute('data-xtabs-ref') || null;
    }

    extract_ref_from_hash() {
        const hash = String(window.location.hash || '');
        const match = hash.match(/(?:^|\/)tab--([a-z0-9_-]+)/i);
        return match ? match[1].toLowerCase() : null;
    }

    has_ref(ref) {
        return this.tabItems.some((tab) => tab.getAttribute('data-xtabs-ref') === ref);
    }

    activate(ref, updateHash = true) {
        if (!ref) {
            return;
        }

        this.tabItems.forEach((tab) => {
            const isActive = tab.getAttribute('data-xtabs-ref') === ref;
            tab.classList.toggle('is-active', isActive);

            const trigger = tab.querySelector('[data-xtabs-trigger]');
            if (trigger) {
                trigger.setAttribute('aria-selected', isActive ? 'true' : 'false');
                trigger.setAttribute('tabindex', isActive ? '0' : '-1');
            }
        });

        this.contentItems.forEach((content) => {
            const isActive = content.getAttribute('data-xtabs-ref') === ref;
            content.classList.toggle('is-active', isActive);
            content.hidden = !isActive;
        });

        if (updateHash) {
            this.update_hash(ref);
        }
    }

    update_hash(ref) {
        const baseHash = this.resolve_hash_base();
        const separator = baseHash === '#' ? '' : '/';
        const targetHash = `${baseHash}${separator}tab--${ref}`;
        if (window.location.hash === targetHash) {
            return;
        }
        history.replaceState(null, '', targetHash);
    }

    resolve_hash_base() {
        const hash = String(window.location.hash || '').trim();
        const normalized = hash.startsWith('#') ? hash.substring(1) : hash;
        if (!normalized) {
            return '#';
        }
        const [base] = normalized.split('/tab--');
        if (!base) {
            return '#';
        }
        return `#${base}`;
    }
}

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', () => XTabsClass.init_all(document));
} else {
    XTabsClass.init_all(document);
}
