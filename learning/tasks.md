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

**Résultat attendu :**
Le fichier `assets/controllers/hello_controller.js` existe déjà — pas besoin d'en créer un nouveau. Connecte-le à un élément dans un template. Au chargement, cet élément doit afficher le texte injecté par `connect()`. Expérimente aussi le déclenchement d'une méthode du controller au clic.

---

### Tâche S2 — Targets et Actions

**Objectif :** Créer un controller Stimulus qui manipule des éléments du DOM via les `targets` et répond à des événements via `data-action`.

Crée un controller `toggle` qui permet de montrer/cacher un élément.

**Pistes :**
- En Stimulus, les `targets` permettent de référencer des éléments DOM depuis le controller sans faire de `querySelector`. Cherche comment les déclarer dans le controller et les marquer dans le HTML.
- `data-action` peut écouter n'importe quel événement natif du navigateur, pas seulement `click`.
- Le controller ne doit pas connaître le contenu de ce qu'il cache — il doit être réutilisable.
- Faire attention au scope ! S'assurer que les variables sont connus par le controller. (indice : déclaration du "data-controller").

**Résultat attendu :**
Un fichier `assets/controllers/toggle_controller.js` à créer. Dans le HTML, un bouton et un élément à cacher sont liés au même controller. Cliquer sur le bouton alterne la visibilité de l'élément cible. Le controller ne doit pas contenir de texte en dur — il doit fonctionner quel que soit le contenu qu'il cache.

---

### Tâche S3 — Values API

**Objectif :** Faire passer des données de Twig vers un controller Stimulus via l'API `values`.

Crée un controller `countdown` qui affiche un compte à rebours. La valeur de départ vient du HTML (donc potentiellement du serveur).

**Pistes :**
- Stimulus a une API `values` qui permet de déclarer des propriétés typées lues depuis des attributs `data-`. Cherche comment la déclarer et comment Stimulus la met à jour automatiquement si l'attribut change.
- Un callback se déclenche automatiquement quand une value change. Comment s'appelle-t-il ?
- `setInterval` et `clearInterval` seront utiles. Où les initialiser et les nettoyer dans le cycle de vie ?

**Résultat attendu :**
Un fichier `countdown_controller.js`. Dans le HTML, un attribut sur le conteneur passe la valeur de départ (ex: 10). Le compte à rebours démarre automatiquement, décrémente chaque seconde, et affiche un message à 0. Si tu veux aller plus loin : un bouton reset qui repart de la valeur initiale.

---

### Tâche S4 — Outlets (communication entre controllers)

**Objectif :** Faire communiquer deux controllers Stimulus distincts via les `outlets`.

Crée un controller `logger` qui affiche un historique de messages, et connecte le controller `toggle` (tâche S2) à lui pour logger chaque toggle.

**Pistes :**
- Les `outlets` sont la façon Stimulus de référencer un autre controller depuis le sien. C'est l'équivalent Stimulus des events inter-composants.
- Un outlet donne accès à l'instance du controller cible et à son élément.
- Réfléchis à qui dépend de qui : lequel des deux controllers doit déclarer l'outlet ?

**Résultat attendu :**
Un fichier `logger_controller.js`. Dans le HTML, les deux controllers coexistent sur la même page. Chaque fois que `toggle` est déclenché, une ligne apparaît dans le `logger` (ex: "toggled at 14:32:01"). Les deux controllers ne se connaissent pas directement — c'est l'outlet qui fait le lien.

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

**Résultat attendu :**
- `src/Component/CounterComponent.php` — classe PHP avec l'attribut Live Component, le trait, et une propriété `$count`
- `templates/components/counter.html.twig` — template du composant avec les boutons et l'affichage du count
- Une route Symfony et son template qui inclut le composant via `<twig:counter />`
- Les boutons +, - et Reset fonctionnent sans rechargement de page

---

### Tâche L2 — LiveProps et état

**Objectif :** Comprendre comment l'état est persisté entre les requêtes AJAX.

Ajoute un `step` configurable au `CounterComponent` : le pas d'incrément vient du template parent.

**Pistes :**
- Toutes les propriétés ne sont pas forcément des `LiveProp`. Quelle est la différence entre une prop normale et une `LiveProp` ?
- `step` doit pouvoir être passé depuis `<twig:counter />` mais ne doit pas être modifiable depuis le navigateur. Comment le protéger ?

**Résultat attendu :**
`CounterComponent.php` modifié. `<twig:counter step="2" />` dans le template parent fait incrémenter de 2 à chaque clic. Changer `step` dans le HTML change le comportement sans toucher au PHP.

---

### Tâche L3 — LiveActions

**Objectif :** Exposer des méthodes PHP au navigateur de façon sécurisée.

Ajoute une action `setCount` qui permet de définir directement la valeur du compteur depuis un input.

**Pistes :**
- Qu'est-ce qui distingue une `#[LiveAction]` d'une méthode PHP ordinaire ?
- Une `#[LiveAction]` peut recevoir des arguments. D'où viennent-ils et comment les typer ?
- Comment déclencher une action depuis un `<form>` plutôt qu'un `<button>` ?

**Résultat attendu :**
Un input + bouton "Aller à" dans le template du composant. Soumettre le formulaire met `$count` à la valeur saisie, sans rechargement de page.

---

### Tâche L4 — Two-way binding

**Objectif :** Synchroniser automatiquement un champ HTML avec une prop du composant.

Crée un composant `search` dont l'input est lié en temps réel à une prop PHP.

**Pistes :**
- `data-model` est le point d'entrée. Sur quel élément le met-on ? Quelle valeur lui donne-t-on ?
- Une `LiveProp` exposée au navigateur nécessite une option supplémentaire. Laquelle et pourquoi ?
- Ouvre les DevTools Network pendant que tu tapes. Qu'est-ce qui déclenche les requêtes ?

**Résultat attendu :**
`src/Component/SearchComponent.php` + `templates/components/search.html.twig`. Un input dont la valeur est reflétée en dessous en temps réel (côté serveur). Les requêtes AJAX sont visibles dans les DevTools à chaque frappe.

---

### Tâche L5 — Contrôler quand les requêtes partent

**Objectif :** Maîtriser le timing des requêtes générées par `data-model`.

Sur le composant `search`, expérimente les différentes façons de contrôler quand la synchronisation se fait.

**Pistes :**
- Par défaut, quand la requête part-elle ? Est-ce toujours souhaitable pour une barre de recherche ?
- `data-model` accepte une syntaxe étendue pour choisir l'événement déclencheur.
- Il existe un attribut pour retarder l'envoi après que l'utilisateur arrête de taper.

**Résultat attendu :**
Le composant `search` modifié : les requêtes ne partent plus à chaque frappe mais après un délai ou sur un événement précis. Comportement visible dans les DevTools Network.

---

### Tâche L6 — Computed properties

**Objectif :** Exposer une valeur calculée côté serveur sans la stocker comme prop.

Ajoute au `CounterComponent` une valeur dérivée de `$count` affichée dans le template, sans créer de nouvelle `LiveProp`.

**Pistes :**
- Live Component expose automatiquement au template les méthodes qui suivent une certaine convention de nommage.
- Cette valeur est recalculée à chaque re-rendu. Est-ce un problème ?

**Résultat attendu :**
`CounterComponent.php` modifié avec une méthode supplémentaire. Le template affiche la valeur calculée (ex: `$count * 2`, ou "pair/impair") qui se met à jour à chaque clic sans nouvelle `LiveProp`.

---

### Tâche L7 — Injection de service via mount()

**Objectif :** Comprendre le rôle de `mount()` et comment les services Symfony s'intègrent dans un Live Component.

Crée un composant `color-palette` qui affiche une liste de couleurs fournie par un service Symfony.

**Pistes :**
- Dans un Live Component, on n'utilise pas le constructeur pour l'initialisation. Quelle méthode joue ce rôle ?
- Cette méthode reçoit à la fois les props passées depuis Twig ET les services injectés par le container. Dans quel ordre Symfony les résout-il ?
- Les couleurs doivent-elles être une `LiveProp` ? Pourquoi ou pourquoi pas ?

**Résultat attendu :**
- `src/Service/ColorService.php` — service qui retourne une liste de couleurs
- `src/Component/ColorPaletteComponent.php` — composant avec un `mount()` qui reçoit le service
- `templates/components/color-palette.html.twig` — affiche la liste
- Les couleurs s'affichent dans la page sans être stockées comme `LiveProp`

---

### Tâche L8 — Actions avec arguments

**Objectif :** Passer des paramètres du template HTML vers une `#[LiveAction]`.

Crée un composant `todo-list` avec des items supprimables. Chaque suppression doit cibler le bon item.

**Pistes :**
- Une `#[LiveAction]` peut recevoir des arguments. D'où viennent-ils ?
- Stimulus params (`data-live-[param]-param`) sont le mécanisme sous-jacent. Comment les utiliser dans une boucle Twig ?

**Résultat attendu :**
`src/Component/TodoListComponent.php` + `templates/components/todo-list.html.twig`. Une liste d'items avec un bouton "Supprimer" sur chacun. Cliquer sur un bouton retire l'item correspondant sans toucher aux autres.

---

### Tâche L9 — Événements entre composants

**Objectif :** Faire communiquer deux Live Components sans lien direct entre eux.

Le composant `todo-list` doit notifier un composant `notification` à chaque suppression, sans que les deux composants se connaissent directement.

**Pistes :**
- Live Component a un système d'événements propre, distinct des événements JavaScript natifs.
- Un composant peut émettre, un autre peut écouter. Cherche les attributs PHP correspondants.
- Les deux composants sont indépendants dans le template — aucun n'est enfant de l'autre.

**Résultat attendu :**
`src/Component/NotificationComponent.php` + `templates/components/notification.html.twig`. Les deux composants sont placés côte à côte dans le même template parent. Supprimer un todo fait apparaître un message dans le composant notification, sans que `todo-list` connaisse `notification`.
