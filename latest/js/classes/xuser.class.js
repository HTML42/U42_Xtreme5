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