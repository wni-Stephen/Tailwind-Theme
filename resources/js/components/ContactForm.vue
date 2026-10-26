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
      input_class: 'w-full text-base bg-lightestgrey border-lightgrey block w-full px-6 py-3.5 border transition duration-100 ease-in-out focus:ring-2 focus:border-black focus:ring-black focus:ring-opacity-25 focus:outline-0 disabled:opacity-50 disabled:cursor-not-allowed text-black font-sans h-full placeholder:text-black',
      loading: false
    }
  },
  computed: {
    schema() {
      return Yup.object({
        full_name: Yup.string()
          .required('Full Name is required'),
        businessname: Yup.string()
          .required('Business Name is required'),
        email: Yup.string()
          .required('Email is required')
          .email('Email is invalid'),
        accept_terms: Yup.string()
          .required('You must accept the privacy policy to continue.'),
      });
    },
  },
  methods: {
    onSubmit(values, { resetForm }, actions) {
      this.loading = true

      window.axios.post('/wp-json/dm/v1/contact/general', values)
        .then((response) => {

          // push data to GA4
          if (window.dataLayer) {
            window.dataLayer.push({
              event: 'contact',
              type: 'General Enquiries',
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
              event: 'contact',
              type: 'General Enquiries',
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
  <Form ref="form" @submit="onSubmit" :validation-schema="schema" v-slot="{ errors }"
    class="grid md:grid-cols-2 gap-5 lg:gap-8">

    <div class="form-group flex flex-col justify-between gap-5 w-full">
      <div class="w-full">
        <Field placeholder="Full Name*" name="full_name" type="text"
          :class="[input_class, { '!border-red': errors.full_name }]" />
        <div v-if="errors.full_name" class="text-red mt-2 text-sm">{{ errors.full_name }}</div>
      </div>
      <div class="w-full">
        <Field placeholder="Email Address*" name="email" type="email"
          :class="[input_class, { '!border-red': errors.email }]" />
        <div v-if="errors.email" class="text-red mt-2 text-sm">{{ errors.email }}</div>
      </div>
      <div class="w-full">
        <Field placeholder="Business Name*" name="businessname" type="text"
          :class="[input_class, { '!border-red': errors.businessname }]" />
        <div v-if="errors.businessname" class="text-red mt-2 text-sm">{{ errors.businessname }}</div>
      </div>
    </div>
    <div class="form-group flex flex-col justify-between w-full h-full">
      <div class="w-full h-full">
        <Field placeholder="Message..." name="message" as="textarea" cols="10" rows="6"
          :class="[input_class, { '!border-red': errors.message }]" />
        <div v-if="errors.message" class="text-red mt-2 text-sm">{{ errors.message }}</div>
      </div>
    </div>

    <div class="form-group flex flex-row w-full  lg:col-span-2">
      <div class="font-normal font-sans text-left text-black w-full">By submitting form you
        agree to subscribe and consent to your data being stored in line with our Privacy Policy.
      </div>
    </div>
    <div class="form-group lg:col-span-2">
      <div class="flex item-center">
        <Field
          class="w-5 h-5 shadow-sm bg-white text-black border border-lightgrey outline-0 focus:ring-offset-0 focus:ring-2 focus:border-black focus:ring-black focus:ring-opacity-25 focus:outline-0"
          name="accept_terms" type="checkbox" id="accept_terms" value="true"
          :class="[{ '!border-red': errors.accept_terms }]" />
        <label for="accept_terms" class="ml-4">I have read and agree to the Privacy Policy</label>
      </div>
      <div v-if="errors.accept_terms" class="text-red mt-2 text-sm">{{ errors.accept_terms }}</div>
    </div>

    <div class="form-group lg:col-span-2 flex gap-6">
      <button type="submit" :disabled="loading" aria-label="Submit" title="Submit"
        class="group bg-red text-white px-8 py-4 flex items-center gap-4 font-semibold text-base duration-200 ease-in-out transition-colors hover:bg-black"><span>Submit
          enquiry</span>
        <arrow class="h-4 w-4 group-hover:rotate-45 transition-transform duration-200"></arrow>
      </button>
      <!-- <button :disabled="loading" type="reset" aria-label="Reset" title="Reset"
        class="text-base border-2 border-transparent font-normal text-center px-8 py-3 hover:text-white hover:bg-black inline-flex items-center transition-colors font-sans bg-black text-black rounded-[30px]">Reset</button> -->
    </div>
  </Form>
</template>
