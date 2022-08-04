<template>
  <link
    rel="stylesheet"
    href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200"
  />
  <link
    rel="stylesheet"
    href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0"
  />
  <div class="home">
    <div class="home__header">
      <h1>Companies Management</h1>
      <button @click="openAddCompanyModal()">Add Company</button>
    </div>
    <div class="home__body">
      <div
        v-for="company in companies"
        v-bind:key="company.id"
        class="home__body__company-card"
      >
        <CompanyCard @close="modalClosed()" :company="company" />
      </div>
    </div>
  </div>
  <AddCompanyModal v-if="modalIsOpen" @close="modalClosed()" />
</template>

<script>
import CompanyCard from "./components/CompanyCard.vue";
import AddCompanyModal from "@/modals/AddCompanyModal.vue";
import { ref } from "vue";
import useCompanies from "./services/companies";
import { onMounted } from "vue";

export default {
  name: "App",
  components: {
    CompanyCard,
    AddCompanyModal,
  },
  emits: ["close"],
  setup() {
    const modalIsOpen = ref(false);

    const { companies, getCompanies } = useCompanies();
    onMounted(getCompanies);

    const modalClosed = () => {
      getCompanies();
      modalIsOpen.value = false;
    };

    return { modalIsOpen, companies, modalClosed };
  },
  methods: {
    openAddCompanyModal: function () {
      this.modalIsOpen = true;
    },
  },
};
</script>

<style lang="scss">
@import url("https://fonts.googleapis.com/css2?family=Poppins&display=swap");

* {
  padding: 0;
  margin: 0;
  box-sizing: border-box;
  font-family: "Poppins", sans-serif;
  color: #2e4052;
}

input {
  border: 0;
  outline: 0;
  color: rgb(60, 66, 87);
  background-color: rgb(255, 255, 255);
  box-shadow: rgb(0 0 0 / 0%) 0px 0px 0px 0px, rgb(0 0 0 / 0%) 0px 0px 0px 0px,
    rgb(0 0 0 / 0%) 0px 0px 0px 0px, rgb(60 66 87 / 16%) 0px 0px 0px 1px,
    rgb(0 0 0 / 0%) 0px 0px 0px 0px, rgb(0 0 0 / 0%) 0px 0px 0px 0px,
    rgb(0 0 0 / 0%) 0px 0px 0px 0px;
  border-radius: 4px;
  font-size: 14px;
  line-height: 20px;
  font-weight: 400;
  /* padding: 4px 8px; */
  min-height: 20px;
  vertical-align: middle;
  transition: background-color 0.24s, box-shadow 0.24s;
  transition-property: background-color, box-shadow;
  transition-duration: 0.24s, 0.24s;
  transition-timing-function: ease, ease;
  transition-delay: 0s, 0s;
  width: 100%;
  font-weight: 600;
  padding: 0.4rem 0.2rem;
  background-color: #fafaf9;
  color: black;
  resize: none;
  height: 2rem;
}

input:focus {
  box-shadow: rgb(0 0 0 / 0%) 0px 0px 0px 0px,
    rgb(58 151 212 / 36%) 0px 0px 0px 4px, rgb(0 0 0 / 0%) 0px 0px 0px 0px,
    rgb(60 66 87 / 16%) 0px 0px 0px 1px, rgb(0 0 0 / 0%) 0px 0px 0px 0px,
    rgb(0 0 0 / 0%) 0px 0px 0px 0px, rgb(0 0 0 / 0%) 0px 0px 0px 0px;
}

button {
  width: 100%;
  background-color: #41729f;
  padding: 0.5rem 1rem;
  color: white;
  border-radius: 0.3rem;
  border: 1px solid #41729f;
  font-size: 1.05rem;
  cursor: pointer;
  transition: background 180ms ease_out;
  font-weight: 600;
  letter-spacing: 0.1rem;
  &:hover {
    background-color: #274472;
    border: 1px solid #274472;
    box-shadow: rgba(50, 50, 93, 0.25) 0px 13px 27px -5px,
      rgba(0, 0, 0, 0.3) 0px 8px 16px -8px;
  }
}

.home {
  background-color: #fafaf9;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: flex-start;
  min-height: 100vh;
  gap: 3rem;

  &__header {
    margin-top: 1rem;
    padding: 0.5rem;
    text-align: center;
    color: #2e4052;

    & button {
      max-width: 10rem;
      padding: 0.5rem;
      margin-top: 1rem;
    }
  }

  &__body {
    display: flex;
    flex-direction: column;
    gap: 2rem;
  }
}

.error {
  & p {
    color: red;
  }
}
</style>
