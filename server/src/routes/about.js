import express from 'express';
import {
  getParcours, getParcoursById, createParcours, updateParcours, deleteParcours,
  getFormations, getFormationById, createFormation, updateFormation, deleteFormation,
  getCompetences, getCompetenceById, createCompetence, updateCompetence, deleteCompetence
} from '../controllers/about.js';
import { authMiddleware, adminMiddleware } from '../middleware/auth.js';

const router = express.Router();

// Parcours routes
router.get('/parcours', getParcours);
router.get('/parcours/:id', getParcoursById);
router.post('/parcours', authMiddleware, adminMiddleware, createParcours);
router.put('/parcours/:id', authMiddleware, adminMiddleware, updateParcours);
router.delete('/parcours/:id', authMiddleware, adminMiddleware, deleteParcours);

// Formations routes
router.get('/formations', getFormations);
router.get('/formations/:id', getFormationById);
router.post('/formations', authMiddleware, adminMiddleware, createFormation);
router.put('/formations/:id', authMiddleware, adminMiddleware, updateFormation);
router.delete('/formations/:id', authMiddleware, adminMiddleware, deleteFormation);

// Compétences routes
router.get('/competences', getCompetences);
router.get('/competences/:id', getCompetenceById);
router.post('/competences', authMiddleware, adminMiddleware, createCompetence);
router.put('/competences/:id', authMiddleware, adminMiddleware, updateCompetence);
router.delete('/competences/:id', authMiddleware, adminMiddleware, deleteCompetence);

export default router;
