import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

// Components that should always be loaded
import Home from '../components/views/Home'

// Components that should be loaded only when needed
const Page404 =  () => import('../components/views/Page404')
const Login =  () => import('../components/views/Login')
const Register =  () => import('../components/views/Register')
const ProfilePage =  () => import('../components/views/ProfilePage')
const EditProfile =  () => import('../components/views/EditProfile')
const FriendPage =  () => import('../components/views/FriendPage')
const FriendList = () => import('../components/views/sub_views/FriendList')
const FriendRequests = () => import('../components/views/sub_views/FriendRequests')
const SentFriendRequests = () => import('../components/views/sub_views/SentFriendRequests')

// Router Initialize
const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/',
            name: 'landpage',
            component: Login,
            meta:{
                guestOnly: true
            }
        },
        {
            path: '/user/login',
            name: 'login',
            component: Login,
            meta:{
                guestOnly: true
            }
        },
        {
            path: '/user/register',
            name: 'register',
            component: Register,
            meta:{
                guestOnly: true
            }
        },
        {
            path: '/user/profile',
            name: 'profilePage',
            component: ProfilePage,
            meta:{
                requiresAuth: true
            }
        },
        {
            path: '/user/edit/profile',
            name: 'editProfile',
            component: EditProfile,
            meta:{
                requiresAuth: true
            }
        },
        {
            path: '/home',
            name: 'home',
            component: Home,
            meta: {
                requiresAuth: true
            }
        },
        {
            path: '/friends',
            name: 'friends',
            component: FriendPage,
            redirect: 'friends/list',
            meta: {
                requiresAuth: true
            },
            children:[
                {
                    path: 'list',
                    component: FriendList,
                    meta: {
                        requiresAuth: true,
                        navSequence: 1
                    }
                },
                {
                    path: 'requests',
                    component: FriendRequests,
                    meta: {
                        requiresAuth: true,
                        navSequence: 2
                    }
                },
                {
                    path: 'sent-requests',
                    component: SentFriendRequests,
                    meta: {
                        requiresAuth: true,
                        navSequence: 3
                    }
                }
            ]
        },



        // This route should be at the last/end part
        // 404 Page
        {
            path: '/404',
            component: Page404,
        },
        {
            path: '*',
            redirect: '/404'
        },
        
    ]
});

export default router