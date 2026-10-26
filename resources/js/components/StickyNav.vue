<template>
  <nav class="top-0 z-20 w-full navigation" :class="[home ? 'fixed bg-transparent text-white uppercase border-b border-b-[#D9D9D9]' : 'fixed border-b border-b-[#D9D9D9] font-extrabold text-black' ]">
    <div
      class="fixed w-full flex justify-between" id="nav-holder"
      :class="{
        'bg-white border-b border-b-[#D9D9D9] text-black': !view.atTopOfPage,
        }"
    >
      <slot />
    </div>
  </nav>
</template>
<script>
export default {
  name: 'StickyNav',
  props: {
    home: {
      type: Boolean,
      required: false,
      default: false
    }
  },
  data () {
    return {
        view: {
            atTopOfPage: true
        }
    }
  },

  // a beforeMount call to add a listener to the window
  beforeMount () {
      window.addEventListener('scroll', this.handleScroll);
  },

  methods: {
  	// the function to call when the user scrolls, added as a method
      handleScroll(){
          // when the user scrolls, check the pageYOffset
          if(window.pageYOffset>0){
              // user is scrolled
              document.getElementsByTagName('html')[0].classList.add('scrolled')
              if(this.view.atTopOfPage) this.view.atTopOfPage = false
          }else{
              // user is at top of page
              document.getElementsByTagName('html')[0].classList.remove('scrolled')
              if(!this.view.atTopOfPage) this.view.atTopOfPage = true
          }
      }
  }
}
</script>
