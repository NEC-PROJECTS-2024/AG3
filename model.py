import pickle
from sklearn.feature_extraction.text import CountVectorizer

# Load the trained Naive Bayes model
with open('nbmod.pkl', 'rb') as nb_model_file:
    nb_model = pickle.load(nb_model_file)

# Recreate the CountVectorizer with the same parameters used during training
vectorizer = CountVectorizer(ngram_range=(2, 3), stop_words='english')

def fit_vectorizer(texts):
    # Fit the CountVectorizer with the training data
    vectorizer.fit(texts)

def predict_category(texts):
    # Ensure that the CountVectorizer is fitted before transforming
    if not hasattr(vectorizer, 'vocabulary_'):
        raise ValueError("CountVectorizer must be fitted with training data before predicting")

    # Vectorize the text using the recreated CountVectorizer
    text_vectorized = vectorizer.transform(texts).toarray()

    # Make prediction using the Naive Bayes model
    category = nb_model.predict(text_vectorized)

    return category
