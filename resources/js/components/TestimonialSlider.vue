<template>
  <div class="embla overflow-hidden md:mx-0 relative" ref="emblaNode">
    <div class="embla__container flex items-stretch">
      <slot />
    </div>
  </div>
  <div v-if="pagination && scrollSnaps.length > 1" class="mt-8 flex flex-row justify-center gap-2">
      <button
        class="rounded-full w-3 h-3 transition-all"
        v-for="(dot, index) in scrollSnaps"
        @click="scrollTo(index)"
        :class="{ 'bg-deepgreen active-dot w-8': selectedIndex === index,  'bg-[#b9bebc]': selectedIndex !== index }"
        :key="index"
      ></button>
    </div>
</template>

<script>
  import { watchEffect, ref } from "vue";
  import emblaCarouselVue from "embla-carousel-vue";
  import { WheelGesturesPlugin } from 'embla-carousel-wheel-gestures'

 export default {
    name: 'TestimonialSlider',
    props: {
      pagination: {
        type: Boolean,
        required: false
      },
    },
    setup() {
      const [emblaNode, emblaApi] = emblaCarouselVue({
        loop: false,
        align: 'start',
        containScroll: 'trimSnaps'
      },[WheelGesturesPlugin()]);

      let selectedIndex = ref(0);
      let scrollSnaps = ref([]);

      const scrollNext = () => emblaApi.value.scrollNext();
      const scrollPrev = () => emblaApi.value.scrollPrev();
      const scrollTo = (index) => emblaApi.value.scrollTo(index);

      const onInit = () => {
        scrollSnaps.value = emblaApi.value.scrollSnapList() || []
      };

      const onSelect = () => {
        if (!emblaApi.value) return;
        selectedIndex.value = emblaApi.value.selectedScrollSnap();
      };

      watchEffect(() => {
        if (!emblaApi.value) return;
        emblaApi.value.on("select", onSelect);
        emblaApi.value.on('reInit', onInit);
        onSelect();
        onInit();
      })

      return {
        emblaNode,
        emblaApi,
        scrollSnaps,
        scrollNext,
        scrollPrev,
        scrollTo,
        selectedIndex,
      }

    }

  }
</script>

