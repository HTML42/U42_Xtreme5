class TemplateClass {
    constructor(template_key) {
        this.content = null;
        this.dom = null;
        this.tag_stack = [];
        //
        if (typeof TEMPLATES[template_key] != "undefined") {
            this.content = TEMPLATES[template_key];
            this.dom = this.parse(this.content);
            this.dom.setAttribute('data-name', template_key);
        } else {
            this.content = false;
        }
    }

    parse(code) {
        if (typeof code === "string") {
            code = code.trim();
        }
        code = this.parse_prepare(code);
        code = this.parse_lines(code);
        return code;
    }
    parse_prepare(code) {
        // Verarbeite Punkte (Klassen) außerhalb von Attributen
        code = code.replace(/(?<!\[[^\]]*)(\.)([\w\d_-]+)/g, '[class="$2"]');
    
        // Verarbeite IDs
        code = code.replace(/(\#)([\w\d_-]+)/g, '[id="$2"]');
    
        // Verarbeite Attribute mit Punkten korrekt
        code = code.replace(/(\[.*?=.*?")([\w\d:/?&._-]+)(".*?\])/g, (match, start, value, end) => {
            // Punkte innerhalb von Attributwerten unangetastet lassen
            return `${start}${value}${end}`;
        });
    
        // Verarbeite mehrere Klassen für das gleiche Element korrekt
        code = code.replace(/\[class="([^"]+)"\]\[class="([^"]+)"\]/g, '[class="$1 $2"]');
    
        let lines = code.split("\n");
        let previousIndents = [0];
    
        for (let i = 0; i < lines.length; i++) {
            let currentIndent = lines[i].search(/\S|$/);
            lines[i] = lines[i].trim();
    
            if (currentIndent > previousIndents[previousIndents.length - 1]) {
                previousIndents.push(currentIndent);
            } else {
                while (
                    previousIndents.length > 1 &&
                    currentIndent < previousIndents[previousIndents.length - 1]
                ) {
                    previousIndents.pop();
                }
            }
            lines[i] = ">".repeat(previousIndents.length - 1) + lines[i];
        }
        return lines.join("\n");
    }
    
    
    parse_lines(code) {
        let lines = code.split("\n");
        let last_indent = -1;
        let dom = document.createElement("x-template");
        let parents = [];
        const tag_regex = /^(\w+[\w\d_:-]*)/;
        const partial_regex = /^(partial):(.+)/;
        lines.forEach((line) => {
            let current_indent = (line.match(/^>+/) || [""])[0].length;
            let new_element = null;
            line = line.replace(/^>+/, "");
            if (line.trim() === "") {
                return;
            }
            const is_partial = line.trim().startsWith("partial:");
            const is_translation =
                    line.trim().startsWith("translate:") ||
                    line.trim().startsWith("translation:");
            const is_tag = !is_partial && !is_translation;
            //
            if (is_tag) {
                const tag_match = line.match(tag_regex);
                if (tag_match) {
                    const tag = tag_match[1];
                    if (tag) {
                        let element = document.createElement(tag);
                        this.attach_element_atttributes(element, line);
                        new_element = element;
                    }
                }
            } else {
                let has_class = false;
                if(is_partial || is_translation) {
                    has_class = /\[class="/.test(line);
                    line = line.replace(/\[class="([^"]+)"\]/g, ".$1");
                    line = line.replace(/translat[e|ion]\:/, '');
                    line = line.trim();
                    if(has_class) {
                        line = line.replace(/\s+/, '.');
                    }
                }
                if (is_partial) {
                    const partial_key = line.replace(/^(partial):/, "").trim();
                    let Partial = new TemplateClass(partial_key);
                    new_element = Partial.dom;
                } else if (is_translation) {
                    const translation_key = line.replace(/^(partial):/, "").trim();
                    const Translation = new TranslationClass(translation_key);
                    new_element = document.createElement('x-translation');
                    new_element.translation_key = translation_key;
                    new_element.innerHTML = Translation.result;
                }
            }
            //
            if(typeof parents[current_indent] != 'object') {
                parents[current_indent] = [];
            }
            parents[current_indent].push(new_element);
            //
            if (current_indent <= 0) {
                dom.append(new_element);
            } else {
                __last_of_array(parents, current_indent - 1).append(new_element);
            }
            last_indent = current_indent;
        });
        
        function __last_of_array(_array, _index) {
            if(typeof _array[_index] == 'object') {
                if(_array[_index].length && _array[_index].length > 0) {
                    return _array[_index][_array[_index].length - 1];
                }
            }
            return {append:function(a){console.log('Append on NULL Element: ', a);}};
        }

        return dom;
    }

    attach_element_atttributes(element, attributes_string) {
        let regex = /\[([^\]]+)\]/g;
        let match;
        while ((match = regex.exec(attributes_string)) !== null) {
            let attr = match[1].split("=");
            let key = attr[0];
            let value = attr[1] ? attr[1].replace(/["']/g, "") : "";
            element.setAttribute(key, value || true);
        }
    }
}
