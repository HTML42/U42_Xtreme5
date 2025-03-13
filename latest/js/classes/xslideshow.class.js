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