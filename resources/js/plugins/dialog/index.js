import dialog from "./dialog.vue";
import service from "./service";

dialog.install = (app, options = {}) => {
  let plugin = service(options);
  app.$dialog = plugin;
  app.config.globalProperties.$dialog = plugin;
};

export default dialog;
export { dialog, service };
