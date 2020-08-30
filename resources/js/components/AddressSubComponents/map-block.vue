<template>
  <div class="row">
    <div v-if="center !== null" class="col-md-12">
      <gmap-map :center="center" :zoom="12" style="width:100%;  height: 300px;">
        <gmap-marker
          :key="index"
          v-for="(m, index) in markers"
          :position="m.position"
          @click="center=m.position"
        ></gmap-marker>
      </gmap-map>
    </div>
  </div>
</template>

<script>
import * as VueGoogleMaps from "vue2-google-maps";

export default {
  props: {
    address: {
      required: true
    }
  },
  data() {
    return {
      center: null,
      markers: []
    }
  },
  methods: {
    loadMap(address) {
      const marker = {
          lat: +address.latitude,
          lng: +address.longitude
        }
        console.log(JSON.stringify(marker))
        this.markers.push({ position: marker })
        this.center = marker
    }
  },
  watch: {
    address: function (newVal, oldVal) {
      if (newVal.address.trim() !== '') {
        this.loadMap(newVal)
      }
    }
  }
}
</script>

<style>
</style>