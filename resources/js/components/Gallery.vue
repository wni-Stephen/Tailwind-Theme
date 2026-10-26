<template>
  <div :ref="element">
    <slot />
  </div>
</template>

<script>
import PhotoSwipeLightbox from 'photoswipe/lightbox';
import 'photoswipe/style.css';
import "../../css/photoswipe.css";

export default {
  name: 'Gallery',
  data () {
    return {
      lightbox: false
    }
  },
  computed: {
    element() {
      let d = new Date().getTime()
      if (typeof performance !== 'undefined' && typeof performance.now === 'function') {
        d += performance.now()
      }
      const newGuid = 'xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx'.replace(/[xy]/g, (c) => {
        const r = (d + Math.random() * 16) % 16 | 0
        d = Math.floor(d / 16)
        return (c === 'x' ? r : (r & 0x3 | 0x8)).toString(16)
      })
      return newGuid
   }
  },
  mounted() {
    if (!this.lightbox) {
      this.lightbox = new PhotoSwipeLightbox({
        gallery: this.$refs[this.element],
        children: 'a',
        pswpModule: () => import('photoswipe'),
        bgOpacity: 1,
      });
      this.lightbox.init();
    }
  },
  unmounted() {
    if (this.lightbox) {
      this.lightbox.destroy();
      this.lightbox = null;
    }
  },
  methods: {
  },
};
</script>
