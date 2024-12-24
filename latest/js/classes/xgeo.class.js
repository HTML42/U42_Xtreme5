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
