class TemplateClass {
  constructor(template_key) {
    this.content = null;
    this.dom = null;
    this.tag_stack = [];
    //
    if (typeof TEMPLATES[template_key] != "undefined") {
      this.content = TEMPLATES[template_key];
      this.dom = this.parse(this.content);
    } else {
      this.content = false;
    }
  }

  parse(code) {
    code = this.parse_prepare(code);
    console.log(code);
    code = this.parse_lines(code);
    return code;
  }

  parse_prepare(code) {
    code = code.replace(/(\.)([\w\d_-]+)/g, '[class="$2"]');
    code = code.replace(/(\#)([\w\d_-]+)/g, '[id="$2"]');

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
    let dom = document.createElement("x-template");
    let last_indent = 0;
    const tag_regex = /^(\w+[\w\d_:-]*)/;
    const partial_regex = /^(partial):(.+)/;
    lines.forEach((line) => {
      let current_indent = (line.match(/^>+/) || [""])[0].length;
      line = line.replace(/^>+/, "");
      const is_partial = line.trim().startsWith("partial:");
      const is_translation =
        line.trim().startsWith("translate:") ||
        line.trim().startsWith("translation:");
      const is_tag = !is_partial && !is_translation;
      if (is_tag) {
        const tag_match = line.match(tag_regex);
        if (tag_match) {
          const tag = tag_match[1];
          if (tag) {
            let element = document.createElement(tag);
            this.attach_element_atttributes(element, line);
            dom.appendChild(element);
          }
        }
      } else if (is_partial) {
        const partial_key = line.replace(/^(partial):/, "").trim();
        let Partial = new TemplateClass(partial_key);
        dom.append(Partial.dom);
      } else if (is_translation) {
      }
      let last_indent = current_indent;
    });

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

  __parse_lines(code) {
    let lines = code.split("\n");
    let parsed_html = "";
    let last_indent = 0;

    lines.forEach((line) => {
      let current_indent = (line.match(/^>+/) || [""])[0].length;
      line = line.replace(/^>+/, ""); // Entferne '>'-Zeichen

      const is_partial = line.trim().startsWith("partial:");
      if (!is_partial && current_indent < last_indent) {
        // Schließe Tags entsprechend der Einrückungstiefe
        while (this.tag_stack.length > current_indent) {
          let tag = this.tag_stack.pop();
          parsed_html += `</${tag}>`;
        }
      }

      if (is_partial) {
        // Verarbeite das referenzierte Template rekursiv
        const partial_key = line.replace(/^(partial):/, "").trim();
        if (TEMPLATES[partial_key]) {
          parsed_html += this.parse(TEMPLATES[partial_key]);
        }
      } else {
        parsed_html += this.parse_line(line, current_indent);
        if (!is_partial) {
          last_indent = current_indent;
        }
      }
    });

    // Schließe alle verbleibenden Tags
    while (this.tag_stack.length > 0) {
      let tag = this.tag_stack.pop();
      parsed_html += `</${tag}>`;
    }

    return parsed_html;
  }

  __parse_line(line, current_indent) {
    const self_closing_tags = ["link", "input", "br", "hr"];
    const tag_regex = /^(\w+[\w\d_:-]*)(\[[^\]]+\])*/;
    const partial_regex = /^(partial):(.+)/;

    if (line.match(partial_regex)) {
      const partial_key = line.replace(partial_regex, "$2").trim();
      if (TEMPLATES[partial_key]) {
        let partial_html = this.parse(TEMPLATES[partial_key]);
        if (current_indent < this.tag_stack.length) {
          // Schließe alle Tags, die über der aktuellen Einrückungsebene liegen
          while (this.tag_stack.length > current_indent) {
            partial_html = `</${this.tag_stack.pop()}>` + partial_html;
          }
        }
        return partial_html;
      }
      return "";
    } else {
      const tag_match = line.match(tag_regex);
      if (tag_match) {
        const tag = tag_match[1];
        const attributes = tag_match[2]
          ? tag_match[2].replace(/[\[\]]/g, "")
          : "";
        const is_self_closing = self_closing_tags.includes(tag);
        const tag_opening = `<${tag}${attributes ? " " + attributes : ""}`;

        if (is_self_closing) {
          return tag_opening + "/>";
        } else {
          this.tag_stack.push(tag);
          return tag_opening + ">";
        }
      }
    }

    return line;
  }
}
