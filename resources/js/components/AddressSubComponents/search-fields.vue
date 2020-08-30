<template>
  <div class="row" style="margin-top: 20px;">
    <div class="col-md-12">
      <div class="row">
        <div class="col-md-1">&nbsp;</div>
        <div class="col-md-4">
          <input
            list="suggestions"
            @change="selectAddress"
            @input="searchAddress"
            type="text"
            class="form-control"
            placeholder="Address"
            v-model="addressDetails.address"
          />
          <datalist id="suggestions">
            <option
              v-for="(suggestion, index) in suggestions"
              :key="index"
              :value="suggestion.text"
            ></option>
          </datalist>
        </div>
        <div class="col-md-2">
          <input type="text" v-model="addressDetails.city" class="form-control" placeholder="City" />
        </div>
        <div class="col-md-2">
          <input
            type="text"
            v-model="addressDetails.state"
            class="form-control"
            placeholder="State"
          />
        </div>
        <div class="col-md-2">
          <input
            type="text"
            v-model="addressDetails.zipcode"
            class="form-control"
            placeholder="ZipCode"
          />
        </div>
      </div>
      <div class="row" style="margin-top: 10px;">
        <div class="col-md-1">&nbsp;</div>
        <div class="col-md-2" v-for="(propertyType, index) in property_types" :key="index">
          <label :for="propertyType">
            <img
              style="cursor:pointer;"
              :src="'img/' + propertyType + '.png'"
              width="100%"
              height="auto"
            />
            <br />
          </label>
          <div style="text-align: center; margin-top: -55px;">
            <input
              :id="propertyType"
              type="radio"
              :value="propertyType"
              v-model="addressDetails.property_type"
            />
          </div>
        </div>
      </div>
      <div class="row" style="margin-top: 40px;text-align: right;">
        <div class="col-md-1">&nbsp;</div>
        <div class="col-md-10">
          <button @click="addAddress" class="btn btn-primary">Add Address</button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios'

export default {
  data() {
    return {
      suggestions: [],
      search:'',
      property_types: ['single_home', 'condo', 'multifamily', 'land', 'other'],
      addressDetails: {
        address: '',
        city: '',
        state: '',
        zipcode: '',
        latitude: '',
        longitude: '',
        property_type: 'single_home'
      }
    }
  },
  methods: {
    resetControls() {
      this.suggestions = []
      this.search = '',
      this.addressDetails = {
        address: '',
        city: '',
        state: '',
        zipcode: '',
        latitude: '',
        longitude: '',
        property_type: 'single_home'
      }
    },
    async searchAddress() {
      let response = await axios.get(`/api/search?q=${this.addressDetails.address}`)
      this.suggestions = response.data.suggestions
    },
    async selectAddress() {
      let response = await axios.get(`/api/search?q=${this.addressDetails.address}`)
      this.addressDetails.address = response.data.suggestions[0].text
      this.addressDetails.city = response.data.suggestions[0].city
      this.addressDetails.state = response.data.suggestions[0].state
      let zipcodeApiResponse = await axios.get(`/api/search-zip?city=${this.addressDetails.city}&state=${this.addressDetails.state}`)
      this.addressDetails.zipcode = zipcodeApiResponse.data.zipCodes[0].zipcode
      this.addressDetails.latitude = zipcodeApiResponse.data.zipCodes[0].latitude
      this.addressDetails.longitude = zipcodeApiResponse.data.zipCodes[0].longitude
    },
    async addAddress() {
      let response = await axios.post(`/api/address`, {
        address: this.addressDetails.address,
        city: this.addressDetails.city,
        state: this.addressDetails.state,
        zipcode: this.addressDetails.zipcode,
        latitude: this.addressDetails.latitude,
        longitude: this.addressDetails.longitude,
        property_type: this.addressDetails.property_type,
        sa_country: 'US',
        ga_country: 'US'
      })
      this.$emit('addressAdded', {
        url: null,
        address: this.addressDetails.address,
        longitude: this.addressDetails.longitude,
        latitude: this.addressDetails.latitude
      })
      this.resetControls()
    }
  }
}
</script>
