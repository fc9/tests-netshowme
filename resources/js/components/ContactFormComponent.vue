<template>
    <div class="bg-contact100" style="background-image: url('/images/bg-01.jpg');">
        <loader-component :is-visible="isLoading"></loader-component>
        <div id="page-container" class="container-contact100" :class="{'enableBlur': isLoading}">
            <div class="wrap-contact100" :class="{'invalidSubmit': !this.validSubmit}" v-on:anima>
                <div class="contact100-pic js-tilt" data-tilt>
                    <img src="/images/logo.svg" alt="netShow.me">
                </div>
                <form ref="form" class="contact100-form validate-form" enctype="multipart/form-data"
                      @submit.prevent="submit">
                    <span class="contact100-form-title">{{ __('contact.get_in_touch') }}</span>

                    <div class="wrap-input100 validate-input"
                         :class="{ 'alert-validate': config.name.error }"
                         :data-validate="config.name.alert">
                        <input class="input100" type="text" name="name" maxlength="45"
                               v-model="$v.name.$model"
                               :placeholder="config.name.label"
                               @focus="setError('name', false)"
                               @keyup="setError('name')"
                               @blur="setError('name', $v.name.$dirty)">
                        <span class="focus-input100"></span>
                        <span class="symbol-input100"><i class="fa fa-user" aria-hidden="true"></i></span>
                    </div>

                    <div class="wrap-input100 validate-input"
                         :class="{ 'alert-validate': config.email.error }"
                         :data-validate="config.email.alert">
                        <input class="input100" type="text" name="email" maxlength="90"
                               v-model="$v.email.$model"
                               :placeholder="config.email.label"
                               @focus="setError('email', false)"
                               @keyup="setError('email')"
                               @blur="setError('email', $v.email.$dirty)">
                        <span class="focus-input100"></span>
                        <span class="symbol-input100"><i class="fa fa-envelope" aria-hidden="true"></i></span>
                    </div>

                    <div class="wrap-input100 validate-input"
                         :class="{ 'alert-validate': config.phone.error }"
                         :data-validate="config.phone.alert">
                        <input class="input100" type="text" name="phone" maxlength="14"
                               v-mask="config.phone.mask"
                               v-model="$v.phone.$model"
                               :placeholder="config.phone.label"
                               @focus="setError('phone', false)"
                               @keyup="setError('phone')"
                               @blur="setError('phone', $v.phone.$dirty)">
                        <span class="focus-input100"></span>
                        <span class="symbol-input100"><i class="fa fa-phone" aria-hidden="true"></i></span>
                    </div>

                    <div class="wrap-input100 validate-input"
                         :class="{ 'alert-validate': config.message.error }"
                         :data-validate="config.message.alert">
            <textarea class="input100" name="message"
                      v-model="$v.message.$model"
                      :placeholder="config.message.label"
                      @focus="setError('message', false)"
                      @keyup="setError('message')"
                      @blur="setError('message', $v.message.$dirty)"></textarea>
                        <span class="focus-input100"></span>
                    </div>

                    <div class="wrap-input100 validate-input"
                         :class="{ 'alert-validate': config.attachment.error }"
                         :data-validate="config.attachment.alert">
                        <input class="input100" type="file" name="attachment" id="attachment" ref="attachment"
                               :accept="config.attachment.accept"
                               :placeholder="config.attachment.label"
                               @click="setError('attachment', false)"
                               @change="changedFile($event)">
                        <span class="focus-input100"></span>
                        <span class="symbol-input100"><i class="fa fa-paperclip" aria-hidden="true"></i></span>
                    </div>

                    <div class="container-contact100-form-btn">
                        <button class="contact100-form-btn" type="submit">{{ __('contact.send') }}</button>
                    </div>
                </form>
            </div><!-- #page-wrap -->
        </div><!-- #page-container -->
    </div><!-- #page-bg -->
</template>

<script>
import {email, maxLength, minLength, required} from 'vuelidate/lib/validators'
import {maxUpload, phoneBR} from '../validators'

export default {
    name: 'contactForm',

    data() {
        /**
         * Data Labels
         */
        let labels = {
                name: this.__('validation.attributes.name'),
                email: this.__('validation.attributes.email'),
                phone: this.__('validation.attributes.phone'),
                message: this.__('validation.attributes.message'),
                attachment: this.__('validation.attributes.attachment')
            },
            maxUploadSize = 500

        return {
            /**
             * Loading Layer controller
             */
            isLoading: false,

            /**
             * Valid form submission
             */
            validSubmit: true,

            /**
             * Form fields.
             */
            name: '',
            email: '',
            phone: '',
            message: '',
            attachment: '',

            /**
             * Dynamic settings of form fields.
             */
            config: {
                name: {
                    label: labels.name,
                    message: this.__('validation.required', {'attribute': labels.name}),
                    alert: '',
                    error: false
                },
                email: {
                    label: labels.email,
                    message: this.__('validation.email', {'attribute': labels.email}),
                    alert: '',
                    error: false
                },
                phone: {
                    label: labels.phone,
                    message: this.__('validation.phone', {'attribute': labels.phone}),
                    alert: '',
                    error: false,
                    mask: {mask: ['(99)9999-9999', '(99)99999-9999'], placeholder: '_'}
                },
                message: {
                    label: labels.message,
                    message: this.__('validation.required', {'attribute': labels.message}),
                    alert: '',
                    error: false
                },
                attachment: {
                    label: labels.attachment,
                    message: this.__('validation.max.file', {'attribute': labels.attachment, 'max': maxUploadSize}),
                    alert: '',
                    error: false,
                    accept: '.pdf,.doc,.docx,.odt,.txt',
                    maxsize: maxUploadSize
                }
            }
        }
    },

    /**
     * Field validation rules.
     */
    validations: {
        name: {required, minLength: minLength(3), maxLength: maxLength(45)},
        email: {required, minLength: minLength(7), maxLength: maxLength(90), email},
        phone: {required, minLength: minLength(10), maxLength: maxLength(14), phoneBR},
        message: {required, maxLength: maxLength(90)},
        attachment: {required, maxUpload}
    },

    methods: {
        /**
         * File field changed.
         */
        changedFile(e) {
            this.attachment = (e.target.files || e.dataTransfer.files)[0]
            this.$v.attachment.$touch()
            this.config.attachment.error = this.$v.attachment.$error
        },

        /**
         * Submitting the form.
         */
        submit(e) {
            console.log('Submitting...')
            this.validSubmit = this.validInputs()
            if (this.validSubmit) {
                let url = '/api/contact',
                    data = this.getData(),
                    config = this.getConfigs()
                this.isLoading = true
                axios.post(url, data, config)
                    .then(this.successModal)
                    .catch(this.errorModal)
            } else {
                this.stopAnimationInvalidSubmit()
            }
        },

        stopAnimationInvalidSubmit() {
            setTimeout(() => this.validSubmit = true, 2010);
        },

        /**
         * Validating all fields for submission.
         */
        validInputs() {
            this.$v.$touch()
            this.setError('name')
            this.setError('email')
            this.setError('phone')
            this.setError('message')
            this.setError('attachment')
            return !this.$v.$invalid
        },

        /**
         * Check if the form field is valid.
         */
        setError(input, dirty) {
            this.config[input].alert = this.config[input].message
            this.config[input].error = (dirty === undefined || dirty !== false)
                ? this.$v[input].$error
                : false
        },

        /**
         * Returns the form data for submission.
         */
        getData() {
            let data = new FormData()
            data.append('name', this.$v.name.$model)
            data.append('email', this.$v.email.$model)
            data.append('phone', this.$v.phone.$model)
            data.append('message', this.$v.message.$model)
            data.append('attachment', this.attachment)
            return data
        },

        /**
         * Returns the request configuration.
         */
        getConfigs() {
            return {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            }
        },

        /**
         * Show confirmation of successful submission.
         */
        successModal: function (response) {
            console.log('success', response.data)
            this.$swal({
                icon: 'success',
                title: this.__('contact.contact_send'),
                showConfirmButton: false,
                timer: 1500
            }).then(() => {
                this.clearForm()
                this.isLoading = false
            })
        },

        /**
         * Resetting the form.
         */
        clearForm() {
            this.$v.name.$model = ''
            this.$v.email.$model = ''
            this.$v.phone.$model = ''
            this.$v.message.$model = ''
            this.$v.attachment.$model = ''
            this.$refs.form.reset()
        },

        /**
         * Show contact registration failure message.
         */
        errorModal: function (error) {
            console.log('error', error)
            if (error.response.status === 422) {
                this.$swal({
                    icon: 'error',
                    title: this.__('contact.contact_not_sent'),
                    showConfirmButton: false,
                    timer: 1500
                }).then(() => {
                    this.showError(error.response.data.errors)
                    this.isLoading = false
                })
            }
        },

        /**
         * Show error messages.
         */
        showError(errors) {
            let inputs = ['name', 'email', 'phone', 'message', 'attachment']
            inputs.forEach(input => {
                if (errors.hasOwnProperty(input)) {
                    this.config[input].alert = errors[input][0]
                    this.config[input].error = true
                }
            })
        }
    }
};


</script>

<style scoped>
/*** fonts ***/

@font-face {
    font-family: Montserrat-Regular;
    src: url('../../fonts/montserrat/Montserrat-Regular.ttf');
}

@font-face {
    font-family: Montserrat-Bold;
    src: url('../../fonts/montserrat/Montserrat-Bold.ttf');
}

@font-face {
    font-family: Montserrat-ExtraBold;
    src: url('../../fonts/montserrat/Montserrat-ExtraBold.ttf');
}

@font-face {
    font-family: Montserrat-Medium;
    src: url('../../fonts/montserrat/Montserrat-Medium.ttf');
}

/*** reset ***/

* {
    margin: 0px;
    padding: 0px;
    box-sizing: border-box;
}

body, html {
    height: 100%;
    font-family: Montserrat-Regular, sans-serif;
    background-color: #ee3965;
}

a {
    font-family: Montserrat-Regular;
    font-size: 14px;
    line-height: 1.7;
    color: #666666;
    margin: 0px;
    transition: all 0.4s;
    -webkit-transition: all 0.4s;
    -o-transition: all 0.4s;
    -moz-transition: all 0.4s;
}

a:focus {
    outline: none !important;
}

a:hover {
    text-decoration: none;
    color: #57b846;
}

h1, h2, h3, h4, h5, h6 {
    margin: 0px;
}

p {
    font-family: Montserrat-Regular;
    font-size: 14px;
    line-height: 1.7;
    color: #666666;
    margin: 0px;
}

ul, li {
    margin: 0px;
    list-style-type: none;
}

input {
    outline: none;
    border: none;
}

textarea {
    outline: none;
    border: none;
}

textarea:focus, input:focus {
    border-color: transparent !important;
}

input:focus::-webkit-input-placeholder {
    color: transparent;
}

input:focus:-moz-placeholder {
    color: transparent;
}

input:focus::-moz-placeholder {
    color: transparent;
}

input:focus:-ms-input-placeholder {
    color: transparent;
}

textarea:focus::-webkit-input-placeholder {
    color: transparent;
}

textarea:focus:-moz-placeholder {
    color: transparent;
}

textarea:focus::-moz-placeholder {
    color: transparent;
}

textarea:focus:-ms-input-placeholder {
    color: transparent;
}

input::-webkit-input-placeholder {
    color: #aaaaaa;
}

input:-moz-placeholder {
    color: #aaaaaa;
}

input::-moz-placeholder {
    color: #aaaaaa;
}

input:-ms-input-placeholder {
    color: #aaaaaa;
}

textarea::-webkit-input-placeholder {
    color: #aaaaaa;
}

textarea:-moz-placeholder {
    color: #aaaaaa;
}

textarea::-moz-placeholder {
    color: #aaaaaa;
}

textarea:-ms-input-placeholder {
    color: #aaaaaa;
}

input, textarea, button {
    animation: move 550ms;
    /*animation-delay: 380ms;*/
    animation-fill-mode: backwards;
}

input[name=name] {
    animation-delay: 380ms;
}

input[name=email] {
    animation-delay: 580ms;
}

input[name=phone] {
    animation-delay: 780ms;
}

textarea {
    animation-delay: 980ms;
}

input[type=file] {
    animation-delay: 1180ms;
}

button {
    animation-delay: 1380ms;
}

button {
    outline: none !important;
    border: none;
    background: transparent;
}

button:hover {
    cursor: pointer;
}

iframe {
    border: none !important;
}

/*** Contact ***/

.bg-contact100 {
    width: 100%;
    background-repeat: no-repeat;
    background-position: center center;
    background-size: cover;
}

.container-contact100 {
    width: 100%;
    min-height: 100vh;
    display: -webkit-box;
    display: -webkit-flex;
    display: -moz-box;
    display: -ms-flexbox;
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    align-items: center;
    padding: 15px;
    background: rgba(238, 57, 101, 0.9);
}

.wrap-contact100 {
    width: 1163px;
    background: #fff;
    border-radius: 10px;
    overflow: hidden;

    display: -webkit-box;
    display: -webkit-flex;
    display: -moz-box;
    display: -ms-flexbox;
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
    padding: 90px 130px 100px 148px;
}

.contact100-pic {
    width: 310px;
    padding-top: 245px;
}

.contact100-pic img {
    max-width: 100%;
}

.contact100-form {
    width: 390px;
}

.contact100-form-title {
    display: block;
    font-family: Montserrat-ExtraBold;
    font-size: 24px;
    color: #1f4280;
    line-height: 1.2;
    text-align: left;
    padding-bottom: 36px;
}

input.input100 {
    height: 50px;
    border-radius: 8px;
    padding: 0 30px 0 50px;
}

input.input100[name="email"] {
    padding: 0 30px 0 54px;
}

input.input100[name="attachment"] {
    padding: 10.7px 0 0 55px;
}

textarea.input100 {
    min-height: 150px;
    border-radius: 8px;
    padding: 14px 30px;
}

.wrap-input100 {
    position: relative;
    width: 100%;
    z-index: 1;
    margin-bottom: 10px;
}

.input100 {
    display: block;
    width: 100%;
    background: #e6e6e6;
    font-family: Montserrat-Bold;
    font-size: 15px;
    line-height: 1.5;
    color: #666666;
}

/*** Focus ***/

.focus-input100 {
    display: block;
    position: absolute;
    border-radius: 8px;
    bottom: 0;
    left: 0;
    z-index: -1;
    width: 100%;
    height: 100%;
    box-shadow: 0px 0px 0px 0px;
    color: rgba(238, 57, 101, 0.5);
}

.input100:focus + .focus-input100 {
    -webkit-animation: anim-shadow 0.5s ease-in-out forwards;
    animation: anim-shadow 0.5s ease-in-out forwards;
}

@-webkit-keyframes anim-shadow {
    to {
        box-shadow: 0px 0px 60px 25px;
        opacity: 0;
    }
}

@keyframes anim-shadow {
    to {
        box-shadow: 0px 0px 60px 25px;
        opacity: 0;
    }
}

.symbol-input100 {
    display: -webkit-box;
    display: -webkit-flex;
    display: -moz-box;
    display: -ms-flexbox;
    display: flex;
    align-items: center;
    position: absolute;
    border-radius: 8px;
    bottom: 0;
    left: 0;
    width: 100%;
    height: 100%;
    padding-left: 30px;
    pointer-events: none;
    color: #aaaaaa;
    font-size: 15px;

    -webkit-transition: all 0.4s;
    -o-transition: all 0.4s;
    -moz-transition: all 0.4s;
    transition: all 0.4s;
}

.input100:focus + .focus-input100 + .symbol-input100 {
    color: #ee3965;
    padding-left: 22px;
}

/*** Button ***/

.container-contact100-form-btn {
    width: 100%;
    display: -webkit-box;
    display: -webkit-flex;
    display: -moz-box;
    display: -ms-flexbox;
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    padding-top: 20px;
}

.contact100-form-btn {
    width: 100%;
    height: 50px;
    border-radius: 8px;
    background: #ee3965;
    font-family: Montserrat-Bold;
    font-size: 15px;
    line-height: 1.5;
    color: #fff;
    display: -webkit-box;
    display: -webkit-flex;
    display: -moz-box;
    display: -ms-flexbox;
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 0 25px;

    -webkit-transition: all 0.4s;
    -o-transition: all 0.4s;
    -moz-transition: all 0.4s;
    transition: all 0.4s;
}

.contact100-form-btn:hover {
    background: #1f4280;
}

/*** Responsive ***/

@media (max-width: 1200px) {
    .contact100-pic {
        width: 33.5%;
    }

    .contact100-form {
        width: 44%;
    }
}

@media (max-width: 992px) {
    .wrap-contact100 {
        padding: 110px 80px 157px 90px;
    }

    .contact100-pic {
        width: 35%;
    }

    .contact100-form {
        width: 55%;
    }
}

@media (max-width: 768px) {
    .wrap-contact100 {
        padding: 110px 80px 157px 80px;
    }

    .contact100-pic {
        display: none;
    }

    .contact100-form {
        width: 100%;
    }
}

@media (max-width: 576px) {
    .wrap-contact100 {
        padding: 110px 15px 157px 15px;
    }
}

/*** Alert validate ***/

.validate-input {
    position: relative;
}

.alert-validate::before {
    content: attr(data-validate);
    position: absolute;
    max-width: 70%;
    background-color: white;
    border: 1px solid #ee3965;
    border-radius: 13px;
    padding: 4px 25px 4px 10px;
    top: 50%;
    -webkit-transform: translateY(-50%);
    -moz-transform: translateY(-50%);
    -ms-transform: translateY(-50%);
    -o-transform: translateY(-50%);
    transform: translateY(-50%);
    right: 8px;
    pointer-events: none;

    font-family: Montserrat-Medium;
    color: #ee3965;
    font-size: 13px;
    line-height: 1.4;
    text-align: left;

    visibility: hidden;
    opacity: 0;

    -webkit-transition: opacity 0.4s;
    -o-transition: opacity 0.4s;
    -moz-transition: opacity 0.4s;
    transition: opacity 0.4s;
}

.alert-validate::after {
    content: "\f06a";
    font-family: FontAwesome;
    display: block;
    position: absolute;
    color: #ee3965;
    font-size: 15px;
    top: 50%;
    -webkit-transform: translateY(-50%);
    -moz-transform: translateY(-50%);
    -ms-transform: translateY(-50%);
    -o-transform: translateY(-50%);
    transform: translateY(-50%);
    right: 13px;
}

.alert-validate:hover:before {
    visibility: visible;
    opacity: 1;
}

@media (max-width: 992px) {
    .alert-validate::before {
        visibility: visible;
        opacity: 1;
    }
}

/*** blur ***/

.enableBlur * {
    filter: blur(2px);
}

/** animates **/

.invalidSubmit {
    animation: nono 200ms linear, fade paused;
    animation-iteration-count: 2;
}

@keyframes nono {
    0%, 100% {
        transform: translateX(0);
    }
    33% {
        transform: translateX(-5%);
    }
    66% {
        transform: translateX(5%);
    }
}

@keyframes move {
    from {
        opacity: 0;
        transform: translateX(-35%);
    }
    to {
        opacity: 1;
        transform: translateX(0);
    }
}
</style>
