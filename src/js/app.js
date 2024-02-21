import "@css/app.css";

import "lazysizes";

// Put Alpine last, so that it has access to other JS modules
import Alpine from "alpinejs";
window.Alpine = Alpine;
Alpine.start();

if (import.meta.hot) {
  import.meta.hot.accept(() => {
    console.log("HMR");
  });
}
