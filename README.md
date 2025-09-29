# EzStore - Plateforme de Gestion de Boutique en Ligne

EzStore est une application web Laravel complète pour la gestion de boutiques en ligne avec système de paiement intégré.

## 🚀 Fonctionnalités

### ✅ Fonctionnalités Implémentées

- **Authentification complète**
  - Inscription/Connexion utilisateurs
  - Réinitialisation de mot de passe
  - Gestion des rôles (Propriétaire, Employé, Admin)

- **Gestion des boutiques**
  - Création et gestion de boutiques multiples
  - Sélection de boutique active
  - Informations détaillées (nom, description, adresse, téléphone)

- **Gestion des produits**
  - Ajout/modification de produits
  - Système de catégories
  - Gestion des stocks et alertes
  - Quantité minimale configurable

- **Système de ventes**
  - Enregistrement des ventes
  - Gestion des clients
  - Modes de paiement multiples
  - Génération de factures PDF

- **Gestion des employés**
  - Ajout d'employés
  - Envoi d'emails de bienvenue
  - Attribution à des boutiques spécifiques

- **Système d'abonnement**
  - Plans tarifaires (Starter, Professional, Enterprise)
  - Intégration NotchPay pour les paiements
  - Gestion des abonnements

- **Tableau de bord**
  - Statistiques en temps réel
  - Graphiques de ventes
  - Alertes de stock faible
  - Activité récente

- **Interface utilisateur**
  - Design moderne et responsive
  - Navigation intuitive
  - Animations et transitions fluides

## 🛠️ Technologies Utilisées

- **Backend**: Laravel 12.x
- **Frontend**: Blade Templates, Bootstrap 5, TailwindCSS
- **Base de données**: SQLite (développement)
- **Paiements**: NotchPay API
- **PDF**: DomPDF
- **Email**: Laravel Mail
- **Icons**: Font Awesome, Bootstrap Icons

## 📋 Prérequis

- PHP 8.2+
- Composer
- Node.js & NPM
- SQLite (ou MySQL/PostgreSQL)

## 🚀 Installation

1. **Cloner le projet**
```bash
git clone <repository-url>
cd ange-more-laravel
```

2. **Installer les dépendances**
```bash
composer install
npm install
```

3. **Configuration de l'environnement**
```bash
cp .env.example .env
php artisan key:generate
```

4. **Configuration de la base de données**
```bash
# Pour SQLite (par défaut)
touch database/database.sqlite

# Ou configurer MySQL/PostgreSQL dans .env
```

5. **Exécuter les migrations et seeders**
```bash
php artisan migrate:fresh --seed
```

6. **Compiler les assets**
```bash
npm run build
```

7. **Démarrer le serveur**
```bash
php artisan serve
```

L'application sera accessible sur `http://localhost:8000`

## 🔧 Configuration

### Variables d'environnement importantes

```env
APP_NAME=EzStore
APP_URL=http://localhost:8000

# Base de données
DB_CONNECTION=sqlite
# DB_DATABASE=database/database.sqlite

# Email
MAIL_MAILER=smtp
MAIL_FROM_ADDRESS=noreply@ezstore.com
MAIL_FROM_NAME="${APP_NAME}"

# NotchPay
NOTCHPAY_API_KEY=your_api_key_here
NOTCHPAY_SECRET_KEY=your_secret_key_here
```

## 👥 Utilisateurs par défaut

Après l'installation, un utilisateur test est créé :
- **Email**: test@example.com
- **Mot de passe**: password
- **Rôle**: Propriétaire

## 📱 Utilisation

### Pour les Propriétaires
1. Créer un compte et se connecter
2. Créer une boutique
3. Ajouter des produits et catégories
4. Gérer les employés
5. Consulter les statistiques et ventes

### Pour les Employés
1. Recevoir l'email d'invitation
2. Se connecter avec les identifiants fournis
3. Accéder à la boutique assignée
4. Effectuer des ventes

## 🔐 Sécurité

- Validation des données côté serveur
- Protection CSRF
- Hachage des mots de passe
- Gestion des sessions sécurisées
- Middleware d'authentification

## 📊 Base de données

### Tables principales
- `users` - Utilisateurs (propriétaires, employés)
- `shops` - Boutiques
- `products` - Produits
- `categories` - Catégories
- `sales` - Ventes
- `sale_items` - Détails des ventes
- `plans` - Plans d'abonnement
- `subscriptions` - Abonnements utilisateurs

## 🎨 Personnalisation

### Thèmes et couleurs
Les couleurs principales sont définies dans les fichiers CSS :
- Couleur primaire : `#2563eb` (bleu)
- Couleur secondaire : `#3b82f6` (bleu clair)

### Ajout de fonctionnalités
1. Créer les migrations nécessaires
2. Définir les modèles avec leurs relations
3. Créer les contrôleurs
4. Définir les routes
5. Créer les vues Blade

## 🐛 Dépannage

### Problèmes courants

1. **Erreur de base de données**
```bash
php artisan migrate:fresh --seed
```

2. **Problème de permissions**
```bash
chmod -R 755 storage bootstrap/cache
```

3. **Cache des vues**
```bash
php artisan view:clear
php artisan config:clear
php artisan cache:clear
```

## 📈 Améliorations futures

- [ ] API REST complète
- [ ] Application mobile
- [ ] Système de notifications push
- [ ] Intégration avec d'autres plateformes de paiement
- [ ] Système de rapports avancés
- [ ] Gestion des inventaires multi-entrepôts
- [ ] Système de fidélité clients

## 🤝 Contribution

1. Fork le projet
2. Créer une branche feature (`git checkout -b feature/AmazingFeature`)
3. Commit les changements (`git commit -m 'Add some AmazingFeature'`)
4. Push vers la branche (`git push origin feature/AmazingFeature`)
5. Ouvrir une Pull Request

## 📄 Licence

Ce projet est sous licence MIT. Voir le fichier `LICENSE` pour plus de détails.

## 📞 Support

Pour toute question ou problème :
- Créer une issue sur GitHub
- Contacter l'équipe de développement

---

**EzStore** - Simplifiez la gestion de votre boutique en ligne 🚀