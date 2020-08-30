<template>
  <div>
    <map-block :address="mapAddress"></map-block>
    <search-field v-on:addressAdded="addressAdded"></search-field>
    <address-table
      v-on:updateAddressTable="fetchAddresses"
      v-on:updateMap="updateMap"
      :addresses="addresses"
      :paginator="paginator"
    ></address-table>
  </div>
</template>

<script>
import MapBlock from './AddressSubComponents/map-block'
import SearchField from './AddressSubComponents/search-fields'
import addressTable from './AddressSubComponents/address-table'

import axios from 'axios'

export default {
  components: {
    MapBlock,
    SearchField,
    addressTable
  },
  data() {
    return {
      addresses: [],
      mapAddress: '',
      paginator: {
        current_page: 1,
        next_page_url: null,
        prev_page_url: null
      }
    }
  },
  mounted() {
    this.fetchAddresses()
  },
  methods: {
    async fetchAddresses(url = null) {
      if (!url) {
        url = `/api/address`
      }
      const response = await axios.get(url)
      this.addresses = response.data.data
      this.paginator.next_page_url = response.data.next_page_url
      this.paginator.prev_page_url = response.data.prev_page_url
      this.paginator.current_page  = response.data.current_page
    },
    async addressAdded(input) {
      this.fetchAddresses(input.url)
      this.mapAddress = {
        'address': input.address,
        'longitude': input.longitude,
        'latitude': input.latitude
      }
      console.log(JSON.stringify(this.mapAddress))
    },
    async updateMap(address) {
      this.mapAddress = address
    }
  }
}
</script>

<style>
</style>