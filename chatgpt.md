# Xtreme Webframework 5 - Coding Manual

This is a guide on how to use the framework.

## Cookbook

 - Routes
 - Controller
 - View
 - Templates
 - Translations
 - Links

## Routes

The routes are not explicitly defined. Routes are working when a specific controller and view is defined.
The Framework is basically a onepager with JS-Controlled subpages.
To navigate to a different subpage we need to use the locationhash.
The syntax for routes in the URL is: #!controller/view
Examples:
 - https://www.domain.de/#!index/index      (Controller: index ; View: index)
 - https://www.domain.de/#!index/coolpage   (Controller: index ; View: coolpage)
 - https://www.domain.de/#!games/tetris     (Controller: games ; View: tetris)

When a page is called in the router.class.js, the render() method in app.class.js executes the Controller and View if they are defined in JS.

## Controller

Controllers are in js/controller/*.controller.js.
Example for a test-controller:

**Filename**: test.controller.js
**Filepath**: js/controller/test.controller.js
**FileContent**:
```javascript
class TestController extends ControllerClass {
    constructor() {
        super();
    }
}
```

## Controller-View

Views are the base of the routing system in this framework.
if you want to access #!test/index, you need to create an index-view inside the TestController.

```javascript
class TestController extends ControllerClass {
    constructor() {
        super();
    }
    
    function view_index() {
        let Page = new PageClass();
        return Page;
    }
}
```

### Give the view some content

A view should have additionally a meta-title and some content

```javascript
class TestController extends ControllerClass {
    constructor() {
        super();
    }
    
    function view_index() {
        let Page = new PageClass();
        Page.title = (new TranslationClass('titles.test.index')).result;
        Page.Template = new TemplateClass('view.test.index');
        return Page;
    }
}
```

## Templates

The templates are stored in templates/*.xtpl.
This Framework uses xtpl-files, which uses new selfwritten template-syntax.
The xtpl-syntax is emmet-like. Here are some example:
**XTPL:**
div.test
**HTML**
<div class="test"></div>
**XTPL:**
div.wrap
  h2
  p
**HTML**
<div class="wrap">
  <h2></h2>
  <p></p>
</div>
**XTPL:**
div.test[data-href="test/index"]
  h1
    translate:pagecaptions.test_index
  ul#mylist
    li
      input[type="text"][readonly="readonly"]
**HTML**
<div class="test" data-href="test/index">
    <h1 translate="pagecaptions.test_index">Page Title</h1>
    <ul id="mylist">
        <li>
            <input type="text" readonly="readonly">
        </li>
    </ul>
</div>

### View Templates

Templates for views should be named like this: view.index.index.xtpl ; the syntax is: view.controllername.viewname.xtpl

## Translations

The translations are stored in translations/.
The main language is englisch (en), with it's directory translations/en/.
Other languages will be in the directory level as en/.
In every language-folder is a core translation file named l18n.json.
Other (bigger) translations (also full HTML-formatted translations) can be stored in files like: translations/en/index_welcome.html.
The respective german language translation would be in translations/de/index_welcome.html and will be accessed by:
In templates: translate:index_welcome
In JS: (new TranslationClass('index_welcome')).result

The l18n.json is "categorized" formatted which means every translation is subbed by it's use.
For example, labels of the main menu of the websites should have the translation key: mainmenu.example
l18n.json needs to have at least this in this case: {"mainmenu":{"example":My Translation"}}

## Links

To navigate between pages on a website, you can utilize either the `RouterClass.redirect()` method or the `data-href` attribute. These methods enable users to move from one page to another without reloading the page.

### Using `RouterClass.redirect()`

The `RouterClass.redirect()` method is used to direct the user from one page to another based on the specified controller and view combination.

Example:
```javascript
RouterClass.redirect('index/imprint');
```

### Using `data-href`

The data-href attribute can be used in HTML elements to specify a link to another page. When an element with this attribute is clicked, the user will be redirected to the corresponding page.

Example:
```html
    <div data-href="index/imprint">Impressum</div>
```
Using transform_datahref()
To ensure all links on the website function properly, the transform_datahref() function should be utilized. This function adds click events to elements that use the data-href attribute, enabling navigation between pages.

Example:
```javascript
    let dom = document.createElement('div');
    dom.setAttribute('data-href', 'index/imprint');
    transform_datahref(dom);
```
Example of Using transform_datahref() with Templates
To ensure templates function correctly and support navigation, the transform_datahref() function should be applied to the rendered DOM of the template.

Example:
```javascript
    let Template = new TemplateClass('my.template');
    let Template_dom = transform_datahref(Template.dom);
    document.body.appendChild(Template_dom);
```
By using these methods, seamless navigation between pages of a website can be ensured, leading to an enhanced user experience.



# Xtreme Webframework 5 - Komplette Dokumentation

## Projektstruktur

```plaintext
Xtreme Webframework 5
├── latest/
│   ├── config/
│   │   ├── xcss.php
│   ├── controllers/
│   ├── templates/
│   │   ├── main.xtpl
│   ├── translations/
│   ├── x5_start.php
│   └── ...
├── emptypage/
│   └── config/
└── php/
    └── lib/
        └── bootstrap.php
```

## Routes

Die Routen werden nicht explizit definiert. Das Framework ist grundsätzlich als Onepager mit JS-gesteuerten Unterseiten aufgebaut. Die Navigation zu verschiedenen Unterseiten erfolgt über den Location Hash. Die Syntax für Routen in der URL ist wie folgt: 

```plaintext
#!controller/view
```

### Beispiele für Routen:

- `https://www.domain.de/#!index/index` 
  - **Controller**: index 
  - **View**: index

- `https://www.domain.de/#!index/coolpage`
  - **Controller**: index
  - **View**: coolpage

- `https://www.domain.de/#!games/tetris`
  - **Controller**: games
  - **View**: tetris

## Controller

Die Controller befinden sich im Verzeichnis **js/controller/*.controller.js**. Beispiel für einen Test-Controller:

**Dateiname**: test.controller.js
**Dateipfad**: js/controller/test.controller.js

**Inhalt**:
```javascript
class TestController extends ControllerClass {
    constructor() {
        super();
    }
    
    function view_index() {
        let Page = new PageClass();
        Page.title = (new TranslationClass('titles.test.index')).result;
        Page.Template = new TemplateClass('view.test.index');
        return Page;
    }
}
```

## Templates

Die Templates sind im Verzeichnis **templates/** gespeichert und verwenden die Endung **.xtpl**. Das Framework verwendet eine selbstgeschriebene Template-Syntax, die Emmet-ähnlich ist.

### Beispiele:

- **XTPL:** `div.test` → **HTML:** `<div class="test"></div>`
- **XTPL:** `div.wrap h2 p` → **HTML:** `<div class="wrap"><h2></h2><p></p></div>`
- **XTPL:** `div.test[data-href="test/index"] h1 translate:pagecaptions.test_index ul#mylist li input[type="text"][readonly="readonly"]` 
  → **HTML:** `<div class="test" data-href="test/index"><h1>{{pagecaptions.test_index}}</h1><ul id="mylist"><li><input type="text" readonly="readonly"></li></ul></div>`

### View Templates:

Die View-Templates sollten folgendermaßen benannt sein: **view.controllername.viewname.xtpl**

Beispiel: **view.index.index.xtpl**

## Translations

Die Übersetzungen sind im Verzeichnis **translations/** gespeichert. Die Hauptsprache ist Englisch (`translations/en/`). Andere Sprachen befinden sich im gleichen Verzeichnis.

### Beispiel einer **l18n.json**:
```json
{
    "titles": {
        "welcome": "Welcome",
        "goodbye": "Goodbye"
    }
}
```

Die Übersetzungen werden in den Templates mit folgendem Syntax verwendet:

```plaintext
translate:index_welcome
```

## Links

Um zwischen Seiten einer Website zu navigieren, kannst du entweder die Methode **RouterClass.redirect()** oder das Attribut **data-href** verwenden.

### Beispiel:

```javascript
RouterClass.redirect('index/imprint');
```

Oder im HTML:
```html
<div data-href="index/imprint">Impressum</div>
```

Das **transform_datahref()** fügt Klick-Events zu den Elementen mit dem **data-href** Attribut hinzu.

### Beispiel:

```javascript
let dom = document.createElement('div');
dom.setAttribute('data-href', 'index/imprint');
transform_datahref(dom);
document.body.appendChild(dom);
```

## Wichtige Klassen

### XUser (in xuser.class.php)

Die **XUser** Klasse verwaltet Benutzerinformationen und -rechte. Sie bietet Methoden, um Benutzer anhand des Namens oder der E-Mail zu laden und Anmeldungen zu verarbeiten.

#### Wichtige Methoden:
- **`load_by_name($name)`**: Lädt einen Benutzer anhand des Namens.
- **`load_by_email($email)`**: Lädt einen Benutzer anhand der E-Mail.
- **`login()`**: Verarbeitet die Anmeldung des Benutzers und setzt ein Login-Cookie.

### RouterClass (in router.class.js)

Die **RouterClass** verarbeitet URL-Hashes und navigiert zu den entsprechenden Controller-View-Kombinationen.

#### Wichtige Methoden:
- **`route()`**: Extrahiert den aktuellen Controller und die View aus dem URL-Hash.
- **`redirect($path)`**: Leitet zu einem neuen Pfad weiter.

### TranslationClass (in translation.class.php)

Verarbeitet Übersetzungen anhand von Schlüsseln und gibt die entsprechende Übersetzung aus der **TRANSLATIONS** Variable zurück.

#### Wichtige Methoden:
- **`fetch_translation()`**: Holt die Übersetzung für einen gegebenen Schlüssel.
- **`set_language($lang)`**: Setzt die aktuelle Sprache.

### PageClass

Die **PageClass** verwaltet die Struktur einer Seite und enthält Titel und Templates.

### TemplateClass

Die **TemplateClass** lädt und rendert Templates aus den **.xtpl** Dateien.

### File (in file.class.php)

Verarbeitet Dateien, lädt Inhalte und bietet Methoden für den Umgang mit Dateipfaden, Erweiterungen und Inhalten.

#### Wichtige Methoden:
- **`get_content()`**: Lädt den Inhalt einer Datei.
- **`get_json()`**: Lädt JSON-Inhalte aus einer Datei.

## Beispiel für die Verwendung von Templates:

```javascript
let Page = new PageClass();
Page.title = 'Meine Seite';
Page.Template = new TemplateClass('view.index.index');
```

## Weitere Hilfsfunktionen

- **uc_first(string)**: Wandelt den ersten Buchstaben eines Strings in einen Großbuchstaben um.
- **is_dom(element)**: Überprüft, ob ein Element ein DOM-Objekt ist.
- **generate_id(length)**: Erzeugt eine zufällige ID.
- **length(input)**: Bestimmt die Länge eines Strings, einer Zahl oder eines Arrays/Objekts.


## RouterClass

The `RouterClass` handles URL hash navigation using the format `#!controller/view/parameter1/parameter2`. It parses the URL and redirects to the correct controller and view combination.

**Main methods:**
- `route()`: Parses the URL and returns the controller, view, and up to three parameters.
- `redirect(path)`: Redirects to a new route by changing the URL hash.

---

## Translations

The `TranslationClass` provides dynamic translations. Translations are stored in files like `l18n.json` and accessed via keys.

**Usage examples:**
- In templates: `translate:captions.users.view`
- In JS: `new TranslationClass('messages.no_tasks_found').result;`

**Main method:**
- `fetch_translation()`: Fetches the translation for a given key. If the key is missing, it returns a fallback error message like `[Missing Translation::key]`.

---

## Template Style

Templates are written using a simplified Emmet-like syntax. Data is passed via `data-attributes` and translations are dynamically inserted.

**Example:**
```javascript
h1.page_caption
    translate:captions.users.view
    span[data-uservar="name"]
h2
    translate:words.karma
div.karmabar[data-karma]
    div.karmabar_bar
ul[data-mytasks]
```

**Main points:**
- `translate:key`: For dynamic translations.
- `data-uservar="name"`: Placeholder for dynamic data from JS.

---

## Controller Style

Controllers manage loading templates, routing, and fetching data. Each controller extends the `ControllerClass`.

**Example:**
In the `view_view()` method, use `get_object_cached` to fetch user data and update the template dynamically.

**Main points:**
- Use `route()` to parse the URL and get parameters.
- Use `get_object_cached()` for API requests with caching (e.g., user data or tasks).
- Update the template using `data-attributes` and dynamically insert content.

## Translations
All translations must be defined statically in the **`translations.json`** format to avoid dynamic constructions. This is especially important for error messages, which must directly reference the specific field.

Example:
- **Incorrect Format**: `sprintf(_('errors.tasks.missing_field'), $field_config['label']);`
- **Correct Format**: ` _('errors.tasks.missing_field.' . $field_name)`

Each field name in forms receives a specific key in the **`translations.json`** file. Examples of static keys in **`translations.json`**:
```json
{
    "errors": {
        "tasks": {
            "missing_field.title": "The title field is required.",
            "min_length.description": "The description field must be at least 10 characters long."
        }
    }
}
```

## Error Handling
Error messages should be pre-configured for each validation and defined in **`translations.json`** for direct access without additional transformations. Error keys are composed of the **form section**, **field name**, and **error type**.

### Example Structure for `task/create`:
- **Field missing**: `errors.tasks.missing_field.title`
- **Minimum length not met**: `errors.tasks.min_length.title`
- **Invalid value**: `errors.tasks.invalid_number.duration`

## Success Callbacks
Success callbacks for actions should be consistently formatted as follows:

```javascript
function callback_task_create_success() {
    (new RouterClass()).redirect('index/index');
    setTimeout('location.reload(true)', 100);
}
```

### Explanation:
1. **Redirect**: Success callbacks always redirect to a standard page (e.g., the homepage) using `RouterClass`.
2. **Page Reload**: Reloading the page after a short delay ensures the user interface is updated.

### Application for Other Success Callbacks:
Example for other forms like **user registration**:
```javascript
function callback_user_registration_success() {
    (new RouterClass()).redirect('users/overview');
    setTimeout('location.reload(true)', 100);
}
```

## Objects Path
In Xtreme Framework, objects/**/*.php files are API-like endpoints accessible via paths like BASEURL . 'captcha/image'.
Framework Auto-Load: Every request to these paths loads the full framework with session handling and utilities ready.
Session: Session is automatically started, so session variables (e.g., $_SESSION['captcha_code']) are available immediately.
JSON Responses: Use Response::ajax(data, status_code, errors) for JSON responses with data and error handling.
File/Image Responses: For binary content like images, set App::$mime (e.g., image/png) and stream with Response::deliver(content).
Example: objects/captcha/image.php generates a Captcha image accessible at BASEURL . 'captcha/image', stores the code in $_SESSION['captcha_code'], sets App::$mime = 'image/png', and delivers with Response::deliver(image_data).
