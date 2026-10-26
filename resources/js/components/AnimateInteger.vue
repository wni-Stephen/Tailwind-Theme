<template>
  <div>
    {{ prefix }}{{ displayValue }}{{ suffix }}
  </div>
</template>
<script>
import gsap from "gsap";
export default {
  name: "AnimateInteger",
  props: {
    value: {
      type: Number,
      required: true
    },
    suffix: {
      type: String,
      required: false
    },
    prefix: {
      type: String,
      required: false
    }
  },

  mounted() {
    gsap.to(this, {
      tweenValue: this.value,
      duration: 2,
      onUpdate: () => {
        this.displayValue = Number.isInteger(this.value) ? Math.ceil(this.tweenValue).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",") : this.tweenValue.toFixed(1);
      },
    });
  },

  data() {
    return {
      displayValue: 0,
      tweenValue: 0,
    };
  },
};
</script>
