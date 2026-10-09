import * as User from '../models/User.js';
import { generateToken } from '../middleware/auth.js';

export const login = async (req, res) => {
  try {
    const { email, password } = req.body;

    if (!email || !password) {
      return res.status(400).json({ error: 'Email and password required' });
    }

    const user = await User.getUserByEmail(email);
    if (!user) {
      return res.status(401).json({ error: 'Invalid credentials' });
    }

    // Check user role status
    if (user.id_role === 3) {
      return res.status(403).json({ error: 'Your registration is pending approval' });
    }
    if (user.id_role === 4) {
      return res.status(403).json({ error: 'Your registration was rejected' });
    }

    const isValid = await User.verifyPassword(password, user.mdp);
    if (!isValid) {
      return res.status(401).json({ error: 'Invalid credentials' });
    }

    const token = generateToken(user);
    const userResponse = {
      id: user.id,
      nom: user.nom,
      prenom: user.prenom,
      email: user.email,
      id_role: user.id_role
    };

    res.json({ token, user: userResponse });
  } catch (err) {
    console.error('Login error:', err);
    res.status(500).json({ error: 'Login failed' });
  }
};

export const register = async (req, res) => {
  try {
    const { nom, prenom, email, password } = req.body;

    if (!nom || !prenom || !email || !password) {
      return res.status(400).json({ error: 'All fields required' });
    }

    const existingUser = await User.getUserByEmail(email);
    if (existingUser) {
      return res.status(409).json({ error: 'Email already exists' });
    }

    const user = await User.createUser(nom, prenom, email, password);
    res.status(201).json({
      message: 'Registration successful. Awaiting admin approval.',
      user
    });
  } catch (err) {
    console.error('Register error:', err);
    res.status(500).json({ error: 'Registration failed' });
  }
};

export const getMe = async (req, res) => {
  try {
    const user = await User.getUserById(req.user.id);
    res.json({ user });
  } catch (err) {
    console.error('GetMe error:', err);
    res.status(500).json({ error: 'Failed to get user' });
  }
};
