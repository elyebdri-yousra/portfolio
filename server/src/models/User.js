import { query } from './db.js';
import bcryptjs from 'bcryptjs';

export const createUser = async (nom, prenom, email, password) => {
  const hashedPassword = await bcryptjs.hash(password, 10);
  const result = await query(
    'INSERT INTO utilisateurs (nom, prenom, email, mdp, id_role) VALUES ($1, $2, $3, $4, 3) RETURNING id, nom, prenom, email, id_role',
    [nom, prenom, email, hashedPassword]
  );
  return result.rows[0];
};

export const getUserByEmail = async (email) => {
  const result = await query(
    'SELECT * FROM utilisateurs WHERE email = $1',
    [email]
  );
  return result.rows[0];
};

export const getUserById = async (id) => {
  const result = await query(
    'SELECT id, nom, prenom, email, id_role, created_at FROM utilisateurs WHERE id = $1',
    [id]
  );
  return result.rows[0];
};

export const verifyPassword = async (password, hashedPassword) => {
  return bcryptjs.compare(password, hashedPassword);
};

export const getAllUsers = async () => {
  const result = await query(
    'SELECT id, nom, prenom, email, id_role, created_at FROM utilisateurs ORDER BY created_at DESC'
  );
  return result.rows;
};

export const updateUserRole = async (userId, roleId) => {
  const result = await query(
    'UPDATE utilisateurs SET id_role = $1 WHERE id = $2 RETURNING id, nom, prenom, email, id_role',
    [roleId, userId]
  );
  return result.rows[0];
};
