<template>
  <div class="veille">
    <section class="hero-section">
      <h1>Veille technologique</h1>
      <p class="subtitle">Rester à jour avec les dernières technologies et tendances du web</p>
    </section>

    <section class="content-section">
      <div class="intro-section">
        <p>
          La veille technologique est essentielle dans le domaine du développement web et du multimédia.
          Je suis constamment à l'écoute des nouvelles tendances, des frameworks émergents et des
          meilleures pratiques pour améliorer mes compétences et offrir des solutions modernes et performantes.
        </p>
      </div>

      <div class="sources-section">
        <h2>Mes sources de veille</h2>
        <div class="sources-grid">
          <article class="source-card">
            <h3>Documentation officielle</h3>
            <ul>
              <li><a href="https://vuejs.org" target="_blank">Vue.js</a></li>
              <li><a href="https://nodejs.org" target="_blank">Node.js</a></li>
              <li><a href="https://postgresql.org" target="_blank">PostgreSQL</a></li>
              <li><a href="https://mdn.org" target="_blank">MDN Web Docs</a></li>
            </ul>
          </article>

          <article class="source-card">
            <h3>Blogs & Articles</h3>
            <ul>
              <li><a href="https://dev.to" target="_blank">Dev.to</a></li>
              <li><a href="https://css-tricks.com" target="_blank">CSS-Tricks</a></li>
              <li><a href="https://smashingmagazine.com" target="_blank">Smashing Magazine</a></li>
              <li><a href="https://webdev.fireship.io" target="_blank">Fireship</a></li>
            </ul>
          </article>

          <article class="source-card">
            <h3>Réseaux sociaux & Communautés</h3>
            <ul>
              <li><a href="https://twitter.com" target="_blank">Twitter</a></li>
              <li><a href="https://github.com" target="_blank">GitHub</a></li>
              <li><a href="https://stackoverflow.com" target="_blank">Stack Overflow</a></li>
              <li><a href="https://reddit.com/r/webdev" target="_blank">Reddit WebDev</a></li>
            </ul>
          </article>

          <article class="source-card">
            <h3>Podcasts & Vidéos</h3>
            <ul>
              <li><a href="https://www.youtube.com" target="_blank">YouTube</a></li>
              <li><a href="https://www.codecourse.com" target="_blank">Codecourse</a></li>
              <li><a href="https://frontendmasters.com" target="_blank">Frontend Masters</a></li>
              <li><a href="https://egghead.io" target="_blank">egghead.io</a></li>
            </ul>
          </article>
        </div>
      </div>

      <div class="topics-section">
        <h2>Thèmes suivis</h2>
        <div class="topics-grid">
          <div class="topic-card">
            <h3>Frontend Moderne</h3>
            <p>Vue 3, React, Next.js, Vite, Tailwind CSS et les derniers frameworks front-end</p>
            <div class="topics-list">
              <span class="topic-tag">Vue 3</span>
              <span class="topic-tag">Vite</span>
              <span class="topic-tag">Web Components</span>
              <span class="topic-tag">Progressive Web Apps</span>
            </div>
          </div>

          <div class="topic-card">
            <h3>Backend & Infrastructure</h3>
            <p>Node.js, Express, PostgreSQL, Docker et les bonnes pratiques de développement serveur</p>
            <div class="topics-list">
              <span class="topic-tag">Node.js</span>
              <span class="topic-tag">Docker</span>
              <span class="topic-tag">REST API</span>
              <span class="topic-tag">Performance</span>
            </div>
          </div>

          <div class="topic-card">
            <h3>Sécurité Web</h3>
            <p>Authentification, autorisation, protection contre les attaques courantes</p>
            <div class="topics-list">
              <span class="topic-tag">JWT</span>
              <span class="topic-tag">HTTPS</span>
              <span class="topic-tag">OWASP</span>
              <span class="topic-tag">Sanitization</span>
            </div>
          </div>

          <div class="topic-card">
            <h3>Design & UX</h3>
            <p>Responsive design, accessibilité, principes d'UX/UI modernes</p>
            <div class="topics-list">
              <span class="topic-tag">Responsive Design</span>
              <span class="topic-tag">Accessibility</span>
              <span class="topic-tag">Web Standards</span>
              <span class="topic-tag">Figma</span>
            </div>
          </div>

          <div class="topic-card">
            <h3>DevOps & Déploiement</h3>
            <p>Intégration continue, déploiement, monitoring et gestion d'infrastructure</p>
            <div class="topics-list">
              <span class="topic-tag">CI/CD</span>
              <span class="topic-tag">GitHub Actions</span>
              <span class="topic-tag">Monitoring</span>
              <span class="topic-tag">Optimization</span>
            </div>
          </div>

          <div class="topic-card">
            <h3>Outils & Workflows</h3>
            <p>Outils de développement, packages managers, et automation</p>
            <div class="topics-list">
              <span class="topic-tag">Git</span>
              <span class="topic-tag">npm/yarn</span>
              <span class="topic-tag">webpack</span>
              <span class="topic-tag">Testing</span>
            </div>
          </div>
        </div>
      </div>

      <div class="methodology-section">
        <h2>Ma méthodologie de veille</h2>
        <div class="methodology-steps">
          <div class="step">
            <div class="step-number">1</div>
            <h3>Exploration</h3>
            <p>Je consulte régulièrement les sources pertinentes pour identifier les tendances et innovations</p>
          </div>
          <div class="step">
            <div class="step-number">2</div>
            <h3>Analyse</h3>
            <p>J'évalue la pertinence et l'impact potentiel de chaque nouvelle technologie ou tendance</p>
          </div>
          <div class="step">
            <div class="step-number">3</div>
            <h3>Expérimentation</h3>
            <p>Je réalise des petits projets pour tester et comprendre les nouveaux outils et frameworks</p>
          </div>
          <div class="step">
            <div class="step-number">4</div>
            <h3>Application</h3>
            <p>J'intègre les apprentissages pertinents dans mes projets professionnels et personnels</p>
          </div>
        </div>
      </div>
    </section>
  </div>
</template>

<script setup>
</script>

<style scoped>
.veille {
  max-width: 1000px;
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
}

.intro-section {
  background: white;
  padding: 2rem;
  border-radius: 8px;
  box-shadow: 0 2px 8px rgba(0,0,0,0.1);
  color: #333;
  line-height: 1.6;
  font-size: 1.05rem;
}

.sources-section h2,
.topics-section h2,
.methodology-section h2 {
  color: #d946a6;
  font-size: 1.8rem;
  margin-bottom: 1.5rem;
}

.sources-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
  gap: 1.5rem;
}

.source-card {
  background: white;
  padding: 1.5rem;
  border-radius: 8px;
  box-shadow: 0 2px 8px rgba(0,0,0,0.1);
}

.source-card h3 {
  color: #333;
  margin-bottom: 1rem;
  border-bottom: 2px solid #d946a6;
  padding-bottom: 0.5rem;
}

.source-card ul {
  list-style: none;
  padding: 0;
}

.source-card li {
  margin-bottom: 0.5rem;
}

.source-card a {
  color: #d946a6;
  text-decoration: none;
  transition: color 0.3s;
}

.source-card a:hover {
  color: #c0209d;
  text-decoration: underline;
}

.topics-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
  gap: 1.5rem;
}

.topic-card {
  background: white;
  padding: 1.5rem;
  border-radius: 8px;
  box-shadow: 0 2px 8px rgba(0,0,0,0.1);
  border-left: 4px solid #d946a6;
}

.topic-card h3 {
  color: #333;
  margin-bottom: 0.5rem;
}

.topic-card p {
  color: #666;
  font-size: 0.95rem;
  margin-bottom: 1rem;
  line-height: 1.5;
}

.topics-list {
  display: flex;
  flex-wrap: wrap;
  gap: 0.5rem;
}

.topic-tag {
  background: #f5f5f5;
  color: #d946a6;
  padding: 0.25rem 0.75rem;
  border-radius: 20px;
  font-size: 0.85rem;
  font-weight: 500;
  border: 1px solid #d946a6;
}

.methodology-steps {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
  gap: 1.5rem;
}

.step {
  background: white;
  padding: 1.5rem;
  border-radius: 8px;
  box-shadow: 0 2px 8px rgba(0,0,0,0.1);
  text-align: center;
}

.step-number {
  display: flex;
  align-items: center;
  justify-content: center;
  width: 40px;
  height: 40px;
  background: #d946a6;
  color: white;
  border-radius: 50%;
  font-size: 1.5rem;
  font-weight: bold;
  margin: 0 auto 1rem;
}

.step h3 {
  color: #333;
  margin-bottom: 0.5rem;
}

.step p {
  color: #666;
  font-size: 0.95rem;
  line-height: 1.5;
}

@media (max-width: 768px) {
  .hero-section h1 {
    font-size: 2rem;
  }

  .sources-grid,
  .topics-grid,
  .methodology-steps {
    grid-template-columns: 1fr;
  }

  .sources-section h2,
  .topics-section h2,
  .methodology-section h2 {
    font-size: 1.5rem;
  }

  .intro-section {
    padding: 1.5rem;
  }
}
</style>
