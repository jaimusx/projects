from tkinter import *
from tkinter import messagebox
import random

#Sets characteristics such as name and dimensions for the GUI Window.
root = Tk()
root.title("Randomizer")
root.resizable(width = False, height = False)
root.geometry("280x270")

mylist = []

def get_data(i):
	#Gets user input and assigns to a list.
    task = box1.get()
    if task != "":
        i.append(task)
		#The print statement is just for console viewing. 
        print(i)
        display_data()
        box1.delete(0, END)
    else:
        messagebox.showwarning("Warning", "No name has been entered")
    box1.delete(0, END)

def display_data():
	#Displays recent list items in a text box.
    list_names.delete(0, END)    
    for items in mylist:
        list_names.insert(END, items)

def del_one():
	#Allows user to delete a selected item in the text box.
    task = list_names.get("active")
    if task in mylist:
        mylist.remove(task)
    display_data()

def del_all():
	#Allows user to delete all items in the text box.
    confirmed = messagebox.askyesno("Please Confirm", "Do you really want to delete all?")
    task = ""    
    if confirmed == True:
        global mylist
        mylist = []
        display_data()
        label3["text"] = task
        
def random_select():
	#Randomly selects an item in the list from the text box.
    task = random.choice(mylist)
    label3["text"] = task

    #Deletes the randomly selected name.
    if task in mylist:      
        mylist.remove(task)
    display_data()

#Initilizes all labels and buttons.
label1 = Label(root,text = "Enter Name:")
label1.grid(row = 0, column = 1)

label2 = Label(root,text = "Your Random Choice is:")
label2.grid(row = 9, column = 1, columnspan = 4, sticky = 'nesw')

label3 = Label(root,text = "", bg = "white")
label3.grid(row = 10, column = 1, columnspan = 4, sticky = 'nesw')

ID = StringVar()
box1 = Entry(root, bd = 4, textvariable = ID)
box1.grid(row = 1, column = 1)

#This button needed a special function within to input items into the list.
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

#Initilizes the GUI window
if __name__ == "__main__":
	root.mainloop()