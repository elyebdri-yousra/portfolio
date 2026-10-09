<template>
  <div class="about">
    <section class="hero-section">
      <h1>À propos de moi</h1>
      <p class="subtitle">Étudiante en BUT Métiers du Multimédia et de l'Internet</p>
    </section>

    <section class="content-section">
      <div class="section-content">
        <h2>Mon parcours</h2>
        <p>
          Je suis Yousra EL YEBDRI, étudiante en BUT Métiers du Multimédia et de l'Internet (MMI)
          au sein de l'IUT. Ma passion pour le développement web et le design m'a poussée à
          explorer diverses technologies et à mettre en pratique mes connaissances à travers
          des projets concrets.
        </p>
        <p>
          Au cours de ma formation, j'ai développé des compétences solides en développement
          front-end et back-end, ainsi qu'une bonne compréhension des principes du design
          et de l'expérience utilisateur.
        </p>
      </div>

      <div class="section-content">
        <h2>Compétences techniques</h2>
        <div class="skills-grid">
          <div class="skill-category">
            <h3>Front-end</h3>
            <ul>
              <li>Vue 3</li>
              <li>HTML5 / CSS3</li>
              <li>JavaScript / ES6+</li>
              <li>Responsive Design</li>
            </ul>
          </div>
          <div class="skill-category">
            <h3>Back-end</h3>
            <ul>
              <li>Node.js / Express.js</li>
              <li>PostgreSQL</li>
              <li>REST API</li>
              <li>Authentification JWT</li>
            </ul>
          </div>
          <div class="skill-category">
            <h3>Outils & Services</h3>
            <ul>
              <li>Git / GitHub</li>
              <li>Docker</li>
              <li>Vite</li>
              <li>Figma</li>
            </ul>
          </div>
        </div>
      </div>

      <div class="section-content">
        <h2>Valeurs & Approche</h2>
        <p>
          Je crois en l'importance de créer des solutions web accessibles, performantes et
          intuitives. Je suis attentive aux détails et je m'efforce toujours de comprendre
          les besoins des utilisateurs pour fournir les meilleurs résultats possibles.
        </p>
        <p>
          Je suis ouverte à l'apprentissage continu et j'aime travailler dans un environnement
          collaboratif où je peux partager mes idées et apprendre des autres.
        </p>
      </div>
    </section>

    <section class="cta-section">
      <h2>Envie de collaborer ?</h2>
      <p>N'hésitez pas à me contacter pour discuter de vos projets ou pour toute opportunité de collaboration.</p>
      <a href="mailto:yousra.elyebdri@icloud.com" class="btn btn-primary">Me contacter</a>
    </section>
  </div>
</template>

<script setup>
</script>

<style scoped>
.about {
  max-width: 900px;
  margin: 0 auto;
}

.hero-section {
  text-align: center;
  padding: 2rem 1rem;
  margin-bottom: 3rem;
}

.hero-section h1 {
  color: #d946a6;
  font-size: 2.5rem;
  margin-bottom: 0.5rem;
}

.subtitle {
  color: #666;
  font-size: 1.1rem;
}

.content-section {
  display: grid;
  gap: 3rem;
  margin-bottom: 3rem;
}

.section-content {
  background: white;
  padding: 2rem;
  border-radius: 8px;
  box-shadow: 0 2px 8px rgba(0,0,0,0.1);
}

.section-content h2 {
  color: #d946a6;
  font-size: 1.8rem;
  margin-bottom: 1rem;
}

.section-content p {
  color: #333;
  line-height: 1.6;
  margin-bottom: 1rem;
}

.section-content p:last-child {
  margin-bottom: 0;
}

.skills-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
  gap: 2rem;
}

.skill-category h3 {
  color: #333;
  font-size: 1.1rem;
  margin-bottom: 0.75rem;
  border-bottom: 2px solid #d946a6;
  padding-bottom: 0.5rem;
}

.skill-category ul {
  list-style: none;
  padding: 0;
}

.skill-category li {
  color: #666;
  padding: 0.5rem 0;
  display: flex;
  align-items: center;
}

.skill-category li:before {
  content: "▸";
  color: #d946a6;
  margin-right: 0.5rem;
  font-weight: bold;
}

.cta-section {
  background: linear-gradient(135deg, #d946a6 0%, #c0209d 100%);
  color: white;
  padding: 3rem 2rem;
  border-radius: 8px;
  text-align: center;
}

.cta-section h2 {
  color: white;
  font-size: 2rem;
  margin-bottom: 1rem;
}

.cta-section p {
  color: white;
  margin-bottom: 1.5rem;
  font-size: 1.05rem;
}

.btn {
  display: inline-block;
  padding: 0.75rem 1.5rem;
  border-radius: 4px;
  text-decoration: none;
  font-weight: 500;
  transition: all 0.3s;
}

.btn-primary {
  background: white;
  color: #d946a6;
}

.btn-primary:hover {
  transform: translateY(-2px);
  box-shadow: 0 4px 12px rgba(0,0,0,0.2);
}

@media (max-width: 768px) {
  .hero-section h1 {
    font-size: 2rem;
  }

  .section-content {
    padding: 1.5rem;
  }

  .section-content h2 {
    font-size: 1.5rem;
  }

  .cta-section {
    padding: 2rem 1rem;
  }

  .cta-section h2 {
    font-size: 1.5rem;
  }

  .skills-grid {
    grid-template-columns: 1fr;
  }
}
</style>
