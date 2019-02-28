<template>
    <div class="row mt-5">
    <vue-headful title="Class Activity - Subject"/>
      <b-modal id="form_subject" ref="form_subject" size="modalsm" title="Form subject">
         <form @submit.prevent="submit_form">
           <fieldset class="form-group">
             <label for="formGroupExampleInput">Subject</label>
             <input type="text" v-model="subject.subject" required class="form-control form-control-sm" id="formGroupExampleInput" placeholder="Entry subject here.. eg: PWD" >
           </fieldset>
           <div class="row">
             <button type="submit" class="btn btn-outline-success badge-pill btn-sm ml-auto mr-3">SUBMIT</button>
           </div>
         </form>
         <div slot="modal-footer" class="w-100"></div>
      </b-modal>

      <div class="col-md-9 mx-auto">
      <h4> <u> <i>Subject List</i> </u>
        <b-button type="button" variant="outline-success" class="btn btn-sm badge-pill" v-b-modal.form_subject> ADD </b-button>
      </h4>
        <table class="table">
          <thead>
            <tr>
              <th>No</th>
              <th>Subject</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody v-for="(subject, i) in data_subject" :key="i">
            <tr>
              <td>{{i+1}}</td>
              <td> <i>{{subject.subject}}</i> </td>
              <td>
                <b-button type="button" variant="outline-info" class="btn btn-sm badge-pill" @click="update_row(subject.id)" v-b-modal.form_subject> UPDATE </b-button>
                <button type="button" @click="delete_row(subject.id)" class="btn btn-outline-danger btn-sm badge-pill">DELETE</button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
</template>

<script>

import Subject from '@/components/Subject'
import {api} from '@/helper/api'

export default {
    name:'Subject',
    data(){
      return{
        subject: {
          id: null,
          subject: '',
        },
        data_subject : []
      }
    },
    mounted(){
      this.get()
    },
    methods: {
      get() {
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
      submit_form() {
        let data = this.subject
        let url = ''

        if(this.subject.id) {
          url = '/edit-subject/' + this.subject.id
        }
        else {
          url = 'create-subject';
        }

        api.post(url, data).then(res => {
          if(res.data.status === 'success') {
            this.data_subject = res.data.result
            this.$refs.form_subject.hide()
            this.subject.subject = ''
            this.subject.id = ''

          }
          else {
            console.log(res.data.message)
          }
        }).catch(err => {
          console.log(err)
        })
      },
      delete_row(id) {
        api.delete('delete-subject/' + id).then(res => {

          if(res.data.status === 'success') {
            this.data_subject = res.data.result
          }
          else {
            console.log(res.data.message)
          }

        })
      },
      update_row(id)
      {

        api.get('/edit-subject/'+ id).then(res => {
          if(res.data.status === 'success') {
            this.subject.id = res.data.result.id
            this.subject.subject = res.data.result.subject
          }
          else{
            console.log(res.data.message)
          }
        }).catch(err => {
          console.log(err)
        })
      }
    },

}

</script>
