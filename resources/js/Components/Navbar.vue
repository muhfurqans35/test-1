<template>
  <nav class="bg-blue-600 text-white py-4">
    <div class="container mx-auto flex justify-between items-center">
      <h1 class="text-2xl font-bold">TiketApp</h1>
      <div class="flex items-center space-x-4">
        <!-- Kondisi Login/Logout dan Peran -->
        <div v-if="!($page.props.auth.user)">
          <Link href="/login" class="px-4 py-2 rounded-lg text-white hover:bg-blue-700">Login</Link>
          <Link href="/register" class="px-4 py-2 rounded-lg text-white hover:bg-blue-700">Register</Link>
        </div>
        <div v-else>
          <div v-if="$page.props.auth.user">
            <div v-if="$page.props.auth.user.role === 'customer'">
            <Link href="/customer/orders" class="px-4 py-2 rounded-lg text-white hover:bg-blue-700">Order</Link>
            </div>
            <div v-if="$page.props.auth.user.role === 'admin'">
            <Link href="/admin/schedules" class="px-4 py-2 rounded-lg text-white hover:bg-blue-700">Order</Link>
            </div>
          </div>
        </div>
      </div>
    </div>
  </nav>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
</script>
