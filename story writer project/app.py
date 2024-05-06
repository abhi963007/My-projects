from flask import Flask, render_template, request, redirect, url_for,session,flash
from pymongo import MongoClient
from bson.objectid import ObjectId
from datetime import datetime

# Creating Flask app and setting session secret key
app = Flask(__name__)
app.secret_key="session_key"

#Connecting mongoDb 
client = MongoClient('mongodb://localhost:27017/')
db = client['storyDB']
collection = db['stories']
users_collection = db['users']

# For getting current time while updates and creation of stry
def getTime():
    current = datetime.strptime(str(datetime.strftime(datetime.now(),"%Y-%m-%d %H:%M:%S")), "%Y-%m-%d %H:%M:%S")
    return current

def add_story(story):
    story['views'] = 0
    story['likes'] = 0
    result = collection.insert_one(story)
    return result.inserted_id

def get_all_stories():
    storys = collection.find().sort({'created':-1})
    return list(storys)

def get_story_by_Id(storyId):
    story = collection.find_one({'_id':ObjectId(storyId)})
    return dict(story)

def get_stories_by_user(uid):
    storys = collection.find({'user_id':ObjectId(uid)}).sort({'created':-1})
    return list(storys)

def get_stories_by_genre(genre):
    storys = collection.find(genre).sort({'created':-1})
    return list(storys)

def update_story(story_id, new_story):
    collection.update_one({'_id': ObjectId(story_id)}, {'$set': new_story})

def update_views(story_id, view_count):
    collection.update_one({'_id': ObjectId(story_id)}, {'$set': view_count})
    
def delete_story(story_id):
    collection.delete_one({'_id': ObjectId(story_id)})


@app.route('/', methods=['POST','GET'])
def index():    
    stories = get_all_stories()
    if request.method == 'POST':
        if 'user_id' in session:
            if request.method == 'POST':
                genre = request.form['genre']
                gobj = collection.find_one({'genre': genre})
                if gobj is not None:
                    stories = get_stories_by_genre({'genre': genre})
                for i in stories:
                    i['created'] = i['created'].strftime("%b-%d-%Y")
            return render_template('index.html', stories=stories,gen = genre)
        else:
            return redirect('logout')
    else:
        for i in stories:
            i['created'] = i['created'].strftime("%b-%d-%Y")
        return render_template('index.html', stories=stories)

@app.route('/myStory')
def myStory():
    if 'user_id' in session:
        stories = get_stories_by_user(session['user_id'])
        for i in stories:
            i['created'] = i['created'].strftime("%I:%M:%S %p, %b-%d-%Y")
        return render_template('my-stories.html', stories=stories)
    else:
        return redirect('logout')
    

@app.route('/read/<storyId>')
def readStory(storyId):
    if 'user_id' in session:
        story = get_story_by_Id(storyId)
        update_views(storyId, {'views': story['views']+1 })
        story['created'] = story['created'].strftime("%I:%M:%S %p, %b-%d-%Y")
        story = get_story_by_Id(storyId)
        return render_template('read-story.html', story=story)
    else:
        return redirect('logout')

@app.route('/add', methods=['POST'])
def add():
    if 'user_id' in session:
        user_id = session['user_id']
        penName = users_collection.find_one({'_id': ObjectId(user_id)})['penName']
        title = request.form['title']
        genre = request.form['genre']
        content = request.form['content']
        createdOn = getTime()
        add_story({'title': title, 'genre' : genre, 'content': content , 'created': createdOn,'user_id': ObjectId(user_id),'penName':penName})
        flash('Story added!')
        return redirect(url_for('myStory'))
    else:
        return redirect(url_for('logout'))

@app.route('/update/<story_id>', methods=['POST','GET'])
def update(story_id):
    if 'user_id' in session:
        story = collection.find_one({'_id':ObjectId(story_id)})
        if request.method =="POST":
            new_title = request.form['title']
            new_genre = request.form['genre']
            new_content = request.form['content']
            updatedOn = getTime()
            update_story(story_id, {'title': new_title,'genre':new_genre, 'created': updatedOn,'content':new_content})
            flash('Story updated!')
            return redirect(url_for('myStory'))
        else:
            return render_template('updateStory.html',story=story)
    else:
        return redirect(url_for('logout'))

@app.route('/delete/<story_id>')
def delete(story_id):
    if 'user_id' in session:
            delete_story(story_id)
            flash('Story deleted!')
            return redirect(url_for('myStory'))
    else:
        return redirect(url_for('logout'))

@app.route('/login', methods=['GET', 'POST'])
def login():
    if request.method == 'POST':
        username = request.form['username']
        password = request.form['password']
        try:
            user_data = users_collection.find_one({'username': username})
            if user_data['password']==password:
                session['user_id']= str(user_data['_id'])
                print(user_data['_id'])
                return redirect(url_for('index'))
            else:
                flash('Wrong Password!!')
                return redirect(url_for('login'))  
        except Exception:
            flash('User not found!!')
            return redirect(url_for('login'))
    return render_template('login.html')

@app.route('/signup', methods=['GET', 'POST'])
def register():
    if request.method == 'POST':
        penName = request.form['penName']
        username = request.form['username']
        password = request.form['password']
        user_data = {'username': username,'penName': penName, 'password': password}
        if not users_collection.find_one({'username': username}):
            users_collection.insert_one(user_data)
            flash('Account creation Successfull!!')
            return redirect(url_for('login'))
        else:
            flash('User exists! try another username!!')
            return redirect(url_for('login'))

@app.route('/logout')
def logout():
    if 'user_id' in session:
        del session['user_id']
    return redirect(url_for('login'))

if __name__  == "__main__":
    app.run(debug=True)

