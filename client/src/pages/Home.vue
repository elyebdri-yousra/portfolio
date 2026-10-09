<template>
  <div class="home">
    <section class="hero">
      <div class="hero-content">
        <h1>EL YEBDRI Yousra</h1>
        <span class="year">2026</span>
        <p>Bienvenue sur mon portfolio ! Je suis Yousra EL YEBDRI, étudiante en BUT Métiers du Multimédia et de l'Internet (MMI).</p>
        <p>Vous pourrez découvrir mon parcours, mes compétences, mes projets et me contacter.</p>
        <router-link to="/about" class="btn btn-primary">En savoir plus</router-link>
      </div>
    </section>
  </div>
</template>

<script setup>
</script>

<style scoped>
.home {
  min-height: 70vh;
  display: flex;
  align-items: center;
  justify-content: center;
}

.hero {
  width: 100%;
  text-align: center;
  padding: 4rem 2rem;
}

.hero-content {
  max-width: 800px;
  margin: 0 auto;
}

h1 {
  font-size: 3rem;
  color: #d946a6;
  margin-bottom: 1rem;
}

.year {
  display: block;
  font-size: 2rem;
  color: #999;
  margin-bottom: 2rem;
}

p {
  font-size: 1.1rem;
  color: #666;
  margin-bottom: 1.5rem;
  line-height: 1.6;
}

.btn {
  display: inline-block;
  padding: 1rem 2rem;
  border-radius: 8px;
  text-decoration: none;
  font-weight: 500;
  transition: all 0.3s;
}

.btn-primary {
  background: #d946a6;
  color: white;
}

.btn-primary:hover {
  background: #c0209d;
  transform: translateY(-2px);
}

@media (max-width: 768px) {
  h1 {
    font-size: 2rem;
  }

  .year {
    font-size: 1.5rem;
  }
}
</style>
