function uc_first(string) {
    return string.charAt(0).toUpperCase() + string.slice(1);
}
function is_dom(element) {
    return typeof element === 'object' && element !== null && typeof element.tagName != 'undefined';
}
//
function transform_datahref(element) {
    if(typeof element !== 'object' || element ===  null) {
        element = document.querySelector('body');
    }
    if(is_dom(element)) {
        const Router = new RouterClass();
        element.querySelectorAll('[data-href]:not([data-linked])').forEach(function(link) {
            link.dataset.linked = true;
            link.onclick = function () {
                Router.redirect(link.dataset.href);
            };
        });
    }
}