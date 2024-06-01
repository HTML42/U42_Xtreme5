

# Framework Guide

This is a guide on how to use the framework. Here, you'll learn how to create new routes and views.

## Setting Up a New Route

To set up a new route, follow these steps:

1. **Check the JavaScript Controller:** Make sure the corresponding JavaScript controller exists. This can be checked in the `controllers/` directory.

2. **Implement the View Function:** Ensure that the function to display the page exists in your controller. The function should look like this:

    ```javascript
    class IndexController extends ControllerClass {
        constructor() {
            super();
        }
        ...
        function view_example() {
            let Page = new PageClass();
            Page.title = (new TranslationClass('titles.index.example')).result;
            Page.Template = new TemplateClass('view.index.example');
            return Page;
        }
        ...
    }
    ```

    Replace "example" with the name of your view.

3. **Create the Template:** Templates are stored in the `templates/` directory. Create a new file named `view.index.example.xtpl` and define the desired HTML layout within it.
    ```html
    div.page_example
      h1
        translate:example.caption
      p
        translate:example.content
    ```

4. **Create the translations:** Create the keys and values in translations/en/l18n.json
    ```json
    {
        ...
        "titles": {
            "index": {
                "example": "This is the Example Page"
            }
        },
        "example": {
            "caption": "Example Caption",
            "content": "Lorem ipsum dolor sit amet"
        },
        ...
    }

    ```

## Example of a View

Here's an example code for a simple view function:

```javascript
function view_example() {
    let Page = new PageClass();
    Page.title = (new TranslationClass('titles.index.example')).result;
    Page.Template = new TemplateClass('view.index.example');
    return Page;
}
```

## This code creates a new page titled "Example" and uses the template "view.index.example.xtpl".

Structure of Templates
Templates follow a specific naming convention and are stored in the templates/ directory. Each template has a unique name corresponding to the route path.