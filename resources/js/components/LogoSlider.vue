<template>
  <div class="relative">
    <div class="embla" ref="emblaNode">
      <div class="embla__container flex flex-row gap-4">
        <slot />
      </div>
    </div>
    <div class="flex flex-row justify-between mt-10 lg:mt-12">

      <div v-if="pagination && scrollSnaps.length > 1" class="flex flex-row justify-start gap-2">
        <button class="rounded-full w-3 h-3 transition-all" v-for="(dot, index) in scrollSnaps" @click="scrollTo(index)"
          :class="{ 'bg-deepgreen dark:bg-black active-dot w-8': selectedIndex === index, 'bg-deepgreen dark:bg-white opacity-20': selectedIndex !== index }"
          :key="index"></button>
      </div>
      <div v-if="arrows && scrollSnaps.length > 1" class="flex justify-end gap-10">
        <button type="button" aria-label="Previous" title="Previous" @click="scrollPrev">
          <arrow class="w-6 h-4 -rotate-[135deg] hover:text-midgreen transition" />
        </button>
        <button type="button" aria-label="Next" title="Next" @click="scrollNext">
          <arrow class="w-6 h-4 rotate-45 hover:text-midgreen transition" />
        </button>
      </div>
    </div>
  </div>
</template>

<script>
import { watchEffect, ref, computed, onUnmounted } from "vue";
import emblaCarouselVue from "embla-carousel-vue";

export default {
  name: 'LogoSlider',
  props: {
    arrows: {
      type: Boolean,
      required: false
    },
    pagination: {
      type: Boolean,
      required: false
    },
  },
  setup() {
    const [emblaNode, emblaApi] = emblaCarouselVue({
      loop: true,
      align: 'start',
      dragFree: false
    });
    let selectedIndex = ref(0);
    let scrollSnaps = ref([]);

    const scrollNext = () => emblaApi.value?.scrollNext();
    const scrollPrev = () => emblaApi.value?.scrollPrev();
    const scrollTo = (index) => emblaApi.value?.scrollTo(index);

    const dots = computed(() => {
      return emblaApi.value?.scrollSnapList() || []
    });

    const onSelect = () => {
      if (!emblaApi.value) return;
      selectedIndex.value = emblaApi.value.selectedScrollSnap();
    };

    const onInit = () => {
      scrollSnaps.value = emblaApi.value.scrollSnapList() || []
    };

    const autoplay = () => {
      const interval = setInterval(() => {
        if (emblaApi.value) {
          scrollNext();
        }
      }, 5000);

      return interval;
    };
    let autoplayInterval = autoplay();

    watchEffect(() => {
      if (!emblaApi.value) return;
      emblaApi.value.on("select", onSelect);
      emblaApi.value.on('reInit', onInit);
      onSelect();
      onInit();
    })

    onUnmounted(() => {
      clearInterval(autoplayInterval);
    });

    return {
      emblaNode,
      emblaApi,
      dots,
      scrollSnaps,
      scrollNext,
      scrollPrev,
      scrollTo,
      selectedIndex,
    }

  }
}
</script>
