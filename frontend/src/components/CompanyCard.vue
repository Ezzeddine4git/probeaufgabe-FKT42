<template>
  <WidgetContainerModal />
  <div class="company__card">
    <div class="company__card__header" @click="toggleCompany()">
      <h4>{{ company.name }}</h4>
      <span class="material-symbols-outlined" v-if="!toggle">
        expand_more
      </span>
      <span class="material-symbols-outlined" v-if="toggle"> expand_less </span>
    </div>
    <div :class="{ toggle: toggle }" class="company__card__employees">
      <div class="company__card__employees__header">
        <h4>Employees</h4>
        <Button @click="openAddEmployeeModal()">Add Employee</Button>
      </div>
      <div
        v-for="employee in company.employees"
        v-bind:key="employee.id"
        class="company__card__employees__body"
      >
        <p class="name">{{ employee.firstname }} {{ employee.lastname }}</p>
        <p class="email">{{ employee.email }}</p>
      </div>
    </div>
  </div>
  <AddEmployeeModal
    v-if="modalIsOpen"
    @close="modalIsOpen = !modalIsOpen"
    :company="company"
  />
</template>

<script>
import AddEmployeeModal from "@/modals/AddEmployeeModal.vue";
import { ref } from "vue";

export default {
  name: "CompanyCard",
  setup() {
    const modalIsOpen = ref(false);

    return { modalIsOpen };
  },
  component: {
    AddEmployeeModal,
  },
  props: {
    company: Object,
  },
  data() {
    return {
      toggle: false,
    };
  },
  methods: {
    toggleCompany: function () {
      this.toggle = !this.toggle;
    },
    openAddEmployeeModal: function () {
      this.modalIsOpen = true;
    },
  },
  components: { AddEmployeeModal },
};
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style lang="scss" scoped>
.company__card {
  background-color: white;
  border: 1px solid lightgray;
  border-radius: 0.3rem;
  box-shadow: rgba(149, 157, 165, 0.2) 0px 8px 24px;
  max-width: 80vw;
  width: 30rem;
  &__header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    width: 100%;
    cursor: pointer;
    padding: 1rem;
  }

  &__employees {
    height: 0;
    overflow: hidden;
    transition: all 180ms ease-out;
    display: flex;
    flex-direction: column;
    gap: 1.5rem;

    &__header {
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 0.5rem;

      & button {
        max-width: 8rem;
        font-size: small;
        padding: 0.5rem 0.2rem;
        font-weight: 600;
      }
    }

    &__body {
      display: flex;
      align-items: center;
      justify-content: space-between;
      border: 1px solid lightgray;
      border-radius: 0.3rem;
      padding: 0.5rem;
    }
  }
}

.toggle {
  height: auto;
  padding: 1rem 2rem;
  border-top: 1px solid lightgray;
}
</style>
