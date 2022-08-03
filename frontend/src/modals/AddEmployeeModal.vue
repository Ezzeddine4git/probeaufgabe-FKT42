<template>
  <div class="vue-modal">
    <div class="vue-modal-inner">
      <div class="vue-modal-content">
        <h1>Add New Employee:</h1>
        <form class="form">
          <div class="fg form-firstname">
            <label for="firstname">Firstname:</label>
            <input type="text" />
          </div>
          <div class="fg form-lastname">
            <label for="lastname">Lastname:</label>
            <input type="text" />
          </div>
          <div class="fg form-email">
            <label for="email">E-Mail Adress:</label>
            <input type="email" />
          </div>
          <div class="form-buttons">
            <button type="submit" @click="$emit('close')">Submit</button>
            <button type="button" @click="$emit('close')">Close</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "AddEmployeeModal",
  props: {
    company: Object,
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
