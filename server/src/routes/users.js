import express from 'express';
import * as usersController from '../controllers/users.js';
import { authMiddleware, adminMiddleware } from '../middleware/auth.js';

const router = express.Router();

router.get('/', authMiddleware, adminMiddleware, usersController.getAllUsers);
router.get('/pending', authMiddleware, adminMiddleware, usersController.getPendingUsers);
router.put('/:id/role', authMiddleware, adminMiddleware, usersController.updateUserRole);
router.delete('/:id', authMiddleware, adminMiddleware, usersController.deleteUser);

export default router;
