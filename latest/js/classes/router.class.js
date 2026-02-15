class RouterClass {
    route() {
        window.last_route_id = null;
        let location_hash = location.hash;
        if(location_hash.length <= 2) {
            return null;
        }
        location_hash = location_hash.trim();
        let route_match = location_hash.match(/\#\!([^\/]+)\/*([^\/]*)\/*([^\/]*)\/*([^\/]*)\/*([^\/]*)/i);
        if(!route_match || route_match.length < 2) {
            return null;
        }
        let route_path = ['index', 'index', null, null, null];
        for(let i = 1 ; i <= 5 ; i++) {
            if(route_match[i] !== undefined && route_match[i] !== '') {
                route_path[i - 1] = route_match[i];
                if(route_path[i - 1] == parseInt(route_path[i - 1])) {
                    route_path[i - 1] = parseInt(route_path[i - 1]);
                }
            }
        }
        for(let i = 0 ; i < route_path.length ; i++) {
            if(typeof route_path[i] === 'number' && !Number.isNaN(route_path[i])) {
                window.last_route_id = route_path[i];
                break;
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
