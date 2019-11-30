
import axios from 'axios'
export default {
    login({commit}, data){
        return new Promise (function(resolve, reject){
            commit('auth_request')
				switch (data.success) {
					case true:
						const userData = {
							token: data.token,
							user: data.user
						}
						const token = data.token
						localStorage.setItem('data', JSON.stringify(userData))
						axios.defaults.headers.common['Authorization'] = 'Bearer ' + token
                        commit('auth_success', userData)
                        commit('updateAccessToken', response.data.token);
                        this.$router.push('/');
						resolve()
						break;
					case false:
						commit('auth_error')
						localStorage.removeItem('data')
						reject(data.message)
						break;
					default:
						break;
				}
        });
    },
    logout({ commit }) {
        localStorage.removeItem('data')
        // axios.defaults.headers.common['Authorization'] = 'Bearer ' + token
        commit('logout')
    },
    fetchAccessToken({ commit }) {
        commit('updateAccessToken', localStorage.getItem('data'));
    },
}
