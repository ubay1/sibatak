import Login from '../page/Login'
import Daftar from '../page/Daftar'
import Home from '../page/Home'
import About from '../page/About'
import Galeri from '../page/Galeri'

import guest from './middleware/guest'
import auth from './middleware/auth'
// const = 'test_laravel/public/';

   const routes = [
        {
            path : "/login",
            name : 'login',
            component : Login,
            meta: {
                middleware: [
                    guest
                ]
            }
        },
        {
            path : "/daftar",
            name : 'daftar',
            component : Daftar,
            meta: {
                middleware: [
                    guest
                ]
            }
        },
        {
            path : "/",
            name : 'home',
            component : Home,
            meta: {
                middleware: [
                    auth
                ]
            }
        },
        {
            path : "/about",
            name : 'about',
            component : About,
            meta: {
                middleware: [
                    auth
                ]
            }
        },
        {
            path : "/galeri",
            name : 'galeri',
            component : Galeri,
            meta: {
                middleware: [
                    auth
                ]
            }
        }

    ]

export default routes;
