import { query } from './db.js';

export const getAllProjets = async (typeId = null, competenceIds = []) => {
  let sql = `
    SELECT DISTINCT p.id, p.titre, p.description, p.id_type, tp.nom as type_nom,
           array_agg(DISTINCT l.nom) FILTER (WHERE l.nom IS NOT NULL) as logiciels,
           array_agg(DISTINCT c.nom) FILTER (WHERE c.nom IS NOT NULL) as competences,
           array_agg(DISTINCT i.url) FILTER (WHERE i.url IS NOT NULL) as images
    FROM projets p
    LEFT JOIN types_projets tp ON p.id_type = tp.id
    LEFT JOIN images_projets i ON p.id = i.id_projet
    LEFT JOIN projets_logiciels pl ON p.id = pl.id_projet
    LEFT JOIN logiciels l ON pl.id_logiciel = l.id
    LEFT JOIN projets_competences pc ON p.id = pc.id_projet
    LEFT JOIN competences c ON pc.id_competence = c.id
    WHERE 1=1
  `;

  const params = [];
  let paramCount = 1;

  if (typeId) {
    sql += ` AND p.id_type = $${paramCount}`;
    params.push(typeId);
    paramCount++;
  }

  if (competenceIds.length > 0) {
    sql += ` AND c.id = ANY($${paramCount})`;
    params.push(competenceIds);
    paramCount++;
  }

  sql += ` GROUP BY p.id, p.titre, p.description, p.id_type, tp.nom
    ORDER BY p.id DESC`;

  const result = await query(sql, params);
  return result.rows;
};

export const getProjetById = async (id) => {
  const sql = `
    SELECT p.id, p.titre, p.description, p.id_type, tp.nom as type_nom,
           array_agg(DISTINCT l.nom) FILTER (WHERE l.nom IS NOT NULL) as logiciels,
           array_agg(DISTINCT c.nom) FILTER (WHERE c.nom IS NOT NULL) as competences,
           array_agg(DISTINCT i.url) FILTER (WHERE i.url IS NOT NULL) as images
    FROM projets p
    LEFT JOIN types_projets tp ON p.id_type = tp.id
    LEFT JOIN images_projets i ON p.id = i.id_projet
    LEFT JOIN projets_logiciels pl ON p.id = pl.id_projet
    LEFT JOIN logiciels l ON pl.id_logiciel = l.id
    LEFT JOIN projets_competences pc ON p.id = pc.id_projet
    LEFT JOIN competences c ON pc.id_competence = c.id
    WHERE p.id = $1
    GROUP BY p.id, p.titre, p.description, p.id_type, tp.nom
  `;

  const result = await query(sql, [id]);
  return result.rows[0];
};

export const createProjet = async (titre, description, typeId) => {
  const result = await query(
    'INSERT INTO projets (titre, description, id_type) VALUES ($1, $2, $3) RETURNING *',
    [titre, description, typeId]
  );
  return result.rows[0];
};

export const updateProjet = async (id, titre, description, typeId) => {
  const result = await query(
    'UPDATE projets SET titre = $1, description = $2, id_type = $3, updated_at = NOW() WHERE id = $4 RETURNING *',
    [titre, description, typeId, id]
  );
  return result.rows[0];
};

export const deleteProjet = async (id) => {
  await query('DELETE FROM projets WHERE id = $1', [id]);
};

export const addImageToProjet = async (projetId, imageUrl, ordre = 0) => {
  const result = await query(
    'INSERT INTO images_projets (id_projet, url, ordre) VALUES ($1, $2, $3) RETURNING *',
    [projetId, imageUrl, ordre]
  );
  return result.rows[0];
};

export const getCompetences = async () => {
  const result = await query('SELECT * FROM competences');
  return result.rows;
};

export const getTypes = async () => {
  const result = await query('SELECT * FROM types_projets');
  return result.rows;
};
