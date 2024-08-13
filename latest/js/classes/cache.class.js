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
