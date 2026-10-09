import express from 'express';
import * as projetController from '../controllers/projets.js';
import { authMiddleware, adminMiddleware } from '../middleware/auth.js';

const router = express.Router();

router.get('/', projetController.getProjets);
router.get('/types', projetController.getTypes);
router.get('/competences', projetController.getCompetences);
router.get('/:id', projetController.getProjetById);

router.post('/', authMiddleware, adminMiddleware, projetController.createProjet);
router.put('/:id', authMiddleware, adminMiddleware, projetController.updateProjet);
router.delete('/:id', authMiddleware, adminMiddleware, projetController.deleteProjet);

export default router;
