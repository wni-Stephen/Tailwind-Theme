<script>
  import { onMounted, ref } from 'vue';
  export default {
  emits: ['pause', 'play', 'stop'],
  name: 'VideoPlayer',
  props: {
    provider: {
      type: String,
      required: false
    },
    video_id: {
      type: [String, Number],
      required: false
    },
    video_poster: {
      type: String,
      required: false
    },
    progressive: {
      type: Boolean,
      required: false
    },
    autoplay:{
      type: Boolean,
      required: false,
      default: false
    }
  },
  setup(props, ctx) {
    const player = ref(null)
    onMounted(async () => {
        const Plyr = await import("plyr")
        const newPlayer = new Plyr.default(player.value, {
          autoplay: props.autoplay
        })

        newPlayer.on('pause', () => ctx.emit('pause'))
        newPlayer.on('play', () => ctx.emit('play'))
        newPlayer.on('ended', () => ctx.emit('ended'))
    });
    return {
      player
    }
  }
}
</script>

<template>
  <div class="overflow-hidden relative">

    <video v-if="video_poster" ref="player" playsinline controls crossorigin :data-poster="video_poster">
      <slot />
    </video>
    <div v-else-if="provider==='youtube' && progressive" ref="player" class="plyr__video-embed">
      <iframe
         :src="`https://www.youtube.com/embed/${video_id}?origin=https://palebluedot.tv&amp;iv_load_policy=3&amp;modestbranding=1&amp;playsinline=1&amp;showinfo=0&amp;rel=0&amp;enablejsapi=1`"
         allowfullscreen
         allowtransparency
         allow="autoplay"
       ></iframe>
    </div>
    <div v-else-if="provider==='vimeo' && progressive" ref="player" class="plyr__video-embed">
      <iframe
         :src="`https://player.vimeo.com/video/${video_id}?loop=false&amp;byline=false&amp;portrait=false&amp;title=false&amp;speed=true&amp;transparent=0&amp;gesture=media&amp;controls=false&amp;autoplay=true&amp;muted=true`"
         allowfullscreen
         allowtransparency
         allow="autoplay"
       ></iframe>
    </div>
    <div v-else-if="provider" ref="player" :data-plyr-provider="provider" :data-plyr-embed-id="video_id"></div>
    <div v-else class="flex items-center justify-center aspect-video bg-black text-white">No Video</div>
  </div>
</template>
