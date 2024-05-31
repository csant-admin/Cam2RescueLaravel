import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'
import ContactView from '../views/contacts/View.vue'
import ContactsCreate from '../views/contacts/Create.vue'
import ContactsEdit from '../views/contacts/Edit.vue'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'home',
      component: HomeView
    },
    {
      path: '/about',
      name: 'about',
      // route level code-splitting
      // this generates a separate chunk (About.[hash].js) for this route
      // which is lazy-loaded when the route is visited.
      component: () => import('../views/AboutView.vue')
    },
    {
      path: '/contacts',
      name: 'contacts',
      component: ContactView
    },
    {
      path: '/create',
      name: 'contactsCreate',
      component: ContactsCreate
    },
    {
      path: '/edit',
      name: 'contactsEdit',
      component: ContactsEdit
    }
  ]
})

export default router
