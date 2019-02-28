<template>
    <div class="row mt-5">
    <vue-headful title="Class Activity - Classroom"/>
      <b-modal id="form_classroom" ref="form_classroom" size="modalsm" title="Form Classroom">
         <form @submit.prevent="submit_form">
           <fieldset class="form-group">
             <label for="formGroupExampleInput">Classroom</label>
             <input type="text" v-model="classroom.room_name" required class="form-control form-control-sm"  id="formGroupExampleInput" placeholder="Entry classroom here.. eg: A21" >
           </fieldset>
           <div class="row">
             <button type="submit" class="btn btn-outline-success badge-pill btn-sm ml-auto mr-3">SUBMIT</button>
           </div>
         </form>
         <div slot="modal-footer" class="w-100"></div>
      </b-modal>

      <div class="col-md-9 mx-auto">
      <h4> <u> <i>Classroom List</i> </u>
        <b-button type="button" variant="outline-success" class="btn btn-sm badge-pill" v-b-modal.form_classroom> ADD </b-button>
      </h4>
        <table class="table">
          <thead>
            <tr>
              <th>No</th>
              <th>Classroom</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody v-for="(classroom, i) in data_classroom" :key="i">
            <tr>
              <td>{{i+1}}</td>
              <td> <i>{{classroom.room_name}}</i> </td>
              <td>
                <b-button type="button" variant="outline-info" class="btn btn-sm badge-pill" @click="update_row(classroom.id)" v-b-modal.form_classroom> UPDATE </b-button>
                <button type="button" @click="delete_row(classroom.id)" class="btn btn-outline-danger btn-sm badge-pill">DELETE</button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
</template>

<script>

import Classroom from '@/components/classroom'
import {api} from '@/helper/api'

export default {
    name:'Classroom',
    data(){
      return{
        classroom: {
          id: null,
          room_name: '',
        },
        data_classroom : []
      }
    },
    mounted(){
      this.get()
    },
    methods: {
      get() {
        api.get('/classroom').then(res => {
          if(res.data.status === 'success') {
            this.data_classroom = res.data.result
          }
          else{
            console.log(res.data.message)
          }
        }).catch(err => {
          console.log(err)
        })
      },
      submit_form() {
        let data = this.classroom
        let url = ''

        if(this.classroom.id) {
          url = '/edit-classroom/' + this.classroom.id
        }
        else {
          url = 'create-classroom';
        }

        api.post(url, data).then(res => {
          if(res.data.status === 'success') {
            this.data_classroom = res.data.result
            this.$refs.form_classroom.hide()
            this.classroom.id = ''
            this.classroom.room_name = ''
          }
          else {
            console.log(res.data.message)
          }
        }).catch(err => {
          console.log(err)
        })
      },
      delete_row(id) {
        api.delete('delete-classroom/' + id).then(res => {

          if(res.data.status === 'success') {
            this.data_classroom = res.data.result
          }
          else {
            console.log(res.data.message)
          }

        })
      },
      update_row(id)
      {

        api.get('/edit-classroom/'+ id).then(res => {
          if(res.data.status === 'success') {
            this.classroom.id = res.data.result.id
            this.classroom.room_name = res.data.result.room_name
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
