<template>
  <div class="">
    <div class="container">
      <div class="row">
        <div class="mx-auto bg-warning badge-pill pl-5 pr-5 mt-5">
          <h1 class=" display-1"> <b>Class</b> <i><u><b class="text-info font-weight-bold">4</b><span class="text-white">ctivity</span> </u> </i></h1>
          <p class="ml-5"> <i> <b>Easy controlling class</b> </i> </p>
        </div>
        <div class="container">
          <div class="row">
            <div class="mx-auto mt-5">
              <router-link to="/studentclass" class="btn btn-outline-dark ml-2 mr-2 badge-pill"> <b>Student Class</b> </router-link>
              <router-link to="/activities" class="btn btn-outline-success ml-2 mr-2 badge-pill"> <b>Class Activity</b> </router-link>
              <router-link to="/classroom" class="btn btn-outline-warning ml-2 mr-2 badge-pill"> <b>Classroom</b> </router-link>
              <router-link to="/subject" class="btn btn-outline-primary ml-2 mr-2 badge-pill"> <b>Subject</b> </router-link>
            </div>
          </div>
        </div>
        <div class="container">
              <router-view/>
        </div>
        <p class="mx-auto badge badge-pill badge-secondary mt-3">Diwah with Love </p>
      </div>
    </div>
  </div>
</template>
<script>

import Vue from 'vue';
import vueHeadful from 'vue-headful';

Vue.component('vue-headful', vueHeadful);

export default {
  title: 'Class Activity',
  name: 'App',
}
</script>
