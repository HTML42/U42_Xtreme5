class IndexController extends ControllerClass {
    constructor() {
        super();
    }

    view_index() {
        let Page = new PageClass();
        Page.title = 'Startseite';
        Page.Template = new TemplateClass('view.index.index');
        return Page;
    }
    view_test() {
        let Page = new PageClass();
        Page.title = 'Testpage';
        Page.Template = null;
        return Page;
    }

}
window.IndexController = IndexController;