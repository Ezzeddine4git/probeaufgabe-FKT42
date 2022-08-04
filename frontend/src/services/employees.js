import { ref } from "vue";
import axios from "axios";

export default function useemployees() {
  const errors = ref("");

  const storeEmployee = async (data) => {
    console.log(data);
    errors.value = "";
    try {
      await axios.post("http://127.0.0.1:8000/api/create_employee", data);
    } catch (e) {
      if (e.response.status === 422) {
        errors.value = e.response.data.errors;
      }
    }
  };

  return {
    storeEmployee,
    errors,
  };
}
