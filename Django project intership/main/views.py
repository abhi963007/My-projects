from django.shortcuts import render

# Create your views here.
def home(request):
    return render(request,'wel.html')
def about(request):
    return render(request,'about.html')
def contact(request):
    return render(request,'contact.html')
def login(request):
    if request.method=="POST":
        un=request.POST['fname']
        pwd=request.POST['pass']
        print("Username=",un)
        print("Password=",pwd)
    return render(request,'login.html')
def register(request):
    if request.method=="POST":
        n=request.POST['Name']
        p=request.POST['Place']
        ph=request.POST['Phone']
        m=request.POST['Mail']
        u=request.POST['Username']
        p=request.POST['Pass']
        print("Name=",n)
        print("Place=",p)
        print("Phone=",ph)
        print("Email=",m)
        print("Username=",u)
        print("Password=",p)
    return render(request,'reg.html')