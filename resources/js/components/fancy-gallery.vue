<template>
  <section ref="main" class="fancy-gallery px-6 my-8 md:my-16 overflow-hidden">
    <div class="px-6 w-full lg:w-10/12 max-w-screen-2xl mx-auto relative">
      <gallery class="pswp-gallery grid grid-cols-2 gap-4 lg:gap-8 xl:gap-16">
        <slot />
      </gallery>
    </div>
  </section>
</template>
<script>
import gsap from "gsap";
import { onMounted, onUnmounted, ref } from 'vue';
import { ScrollTrigger } from 'gsap/ScrollTrigger';



export default {
  name: 'FancyGallery',
  setup() {

    const main = ref(null);
    const count = ref(0)
    let ctx;

      onMounted(() => {

        ctx = gsap.context((self) => {

          var posX = [-10, 20, 0, 10];
          var posY = [0, 0, 10, -10];
          var w = ['100%', '80%', '80%', '100%'];


          var end_X = [-50, 40, -100, 30];
          var end_Y = [0, -60, 20, -50];

          gsap.utils.toArray(".fancy-card", main.value).forEach(el => {

            var card = el.querySelector("a")

            gsap.set(card, {
              width: w[count.value],
              height: w[count.value]
            })

            gsap.set(el, {
              xPercent: posX[count.value],
              yPercent: posY[count.value],
              willChange: "transform"
            })


            const anim = gsap.to(el,
              {
                autoAlpha: 0,
                xPercent: end_X[count.value],
                yPercent: end_Y[count.value],
                ease: "power1.inOut",

              }
            );

            ScrollTrigger.create({
              trigger: el,
              start: "top 0",
              animation: anim,
              scrub: true
            });


            ++count.value


            if(count.value === 4) {
              count.value = 0;
            }

        })

      }, main.value, count.value);
    });
    onUnmounted(() => {
      ctx.revert();
    });
    return { main, count };
  },
};
</script>
