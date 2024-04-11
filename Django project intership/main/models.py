from django.db import models

# Create your models here.
class login(models.Model):
    username=models.CharField(max_length=30)
    password=models.CharField(max_length=20)
class register(models.Model):
    username=models.CharField(max_length=30,blank=True,null=True)
    password=models.CharField(max_length=20,blank=True,null=True)
    name=models.CharField(max_length=25,blank=True,null=True)
    place=models.CharField(max_length=25,blank=True,null=True)
    phone=models.IntegerField(max_length=20,blank=True,null=True)
    email=models.EmailField(max_length=30,blank=True,null=True)
