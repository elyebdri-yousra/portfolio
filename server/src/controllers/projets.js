import * as ProjetModel from '../models/Projet.js';

export const getProjets = async (req, res) => {
  try {
    const { typeId, competenceIds } = req.query;
    const competenceIdsArray = competenceIds ? competenceIds.split(',').map(Number) : [];

    const projets = await ProjetModel.getAllProjets(typeId ? Number(typeId) : null, competenceIdsArray);
    res.json(projets);
  } catch (err) {
    console.error('Error getting projets:', err);
    res.status(500).json({ error: 'Failed to get projets' });
  }
};

export const getProjetById = async (req, res) => {
  try {
    const { id } = req.params;
    const projet = await ProjetModel.getProjetById(id);

    if (!projet) {
      return res.status(404).json({ error: 'Projet not found' });
    }

    res.json(projet);
  } catch (err) {
    console.error('Error getting projet:', err);
    res.status(500).json({ error: 'Failed to get projet' });
  }
};

export const getCompetences = async (req, res) => {
  try {
    const competences = await ProjetModel.getCompetences();
    res.json(competences);
  } catch (err) {
    res.status(500).json({ error: 'Failed to get competences' });
  }
};

export const getTypes = async (req, res) => {
  try {
    const types = await ProjetModel.getTypes();
    res.json(types);
  } catch (err) {
    res.status(500).json({ error: 'Failed to get types' });
  }
};

export const createProjet = async (req, res) => {
  try {
    const { titre, description, typeId } = req.body;

    if (!titre || !typeId) {
      return res.status(400).json({ error: 'Title and type required' });
    }

    const projet = await ProjetModel.createProjet(titre, description || '', typeId);
    res.status(201).json(projet);
  } catch (err) {
    console.error('Error creating projet:', err);
    res.status(500).json({ error: 'Failed to create projet' });
  }
};

export const updateProjet = async (req, res) => {
  try {
    const { id } = req.params;
    const { titre, description, typeId } = req.body;

    if (!titre || !typeId) {
      return res.status(400).json({ error: 'Title and type required' });
    }

    const projet = await ProjetModel.updateProjet(id, titre, description || '', typeId);
    res.json(projet);
  } catch (err) {
    console.error('Error updating projet:', err);
    res.status(500).json({ error: 'Failed to update projet' });
  }
};

export const deleteProjet = async (req, res) => {
  try {
    const { id } = req.params;
    await ProjetModel.deleteProjet(id);
    res.json({ message: 'Projet deleted' });
  } catch (err) {
    console.error('Error deleting projet:', err);
    res.status(500).json({ error: 'Failed to delete projet' });
  }
};
