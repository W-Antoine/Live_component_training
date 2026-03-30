# Training — Stimulus & Live Component

Projet d'entraînement pour apprendre **Hotwired Stimulus** et **Symfony UX Live Component** step by step.

Le projet fournit une landing page, un questionnaire et des tâches de coding progressives. L'objectif est de comprendre comment Stimulus fonctionne seul, puis comment Live Component s'appuie dessus pour créer des interfaces réactives sans écrire de JavaScript métier.

---

## Prérequis

- PHP >= 8.4
- Composer
- Node.js & npm

---

## Installation

**Mac / Linux**
```bash
make install
```

**Windows**
```bat
install.bat
```

---

## Lancer le projet

**Mac / Linux**
```bash
make dev
```

**Windows**
```bat
start.bat
```

Puis ouvre [http://localhost:8000](http://localhost:8000).

---

## Structure

```
assets/
  controllers/       # Tes controllers Stimulus
  styles/app.css     # Styles globaux
learning/
  tasks.md           # Tâches de coding (Stimulus + Live Component)
  questionnaire.md   # Questions de compréhension à remplir après chaque tâche
src/
  Controller/        # Controllers Symfony
templates/           # Templates Twig
```

## Parcours d'apprentissage

Les tâches et le questionnaire sont accessibles directement depuis la landing page.

1. **Partie 1 — Stimulus** (S1 à S4) : cycle de vie, targets, values API, outlets
2. **Partie 2 — Live Component** (L1 à L9) : créer ses propres composants de A à Z

Fais une tâche de coding, puis réponds aux questions du questionnaire correspondant pendant que c'est frais.
