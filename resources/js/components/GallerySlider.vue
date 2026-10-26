<template>
  <div class="embla overflow-hidden -mx-6 md:mx-0 relative" ref="emblaGallerSlider">
    <div class="embla__container flex">
      <slot></slot>
    </div>
    <div class="relative text-gray-900 bottom-0">
      <div class="flex justify-center gap-8 lg:justify-end mt-4 md:mt-8">
        <button type="button" aria-label="Previous" title="Previous" @click="scrollPrev">
          <arrow class="w-10 h-5 stroke-2 rotate-180 hover:text-secondary-500 transition"></arrow>
        </button>
        <button type="button" aria-label="Next" title="Next" @click="scrollNext">
          <arrow class="w-10 h-5 stroke-2 hover:text-secondary-500 transition"></arrow>
        </button>
      </div>
    </div>
  </div>
</template>

<script>
  import emblaCarouselVue from 'embla-carousel-vue'

  export default {
    name: 'GallerSlider',
    setup() {
      const [emblaGallerSlider, emblaApi] = emblaCarouselVue({
        loop: true,
        align: 'start',
        containScroll: 'trimSnaps'
      })

      const scrollNext = () => emblaApi.value?.scrollNext();
      const scrollPrev = () => emblaApi.value?.scrollPrev();

      return {
        emblaGallerSlider,
        emblaApi,
        scrollNext,
        scrollPrev,
      }

    }
  }
</script>
