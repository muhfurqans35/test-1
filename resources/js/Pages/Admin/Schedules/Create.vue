<script setup>
import { useForm } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';

const form = useForm({
  destination: '',
  departure_date: '',
  departure_time: '',
  quota: '',
  ticket_price: ''
});

const submitForm = () => {
  form.post('/admin/schedules', {
    onSuccess: () => {
      alert('Jadwal berhasil ditambahkan!');
    },
    onError: (errors) => {
      console.log(errors);
    },
  });
};
</script>

<template>
  <Head title="Tambah Jadwal Travel" />
  <AuthenticatedLayout>
    <template #header>
      <h2 class="text-xl font-semibold leading-tight text-gray-800">
        Tambah Jadwal Travel
      </h2>
    </template>

    <div class="py-12">
      <div class="mx-auto max-w-4xl bg-white shadow-md rounded-lg p-6">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">Tambah Jadwal Travel</h1>
        <form @submit.prevent="submitForm">
          <div class="mb-4">
            <label for="destination" class="block text-sm font-medium text-gray-700 mb-2">
              Tujuan
            </label>
            <input 
              v-model="form.destination"
              type="text" 
              id="destination" 
              name="destination" 
              class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring focus:ring-blue-300" 
              required 
            />
          </div>

          <div class="mb-4">
            <label for="departure_date" class="block text-sm font-medium text-gray-700 mb-2">
              Tanggal Keberangkatan
            </label>
            <input 
              v-model="form.departure_date"
              type="date" 
              id="departure_date" 
              name="departure_date" 
              class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring focus:ring-blue-300" 
              required 
            />
          </div>

          <div class="mb-4">
            <label for="departure_time" class="block text-sm font-medium text-gray-700 mb-2">
              Waktu Keberangkatan
            </label>
            <input 
              v-model="form.departure_time"
              type="time" 
              id="departure_time" 
              name="departure_time" 
              class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring focus:ring-blue-300" 
              required 
            />
          </div>

          <div class="mb-4">
            <label for="quota" class="block text-sm font-medium text-gray-700 mb-2">
              Kuota
            </label>
            <input 
              v-model="form.quota"
              type="number" 
              id="quota" 
              name="quota" 
              min="1" 
              class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring focus:ring-blue-300" 
              required 
            />
          </div>

          <div class="mb-4">
            <label for="ticket_price" class="block text-sm font-medium text-gray-700 mb-2">
              Harga Tiket
            </label>
            <input 
              v-model="form.ticket_price"
              type="number" 
              id="ticket_price" 
              name="ticket_price" 
              min="0" 
              step="0.01" 
              class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring focus:ring-blue-300" 
              required 
            />
          </div>

          <div class="flex justify-end">
            <button 
              type="submit" 
              class="px-6 py-2 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 focus:outline-none focus:ring focus:ring-blue-300"
            >
              Simpan
            </button>
          </div>
        </form>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
