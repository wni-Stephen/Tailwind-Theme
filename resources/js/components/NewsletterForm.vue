<script>
import { Form, Field } from 'vee-validate';
import { inject, onMounted } from 'vue'

import * as Yup from 'yup';

export default {
  components: {
    Form,
    Field
  },
  data() {
    return {
      input_class: 'w-full text-base bg-deepgreen text-white placeholder:text-white text-manrope block w-full py-3.5 border border-transparent transition duration-100 ease-in-out focus:ring-0 focus:ring-white focus:ring-opacity-0 focus:border-white  focus:border-b-brightgreen focus:outline-0 disabled:opacity-50 disabled:cursor-not-allowed text-inherit px-0 border-b border-b-white mb-6 font-manrope',
      loading: false
    }
  },
  computed: {
    schema() {
      return Yup.object({
        email: Yup.string()
          .required('Email is required')
          .email('Email is invalid'),
        accept_terms: Yup.string()
          .required('You must accept the privacy policy to continue.')
      });
    },
  },
  methods: {
    onSubmit(values, { resetForm }, actions) {
      this.loading = true


      window.axios.post('/wp-json/dm/v1/newsletter/general', values)
        .then((response) => {

          // push data to GA4
          if (window.dataLayer) {
            window.dataLayer.push({
              event: 'newsletter',
              type: 'Newsletter Signup',
              status: 'success',
            })
          }

          //  this.form = {} // Clear input fields.
          resetForm();

          this.$dialog.show({
            title: response.data.status,
            message: response.data.message,
          })

        })
        .catch((err) => {

          // push data to GA4
          if (window.dataLayer) {
            window.dataLayer.push({
              event: 'newsletter',
              type: 'Newsletter Signup',
              status: 'error',
              message: err.response.data.message,
            })
          }

          //    actions.setErrors(err.response.data.errors)

          this.$dialog.show({
            title: 'Error',
            message: err.response.data.message,
          })

        })
        .then(() => {
          this.loading = false
        })
    }

  }
}

</script>
<template>
  <Form ref="form" @submit="onSubmit" :validation-schema="schema" v-slot="{ errors }" class="block">

    <div class="form-group">
      <!-- <label class="label required">Email</label> -->
      <Field placeholder="Your email address" name="email" type="email" :class="[input_class, { '!border-white': errors.email }]" />
      <div v-if="errors.email" class="mt-2 text-sm text-brightorange font-manrope">{{ errors.email }}</div>
    </div>

    <div class="form-group lg:col-span-2 my-3 flex justify-between gap-6 md:gap-10 items-start lg:items-center flex-col lg:flex-row">
      <div class="flex justify-start flex-row ">
        <Field
          class="w-5 h-5 shadow-sm text-black !px-0 outline-0 focus:ring-offset-0 focus:ring-2 focus:border-brightgreen focus:ring-brightgreen focus:ring-opacity-25 focus:outline-0 rounded-[32px]"
          name="accept_terms" type="checkbox" id="accept_terms" value="true"
          :class="[{ '!border-brightorange': errors.accept_terms }]" />
        <label for="accept_terms" class="ml-4 text-xs font-manrope mb-2 block text-white">I agree to the terms and conditions</label>
      </div>
      <div v-if="errors.accept_terms" class="text-brightorange mt-2 text-sm font-manrope">{{ errors.accept_terms }}</div>
      <button aria-label="Subscribe" title="Subscribe" type="submit" :disabled="loading" class="hover:underline hover:underline-offset-8">
        <div class="flex gap-4  justify-end items-center">
            <span>Subscribe</span>
            <arrow class="w-10 h-5 stroke-2"></arrow>
        </div>
      </button>
    </div>
  </Form>
</template>
