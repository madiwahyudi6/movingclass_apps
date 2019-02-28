<template>
    <div class="row mt-5">
    <vue-headful title="Class Activity - Activities"/>
      <b-modal id="detail_activity" ref="detail_activity" size="modalsm" title="Detail Activity">
        <div class="container">
          <ul class="list-group">
          <li class="list-group-item">Room Name: <b>{{detail_activity.room_name}}</b> </li>
          <li class="list-group-item">Status: <b>{{ (detail_activity.created_at != null ? 'Available Class' : 'Free Class') }}</b> </li>
          <div v-if="detail_activity.created_at != null">
            <li class="list-group-item">Student Class: <b>{{detail_activity.studentclass}}</b> </li>
            <li class="list-group-item">Subject: <b>{{detail_activity.subject}}</b> </li>
            <li class="list-group-item">Since:  <b>{{detail_activity.since}}</b> </li>
          </div>
          <div>
          <b-button v-b-toggle.collapse1 variant="primary" class="w-100">Setting</b-button>
          <b-collapse id="collapse1" class="mt-2">
            <b-card>
              <form @submit.prevent="addtoavail(detail_activity.id)">
                <fieldset class="form-group">
                  <label for="formGroupExampleInput">Student Class</label>
                  <select class="form-control form-control-sm" v-model="setting.studentclass_id" name="" required>
                    <option value="">Choose student class here..</option>
                    <option v-for="studentclass in data_studentclass" :value="studentclass.id">
                     {{ studentclass.studentclass }}
                   </option>
                  </select>
                </fieldset>
                <fieldset class="form-group">
                  <label for="formGroupExampleInput2">Subject</label>
                  <select class="form-control form-control-sm" v-model="setting.subject_id" name="" required>
                    <option value="">Choose subject here..</option>
                    <option v-for="subject in data_subject" :value="subject.id">
                     {{ subject.subject }}
                   </option>
                  </select>
                </fieldset>
                <div class="row">
                  <button type="submit" @click="onavailclass(detail_activity.id)" class="btn btn-outline-danger btn-sm badge-pill ml-3">ADD TO AVAILABLE CLASS</button>
                  <button type="button" @click="onfreeclass(detail_activity.id)" class="btn btn-outline-success btn-sm badge-pill ml-auto mr-3">ADD TO FREE CLASS</button>
                </div>
              </form>
            </b-card>
          </b-collapse>
        </div>
        </ul>
        </div>
        <div slot="modal-footer" class="w-100"></div>
      </b-modal>


      <div class="col-md-2 mb-4" v-for="(activity, i) in activities" :key="i">
        <b-button type="button" @click="detail_act(activity.id)" class="btn w-100 pt-3 pb-3" :title="[activity.subject_id != null ? 'Available Class' : 'Free Class']"
        v-b-modal.detail_activity :class="[activity.subject_id != null ? 'btn-danger' : 'btn-success']">{{activity.room_name}}</b-button>
      </div>
    </div>
</template>

<script>

import Activities from '@/components/Activities'
import {api} from '@/helper/api'

export default {
    name:'Activities',
    data(){
      return{
        activities: [],
        data_studentclass: [],
        data_subject: [],
        detail_activity: {
          room_name: '',
          status: '',
          student_class: '',
          subject: '',
          since: ''
        },
        setting: {
          classroom_id: null,
          studentclass_id: '',
          subject_id: ''
        }
      }
    },
    mounted(){
      this.get(),
      this.getsubject(),
      this.getstudentclass()
    },
    methods: {
      get() {
        api.get('/activities').then(res => {
          if(res.data.status === 'success') {
            this.activities = res.data.result
          }
          else{
            console.log(res.data.message)
          }
        }).catch(err => {
          console.log(err)
        })
      },
      getstudentclass() {
        api.get('/studentclass').then(res => {
          if(res.data.status === 'success') {
            this.data_studentclass = res.data.result
          }
          else{
            console.log(res.data.message)
          }
        }).catch(err => {
          console.log(err)
        })
      },
      getsubject() {
        api.get('/subject').then(res => {
          if(res.data.status === 'success') {
            this.data_subject = res.data.result
          }
          else{
            console.log(res.data.message)
          }
        }).catch(err => {
          console.log(err)
        })
      },
      detail_act(id) {
        api.get('/edit-activity/'+ id).then(res => {
          if(res.data.status === 'success') {
            this.detail_activity = res.data.result
          }
          else{
            console.log(res.data.message)
          }
        }).catch(err => {
          console.log(err)
        })
      },
      addtoavail(id) {

        this.setting.classroom_id = id
        let data = this.setting

        api.post('create-activity', data).then(res => {
          if(res.data.status === 'success') {
            this.activities = res.data.result
            this.$refs.detail_activity.hide()
            this.setting.studentclass_id = ''
            this.setting.subject_id = ''
            this.setting.classroom_id = ''

          }
          else {
            console.log(res.data.message)
          }
        }).catch(err => {
          console.log(err)
        })

      },
      onfreeclass(id) {
        api.delete('delete-activity/' + id).then(res => {

          if(res.data.status === 'success') {
            this.activities = res.data.result
            this.$refs.detail_activity.hide()
            this.setting.studentclass_id = ''
            this.setting.subject_id = ''
            this.setting.classroom_id = ''          }
          else {
            console.log(res.data.message)
          }

        })
      }


    },

}

</script>
