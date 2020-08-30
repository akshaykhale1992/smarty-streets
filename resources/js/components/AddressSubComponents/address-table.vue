<template>
  <div class="row">
    <div class="col-md-1">&nbsp;</div>
    <div class="col-md-10">
      <div v-if="!(paginator.prev_page_url === null && paginator.next_page_url === null)" class="row" style="margin-top: 10px;">
        <div class="col-md-12">
          <button
            @click="loadNextPage"
            :disabled="paginator.prev_page_url === null"
            class="btn btn-primary"
          >&lt;</button>
          <button class="btn btn-primary">{{ paginator.current_page }}</button>
          <button
            @click="loadPreviousPage"
            :disabled="paginator.next_page_url === null"
            class="btn btn-primary"
          >&gt;</button>
        </div>
      </div>
      <div class="row" style="margin-top: 10px;">
        <div class="col-md-12">
          <table class="table">
            <thead>
              <th>Address</th>
              <th>City</th>
              <th>State</th>
              <th>ZipCode</th>
              <th>Property Type</th>
              <th>Load Map</th>
            </thead>
            <tbody>
              <tr v-for="address in addresses" :key="address.id">
                <td>{{ address.address }}</td>
                <td>{{ address.city }}</td>
                <td>{{ address.state }}</td>
                <td>{{ address.zipcode }}</td>
                <td>{{ address.property_type }}</td>
                <td>
                  <button
                    @click="selectMap(address.address, address.longitude, address.latitude)"
                    class="btn btn-primary"
                  >Load Map</button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    addresses: {
      required: true
    },
    paginator: {
      required: true
    }
  },
  methods: {
    loadNextPage() {
      this.$emit('updateAddressTable', this.paginator.prev_page_url)
    },
    loadPreviousPage() {
      this.$emit('updateAddressTable', this.paginator.next_page_url)
    },
    selectMap(addressText, longitude, latitude) {
      this.$emit('updateMap', {
        'address': addressText,
        'longitude': longitude,
        'latitude': latitude
        })
    }
  }
  
}
</script>
