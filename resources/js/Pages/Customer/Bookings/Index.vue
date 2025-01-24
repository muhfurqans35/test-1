<template>
  <AuthenticatedLayout>
    <Head title="Manajemen Jadwal Travel" />
    <template #header>
            <h2
                class="text-xl font-semibold leading-tight text-gray-800"
            >
                Riwayat Pemesanan
            </h2>
      </template>
    <div class="max-w-4xl mx-auto px-6 py-8">

      <!-- Tampilkan pesan sukses/error -->
      <div v-if="success" class="mb-4 p-4 bg-green-100 text-green-800 rounded">
        {{ success }}
      </div>
      <div v-if="errors.error" class="mb-4 p-4 bg-red-100 text-red-800 rounded">
        {{ errors.error }}
      </div>

      <!-- Daftar pemesanan -->
      <div class="bg-white p-6 rounded-lg shadow-md mb-4">
        <h2 class="text-xl font-semibold text-gray-700 mb-4">Daftar Pemesanan</h2>
        <ul class="space-y-4">
          <li v-for="booking in bookings" :key="booking.id" class="border-b pb-4">
            <div class="flex justify-between items-center">
              <div>
                <p><strong>Tujuan:</strong> {{ booking.travel_schedule.destination }}</p>
                <p><strong>Tanggal Keberangkatan:</strong> {{ new Date(booking.travel_schedule.departure_date).toLocaleDateString() }}</p>
                <p><strong>Status Pembayaran:</strong> 
                  <span :class="{ 'text-green-600': booking.status === 'confirmed', 'text-red-600': booking.status === 'pending' }">
                    {{ booking.status === 'confirmed' ? 'Dikonfirmasi' : 'Belum Dikonfirmasi' }}
                  </span>
                </p>
              </div>
              <div class="flex space-x-4">
                <!-- Tombol bayar -->
                <button
                  v-if="booking.status === 'pending'"
                  @click="handlePayment(booking.id)"
                  class="px-4 py-2 bg-blue-600 text-white rounded-lg"
                >
                  Bayar Sekarang
                </button>

                <!-- Tombol tampilkan invoice -->
                <button
                  v-if="booking.status === 'confirmed'"
                  @click="showInvoice(booking)"
                  class="px-4 py-2 bg-green-600 text-white rounded-lg"
                >
                  Lihat Invoice
                </button>
              </div>
            </div>
          </li>
        </ul>
      </div>

     <!-- Modal invoice -->
     <div
        v-if="isInvoiceModalOpen"
        class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center z-50"
      >
        <div class="bg-white w-full max-w-2xl p-6 rounded-lg shadow-lg">
          <h2 class="text-2xl font-bold mb-4 text-center">Invoice</h2>

          <div class="grid grid-cols-2 gap-4 text-sm">
            <div>
              <p><strong>Nomor Tiket:</strong> {{ selectedBooking?.id }}</p>
              <p><strong>Nama Penumpang:</strong> {{ selectedBooking?.user.name }}</p>
              <p><strong>Email:</strong> {{ selectedBooking?.user.email }}</p>
            </div>
            <div>
              <p><strong>Tujuan:</strong> {{ selectedBooking?.travel_schedule.destination }}</p>
              <p><strong>Tanggal Keberangkatan:</strong> {{ new Date(selectedBooking?.travel_schedule.departure_date).toLocaleDateString() }}</p>
              <p><strong>Waktu Keberangkatan:</strong> {{ selectedBooking?.travel_schedule.departure_time }}</p>
            </div>
          </div>

          <div class="mt-6 border-t pt-4 text-sm">
            <p><strong>Jumlah Penumpang:</strong> {{ selectedBooking?.travel_schedule.quota }}</p>
            <p><strong>Harga Tiket:</strong> Rp {{ Math.floor(selectedBooking?.travel_schedule.ticket_price) }}</p>
          </div>

          <div class="mt-6 text-center">
            <p class="text-gray-600 text-xs">Terima kasih telah memesan tiket dengan kami.</p>
          </div>

          <div class="mt-6 flex justify-end space-x-4">
            <button @click="closeInvoiceModal" class="px-4 py-2 bg-gray-400 text-white rounded-lg">
              Tutup
            </button>
          </div>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>

<script setup>
import { ref } from 'vue';
import { useForm } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';

const props = defineProps({
  bookings: Array,
  errors: Object,
  success: String,
});

const form = useForm();
const isInvoiceModalOpen = ref(false);
const selectedBooking = ref(null);

// Fungsi untuk menangani pembayaran
const handlePayment = async (bookingId) => {
  try {
    await form.post(`/customer/bookings/${bookingId}/pay`);
  } catch (error) {
    console.error('Error saat melakukan pembayaran:', error);
  }
};

// Fungsi untuk menampilkan modal invoice
const showInvoice = (booking) => {
  selectedBooking.value = booking;
  isInvoiceModalOpen.value = true;
};

// Fungsi untuk menutup modal invoice
const closeInvoiceModal = () => {
  isInvoiceModalOpen.value = false;
  selectedBooking.value = null;
};
</script>
