import { ref } from "vue";
import axios from "axios";

export default function useCompanies() {
  const companies = ref([]);
  const errors = ref("");

  const getCompanies = async () => {
    let response = await axios.get(
      "http://127.0.0.1:8000/api/get_all_companies_with_respective_employees"
    );
    companies.value = response.data;
  };

  const storeCompany = async (data) => {
    errors.value = "";
    try {
      await axios.post("http://127.0.0.1:8000/api/create_company", data);
    } catch (e) {
      if (e.response.status === 422) {
        errors.value = e.response.data.errors;
      }
    }
  };

  return {
    companies,
    storeCompany,
    getCompanies,
    errors,
  };
}
