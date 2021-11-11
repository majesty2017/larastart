<template>
    <div class="container mt-3">
        <!-- /.row -->
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Users Table</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-primary" @click="addModal()">
                                <i class="fa fa-user-plus"></i> Add New
                            </button>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Type</th>
                                <th>Registered At</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="user in users" :key="user.id">
                                <td>{{ user.id}}</td>
                                <td>{{ user.name | upText}}</td>
                                <td>{{ user.email}}</td>
                                <td><span class="tag tag-success">{{ user.type | upText}}</span></td>
                                <td>{{ user.created_at | forHumans }}</td>
                                <td>
                                    <a href="#" class="btn btn-sm" title="Edit" @click="editModal(user)">
                                        <i class="fa fa-edit text-blue"></i>
                                    </a>
                                    <a href="#" class="btn btn-sm" title="Delete">
                                        <i class="fa fa-trash text-red"></i>
                                    </a>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>
        <!-- /.row -->

        <!-- Modal -->
        <div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel" v-show="!edit_mode">Add New User</h5>
                        <h5 class="modal-title" id="" v-show="edit_mode">Edit User</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form @submit.prevent="edit_mode ? updateUser() : createUser()"
                          @keydown="form.onKeydown($event)"
                          @keyup.enter="edit_mode ? updateUser() : createUser()">
                            <div class="modal-body">
                            <div class="form-group">
                                <input v-model="form.name" type="text" class="form-control"
                                       :class="{'is-invalid': form.errors.has('name')}"
                                       name="name" placeholder="Name">
                                <has-error field="name" :form="form"></has-error>
                            </div>

                            <div class="form-group">
                                <input v-model="form.email" type="text" class="form-control"
                                       :class="{'is-invalid': form.errors.has('email')}"
                                       name="email" placeholder="E-mail">
                                <has-error field="email" :form="form"></has-error>
                            </div>

                            <div class="form-group">
                                <select name="type" id="type" class="form-control"
                                        :class="{'is-invalid': form.errors.has('type')}"
                                        v-model="form.type">
                                    <option value="">Select User Role</option>
                                    <option value="admin">Admin</option>
                                    <option value="user">Standard User</option>
                                    <option value="author">Author</option>
                                </select>
                                <has-error field="type" :form="form"></has-error>
                            </div>

                            <div class="form-group">
                                <textarea v-model="form.bio" class="form-control"
                                          :class="{'is-invalid': form.errors.has('bio')}"
                                          name="bio" id="bio" placeholder="Short bio for user (Optional)"></textarea>
                                <has-error field="bio" :form="form"></has-error>
                            </div>

                            <div class="form-group">
                                <input v-model="form.password" type="password" class="form-control"
                                       :class="{'is-invalid': form.errors.has('password')}"
                                       name="password" placeholder="Password">
                                <has-error field="password" :form="form"></has-error>
                            </div>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary" v-show="!edit_mode">Save</button>
                                <button type="submit" class="btn btn-primary" v-show="edit_mode">Save Changes</button>
                            </div>
                        </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data () {
        return {
            users: {},
            edit_mode: false,
            form: new Form({
                id: '',
                name: '',
                email: '',
                password: '',
                type: '',
                bio: '',
                photo: '',
            })
        }
    },
    methods: {
        addModal() {
            this.edit_mode = false
            this.form.reset()
            $('#addUserModal').modal('show')
        },

        editModal(user) {
            this.edit_mode = true
            this.form.reset()
            this.form.fill(user)
            $('#addUserModal').modal('show')
        },

        createUser() {
            this.$Progress.start()
            this.form.post('api/users')
            .then(res => {
                if (res.status === 201) {
                    Fire.$emit('loadUser')
                    $('#addUserModal').modal('hide')
                    this.getUser()
                    this.$Progress.finish()

                    toast.fire({
                        icon: 'success',
                        title: 'User saved successfully'
                    })
                }
            }).catch(err => {
                console.log(err)
                this.$Progress.fail()
            })
        },

        getUser() {
            axios.get('api/users')
            .then(res => {
                if (res.status === 200) {
                    this.users = res.data.data
                }
            }).catch(err => {
                console.log(err)
            })
        },

        updateUser() {
            this.edit_mode = true
            this.$Progress.start()
            this.form.put(`api/users/${this.form.id}`)
            .then(res => {
                if (res.status === 200) {
                    this.$Progress.finish()
                    this.getUser()
                    $('#addUserModal').modal('hide')
                    toast.fire({
                        icon: 'success',
                        title: 'Changes saved successfully'
                    })
                }
            }).catch(err => {
                console.log(err)
                toast.fire({
                    icon: 'error',
                    title: 'Something went wrong, failed to update user!'
                })
            })
        },

        deleteUser(id) {
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false
            })

            swalWithBootstrapButtons.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    this.form.delete(`api/users/${id}`)
                    .then(res => {
                        if (res.status === 200) {
                            swalWithBootstrapButtons.fire(
                                'Deleted!',
                                'Your record has been deleted.',
                                'success'
                            )
                        }
                    })
                } else if (
                    /* Read more about handling dismissals below */
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    swalWithBootstrapButtons.fire(
                        'Cancelled',
                        'Your data is safe :)',
                        'error'
                    )
                }
            })
        }
    },

    created() {
        this.getUser()
        Fire.$on('loadUser', () => {
            this.getUser()
        })
    }
}
</script>

<style scoped>

</style>
