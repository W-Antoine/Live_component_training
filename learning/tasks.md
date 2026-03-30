# Tâches de coding — Stimulus & Live Component

Les tâches Stimulus viennent en premier car Live Component repose dessus.
Fais-les dans l'ordre.

---

## PARTIE 1 — Stimulus

---

### Tâche S1 — Prendre en main un controller existant

**Objectif :** Comprendre la structure d'un controller Stimulus et comment il se connecte au HTML.

`hello_controller.js` existe déjà dans `assets/controllers/`. Utilise-le comme terrain d'exploration : connecte-le à un élément dans une page, observe le cycle de vie, puis modifie son comportement.

**Pistes :**
- Le nom du controller vient du nom du fichier. Comment l'attacher à un élément HTML ?
- `connect()` se déclenche quand ? Et si tu supprimes l'élément du DOM ?
- Stimulus a d'autres hooks de cycle de vie que `connect()`.

---

### Tâche S2 — Targets et Actions

**Objectif :** Créer un controller Stimulus qui manipule des éléments du DOM via les `targets` et répond à des événements via `data-action`.

Crée un controller `toggle` qui permet de montrer/cacher un élément.

**Pistes :**
- En Stimulus, les `targets` permettent de référencer des éléments DOM depuis le controller sans faire de `querySelector`. Cherche comment les déclarer dans le controller et les marquer dans le HTML.
- `data-action` peut écouter n'importe quel événement natif du navigateur, pas seulement `click`.
- Le controller ne doit pas connaître le contenu de ce qu'il cache — il doit être réutilisable.

---

### Tâche S3 — Values API

**Objectif :** Faire passer des données de Twig vers un controller Stimulus via l'API `values`.

Crée un controller `countdown` qui affiche un compte à rebours. La valeur de départ vient du HTML (donc potentiellement du serveur).

**Pistes :**
- Stimulus a une API `values` qui permet de déclarer des propriétés typées lues depuis des attributs `data-`. Cherche comment la déclarer et comment Stimulus la met à jour automatiquement si l'attribut change.
- Un callback se déclenche automatiquement quand une value change. Comment s'appelle-t-il ?
- `setInterval` et `clearInterval` seront utiles. Où les initialiser et les nettoyer dans le cycle de vie ?

---

### Tâche S4 — Outlets (communication entre controllers)

**Objectif :** Faire communiquer deux controllers Stimulus distincts via les `outlets`.

Crée un controller `logger` qui affiche un historique de messages, et connecte le controller `toggle` (tâche S2) à lui pour logger chaque toggle.

**Pistes :**
- Les `outlets` sont la façon Stimulus de référencer un autre controller depuis le sien. C'est l'équivalent Stimulus des events inter-composants.
- Un outlet donne accès à l'instance du controller cible et à son élément.
- Réfléchis à qui dépend de qui : lequel des deux controllers doit déclarer l'outlet ?

---

## PARTIE 2 — Live Component

---

### Tâche L1 — Créer son premier Live Component

**Objectif :** Mettre en place un Live Component de A à Z — la classe PHP, le template Twig, la route, et la configuration.

Recrée le `CounterComponent` : un compteur avec les boutons +, -, Reset.

**Pistes :**
- Un Live Component, c'est une classe PHP avec un attribut, un trait, et un template Twig associé. Cherche quels sont ces trois éléments.
- Le nom du composant dans l'attribut PHP doit correspondre au nom du fichier template. Cherche comment Symfony résout ce lien (indice : `debug:twig-component`).
- La configuration dans `twig_component.yaml` a son importance. Quel namespace doit-il pointer ?
- Pour l'afficher dans une page, tu as besoin d'un controller Symfony et d'un template qui l'inclut.

---

### Tâche L2 — LiveProps et état

**Objectif :** Comprendre comment l'état est persisté entre les requêtes AJAX.

Ajoute un `step` configurable au `CounterComponent` : le pas d'incrément vient du template parent.

**Pistes :**
- Toutes les propriétés ne sont pas forcément des `LiveProp`. Quelle est la différence entre une prop normale et une `LiveProp` ?
- `step` doit pouvoir être passé depuis `<twig:counter />` mais ne doit pas être modifiable depuis le navigateur. Comment le protéger ?

---

### Tâche L3 — LiveActions

**Objectif :** Exposer des méthodes PHP au navigateur de façon sécurisée.

Ajoute une action `setCount` qui permet de définir directement la valeur du compteur depuis un input.

**Pistes :**
- Qu'est-ce qui distingue une `#[LiveAction]` d'une méthode PHP ordinaire ?
- Une `#[LiveAction]` peut recevoir des arguments. D'où viennent-ils et comment les typer ?
- Comment déclencher une action depuis un `<form>` plutôt qu'un `<button>` ?

---

### Tâche L4 — Two-way binding

**Objectif :** Synchroniser automatiquement un champ HTML avec une prop du composant.

Crée un composant `search` dont l'input est lié en temps réel à une prop PHP.

**Pistes :**
- `data-model` est le point d'entrée. Sur quel élément le met-on ? Quelle valeur lui donne-t-on ?
- Une `LiveProp` exposée au navigateur nécessite une option supplémentaire. Laquelle et pourquoi ?
- Ouvre les DevTools Network pendant que tu tapes. Qu'est-ce qui déclenche les requêtes ?

---

### Tâche L5 — Contrôler quand les requêtes partent

**Objectif :** Maîtriser le timing des requêtes générées par `data-model`.

Sur le composant `search`, expérimente les différentes façons de contrôler quand la synchronisation se fait.

**Pistes :**
- Par défaut, quand la requête part-elle ? Est-ce toujours souhaitable pour une barre de recherche ?
- `data-model` accepte une syntaxe étendue pour choisir l'événement déclencheur.
- Il existe un attribut pour retarder l'envoi après que l'utilisateur arrête de taper.

---

### Tâche L6 — Computed properties

**Objectif :** Exposer une valeur calculée côté serveur sans la stocker comme prop.

Ajoute au `CounterComponent` une valeur dérivée de `$count` affichée dans le template, sans créer de nouvelle `LiveProp`.

**Pistes :**
- Live Component expose automatiquement au template les méthodes qui suivent une certaine convention de nommage.
- Cette valeur est recalculée à chaque re-rendu. Est-ce un problème ?

---

### Tâche L7 — Injection de service via mount()

**Objectif :** Comprendre le rôle de `mount()` et comment les services Symfony s'intègrent dans un Live Component.

Crée un composant `color-palette` qui affiche une liste de couleurs fournie par un service Symfony.

**Pistes :**
- Dans un Live Component, on n'utilise pas le constructeur pour l'initialisation. Quelle méthode joue ce rôle ?
- Cette méthode reçoit à la fois les props passées depuis Twig ET les services injectés par le container. Dans quel ordre Symfony les résout-il ?
- Les couleurs doivent-elles être une `LiveProp` ? Pourquoi ou pourquoi pas ?

---

### Tâche L8 — Actions avec arguments

**Objectif :** Passer des paramètres du template HTML vers une `#[LiveAction]`.

Crée un composant `todo-list` avec des items supprimables. Chaque suppression doit cibler le bon item.

**Pistes :**
- Une `#[LiveAction]` peut recevoir des arguments. D'où viennent-ils ?
- Stimulus params (`data-live-[param]-param`) sont le mécanisme sous-jacent. Comment les utiliser dans une boucle Twig ?

---

### Tâche L9 — Événements entre composants

**Objectif :** Faire communiquer deux Live Components sans lien direct entre eux.

Le composant `todo-list` doit notifier un composant `notification` à chaque suppression, sans que les deux composants se connaissent directement.

**Pistes :**
- Live Component a un système d'événements propre, distinct des événements JavaScript natifs.
- Un composant peut émettre, un autre peut écouter. Cherche les attributs PHP correspondants.
- Les deux composants sont indépendants dans le template — aucun n'est enfant de l'autre.
