class IndexController extends ControllerClass {
    constructor() {
        super();
    }

    view_index() {
        let Page = new PageClass();
        Page.title = 'Mark Paspirgilis';
        Page.Template = new TemplateClass('view.index.index');
        let route = (new RouterClass()).route();
        if (route[2] && route[2].length > 1) {
            setTimeout('scroll_to("' + route[2].toLowerCase().trim() + '")', 500);
        }
        setTimeout(function() {
            // Handle s
        }, 500);
        return Page;
    }

}
window.IndexController = IndexController;
