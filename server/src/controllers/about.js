import { About } from '../models/About.js';

// Parcours handlers
export const getParcours = async (req, res, next) => {
  try {
    const parcours = await About.getParcours();
    res.json(parcours);
  } catch (error) {
    next(error);
  }
};

export const getParcoursById = async (req, res, next) => {
  try {
    const parcours = await About.getParcoursById(req.params.id);
    if (!parcours) return res.status(404).json({ error: 'Parcours not found' });
    res.json(parcours);
  } catch (error) {
    next(error);
  }
};

export const createParcours = async (req, res, next) => {
  try {
    const parcours = await About.createParcours(req.body);
    res.status(201).json(parcours);
  } catch (error) {
    next(error);
  }
};

export const updateParcours = async (req, res, next) => {
  try {
    const parcours = await About.updateParcours(req.params.id, req.body);
    if (!parcours) return res.status(404).json({ error: 'Parcours not found' });
    res.json(parcours);
  } catch (error) {
    next(error);
  }
};

export const deleteParcours = async (req, res, next) => {
  try {
    const parcours = await About.deleteParcours(req.params.id);
    if (!parcours) return res.status(404).json({ error: 'Parcours not found' });
    res.json({ message: 'Deleted successfully' });
  } catch (error) {
    next(error);
  }
};

// Formations handlers
export const getFormations = async (req, res, next) => {
  try {
    const formations = await About.getFormations();
    res.json(formations);
  } catch (error) {
    next(error);
  }
};

export const getFormationById = async (req, res, next) => {
  try {
    const formation = await About.getFormationById(req.params.id);
    if (!formation) return res.status(404).json({ error: 'Formation not found' });
    res.json(formation);
  } catch (error) {
    next(error);
  }
};

export const createFormation = async (req, res, next) => {
  try {
    const formation = await About.createFormation(req.body);
    res.status(201).json(formation);
  } catch (error) {
    next(error);
  }
};

export const updateFormation = async (req, res, next) => {
  try {
    const formation = await About.updateFormation(req.params.id, req.body);
    if (!formation) return res.status(404).json({ error: 'Formation not found' });
    res.json(formation);
  } catch (error) {
    next(error);
  }
};

export const deleteFormation = async (req, res, next) => {
  try {
    const formation = await About.deleteFormation(req.params.id);
    if (!formation) return res.status(404).json({ error: 'Formation not found' });
    res.json({ message: 'Deleted successfully' });
  } catch (error) {
    next(error);
  }
};

// Compétences handlers
export const getCompetences = async (req, res, next) => {
  try {
    const competences = await About.getCompetences();
    res.json(competences);
  } catch (error) {
    next(error);
  }
};

export const getCompetenceById = async (req, res, next) => {
  try {
    const competence = await About.getCompetenceById(req.params.id);
    if (!competence) return res.status(404).json({ error: 'Competence not found' });
    res.json(competence);
  } catch (error) {
    next(error);
  }
};

export const createCompetence = async (req, res, next) => {
  try {
    const competence = await About.createCompetence(req.body);
    res.status(201).json(competence);
  } catch (error) {
    next(error);
  }
};

export const updateCompetence = async (req, res, next) => {
  try {
    const competence = await About.updateCompetence(req.params.id, req.body);
    if (!competence) return res.status(404).json({ error: 'Competence not found' });
    res.json(competence);
  } catch (error) {
    next(error);
  }
};

export const deleteCompetence = async (req, res, next) => {
  try {
    const competence = await About.deleteCompetence(req.params.id);
    if (!competence) return res.status(404).json({ error: 'Competence not found' });
    res.json({ message: 'Deleted successfully' });
  } catch (error) {
    next(error);
  }
};
