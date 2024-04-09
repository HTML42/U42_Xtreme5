class RouterClass {
    route() {
        let location_hash = location.hash;
        if(location_hash.length <= 2) {
            return null;
        }
        location_hash = location_hash.trim();
        let route_match = location_hash.match(/\#\!([^\/]+)\/*([^\/]*)/i);
        let route_path = ['index', 'index'];
        if(route_match[1] && route_match[1].length) {
            route_path[0] = route_match[1];
        }
        if(route_match[2] && route_match[2].length) {
            route_path[1] = route_match[2];
        }
        return route_path;
    }

    redirect(path) {
        if(typeof path == 'string' && path.length) {
            path = path.split('/');
        }
        if(typeof path == 'object' && path.length) {
            location.hash = '#!' + path[0] + '/' + path[1];
        }
        setTimeout(App.render, 1);
    }
}