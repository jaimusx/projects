from tkinter import *
from tkinter import messagebox
import random

root = Tk()
root.title("Randomizer")
root.resizable(width = False, height = False)
root.geometry("280x270")

mylist = []

def get_data(i):
    task = box1.get()

    if task != "":
        i.append(task)
        print(i)
        display_data()
        box1.delete(0, END)
    else:
        messagebox.showwarning("Warning", "No name has been entered")
    box1.delete(0, END)

def display_data():
    list_names.delete(0, END)
    
    for items in mylist:
        list_names.insert(END, items)

def del_one():
    task = list_names.get("active")

    if task in mylist:
        mylist.remove(task)
    display_data()

def del_all():
    confirmed = messagebox.askyesno("Please Confirm", "Do you really want to delete all?")
    task = ""
    
    if confirmed == True:
        global mylist
        mylist = []
        display_data()
        label3["text"] = task
        
def random_select():
    task = random.choice(mylist)
    label3["text"] = task

    "Deletes the randomly selected name"
    if task in mylist:      
        mylist.remove(task)
    display_data()

label1 = Label(root,text = "Enter Name:")
label1.grid(row = 0, column = 1)

label2 = Label(root,text = "Your Random Choice is:")
label2.grid(row = 9, column = 1, columnspan = 4, sticky = 'nesw')

label3 = Label(root,text = "", bg = "white")
label3.grid(row = 10, column = 1, columnspan = 4, sticky = 'nesw')

ID = StringVar()
box1 = Entry(root, bd = 4, textvariable = ID)
box1.grid(row = 1, column = 1)

buttonA = Button(root, text = "Submit", command = lambda: get_data(mylist), width = 5)
buttonA.grid(row = 2, column = 1)

buttonB = Button(root, text = "Delete Name", command = del_one, )
buttonB.grid(row = 3, column = 1)

buttonC = Button(root, text = "Delete All", command = del_all)
buttonC.grid(row = 4, column = 1)

buttonD = Button(root, text = "Random Select", command = random_select)
buttonD.grid(row = 11, column = 1, columnspan = 4, sticky = 'nsew')

list_names = Listbox(root, bd = 4)
list_names.grid(row = 1, column = 3, rowspan = 7)

list_bar = Scrollbar(root)
list_bar.grid(row = 1, column = 4, rowspan = 7, sticky = 'nsew')
list_names.configure(yscrollcommand = list_bar.set)
list_bar.configure(command = list_names.yview)

root.mainloop()
