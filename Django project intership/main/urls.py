from.import views
from django.urls import path
urlpatterns = [
   path('',views.home),
   path('abo',views.about),
   path('con',views.contact),
   path('log',views.login),
   path('reg',views.register),
]
