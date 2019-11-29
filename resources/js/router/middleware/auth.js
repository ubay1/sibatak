export default function auth ({ next, store }){
    if(!store.getters.status){
        return next({
           name: 'login'
        })
    }

    return next()
}
