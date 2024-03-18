class XTemplate extends HTMLElement {
  constructor() {
    super();
  }
}
class XPartial extends HTMLElement {
  constructor() {
    super();
  }
}
class XTranslation extends HTMLElement {
  constructor() {
    super();
  }
}
customElements.define("x-template", XTemplate);
customElements.define("x-partial", XPartial);
customElements.define("x-translation", XTranslation);

setTimeout(App.render, 1);
