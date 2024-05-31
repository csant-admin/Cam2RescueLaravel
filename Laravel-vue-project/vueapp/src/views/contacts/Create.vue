<template>
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <h3>Add Contacts</h3>
            </div>
            <div class="mb-3">
                <div class="card-body">
                    <ul class="alert alert-warning" v-if="Object.keys(errorList).length > 0">
                        <li class="mb-0 ms-3" v-for="(error, index) in errorList" :key="index">
                            {{ error[0] }}
                        </li>
                    </ul>

                    <form>
                        <div class="row">
                            <div class="col-md-6">
                                <label>Name</label>
                                <input type="text" v-model="contacts.name" class="form-control"/>
                            </div>
                            <div class="col-md-6">
                                <label>Contact No.</label>
                                <input type="text" v-model="contacts.contact_no" class="form-control"/>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <label>Email</label>
                                <input type="email" v-model="contacts.email" class="form-control"/>
                            </div>
                        </div>
                        <div class="mt-3">
                            <button type="button" @click="saveContact" class="btn btn-primary">Save Contact</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios'

import Swal from 'sweetalert2'

export default {
    name: 'contactsCreate',
    data() {
        return {
            errorList: [],
            contacts: {
                name: '',
                contact_no: '',
                email: ''
            }
        }
    },
    methods: {
        saveContact() {
            axios.post('http://localhost:8000/api/contact', this.contacts)
                .then(res => {
                    console.log(res)
                    Swal.fire({
                        position: "center",
                        icon: "success",
                        title: res.data.message,
                        showConfirmButton: false,
                        timer: 1500
                    });
                    this.contacts = {
                        name: '',
                        contact_no: '',
                        email: ''
                    }
                })
                .catch(error => {
                    if (error.response) {
                        if (error.response.status == 422) {
                            this.errorList = error.response.data.errors;
                        }
                    } else if (error.request) {
                        console.log(error.request);
                    } else {
                        console.log('Error', error.message);
                    }
                })
        }
    }
}
</script>
