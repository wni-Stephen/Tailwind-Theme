<script>
import { XMarkIcon } from '@heroicons/vue/24/solid'
export default {
  components: { XMarkIcon },
  props: {
    variant: {
      type: String,
      required: false
    }
  },
  data() {
    return {
      open: false,
      params: undefined
    }
  },
  methods: {
    show(params = undefined) {
      if(params){
        this.params = params
      }
      this.open = true
      //document.getElementsByTagName('html')[0].classList.add('overflow-hidden')
      window.lenis.stop()
      this.$emit('modal', this.open)
    },
    close() {
      this.open = false
    //  document.getElementsByTagName('html')[0].classList.remove('overflow-hidden')
      window.lenis.start()
      this.$emit('modal', this.open)
    }
  },
  computed: {
    classes() {
      switch (this.variant) {
        case 'drawer':
          return {
            wrapper: 'fixed inset-0 z-50 pointer-events-none',
            modal: 'pointer-events-auto w-full text-center right-0 top-0 h-screen bg-darkpurple text-white shadow-lg fixed flex flex-col overflow-y-auto',

            overlayEnterClass: 'opacity-0',
            overlayEnterActiveClass: 'transition ease-in-out duration-300',
            overlayEnterToClass: 'opacity-100',
            overlayLeaveClass: 'opacity-100',
            overlayLeaveActiveClass: 'transition ease-in-out duration-300',
            overlayLeaveToClass: 'opacity-0',

            enterClass: 'translate-x-full',
            enterActiveClass: 'transition-transform transform ease-in-out duration-300',
            enterToClass: 'translate-x-0',
            leaveClass: 'translate-x-0',
            leaveActiveClass: 'transition-transform transform ease-in-out duration-300',
            leaveToClass: 'translate-x-full'
          }

        case 'video':
            return {
              wrapper: 'max-w-auto w-full lg:p-8 h-full flex items-center fixed inset-0 z-50',
              modal: 'relative w-full h-auto max-w-screen-lg max-h-full mx-auto bg-black shadow-lg flex flex-col overflow-hidden',

              overlayEnterClass: 'opacity-0',
              overlayEnterActiveClass: 'transition ease-in-out duration-300',
              overlayEnterToClass: 'opacity-100',
              overlayLeaveClass: 'opacity-100',
              overlayLeaveActiveClass: 'transition ease-in-out duration-300',
              overlayLeaveToClass: 'opacity-0',

              enterClass: 'opacity-0 translate-y-8',
              enterActiveClass: 'transition-all transform ease-in-out duration-300',
              enterToClass: 'opacity-100 translate-y-0',
              leaveClass: 'opacity-100 translate-y-0',
              leaveActiveClass: 'transition-all transform ease-in-out duration-300',
              leaveToClass: 'opacity-0 translate-y-8'
            }
        case 'team':
            return {
              wrapper: 'max-w-auto w-full lg:p-8 h-full flex items-center fixed inset-0 z-50',
              modal: 'relative w-full h-auto max-w-xl max-h-full mx-auto bg-black text-white shadow-lg flex flex-col overflow-y-auto rounded-[10px]',

              overlayEnterClass: 'opacity-0',
              overlayEnterActiveClass: 'transition ease-in-out duration-300',
              overlayEnterToClass: 'opacity-100',
              overlayLeaveClass: 'opacity-100',
              overlayLeaveActiveClass: 'transition ease-in-out duration-300',
              overlayLeaveToClass: 'opacity-0',

              enterClass: 'opacity-0 translate-y-8',
              enterActiveClass: 'transition-all transform ease-in-out duration-300',
              enterToClass: 'opacity-100 translate-y-0',
              leaveClass: 'opacity-100 translate-y-0',
              leaveActiveClass: 'transition-all transform ease-in-out duration-300',
              leaveToClass: 'opacity-0 translate-y-8'
            }
        default:
          return {
            wrapper: 'max-w-auto w-full lg:p-8 h-full flex items-center fixed inset-0 z-50',
            modal: 'relative w-full h-auto max-w-lg max-h-full mx-auto bg-white shadow-lg flex flex-col overflow-y-auto',

            overlayEnterClass: 'opacity-0',
            overlayEnterActiveClass: 'transition ease-in-out duration-300',
            overlayEnterToClass: 'opacity-100',
            overlayLeaveClass: 'opacity-100',
            overlayLeaveActiveClass: 'transition ease-in-out duration-300',
            overlayLeaveToClass: 'opacity-0',

            enterClass: 'opacity-0 translate-y-8',
            enterActiveClass: 'transition-all transform ease-in-out duration-300',
            enterToClass: 'opacity-100 translate-y-0',
            leaveClass: 'opacity-100 translate-y-0',
            leaveActiveClass: 'transition-all transform ease-in-out duration-300',
            leaveToClass: 'opacity-0 translate-y-8'
          }
      }
    },
  },
}
</script>

<template>
  <Teleport to="body">
    <Transition
      :enter-from-class="classes?.overlayEnterClass"
      :enter-active-class="classes?.overlayEnterActiveClass"
      :enter-to-class="classes?.overlayEnterToClass"
      :leave-from-class="classes?.overlayLeaveClass"
      :leave-active-class="classes?.overlayLeaveActiveClass"
      :leave-to-class="classes?.overlayLeaveToClass"
    >
      <div v-if="open" @click="close()" class="z-40 h-screen w-screen inset-0 fixed bg-gray-900 bg-opacity-25 backdrop-blur-sm"></div>
    </Transition>
    <Transition
      :enter-from-class="classes?.enterClass"
      :enter-active-class="classes?.enterActiveClass"
      :enter-to-class="classes?.enterToClass"
      :leave-from-class="classes?.leaveClass"
      :leave-active-class="classes?.leaveActiveClass"
      :leave-to-class="classes?.leaveToClass"
    >
      <div v-if="open" :class="classes?.wrapper">
        <div :class="classes?.modal">
          <button @click="close()" type="button" class="leading-none flex items-center justify-center absolute right-0 top-0 md:right-6 md:top-6 lg:right-[50px] lg:top-[50px] z-10 p-1.5 m-2 h-10 w-10 transition focus:ring-2 focus:ring-brightgreen focus:outline-none focus:ring-opacity-25 text-white stroke-white">
            <XMarkIcon class="current-color h-10 w-10 stroke-1" />
          </button>
          <slot name="header" />
          <slot :params="params" />
          <slot name="footer" />
        </div>
      </div>
    </Transition>
  </Teleport>
</template>
