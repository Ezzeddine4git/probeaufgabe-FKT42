<template>
  <div class="vue-modal">
    <div class="vue-modal-inner">
      <div class="vue-modal-content">
        <h1>Add New Company:</h1>
        <form @submit.prevent="submitForm()" class="form">
          <div class="fg form-firstname">
            <label for="name">Company Name:</label>
            <input v-model="v$.form.name.$model" name="name" type="text" />
          </div>
          <div class="form-buttons">
            <button
              :disabled="v$.form.$invalid"
              type="submit"
              @click="submitForm()"
            >
              Submit
            </button>
            <button type="button" @click="$emit('close')">Close</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
import useVuelidate from "@vuelidate/core";
import { required, maxLength } from "@vuelidate/validators";

export default {
  name: "AddCompanyModal",
  props: {
    company: Object,
  },
  setup() {
    return { v$: useVuelidate() };
  },
  data() {
    return {
      form: {
        name: "",
      },
    };
  },
  validations() {
    return {
      form: {
        name: {
          required,
          mmaxLengthValueax: maxLength(500),
        },
      },
    };
  },
  methods: {
    submitForm: function () {
      console.log(this.form.name);
    },
  },
};
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style lang="scss" scoped>
.vue-modal {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  overflow-x: hidden;
  overflow-y: auto;
  background-color: rgba(0, 0, 0, 0.4);
  z-index: 1;
}

.vue-modal-inner {
  max-width: 500px;
  margin: 2rem auto;
}

.vue-modal-content {
  position: relative;
  background-color: #fff;
  border: 1px solid rgba(0, 0, 0, 0.3);
  background-clip: padding-box;
  border-radius: 0.3rem;
  padding: 1rem;
}

.form {
  width: 100%;
  display: flex;
  flex-direction: column;
  gap: 1rem;

  &-buttons {
    display: flex;
    gap: 1rem;

    & button {
      padding: 0.5rem;
    }
  }
}
</style>
