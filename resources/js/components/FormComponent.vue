<template>
    <div class="container">
        <div class="row justify-content-center my-5">
            <div class="col-md-8">
                <div v-bind:class="'alert alert-' + response.status" v-show="response">
                    <div v-if="response.text"><b>{{ response.text }}</b></div>
                    <div v-else>
                        <ul class="pb-0 mb-0">
                            <li v-for="(message) in response.errors" v-text="message.toString()"></li>
                        </ul>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">Feedback form</div>
                    <div class="card-body">
                        <form ref="feedbackForm" @submit="formSubmit">
                            <div class="form-group pb-4">
                                <label for="fullName">Full name</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    id="fullName"
                                    placeholder="Full name"
                                    v-model="formData.fullName"
                                    required
                                >
                            </div>
                            <div class="form-group pb-4">
                                <label for="phoneNumber">Phone number</label>
                                <input
                                    type="tel"
                                    class="form-control"
                                    id="phoneNumber"
                                    placeholder="Phone number"
                                    v-model="formData.phoneNumber"
                                    required
                                >
                            </div>
                            <div class="form-group pb-4">
                                <label for="country">Country</label>
                                <select
                                    name="country"
                                    class="form-control"
                                    id="country"
                                    v-model="formData.country"
                                    required
                                >
                                    <option v-for="(item, key) in countries_list" v-bind:value="key">{{ item }}</option>
                                </select>

                            </div>

                            <div class="form-group pb-4">
                                <label for="message">Message</label>
                                <textarea
                                    id="message"
                                    class="form-control"
                                    v-model="formData.message"
                                    required
                                >
                                </textarea>
                            </div>

                            <button class="btn btn-success">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    created() {
            axios.get('api/v1/countries').then(response => {
                this.countries_list = response.data
            }).catch(function (error) {
                console.log(error)
            })
    },
    mounted() {
        console.log('Component mounted.')
    },
    data() {
        return {
            countries_list: [],
            formData: {
                fullName: '',
                phoneNumber: '',
                country: '',
                message: ''
            },
            response: ''
        };
    },
    methods: {
        formSubmit: function (e) {
            let self = this;
            e.preventDefault();

            this.sendRequest('api/v1/feedback/create', this.formData).then(response => {
                self.response = response.data;
                self.$refs.feedbackForm.reset();
                self.formData = {
                    fullName: '',
                    country: '',
                    phoneNumber: '',
                    message: ''
                }

            }).catch(function (error) {
                self.response = error;
            });
        },

        sendRequest: function (url, data) {
            return window.axios.post(url, data)
        },
    }
}
</script>
