<script setup>
import { ref, watch } from 'vue';
import { Link, useForm } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';


defineProps({
  schedules: Array,
});

// Referensi untuk modal dan jadwal yang dipilih
const showModal = ref(false);
const selectedSchedule = ref({
  id: null,
  destination: '',
  departure_date: '',
  departure_time: '',
  quota: 0,
  ticket_price: 0,
});

// Form untuk update jadwal
const updateForm = useForm({
  destination: '',
  departure_date: '',
  departure_time: '',
  quota: '',
  ticket_price: '',
});

// Sinkronisasi data selectedSchedule ke updateForm
watch(selectedSchedule, (schedule) => {
  updateForm.destination = schedule.destination;
  updateForm.departure_date = schedule.departure_date;
  updateForm.departure_time = schedule.departure_time;
  updateForm.quota = schedule.quota;
  updateForm.ticket_price = schedule.ticket_price;
});

// Buka modal dengan jadwal yang dipilih
const openModal = (schedule) => {
  selectedSchedule.value = { ...schedule };
  showModal.value = true;
};

// Tutup modal dan reset data
const closeModal = () => {
  showModal.value = false;
  selectedSchedule.value = { id: null, destination: '', departure_date: '', departure_time: '', quota: 0, ticket_price: 0 };
};

// Update jadwal
const updateSchedule = () => {
  updateForm.put(route('admin.schedules.update', { schedule: selectedSchedule.value.id }), {
    onSuccess: () => {
      alert('Jadwal berhasil diperbarui!');
      closeModal();
    },
    onError: (errors) => {
      console.error(errors);
    },
  });
};

// Hapus jadwal
const deleteSchedule = (scheduleId) => {
  if (confirm('Apakah Anda yakin ingin menghapus jadwal ini?')) {
    updateForm.delete(route('admin.schedules.destroy', { schedule: scheduleId }), {
      onSuccess: () => {
        alert('Jadwal berhasil dihapus!');
      },
      onError: (error) => {
        console.error('Gagal menghapus jadwal:', error);
      },
    });
  }
};
</script>

<template>
  <AuthenticatedLayout>
    <Head title="Manajemen Jadwal Travel" />
    <template #header>
            <h2
                class="text-xl font-semibold leading-tight text-gray-800"
            >
                Manajemen Jadwal Travel 
            </h2>
      </template>
    <div class="py-12">
      <div class="mx-auto max-w-6xl bg-white shadow-md rounded-lg p-6">
    <Link href="/admin/schedules/create" class="bg-blue-600 text-white px-4 py-2 rounded-lg mb-6 inline-block">Tambah Jadwal</Link>

    <div class="overflow-x-auto bg-white shadow-md rounded-lg">
      <table class="min-w-full table-auto">
        <thead>
          <tr class="bg-gray-200 text-left">
            <th class="px-6 py-3">Tujuan</th>
            <th class="px-6 py-3">Tanggal Keberangkatan</th>
            <th class="px-6 py-3">Waktu Keberangkatan</th>
            <th class="px-6 py-3">Kuota</th>
            <th class="px-6 py-3">Harga Tiket</th>
            <th class="px-6 py-3">Aksi</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="schedule in schedules" :key="schedule.id" class="border-b hover:bg-gray-100">
            <td class="px-6 py-4">{{ schedule.destination }}</td>
            <td class="px-6 py-4">{{ schedule.departure_date }}</td>
            <td class="px-6 py-4">{{ schedule.departure_time }}</td>
            <td class="px-6 py-4">{{ schedule.quota }}</td>
            <td class="px-6 py-4">{{ Math.floor(schedule.ticket_price) }}</td>
            <td class="px-6 py-4">
              <button @click="openModal(schedule)" class="bg-yellow-500 text-white px-4 py-2 rounded-lg mr-2">Edit</button>
              <button @click="deleteSchedule(schedule.id)" class="bg-red-600 text-white px-4 py-2 rounded-lg">Hapus</button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>

    <!-- Modal untuk Update Jadwal -->
    <div v-if="showModal" class="fixed inset-0 bg-gray-500 bg-opacity-75 flex justify-center items-center z-50">
      <div class="bg-white p-6 rounded-lg w-96">
        <h5 class="text-xl font-semibold mb-4">Update Jadwal Travel</h5>
        <form @submit.prevent="updateSchedule">
          <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Tujuan</label>
            <input
              type="text"
              v-model="updateForm.destination"
              class="w-full px-4 py-2 border border-gray-300 rounded-lg mt-2"
              required
            />
          </div>
          <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Tanggal Keberangkatan</label>
            <input
              type="date"
              v-model="updateForm.departure_date"
              class="w-full px-4 py-2 border border-gray-300 rounded-lg mt-2"
              required
            />
          </div>
          <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Waktu Keberangkatan</label>
            <input
              type="time"
              v-model="updateForm.departure_time"
              class="w-full px-4 py-2 border border-gray-300 rounded-lg mt-2"
              required
            />
          </div>
          <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Kuota</label>
            <input
              type="number"
              v-model="updateForm.quota"
              class="w-full px-4 py-2 border border-gray-300 rounded-lg mt-2"
              required
            />
          </div>
          <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Harga Tiket</label>
            <input
              type="number"
              v-model="updateForm.ticket_price"
              class="w-full px-4 py-2 border border-gray-300 rounded-lg mt-2"
              required
            />
          </div>
          <div class="flex justify-end space-x-2">
            <button type="button" @click="closeModal" class="bg-gray-400 text-white px-4 py-2 rounded-lg">Tutup</button>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg">Update</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  </div>

 </AuthenticatedLayout>
</template>