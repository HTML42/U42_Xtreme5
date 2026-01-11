# AGENTS – Empty Page Boilerplate

This guide orients AI assistants that start new projects from the Empty Page template. It summarizes the Xtreme Webframework 5 conventions, coding style, and where to find the authoritative docs.

## Must-read references
- **Project root (after copying this boilerplate):** `agents.md`, `framework.md` (quick reference), and `framework-dump.md` (current dump of framework assets). These files ship with the template and live in the project root once you start a new app.
- **Framework package (vendor / upstream):** The GitHub project for Xtreme Webframework 5 contains `Documentation.md` and `chat-gpt.md`. When the framework is installed via Composer, these live under `vendor/`—consult upstream if they are missing locally.
- **Per-project brief:** A `project.md` should exist in the project root to outline the product vision or concept—create or read it before changing features.

## Code style & structure
- **Routing:** Hash-based (`#!controller/view`). A route exists when both controller and view are present. Navigate with `RouterClass.redirect()` or set `data-href` and run `transform_datahref()`.
- **Controllers:** Classes in `js/controller/*.controller.js` named `NameController extends ControllerClass`. Views are `view_<name>()` methods returning a `PageClass` with `title` and `Template`.
- **Templates (XTPL):** Files `templates/view.<controller>.<view>.xtpl`. Use Emmet-like syntax with translation keys or `data-*` placeholders—avoid raw text nodes. **No blank lines** inside `.xtpl` files (including the end). Each attribute gets its own brackets (`[attr="value"]`).
- **Translations:** Stored under `translations/<lang>/l18n.json` (plus any language-specific HTML). Keys are static and hierarchical (e.g., `section.key`). In JS use `(new TranslationClass('key')).result`; in templates use `translate:key`.
- **Links & navigation:** Prefer `RouterClass.redirect('controller/view')`. Alternatively, set `data-href` then run `transform_datahref()` on the DOM.
- **Objects / API endpoints:** PHP objects under `php/objects/**/*.php` respond via `Response::ajax($data, $status, $errors)`. Leave `$data` empty on errors and return error keys instead.
- **Caching (server):** Read with `Cache::get($key, $ttl)`, write with `Cache::set($key, $value)`. See examples such as `php/objects/user/account_get.php` in the framework dump.
- **Styles:** Use CSS/LESS variables `_tiny`, `_small`, `_normal`, `_big`, `_huge` (not `_large`). Prefer existing mixins (`.h()`, `.xbutton`, `.xform`, etc.) for components.
- **Datenbanktabellen (Naming):** Normale Tabellen sind **ein Wort** und **immer plural** (zwei Wörter werden zusammengeschrieben ohne `_`). Zuweisungstabellen nutzen **zwei Wörter mit `_`**: meist `plural_plural` für n:m-Beziehungen; in Sonderfällen kann eine Seite **singular** sein, um die Richtung/Art der Relation zu zeigen.
- **Datenbankstruktur:** Wir legen **keine** Tabellen- oder Metadateien manuell an. Es wird **nur** die Konfiguration in `db.phb` gepflegt.
- **Formulare:** Formulare sollen über die **Konfiguration** erstellt werden, damit Validierung und Metadaten zentral definiert sind und später im JavaScript verfügbar sind.

## Tips for AI-driven changes
- Create translation keys before referencing them in templates/JS.
- Use `TemplateClass` and `PageClass` instead of rendering raw HTML.
- Keep the boilerplate minimal—Empty Page is the starting point for new apps, so follow the global rules from the referenced docs.
- Check `project.md` for project-specific goals before altering behavior.

## File locations (relative to project root once the template is copied)
- This guide: `agents.md`.
- Framework quick refs: `framework.md`, `framework-dump.md` (both at project root).
- Upstream framework docs: Xtreme Webframework 5 GitHub project and the installed copy under `vendor/` (`Documentation.md`, `chat-gpt.md`).
- Project brief: `project.md` in the project root.
