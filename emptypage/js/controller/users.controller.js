class UsersController extends ControllerClass {
    constructor() {
        super();
    }

    view_index() {
        let Page = new PageClass();
        Page.title = 'Users - Overview';
        Page.Template = new TemplateClass('view.users.index');
        return Page;
    }
    view_login() {
        let Page = new PageClass();
        Page.title = 'Users - Login';
        Page.Template = new TemplateClass('view.users.login');
        return Page;
    }
    view_logout() {
        let Page = new PageClass();
        App.get_object('users/logout');
        setTimeout(function() {
            (new RouterClass()).redirect('index/index');
            setTimeout('location.reload(true)', 100);
        }, 500);
        return Page;
    }

}
window.UsersController = UsersController;