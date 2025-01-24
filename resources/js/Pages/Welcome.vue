<script setup>
  import { Link, Head } from '@inertiajs/vue3';
  import Navbar from "@/components/Navbar.vue";
  import Footer from "@/components/Footer.vue";
</script>
<template> 
    <div>
      <!-- Navbar -->
      <Navbar />
      <Head title="Home" />
      <!-- Hero Section -->
      <section class="bg-blue-600 text-white py-20">
        <div class="container mx-auto text-center">
          <h1 class="text-4xl font-bold mb-4">Selamat Datang di Aplikasi Pemesanan Tiket</h1>
          <p class="text-lg mb-6">Pesan tiket perjalanan Anda dengan cepat dan mudah hanya dalam beberapa klik.</p>
          <button class="bg-white text-blue-600 px-6 py-2 rounded-lg font-semibold">
            <Link href="/register">Mulai Sekarang</Link>
          </button>
        </div>
      </section>
  
      <!-- Features Section -->
      <section class="features py-20 bg-gray-100">
        <div class="container mx-auto">
          <h2 class="text-3xl font-bold text-center mb-12">Mengapa Memilih Kami?</h2>
          <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="feature-card bg-white p-6 rounded-lg shadow-md">
              <h3 class="text-xl font-bold mb-4">Mudah Digunakan</h3>
              <p class="text-gray-600">Interface yang sederhana dan mudah dipahami oleh siapa saja.</p>
            </div>
            <div class="feature-card bg-white p-6 rounded-lg shadow-md">
              <h3 class="text-xl font-bold mb-4">Pembayaran Aman</h3>
              <p class="text-gray-600">Kami menggunakan sistem pembayaran terpercaya untuk keamanan transaksi Anda.</p>
            </div>
            <div class="feature-card bg-white p-6 rounded-lg shadow-md">
              <h3 class="text-xl font-bold mb-4">Pelayanan Cepat</h3>
              <p class="text-gray-600">Proses pemesanan tiket yang cepat tanpa antrean panjang.</p>
            </div>
          </div>
        </div>
      </section>
  
      <!-- Footer -->
      <Footer />
    </div>
  </template>
  

  
  