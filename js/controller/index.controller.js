class IndexController extends ControllerClass {
    constructor() {
        super();
    }

    view_index() {
        let Page = new PageClass();
        Page.title = 'Startseite';
        return Page;
    }
    view_test() {
        let Page = new PageClass();
        Page.title = 'Testpage';
        return Page;
    }

}
window.IndexController = IndexController;