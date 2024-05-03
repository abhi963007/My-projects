from flask import Flask, render_template, request, redirect, url_for,session,flash
from pymongo import MongoClient
from bson.objectid import ObjectId
from datetime import datetime

def getTime():
    current = datetime.strptime(str(datetime.strftime(datetime.now(),"%Y-%m-%d %H:%M")),"%Y-%m-%d %H:%M")
    return current
def getTimeLimit():
    timeLimit = datetime.now().strftime('%Y-%m-%dT%H:%M')
    return timeLimit

app = Flask(__name__)
app.secret_key="sample_secret_key"
client = MongoClient('mongodb://localhost:27017/')
db = client['todolist']
collection = db['tasks']
users_collection = db['users']

def add_task(task):
    task['status'] = 'pending'
    result = collection.insert_one(task)
    return result.inserted_id

def get_tasks(uid):
    tasks = collection.find({'status':'pending','user_id':ObjectId(uid)}).sort('time_to_complete')
    return list(tasks)
def get_c_tasks(uid):
    ctasks = collection.find({'status':'completed','user_id':ObjectId(uid)}).sort('time_to_complete',-1)
    return list(ctasks)

def update_task(task_id, new_task):
    collection.update_one({'_id': ObjectId(task_id)}, {'$set': new_task})

def delete_task(task_id):
    collection.delete_one({'_id': ObjectId(task_id)})

@app.route('/')
def index():
    if 'user_id' in session:
        tasks = get_tasks(session['user_id'])
        for i in tasks:
            if getTime() >= i['time_to_complete']:
                i['late'] = True
            else:
                i['late'] =False
            i['time_to_complete'] = i['time_to_complete'].strftime("%I:%M %p %a, %b-%d-%Y")
        ctasks = get_c_tasks(session['user_id'])
        for i in ctasks:
            i['time_to_complete'] = i['time_to_complete'].strftime("%I:%M %p %a, %b-%d-%Y")
        return render_template('index.html', tasks=tasks,ctasks=ctasks,loggedIn = True,datetime=getTimeLimit())
    else:
        return render_template('index.html', loggedIn = False )
@app.route('/add', methods=['POST'])
def add():
    if 'user_id' in session:
        user_id = session['user_id']
        task_name = request.form['task_name']
        time_to_complete = request.form['time_to_complete']
        task_time = datetime.strptime(time_to_complete, "%Y-%m-%dT%H:%M")
        add_task({'name': task_name, 'time_to_complete': task_time,'user_id': ObjectId(user_id)})
        return redirect(url_for('index'))
    else:
        return redirect(url_for('logout'))

@app.route('/update/<task_id>', methods=['POST'])
def update(task_id):
    if 'user_id' in session:
        new_task_name = request.form['new_task_name']
        task_time = request.form['new_task_time']
        new_task_time = datetime.strptime(task_time, "%Y-%m-%dT%H:%M")
        update_task(task_id, {'name': new_task_name,'time_to_complete':new_task_time})
        return redirect(url_for('index'))
    else:
        return redirect(url_for('logout'))
@app.route('/status/<task_id>', methods=['POST'])
def status(task_id):
    if 'user_id' in session:
        update_task(task_id, {'status': 'completed'})
        return redirect(url_for('index'))
    else:
        return redirect(url_for('logout'))

@app.route('/delete/<task_id>', methods=['POST'])
def delete(task_id):
    if 'user_id' in session:
            delete_task(task_id)
            return redirect(url_for('index'))
    else:
        return redirect(url_for('logout'))

@app.route('/login', methods=['GET', 'POST'])
def login():
    if request.method == 'POST':
        username = request.form['username']
        password = request.form['password']
        try:
            user_data = users_collection.find_one({'username': username})
            print(user_data)
            if user_data['password']==password:
                session['user_id']= str(user_data['_id'])
                print(user_data['_id'])
                return redirect(url_for('index'))
            else:
                flash('Password Error')
                return redirect(url_for('index'))  
        except Exception:
            flash('Username not found')
            return redirect(url_for('index'))

@app.route('/register', methods=['GET', 'POST'])
def register():
    if request.method == 'POST':
        username = request.form['username']
        password = request.form['password']
        user_data = {'username': username, 'password': password}
        if not users_collection.find_one({'username': username}):
            users_collection.insert_one(user_data)
            flash('Signup Successfull, Please Login')
            return redirect(url_for('index'))
        else:
            flash('Username already exists! try another!!')
            return redirect(url_for('index'))

@app.route('/logout')
def logout():
    if 'user_id' in session:
        del session['user_id']
    return redirect(url_for('index'))

if __name__ == "__main__":
    app.run(debug=True)
