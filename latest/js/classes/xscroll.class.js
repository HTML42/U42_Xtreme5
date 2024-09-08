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
