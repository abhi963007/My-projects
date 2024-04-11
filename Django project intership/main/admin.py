from django.contrib import admin

# Register your models here.
from main.models import login
admin.site.register(login)
from main.models import register
admin.site.register(register)