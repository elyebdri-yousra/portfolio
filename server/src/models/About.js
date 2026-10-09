import { pool } from './db.js';

export const About = {
  // Parcours (Career experiences)
  async getParcours() {
    const query = 'SELECT * FROM about_parcours ORDER BY ordre ASC';
    const result = await pool.query(query);
    return result.rows;
  },

  async getParcoursById(id) {
    const query = 'SELECT * FROM about_parcours WHERE id = $1';
    const result = await pool.query(query, [id]);
    return result.rows[0];
  },

  async createParcours(data) {
    const { poste, entreprise, periode, missions } = data;
    const query = `
      INSERT INTO about_parcours (poste, entreprise, periode, missions)
      VALUES ($1, $2, $3, $4)
      RETURNING *
    `;
    const result = await pool.query(query, [poste, entreprise, periode, missions]);
    return result.rows[0];
  },

  async updateParcours(id, data) {
    const { poste, entreprise, periode, missions, ordre } = data;
    const query = `
      UPDATE about_parcours
      SET poste = $1, entreprise = $2, periode = $3, missions = $4, ordre = $5, updated_at = CURRENT_TIMESTAMP
      WHERE id = $6
      RETURNING *
    `;
    const result = await pool.query(query, [poste, entreprise, periode, missions, ordre, id]);
    return result.rows[0];
  },

  async deleteParcours(id) {
    const query = 'DELETE FROM about_parcours WHERE id = $1 RETURNING *';
    const result = await pool.query(query, [id]);
    return result.rows[0];
  },

  // Formations (Education)
  async getFormations() {
    const query = 'SELECT * FROM about_formation ORDER BY ordre ASC';
    const result = await pool.query(query);
    return result.rows;
  },

  async getFormationById(id) {
    const query = 'SELECT * FROM about_formation WHERE id = $1';
    const result = await pool.query(query, [id]);
    return result.rows[0];
  },

  async createFormation(data) {
    const { titre, etablissement, contenu } = data;
    const query = `
      INSERT INTO about_formation (titre, etablissement, contenu)
      VALUES ($1, $2, $3)
      RETURNING *
    `;
    const result = await pool.query(query, [titre, etablissement, contenu]);
    return result.rows[0];
  },

  async updateFormation(id, data) {
    const { titre, etablissement, contenu, ordre } = data;
    const query = `
      UPDATE about_formation
      SET titre = $1, etablissement = $2, contenu = $3, ordre = $4, updated_at = CURRENT_TIMESTAMP
      WHERE id = $5
      RETURNING *
    `;
    const result = await pool.query(query, [titre, etablissement, contenu, ordre, id]);
    return result.rows[0];
  },

  async deleteFormation(id) {
    const query = 'DELETE FROM about_formation WHERE id = $1 RETURNING *';
    const result = await pool.query(query, [id]);
    return result.rows[0];
  },

  // Compétences (Skills)
  async getCompetences() {
    const query = 'SELECT * FROM about_competence ORDER BY ordre ASC';
    const result = await pool.query(query);
    return result.rows;
  },

  async getCompetenceById(id) {
    const query = 'SELECT * FROM about_competence WHERE id = $1';
    const result = await pool.query(query, [id]);
    return result.rows[0];
  },

  async createCompetence(data) {
    const { categorie, details } = data;
    const query = `
      INSERT INTO about_competence (categorie, details)
      VALUES ($1, $2)
      RETURNING *
    `;
    const result = await pool.query(query, [categorie, details]);
    return result.rows[0];
  },

  async updateCompetence(id, data) {
    const { categorie, details, ordre } = data;
    const query = `
      UPDATE about_competence
      SET categorie = $1, details = $2, ordre = $3, updated_at = CURRENT_TIMESTAMP
      WHERE id = $4
      RETURNING *
    `;
    const result = await pool.query(query, [categorie, details, ordre, id]);
    return result.rows[0];
  },

  async deleteCompetence(id) {
    const query = 'DELETE FROM about_competence WHERE id = $1 RETURNING *';
    const result = await pool.query(query, [id]);
    return result.rows[0];
  }
};
