export default {
    namespaced: true,
    state: {
		transactions: 0
    },
    actions: {

    },
	mutations: {
        insert: (state, payload) => {
            state.transactions++	
		},
	},	
    getters: {
        transactions: state =>state.transactions
    },
}