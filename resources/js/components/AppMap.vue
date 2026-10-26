<template>
  <div class="relative h-full w-full">
    <l-map
      :use-global-leaflet="false"
      :zoom="zoom"
      :minZoom="minZoom"
      :maxZoom="maxZoom"
      :center="center"
      :options="options"
      class="z-0"

    >
      <l-tile-layer :url="url" :attribution="attribution" />
      <l-marker :lat-lng="center" @click="$refs.directions.show()">
        <l-icon :icon-anchor="staticAnchor" :icon-size="[20, 35]">
          <svg xmlns="http://www.w3.org/2000/svg" class="w-6 text-secondary-500" viewBox="0 0 365 560" fill="currentColor">
            <path fill-rule="evenodd" d="M182.9,551.7c0,0.1,0.2,0.3,0.2,0.3S358.3,283,358.3,194.6c0-130.1-88.8-186.7-175.4-186.9   C96.3,7.9,7.5,64.5,7.5,194.6c0,88.4,175.3,357.4,175.3,357.4S182.9,551.7,182.9,551.7z M122.2,187.2c0-33.6,27.2-60.8,60.8-60.8   c33.6,0,60.8,27.2,60.8,60.8S216.5,248,182.9,248C149.4,248,122.2,220.8,122.2,187.2z" clip-rule="evenodd" />
          </svg>
        </l-icon>
      </l-marker>
    </l-map>

    <modal ref="directions">
      <div class="p-8">
        <slot />
      </div>
    </modal>
  </div>
</template>
<script>
/*
import { Icon } from 'leaflet'

delete Icon.Default.prototype._getIconUrl
Icon.Default.mergeOptions({
	iconRetinaUrl: '',
	iconUrl: '',
	shadowUrl: ''
})
*/
//import "leaflet/dist/leaflet.css";
import { LMap, LTileLayer, LIcon, LMarker } from "@vue-leaflet/vue-leaflet";

export default {
	name: 'AppMap',
  components: {
    LMap,
    LTileLayer,
    LIcon,
    LMarker
  },
  props: {
    center: {
      type: Array,
      required: true
    }
  },
	data () {
		return {
      popup: false,
      url: 'https://tile.jawg.io/jawg-light/{z}/{x}/{y}{r}.png?access-token=omj6cmUkVmn2L0vrJBy9I7zmpPzti8gFHV15FJbKtDX6uwjIa2ska1THaIMRm4X0',
			attribution: '',
      subdomains: 'abcd',
			zoom: 13,
			minZoom: 6,
			maxZoom: 16,
			staticAnchor: [10, 17],
      options: {
        scrollWheelZoom: false
      }
		}
	}
}
</script>
