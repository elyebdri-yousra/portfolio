<template>
  <div class="min-h-screen bg-surface py-12 px-4">
    <div class="max-w-2xl mx-auto">
      <!-- Header -->
      <div class="text-center mb-12">
        <h1 class="text-4xl font-bold text-primary mb-4">Contactez-moi</h1>
        <p class="text-lg text-primary">
          Vous avez un projet en tête ? Je serais ravi de discuter avec vous !
        </p>
      </div>

      <!-- Contact Form -->
      <div class="bg-white rounded-lg shadow-lg p-8 md:p-12">
        <form @submit.prevent="submitForm" class="space-y-6">
          <!-- Name -->
          <div>
            <label for="name" class="block text-sm font-semibold text-primary mb-2">
              Nom complet *
            </label>
            <input
              id="name"
              v-model="form.name"
              type="text"
              required
              class="w-full px-4 py-2 border border-primary border-opacity-30 rounded-lg focus:outline-none focus:border-accent focus:ring-1 focus:ring-accent text-primary"
              placeholder="Votre nom">
          </div>

          <!-- Email -->
          <div>
            <label for="email" class="block text-sm font-semibold text-primary mb-2">
              Email *
            </label>
            <input
              id="email"
              v-model="form.email"
              type="email"
              required
              class="w-full px-4 py-2 border border-primary border-opacity-30 rounded-lg focus:outline-none focus:border-accent focus:ring-1 focus:ring-accent text-primary"
              placeholder="votre.email@exemple.com">
          </div>

          <!-- Subject -->
          <div>
            <label for="subject" class="block text-sm font-semibold text-primary mb-2">
              Sujet *
            </label>
            <input
              id="subject"
              v-model="form.subject"
              type="text"
              required
              class="w-full px-4 py-2 border border-primary border-opacity-30 rounded-lg focus:outline-none focus:border-accent focus:ring-1 focus:ring-accent text-primary"
              placeholder="Le sujet de votre message">
          </div>

          <!-- Message -->
          <div>
            <label for="message" class="block text-sm font-semibold text-primary mb-2">
              Message *
            </label>
            <textarea
              id="message"
              v-model="form.message"
              required
              rows="6"
              class="w-full px-4 py-2 border border-primary border-opacity-30 rounded-lg focus:outline-none focus:border-accent focus:ring-1 focus:ring-accent text-primary"
              placeholder="Votre message..."></textarea>
          </div>

          <!-- Submit Button -->
          <button
            type="submit"
            :disabled="submitting"
            class="w-full bg-accent text-white font-semibold py-3 rounded-lg hover:bg-accent-dark transition-colors disabled:bg-primary disabled:opacity-50">
            {{ submitting ? 'Envoi en cours...' : 'Envoyer' }}
          </button>

          <!-- Message -->
          <div v-if="submitStatus" :class="submitStatus.type === 'success' ? 'bg-accent bg-opacity-10 text-accent' : 'bg-red-100 text-red-700'" class="p-4 rounded-lg">
            {{ submitStatus.message }}
          </div>
        </form>
      </div>

      <!-- Direct Contact Info -->
      <div class="mt-12 grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="bg-white rounded-lg shadow p-6 text-center border-t-4 border-accent">
          <h3 class="text-lg font-semibold text-primary mb-2">Email</h3>
          <a href="mailto:yousra.elyebdri@icloud.com" class="text-accent hover:text-accent-dark transition-colors font-medium">
            yousra.elyebdri@icloud.com
          </a>
        </div>

        <div class="bg-white rounded-lg shadow p-6 text-center border-t-4 border-accent2">
          <h3 class="text-lg font-semibold text-primary mb-2">Réseaux sociaux</h3>
          <div class="flex justify-center gap-4">
            <a href="#" class="text-accent hover:text-accent-dark transition-colors font-medium">LinkedIn</a>
            <a href="#" class="text-accent hover:text-accent-dark transition-colors font-medium">GitHub</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue';

const form = ref({
  name: '',
  email: '',
  subject: '',
  message: ''
});

const submitting = ref(false);
const submitStatus = ref(null);

const submitForm = async () => {
  submitting.value = true;
  try {
    // For now, just show a success message
    // In a real application, this would send to an email service or API
    submitStatus.value = {
      type: 'success',
      message: 'Merci pour votre message ! Je vous répondrai dès que possible.'
    };

    // Reset form
    form.value = {
      name: '',
      email: '',
      subject: '',
      message: ''
    };

    // Clear message after 5 seconds
    setTimeout(() => {
      submitStatus.value = null;
    }, 5000);
  } catch (error) {
    submitStatus.value = {
      type: 'error',
      message: 'Une erreur est survenue. Veuillez réessayer.'
    };
  } finally {
    submitting.value = false;
  }
};
</script>
