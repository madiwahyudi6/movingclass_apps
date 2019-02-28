import Vue from 'vue'
import Router from 'vue-router'
import Activities from '@/components/Activities'
import Studentclass from '@/components/Studentclass'
import Classroom from '@/components/Classroom'
import Subject from '@/components/Subject'


Vue.use(Router)

export default new Router({
  routes: [
    {
      path: '/',
      component: Activities,
    },
    {
      path: '/activities',
      name: 'Activities',
      component: Activities,
    },
    {
      path: '/studentclass',
      name: 'Studentclass',
      component: Studentclass
    },
    {
      path: '/classroom',
      name: 'Classroom',
      component: Classroom
    },
    {
      path: '/subject',
      name: 'Subject',
      component: Subject
    }
  ]
})
