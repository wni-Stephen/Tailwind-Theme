<template>
  <div class="fixed flex flex-col items-center justify-center inset-0 z-50 overflow-hidden">
    <Transition
      :enter-from-class="classes.overlayEnterClass"
      :enter-active-class="classes.overlayEnterActiveClass"
      :enter-to-class="classes.overlayEnterToClass"
      :leave-from-class="classes.overlayLeaveClass"
      :leave-active-class="classes.overlayLeaveActiveClass"
      :leave-to-class="classes.overlayLeaveToClass"
    >
      <div v-if="show" class="z-0 h-screen w-screen inset-0 fixed bg-gray-900 bg-opacity-25 dark:bg-gray-700 dark:bg-opacity-50 backdrop-blur-sm pointer-events-none"></div>
    </Transition>
    <Transition
      :enter-from-class="classes.enterClass"
      :enter-active-class="classes.enterActiveClass"
      :enter-to-class="classes.enterToClass"
      :leave-from-class="classes.leaveClass"
      :leave-active-class="classes.leaveActiveClass"
      :leave-to-class="classes.leaveToClass"
    >
      <div v-if="show" class="absolute flex overflow-hidden shadow-lg pointer-events-auto max-w-sm w-11/12 mx-auto bg-black text-white">
        <div class="relative w-full">
          <div class="px-6 pt-6">
            <div v-if="title" class="text-white text-xl mb-2 font-sora">{{ title }}</div>
            <div class="prose lg:prose-lg font-manrope"><p>{{ message }}</p></div>
          </div>
          <div class="p-6 w-full flex gap-4">
            <button aria-label="Close" title="Close"
              class="text-sm border-2 border-transparent text-center py-2.5 px-5 bg-white text-deepgreen hover:bg-gray-100 inline-flex items-center transition-colors disabled:opacity-50 disabled:cursor-not-allowed font-sora font-medium"
              @click="Close()"
            >Ok</button>
          </div>
        </div>
      </div>
    </Transition>
  </div>
</template>

<script>
import events from "./events"
import elements from "./elements"

export default {
  name: "dialog",
  props: {
    message: {
      type: String,
      required: true,
    },
    title: {
      type: String,
      required: false,
    },
  },
  data: () => ({
    show: false,
    classes:{
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
    },
  }),
  mounted() {
    this.notify();
  //  events.$on("dialog-clean", this.Close());
  },
  methods: {
    notify() {
      document.body.insertAdjacentElement("beforeend", this.$el);
      this.show = true
    },
    Close() {
      this.show = false
      setTimeout(() => {
          elements.removeElement(this.$el);
      }, 200);


    },
  },
  beforeUnmount() {
    events.$off("dialog-clear", this.close);
  },
};
</script>
