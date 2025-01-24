
<script setup>
import { ref } from 'vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
const props = defineProps({
  reports: Array,
});

const isModalOpen = ref(false);
const selectedReport = ref(null);

const openPassengerModal = (reportId) => {
  const report = props.reports.find((r) => r.id === reportId);
  if (report) {
    selectedReport.value = report;
    isModalOpen.value = true;
  }
};

const closeModal = () => {
  isModalOpen.value = false;
  selectedReport.value = null;
};
</script>

<template>
  <AuthenticatedLayout>
    <Head title="Laporan Travel" />
    <template #header>
            <h2
                class="text-xl font-semibold leading-tight text-gray-800"
            >
                Laporan Travel 
            </h2>
        </template>
    <div class="py-12">
      <div class="mx-auto max-w-6xl bg-white shadow-md rounded-lg p-6">
        <div class="overflow-x-auto bg-white shadow-md rounded-lg"></div>
      <table class="min-w-full table-auto border border-white shadow-sm rounded-lg">
        <thead>
          <tr class="bg-gray-100">
            <th class="px-6 py-4 text-left text-sm font-medium text-gray-600">Tujuan</th>
            <th class="px-6 py-4 text-left text-sm font-medium text-gray-600">Tanggal Keberangkatan</th>
            <th class="px-6 py-4 text-left text-sm font-medium text-gray-600">Jumlah Penumpang</th>
            <th class="px-6 py-4 text-left text-sm font-medium text-gray-600">Aksi</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="report in reports" :key="report.id" class="border-b hover:bg-gray-50">
            <td class="px-6 py-4 text-sm">{{ report.destination }}</td>
            <td class="px-6 py-4 text-sm">{{ new Date(report.departure_date).toLocaleDateString() }}</td>
            <td class="px-6 py-4 text-sm">{{ report.bookings_count }}</td>
            <td class="px-6 py-4">
              
              <button 
                @click="openPassengerModal(report.id)"
                class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition"
              >
                Lihat Penumpang
              </button>
            </td>
          </tr>
        </tbody>
      </table>

      <div v-if="isModalOpen" class="fixed inset-0 bg-gray-500 bg-opacity-50 flex justify-center items-center">
        <div class="bg-white p-6 rounded-lg shadow-lg max-w-lg w-full">
          <h2 class="text-xl font-semibold mb-4 text-gray-800">Penumpang untuk Jadwal: {{ selectedReport.destination }}</h2>
          <table class="min-w-full table-auto border border-gray-300">
            <thead>
              <tr class="bg-gray-100">
                <th class="px-6 py-4 text-left text-sm font-medium text-gray-600">Nama Penumpang</th>
                <th class="px-6 py-4 text-left text-sm font-medium text-gray-600">Email</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="user in selectedReport.bookings" :key="user.id" class="border-b hover:bg-gray-50">
                <td class="px-6 py-4 text-sm">{{ user.user.name }}</td> 
                <td class="px-6 py-4 text-sm">{{ user.user.email }}</td> 
              </tr>
            </tbody>
          </table>
          <div class="mt-4 flex justify-end">
            <button 
              @click="closeModal"
              class="bg-gray-600 text-white px-4 py-2 rounded-lg hover:bg-gray-700 transition"
            >
              Tutup
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>

  </AuthenticatedLayout>
</template>
