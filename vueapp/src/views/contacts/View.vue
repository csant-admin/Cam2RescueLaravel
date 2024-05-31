<template>
    <div class="container mt-5">
        <div>
            <div class="card">
                <div class="card-header">
                    <h4>Contact List</h4>
                    <router-link to="/create" class="btn btn-success float-end">+ ADD Contact</router-link>
                </div>
                <div class="mb-3">
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Contact No</th>
                                    <th>Email</th>
                                    <th>Created on</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody v-if="contact.length > 0">
                                <tr v-for="(contact, index) in contact" :key="index">
                                    <td>{{contact.id}}</td>
                                    <td>{{contact.name}}</td>
                                    <td>{{contact.contact_no}}</td>
                                    <td>{{contact.email}}</td>
                                    <td>{{ formatDate(contact.created_at) }}</td>
                                    <td>
                                        <div class="d-flex justify-content-around">

                                            <router-link class="btn btn-warning" to="/edit">
                                                <font-awesome-icon icon="fa-solid fa-edit" />
                                            </router-link>

                                            <button type="button" class="btn btn-danger">
                                                <font-awesome-icon icon="fa-solid fa-trash" />
                                            </button>
                                            
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                            <tbody v-else>
                                <tr>
                                    <td colspan="6">Loading...</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
export default {
    
    name: 'contact',
    data() {
        return {
            contact: []
        };
    },
    mounted() {
        this.getContact();
    },
    methods: {
        getContact() {
            axios.get('http://localhost:8000/api/contact').then(res => {
                this.contact = res.data.contact;
                console.log(this.contact);
            });
        },
        formatDate(value) {
            const options = { month: 'long', day: 'numeric', year: 'numeric' };
            const date = new Date(value);
            return date.toLocaleDateString('en-US', options);
        }

    }
};
</script>
