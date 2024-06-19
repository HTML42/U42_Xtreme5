class RouterClass {
    route() {
        let location_hash = location.hash;
        if(location_hash.length <= 2) {
            return null;
        }
        location_hash = location_hash.trim();
        let route_match = location_hash.match(/\#\!([^\/]+)\/*([^\/]*)\/*([^\/]*)\/*([^\/]*)\/*([^\/]*)/i);
        let route_path = ['index', 'index', null, null, null];
        for(let i = 1 ; i <= 5 ; i++) {
            if((route_match[i] && route_match[i].length) || typeof route_match[i] == 'number' || route_match[i] === '0' || route_match[i] === 'false' || route_match[i] === 'null') {
                route_path[i - 1] = route_match[i];
                if(route_path[i - 1] == parseInt(route_path[i - 1])) {
                    route_path[i - 1] = parseInt(route_path[i - 1]);
                }
            }
        }
        return route_path;
    }

    redirect(path) {
        if(typeof path == 'string' && path.length) {
            path = path.split('/');
        }
        if(typeof path == 'object' && path.length) {
            let _hash = '#!';
            for(let i = 0 ; i < path.length ; i++) {
                _hash += path[i] + '/';
            }
            location.hash = _hash.substring(0, _hash.length - 1);
        }
        setTimeout(App.render, 1);
    }
}
function get_route() {
    return (new RouterClass).route();
}