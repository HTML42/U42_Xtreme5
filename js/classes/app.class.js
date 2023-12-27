class AppClass {
  constructor() {
    this.mime = 'text/html';
    this.encoding = 'UTF-8';
    this.dom_created = false;
  }

  set_mime(mime) {
    this.mime = mime;
  }

  get_mime() {
    return this.mime;
  }

  set_encoding(encoding) {
    this.encoding = encoding;
  }

  get_encoding() {
    return this.encoding;
  }

  render() {
    if(!this.dom_created) {
      this.dom_created =  true;
      let Template_body = new TemplateClass('body');
      let Template_head = new TemplateClass('head');
      console.log(Template_body.content);
      document.head.append(Template_head.dom);
      document.body.append(Template_body.dom);
    }
  }
}

var App = new AppClass();
