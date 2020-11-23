export default {
    namespaced: true,
    state: {
        status: false,
        color: 'orange darken-2',
        text: ''
    },
    actions: {
        set: ({commit}, payload) => {
            commit('set', payload)
        }
    },
	mutations: {
        set: (state, payload) => {
            state.status = payload.status
            state.text = payload.text
            state.color = payload.color	
		},
	},	
    getters: {
        status: state =>state.status,
        color: state =>state.color,
        text: state =>state.text,
    },
}