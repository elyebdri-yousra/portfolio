<template>
  <div class="home">
    <section class="hero">
      <div class="hero-background"></div>
      <div class="hero-content">
        <h1 class="hero-title">EL YEBDRI Yousra</h1>
        <span class="year">2026</span>
        <p class="hero-subtitle">Développeuse Web & Designer Multimédia</p>
        <p class="hero-description">Bienvenue sur mon portfolio ! Je suis une étudiante en BUT Métiers du Multimédia et de l'Internet (MMI), passionnée par le développement web et le design numérique. Découvrez mon parcours, mes compétences, et mes projets.</p>
        <div class="cta-buttons">
          <router-link to="/about" class="btn btn-primary">Découvrir mon parcours</router-link>
          <router-link to="/projets" class="btn btn-secondary">Voir mes projets</router-link>
        </div>
      </div>
    </section>

    <section class="highlights">
      <div class="highlights-content">
        <h2>Domaines de compétences</h2>
        <div class="highlights-grid">
          <div class="highlight-card">
            <div class="highlight-icon">🎨</div>
            <h3>Design</h3>
            <p>Créer des interfaces modernes et intuitives avec Figma et CSS</p>
          </div>
          <div class="highlight-card">
            <div class="highlight-icon">💻</div>
            <h3>Développement Frontend</h3>
            <p>Vue 3, JavaScript, HTML5 et les dernières technologies web</p>
          </div>
          <div class="highlight-card">
            <div class="highlight-icon">⚙️</div>
            <h3>Développement Backend</h3>
            <p>Node.js, Express, PostgreSQL et REST APIs</p>
          </div>
        </div>
      </div>
    </section>
  </div>
</template>

<script setup>
</script>

<style scoped>
.home {
  display: flex;
  flex-direction: column;
}

.hero {
  position: relative;
  min-height: 60vh;
  display: flex;
  align-items: center;
  justify-content: center;
  overflow: hidden;
  padding: 4rem 2rem;
}

.hero-background {
  position: absolute;
  inset: 0;
  background: linear-gradient(135deg, rgba(217, 70, 166, 0.05) 0%, rgba(217, 70, 166, 0.02) 100%);
  z-index: 0;
}

.hero::before {
  content: '';
  position: absolute;
  width: 600px;
  height: 600px;
  background: radial-gradient(circle, rgba(217, 70, 166, 0.08) 0%, transparent 70%);
  border-radius: 50%;
  top: -200px;
  right: -200px;
  z-index: 0;
  pointer-events: none;
}

.hero-content {
  max-width: 700px;
  margin: 0 auto;
  text-align: center;
  position: relative;
  z-index: 1;
}

.hero-title {
  font-size: 3.5rem;
  font-weight: 800;
  color: #d946a6;
  margin-bottom: 0.5rem;
  letter-spacing: -1px;
  line-height: 1.1;
}

.year {
  display: block;
  font-size: 1.5rem;
  color: #999;
  margin-bottom: 1.5rem;
  font-weight: 500;
}

.hero-subtitle {
  font-size: 1.4rem;
  color: #d946a6;
  margin-bottom: 1rem;
  font-weight: 600;
}

.hero-description {
  font-size: 1.05rem;
  color: #666;
  margin-bottom: 2.5rem;
  line-height: 1.7;
}

.cta-buttons {
  display: flex;
  gap: 1rem;
  justify-content: center;
  flex-wrap: wrap;
}

.btn {
  display: inline-block;
  padding: 0.95rem 2rem;
  border-radius: 6px;
  text-decoration: none;
  font-weight: 600;
  transition: all 0.3s ease;
  border: 2px solid transparent;
}

.btn-primary {
  background: #d946a6;
  color: white;
  box-shadow: 0 4px 12px rgba(217, 70, 166, 0.3);
}

.btn-primary:hover {
  background: #c0209d;
  transform: translateY(-3px);
  box-shadow: 0 6px 20px rgba(217, 70, 166, 0.4);
}

.btn-secondary {
  background: transparent;
  color: #d946a6;
  border-color: #d946a6;
}

.btn-secondary:hover {
  background: #d946a6;
  color: white;
  transform: translateY(-3px);
  box-shadow: 0 6px 20px rgba(217, 70, 166, 0.3);
}

.highlights {
  padding: 4rem 2rem;
  background: #f9f9f9;
}

.highlights-content {
  max-width: 1000px;
  margin: 0 auto;
}

.highlights-content h2 {
  font-size: 2rem;
  color: #d946a6;
  text-align: center;
  margin-bottom: 3rem;
  font-weight: 700;
}

.highlights-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
  gap: 2rem;
}

.highlight-card {
  background: white;
  padding: 2rem;
  border-radius: 8px;
  text-align: center;
  transition: all 0.3s ease;
  box-shadow: 0 2px 8px rgba(0,0,0,0.05);
  border-top: 3px solid #d946a6;
}

.highlight-card:hover {
  transform: translateY(-5px);
  box-shadow: 0 8px 24px rgba(0,0,0,0.12);
}

.highlight-icon {
  font-size: 3rem;
  margin-bottom: 1rem;
}

.highlight-card h3 {
  color: #1a1a1a;
  margin-bottom: 0.75rem;
  font-size: 1.25rem;
  font-weight: 600;
}

.highlight-card p {
  color: #666;
  font-size: 0.95rem;
  line-height: 1.6;
}

@media (max-width: 768px) {
  .hero {
    min-height: 50vh;
    padding: 2rem 1rem;
  }

  .hero-title {
    font-size: 2.2rem;
  }

  .year {
    font-size: 1.2rem;
    margin-bottom: 1rem;
  }

  .hero-subtitle {
    font-size: 1.1rem;
  }

  .hero-description {
    font-size: 1rem;
    margin-bottom: 2rem;
  }

  .cta-buttons {
    flex-direction: column;
  }

  .btn {
    width: 100%;
  }

  .highlights {
    padding: 3rem 1rem;
  }

  .highlights-content h2 {
    font-size: 1.5rem;
    margin-bottom: 2rem;
  }

  .highlights-grid {
    grid-template-columns: 1fr;
    gap: 1.5rem;
  }

  .hero::before {
    width: 400px;
    height: 400px;
    top: -150px;
    right: -150px;
  }
}
</style>
