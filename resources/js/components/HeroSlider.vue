<template>
  <div class="relative">
    <div v-if="arrows" class="mb-4">
      <button type="button" aria-label="Previous" title="Previous" @click="scrollPrev">
        <arrow class="w-10 h-5 stroke-2 rotate-180 hover:text-primary-500 transition"></arrow>
      </button>
      <button type="button" aria-label="Next" title="Next" @click="scrollNext">
        <arrow class="w-10 h-5 stroke-2 hover:text-primary-500 transition"></arrow>
      </button>
    </div>
       <div class="embla overflow-hidden" ref="emblaNode">
        <div class="embla__container flex lg:justify-start">
          <slot></slot>
        </div>
    </div>
    <div class="px-6 w-full lg:w-10/12 max-w-screen-2xl mx-auto relative text-left">
    <div v-if="pagination && scrollSnaps.length > 1" class=" flex flex-row justify-start gap-2 absolute left-12 lg:left-auto md:right-0 bottom-16">
      <button
        class="rounded-full w-3 h-3 transition-all"
        v-for="(dot, index) in scrollSnaps"
        @click="scrollTo(index)"
        :class="{ 'bg-white active-dot w-8': selectedIndex === index,  'bg-[#FFFFFF4D]': selectedIndex !== index }"
        :key="index"
      ></button>
    </div>
    </div>

  </div>
</template>

<script>
import { watchEffect, ref } from "vue";
import emblaCarouselVue from "embla-carousel-vue";
import { WheelGesturesPlugin } from 'embla-carousel-wheel-gestures'
export default {
    name: 'HeroSlider',
    props: {
      tagline: {
        type: String,
        required: false
      },
      pagination: {
        type: Boolean,
        required: false
      },
      arrows: {
        type: Boolean,
        required: false
      }
    },
    setup() {
      const [emblaNode, emblaApi] = emblaCarouselVue({
        loop: true,
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
