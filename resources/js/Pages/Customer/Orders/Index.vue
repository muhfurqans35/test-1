<template>
  <AuthenticatedLayout>
    <Head title="Manajemen Jadwal Travel" />
    <template #header>
            <h2
                class="text-xl font-semibold leading-tight text-gray-800"
            >
                Daftar Jadwal Travel
            </h2>
    </template>
    <div class="max-w-4xl mx-auto px-6 py-8">
      <div class="bg-white p-6 rounded-lg shadow-md mb-4">
      <ul class="space-y-4">
        <li v-for="schedule in schedules" :key="schedule.id" class="border-b border-gray-200 pb-4">
          <div class="flex justify-between items-center">
            <div>
              <p class="text-lg font-semibold text-gray-900">{{ schedule.destination }}</p>
              <p class="text-sm text-gray-600">{{ new Date(schedule.departure_date).toLocaleDateString() }} - Kuota: {{ schedule.quota }}</p>
            </div>
            <form @submit.prevent="makeBooking(schedule.id)" class="flex items-center">
              <button 
                type="submit" 
                :disabled="schedule.quota <= 0" 
                class="px-4 py-2 bg-blue-600 text-white rounded-lg disabled:bg-gray-400 transition duration-200"
              >
                Pesan
              </button>
            </form>
          </div>
        </li>
      </ul>
      <div v-if="successMessage" class="mt-4 text-green-600">{{ successMessage }}</div>
      <div v-if="errorMessage" class="mt-4 text-red-600">{{ errorMessage }}</div>
    </div>
  </div>
  </AuthenticatedLayout>
</template>

<script setup>
import { useForm } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { ref } from 'vue';
import { Head } from '@inertiajs/vue3';

defineProps({
  schedules: Array,
});

const successMessage = ref(null);
const errorMessage = ref(null);

const makeBooking = (scheduleId) => {
  const form = useForm({
    travel_schedule_id: scheduleId,
  });

  successMessage.value = null;
  errorMessage.value = null;
  
  form.post('/customer/bookings', {
    onSuccess: () => {
      successMessage.value = 'Pemesanan berhasil dilakukan!';
    },
    onError: () => {
      errorMessage.value = 'Pemesanan gagal, kuota habis.';
    },
  });
};
</script>