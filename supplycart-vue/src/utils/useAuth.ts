import { ref, type Ref } from 'vue';
import { useRouter } from 'vue-router';
import axios from './api'; 

interface User {
  id: number;
  name: string;
  email: string;
}

interface Credentials {
  email: string;
  password: string;
}

interface RegisterData extends Credentials {
  name: string;
  password_confirmation: string;
}

interface ErrorResponse {
  [key: string]: string[]; 
}

export default function useAuth() {
  const user: Ref<User | null> = ref(null);
  const errors: Ref<ErrorResponse | null> = ref(null);
  const router = useRouter();

  const fetchUser = async () => {
    try {
      const response = await axios.get('/user');
      user.value = response.data;
    } catch (error: any) {
      user.value = null;
    }
  };

  const register = async (userData: RegisterData) => {
    try {
      await axios.post('/register', userData);
      await fetchUser();
      router.push('/');
    } catch (error: any) {
      if (error.response && error.response.data && error.response.data.errors) {
        errors.value = error.response.data.errors;
      } else {
        errors.value = { message: ['An error occurred. Please try again.'] };
      }
    }
  };

  const login = async (credentials: Credentials) => {
    try {
      await axios.post('/login', credentials);
      await fetchUser();
      router.push('/');
    } catch (error: any) {
      if (error.response && error.response.data && error.response.data.errors) {
        errors.value = error.response.data.errors;
      } else {
        errors.value = { message: ['An error occurred. Please try again.'] };
      }
    }
  };

  const logout = async () => {
    try {
      await axios.post('/logout');
      user.value = null;
      router.push('/login');
    } catch (error: any) {
      if (error.response && error.response.data && error.response.data.errors) {
        errors.value = error.response.data.errors;
      } else {
        errors.value = { message: ['An error occurred. Please try again.'] };
      }
    }
  };

  return {
    user,
    errors,
    register,
    login,
    logout,
    fetchUser,
  };
}
