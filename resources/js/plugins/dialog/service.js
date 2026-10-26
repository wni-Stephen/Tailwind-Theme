import dialog from "./dialog.vue";
import elements from "./elements.js";
import events from "./events";

const service = (globalOptions = {}) => {
  return {
    show(options = {}) {
      return elements.mountElement(dialog, {
        props: { ...globalOptions, ...options },
      });
    },
    clear() {
      events.$emit("dialog-clear");
    },
  };
};

export default service;
