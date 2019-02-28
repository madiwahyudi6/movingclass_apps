<template>
    <div class="row mt-5">
    <vue-headful title="Class Activity - Student Class"/>
     <b-modal id="form_studentclass" ref="form_studentclass" size="modalsm" title="Form Student Class">
        <form @submit.prevent="submit_form">
          <fieldset class="form-group">
            <label for="formGroupExampleInput">Student class</label>
            <input type="text" v-model="studentclass.studentclass" required class="form-control form-control-sm" id="formGroupExampleInput" placeholder="Entry student class here.. eg: XII RPL 2" >
          </fieldset>
          <div class="row">
            <button type="submit" class="btn btn-outline-success badge-pill btn-sm ml-auto mr-3">SUBMIT</button>
          </div>
        </form>
        <div slot="modal-footer" class="w-100"></div>
     </b-modal>

      <div class="col-md-9 mx-auto">
        <h4> <u> <i>Student Class List</i> </u>
          <b-button type="button" variant="outline-success" class="btn btn-sm badge-pill" v-b-modal.form_studentclass> ADD </b-button>
        </h4>
        <table class="table mt-3 pre-scrollable">
          <thead>
            <tr>
              <th>No</th>
              <th>Student Class</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody v-for="(studentclass, i) in data_studentclass" :key="i">
            <tr>
              <td>{{i+1}}</td>
              <td> <i>{{studentclass.studentclass}}</i> </td>
              <td>
                <b-button type="button" variant="outline-info" class="btn btn-sm badge-pill" @click="update_row(studentclass.id)" v-b-modal.form_studentclass> UPDATE </b-button>
                <button type="button" @click="delete_row(studentclass.id)" class="btn btn-outline-danger btn-sm badge-pill">DELETE</button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
</template>

<script>

import Studentclass from '@/components/Studentclass'
import {api} from '@/helper/api'

export default {
    name:'Studentclass',
    data(){
      return{
        studentclass: {
          id: null,
          studentclass: '',
        },
        update_studentclass: 0,
        data_studentclass : []
      }
    },
    mounted(){
      this.get()
      let id = this.$route.params.id
      if(id) {
        api.get('studentclass/'+ id).thn(res => {
          this.studentclass = res.data.result
        })
      }
    },
    methods: {
      get() {
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
      submit_form() {
        let data = this.studentclass
        let url = ''

        if(this.studentclass.id) {
          url = '/edit-studentclass/' + this.studentclass.id + ''
        }
        else {
          url = 'create-studentclass';
        }

        api.post(url, data).then(res => {
          if(res.data.status === 'success') {
            this.data_studentclass = res.data.result
            this.$refs.form_studentclass.hide()
            this.studentclass.studentclass = ''
            this.studentclass.id = ''

          }
          else {
            console.log(res.data.message)
          }
        }).catch(err => {
          console.log(err)
        })
      },
      delete_row(id) {
        api.delete('delete-studentclass/' + id).then(res => {

          if(res.data.status === 'success') {
            this.data_studentclass = res.data.result
          }
          else {
            console.log(res.data.message)
          }

        })
      },
      update_row(id)
      {

        api.get('/edit-studentclass/'+ id).then(res => {
          if(res.data.status === 'success') {
            this.studentclass.id = res.data.result.id
            this.studentclass.studentclass = res.data.result.studentclass
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
