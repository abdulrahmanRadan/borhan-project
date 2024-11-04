from flask import Flask, request, jsonify
from pdfminer.high_level import extract_text

app = Flask(__name__)

@app.route('/train', methods=['POST'])
def train():
    file = request.files['file']
    text = extract_text(file)
    # تدريب النموذج باستخدام النص المستخرج
    # model.train(text)
    return jsonify({"status": "success", "message": "Model trained successfully"})


@app.route('/predict', methods=['POST'])
def predict():
    data = request.json
    # الحصول على الإجابة من النموذج
    # answer = model.predict(data['input'])
    answer = "Example answer based on trained data"
    return jsonify({"answer": answer})

if __name__ == '__main__':
    app.run()
