# Questionnaire — Stimulus & Live Component

Réponds après avoir fait la tâche de coding correspondante.
Observe le comportement dans le navigateur, lis le code, puis réponds sans chercher la réponse parfaite.

---

## PARTIE 1 — Stimulus

---

### Tâche S1 — Prendre en main un controller existant

1. Comment Stimulus sait-il quel controller attacher à quel élément HTML ?

   > Réponse :

2. `connect()` se déclenche à quel moment précisément ? Que se passe-t-il si l'élément est retiré du DOM ?

   > Réponse :

3. Quels autres hooks de cycle de vie as-tu trouvés ? À quoi servent-ils ?

   > Réponse :

4. Le nom du controller dans le HTML vient d'où ?

   > Réponse :

---

### Tâche S2 — Targets et Actions

1. Quelle est la différence entre utiliser une `target` Stimulus et faire un `document.querySelector()` dans le controller ?

   > Réponse :

2. Comment déclare-t-on une target dans le controller ? Et dans le HTML ?

   > Réponse :

3. `data-action="click->toggle#hide"` vs `data-action="toggle#hide"` : quelle différence ?

   > Réponse :

4. Que se passe-t-il si une target n'existe pas dans le DOM au moment où le controller essaie d'y accéder ?

   > Réponse :

---

### Tâche S3 — Values API

1. À quoi sert l'API `values` ? Qu'est-ce qu'elle apporte par rapport à lire un `data-` attribut manuellement avec `this.element.dataset` ?

   > Réponse :

2. Comment s'appelle le callback qui se déclenche automatiquement quand une value change ? Quelle est la convention de nommage ?

   > Réponse :

3. Où as-tu initialisé et nettoyé ton `setInterval` ? Pourquoi est-il important de le nettoyer ?

   > Réponse :

4. Si la value change dans le HTML (via Twig/serveur), que se passe-t-il côté Stimulus ?

   > Réponse :

---

### Tâche S4 — Outlets

1. Quelle est la différence entre un `outlet` et un événement JavaScript custom (`dispatchEvent`) pour faire communiquer deux controllers ?

   > Réponse :

2. Lequel des deux controllers déclare l'outlet ? Pourquoi ce sens et pas l'inverse ?

   > Réponse :

3. Que donne accès un outlet concrètement — à quoi as-tu accès une fois qu'il est connecté ?

   > Réponse :

4. Que se passe-t-il si l'élément cible de l'outlet n'est pas dans le DOM ?

   > Réponse :

---

## PARTIE 2 — Live Component

---

### Tâche L1 — Créer son premier Live Component

1. Quels sont les éléments minimaux pour qu'un Live Component fonctionne (classe PHP, template, config) ?

   > Réponse :

2. Comment Symfony fait le lien entre la classe PHP et le fichier template ? Quel rôle joue `twig_component.yaml` ?

   > Réponse :

3. Qu'est-ce que `debug:twig-component` t'a appris sur ton composant ? As-tu vu une différence entre un composant "Live" et un composant "Anon" ?

   > Réponse :

4. Que se passe-t-il dans le Network quand tu cliques sur "+" ? Décris la requête et la réponse.

   > Réponse :

---

### Tâche L2 — LiveProps et état

1. Qu'est-ce qui se passe si tu enlèves `#[LiveProp]` de `$count` et que tu cliques sur "+" ?

   > Réponse :

2. As-tu fait de `step` une `LiveProp` ? Pourquoi ce choix ?

   > Réponse :

3. Quelle option de `#[LiveProp]` empêche la modification depuis le navigateur ? Pourquoi c'est important ?

   > Réponse :

---

### Tâche L3 — LiveActions

1. Qu'est-ce qui distingue une `#[LiveAction]` d'une méthode PHP ordinaire dans le composant ?

   > Réponse :

2. Comment les arguments arrivent-ils dans la méthode PHP depuis le HTML ?

   > Réponse :

3. Comment as-tu déclenché l'action depuis un `<form>` ? Quelle différence avec un `<button>` ?

   > Réponse :

---

### Tâche L4 — Two-way binding

1. Que fait `data-model="query"` concrètement ? Quel est le lien avec la prop PHP ?

   > Réponse :

2. Pourquoi as-tu dû ajouter une option à `#[LiveProp]` pour que le binding fonctionne ?

   > Réponse :

3. À quel moment exact la requête part-elle quand tu tapes dans le champ ?

   > Réponse :

---

### Tâche L5 — Contrôler quand les requêtes partent

1. Quelle différence concrète as-tu observée dans Network entre `data-model="query"` et `data-model="on(change)|query"` ?

   > Réponse :

2. Le debounce réduit le nombre de requêtes, mais introduit-il un inconvénient ? Lequel ?

   > Réponse :

3. Dans quel cas réel préférerais-tu `on(change)` plutôt que `on(input)` avec debounce ?

   > Réponse :

---

### Tâche L6 — Computed properties

1. Quelle convention de nommage as-tu utilisée pour exposer la valeur calculée au template ?

   > Réponse :

2. Cette valeur est recalculée à chaque re-rendu. Est-ce un problème si le calcul est coûteux ?

   > Réponse :

3. Quelle différence entre une computed property et une `LiveProp` pour stocker une valeur dérivée ?

   > Réponse :

---

### Tâche L7 — Injection de service via mount()

1. Quelle différence entre `mount()` et un constructeur PHP classique dans ce contexte ?

   > Réponse :

2. As-tu fait des couleurs une `LiveProp` ? Explique ton choix.

   > Réponse :

3. Que se passe-t-il si tu appelles `mount()` avec un argument qui correspond à la fois à une prop Twig et à un service ? Qui est prioritaire ?

   > Réponse :

---

### Tâche L8 — Actions avec arguments

1. Comment le paramètre (l'index) voyage-t-il du HTML jusqu'à la méthode PHP ?

   > Réponse :

2. Quel est le lien entre les Stimulus params (`data-live-[param]-param`) et les arguments de la `#[LiveAction]` ?

   > Réponse :

3. Pourquoi ne peut-on pas simplement faire `$this->items[$index] = null` au lieu de `array_splice` ?

   > Réponse :

---

### Tâche L9 — Événements entre composants

1. Comment le composant émetteur envoie-t-il l'événement ? Et comment le récepteur l'écoute-t-il ?

   > Réponse :

2. Les deux composants se connaissent-ils directement ? Qu'est-ce que ça implique pour la maintenabilité ?

   > Réponse :

3. Quelle différence entre ce système d'événements Live Component et les `outlets` Stimulus vus en partie 1 ?

   > Réponse :
