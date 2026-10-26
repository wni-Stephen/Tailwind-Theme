<template>
  <div class="relative font-sans w-full">
      <div class="absolute z-0 inset-0 pointer-events-none opacity-50">
          <div class="fade_slider embla w-full h-full" ref="emblaBackground">
              <div class="embla__container flex h-full w-full">
                  <slot name="background" class="w-full"></slot>
              </div>
          </div>
      </div>
      <div class="w-full">
          <div v-if="arrows && scrollSnaps.length > 1" class="absolute top-0 right-0 flex justify-between gap-4 z-10 items-center" data-aos="fade">
              <div class="w-full flex justify-between flex-row items-center relative">
                  <div class="flex absolute top-0 right-0">
                      <button type="button"
                          class="h-14 w-14 bg-red hover:bg-darkred duration-200 transition-colors ease-in-out flex items-center justify-center"
                          @click="scrollPrev" aria-label="Previous">
                          <arrow class="w-4 h-4 stroke-2 transition text-white left-arrow"></arrow>
                      </button>
                      <button type="button"
                          class="h-14 w-14 bg-red hover:bg-darkred duration-200 transition-colors ease-in-out flex items-center justify-center"
                          @click="scrollNext" aria-label="Next">
                          <arrow class="w-4 h-4 stroke-2 rotate-45 transition text-white"></arrow>
                      </button>
                  </div>
              </div>
          </div>

          <div class="embla h-full relative w-full" ref="emblaNode">
              <div class="embla__container flex h-full w-full mx-auto">
                  <slot></slot>
              </div>
          </div>
          <div v-if="pagination && scrollSnaps.length > 1" class="mt-8 flex justify-center items-center gap-2 h-6">
              <span class="rounded w-2 h-2 transition-all" v-for="(dot, index) in scrollSnaps"
                  @click="scrollTo(index)"
                  :class="{ 'bg-red-500 w-6': selectedIndex === index, 'bg-gray-200': selectedIndex !== index }"
                  :key="index"></span>
          </div>
      </div>
  </div>
</template>

<script>
import { watchEffect, ref, computed, onUnmounted } from "vue";
import emblaCarouselVue from "embla-carousel-vue";

export default {
  name: 'ImageSlider',
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
