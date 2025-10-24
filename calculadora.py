from flask import Flask, render_template, request, session, redirect, url_for
from flask_session import Session

app = Flask(__name__)
app.config['SECRET_KEY'] = 'your_secret_key_here'  
app.config['SESSION_TYPE'] = 'filesystem'
Session(app)

@app.route('/', methods=['GET', 'POST'])
def calculator():
    if 'historial' not in session:
        session['historial'] = []
    
    if request.method == 'POST':
        if 'limpiar' in request.form:
            session['historial'] = []
            return redirect(url_for('calculator'))
            
        if 'operacion' in request.form:
            num1 = float(request.form['num1'])
            num2 = float(request.form['num2'])
            operacion = request.form['operacion']
            
            if operacion == "Sumar":
                resultado = num1 + num2
                texto = f"{num1} + {num2} = {resultado}"
            elif operacion == "Restar":
                resultado = num1 - num2
                texto = f"{num1} - {num2} = {resultado}"
                
            session['historial'].append(texto)
            return render_template('calculadora.html', resultado=texto, historial=session['historial'])
    
    return render_template('calculadora.html', historial=session['historial'])

if __name__ == '__main__':
    app.run(debug=True)
