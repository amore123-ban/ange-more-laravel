import pandas as pd
from sklearn.ensemble import RandomForestClassifier
from sklearn.model_selection import train_test_split
from sklearn.preprocessing import LabelEncoder
import joblib

# 1. Charger les données
df = pd.read_csv('activity_logs.csv')

# 2. Préparer les features
X = df[['user_id', 'method']]  # On peut encoder method et autres infos
X = pd.get_dummies(X)          # Encode les colonnes catégorielles
y = df['action']

# 3. Encoder les labels
le = LabelEncoder()
y_encoded = le.fit_transform(y)

# 4. Split dataset
X_train, X_test, y_train, y_test = train_test_split(X, y_encoded, test_size=0.2, random_state=42)

# 5. Entraîner Random Forest
model = RandomForestClassifier(n_estimators=100, random_state=42)
model.fit(X_train, y_train)

# 6. Sauvegarder le modèle et l'encodeur
joblib.dump(model, 'activity_rf_model.pkl')
joblib.dump(le, 'action_label_encoder.pkl')
