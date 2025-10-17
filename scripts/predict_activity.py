import sys
import pandas as pd
import joblib

# Arguments depuis Laravel
user_id = int(sys.argv[1])
method = sys.argv[2]

# Charger modèle et encodeur
model = joblib.load('activity_rf_model.pkl')
le = joblib.load('action_label_encoder.pkl')
X_columns = joblib.load('X_columns.pkl')

# Créer DataFrame
new_log = pd.DataFrame([{
    'user_id': user_id,
    'method': method
}])

# Encoder et ajouter colonnes manquantes
new_log = pd.get_dummies(new_log)
for col in X_columns:
    if col not in new_log.columns:
        new_log[col] = 0
new_log = new_log[X_columns]

# Prédiction
prediction = model.predict(new_log)
action_label = le.inverse_transform(prediction)

print(action_label[0])
