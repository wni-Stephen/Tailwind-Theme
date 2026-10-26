<template>
    <div class="relative h-full font-sans w-full">
        <div class="absolute z-0 inset-0 pointer-events-none opacity-50">
            <div class="fade_slider embla w-full h-full" ref="emblaBackground">
                <div class="embla__container flex h-full w-full">
                    <slot name="background" class="w-full"></slot>
                </div>
            </div>
        </div>
        <div class="px-6 w-full max-w-screen-2xl lg:w-10/12 mx-auto h-full">

            <div v-if="arrows" class="absolute top-0 inset-x-6 flex justify-between gap-4 z-10 items-center lg:pr-1">

                <div
                    class="lg:w-10/12 max-w-screen-2xl mx-auto flex justify-between flex-row items-center relative w-full px-6">
                    <p class="text-2xl leading-tight py-6 font-sans font-extrabold uppercase xl:pt-24 pl-10">Latest News
                    </p>

                    <div class="flex absolute top-0 right-0">
                        <button type="button"
                            class="h-14 w-14 bg-black hover:bg-[#888782] duration-200 transition-colors ease-in-out flex items-center justify-center"
                            @click="scrollPrev" aria-label="Previous">
                            <arrow class="w-4 h-4 stroke-2 transition text-white left-arrow"></arrow>
                        </button>
                        <button type="button"
                            class="h-14 w-14 bg-black hover:bg-[#888782] duration-200 transition-colors ease-in-out flex items-center justify-center"
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
import { watchEffect, ref, onUnmounted, computed } from "vue"
import emblaCarouselVue from "embla-carousel-vue"
import { WheelGesturesPlugin } from 'embla-carousel-wheel-gestures'
export default {
    name: 'LatestNewsSlider',
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
            containScroll: 'keepSnaps',
            dragFree: false,
        }, [WheelGesturesPlugin()]);

        const [emblaBackground, emblaBackgroundApi] = emblaCarouselVue({
            loop: false,
            align: 'start',
            containScroll: 'keepSnaps'
        }, [])

        let selectedIndex = ref(0);
        let scrollSnaps = ref([]);

        const scrollNext = () => emblaApi.value.scrollNext();
        const scrollPrev = () => emblaApi.value.scrollPrev();
        const scrollTo = (index) => emblaApi.value.scrollTo(index);

        const dots = computed(() => {
            return emblaApi.value?.scrollSnapList() || []
        });

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

        const onSelect = () => {
            if (!emblaApi.value || !emblaBackgroundApi.value) return;

            const contentSlides = emblaApi.value.slideNodes();
            const backgroundSlides = emblaBackgroundApi.value.slideNodes();

            contentSlides.forEach(slide => slide.classList.remove("is-active"));
            backgroundSlides.forEach(slide => slide.classList.remove("is-active"));

            selectedIndex.value = emblaApi.value.selectedScrollSnap();

            const currentContentSlide = contentSlides[selectedIndex.value];
            const currentBackgroundSlide = backgroundSlides[selectedIndex.value];

            if (currentContentSlide) currentContentSlide.classList.add("is-active");
            if (currentBackgroundSlide) currentBackgroundSlide.classList.add("is-active");

            emblaBackgroundApi.value.scrollTo(selectedIndex.value);
        };

        const toggleEmblaReady = (event) => {
            if (!emblaBackgroundApi.value) return;
            const isResizeEvent = event === "resize";

            const toggleClass = isResizeEvent ? "remove" : "add";
            emblaBackground.value.classList[toggleClass]("slider--is-ready");
            if (isResizeEvent) emblaNode.value.reInit();

        };

        watchEffect(() => {
            if (!emblaApi.value) return;
            emblaApi.value.on("select", onSelect);
            emblaApi.value.on('reInit', onInit);
            emblaApi.value.on("init", toggleEmblaReady)
            emblaApi.value.on("resize", toggleEmblaReady)
            emblaApi.value.on("reInit", toggleEmblaReady);
            onSelect();
            onInit();
        })

        return {
            emblaNode,
            emblaApi,
            emblaBackground,
            emblaBackgroundApi,
            scrollSnaps,
            scrollNext,
            scrollPrev,
            scrollTo,
            selectedIndex,
        }

    }

}
</script>