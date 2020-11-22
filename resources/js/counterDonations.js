import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

const counterDonations = new Vuex.Store({
	state: {
		count: 0
	},
	getters: {
		getCounterDonations: state => {
			return state.count
		}
	},
	mutations: {
		incrementDonations (state) {
			state.count++	
		},
	}	
})

export default counterDonations