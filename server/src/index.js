import express from 'express';
import cors from 'cors';
import dotenv from 'dotenv';
import { pool } from './models/db.js';
import authRoutes from './routes/auth.js';
import projetRoutes from './routes/projets.js';
import usersRoutes from './routes/users.js';

dotenv.config();

const app = express();
const PORT = process.env.PORT || 3000;

// Middleware
app.use(cors());
app.use(express.json());

// Health check
app.get('/api/health', (req, res) => {
  res.json({ status: 'ok' });
});

// Routes
app.use('/api/auth', authRoutes);
app.use('/api/projets', projetRoutes);
app.use('/api/users', usersRoutes);

// Error handler
app.use((err, req, res, next) => {
  console.error(err);
  res.status(err.status || 500).json({
    error: err.message || 'Internal Server Error'
  });
});

// Start server
app.listen(PORT, async () => {
  try {
    const result = await pool.query('SELECT NOW()');
    console.log('✅ Base de données connectée');
    console.log(`🚀 Serveur démarré sur http://localhost:${PORT}`);
  } catch (err) {
    console.error('❌ Erreur BDD:', err);
    process.exit(1);
  }
});

export default app;
