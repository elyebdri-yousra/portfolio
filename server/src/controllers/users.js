import * as User from '../models/User.js';
import { query } from '../models/db.js';

export const getAllUsers = async (req, res) => {
  try {
    const users = await User.getAllUsers();
    res.json(users);
  } catch (err) {
    console.error('Error getting users:', err);
    res.status(500).json({ error: 'Failed to get users' });
  }
};

export const getPendingUsers = async (req, res) => {
  try {
    const result = await query(
      'SELECT id, nom, prenom, email, created_at FROM utilisateurs WHERE id_role = 3 ORDER BY created_at DESC'
    );
    res.json(result.rows);
  } catch (err) {
    console.error('Error getting pending users:', err);
    res.status(500).json({ error: 'Failed to get pending users' });
  }
};

export const updateUserRole = async (req, res) => {
  try {
    const { id } = req.params;
    const { roleId } = req.body;

    if (!roleId) {
      return res.status(400).json({ error: 'Role ID required' });
    }

    const user = await User.updateUserRole(id, roleId);
    res.json(user);
  } catch (err) {
    console.error('Error updating user:', err);
    res.status(500).json({ error: 'Failed to update user' });
  }
};

export const deleteUser = async (req, res) => {
  try {
    const { id } = req.params;
    await query('DELETE FROM utilisateurs WHERE id = $1', [id]);
    res.json({ message: 'User deleted' });
  } catch (err) {
    console.error('Error deleting user:', err);
    res.status(500).json({ error: 'Failed to delete user' });
  }
};
