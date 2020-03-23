from tkinter import *
import random

root=Tk()
root.title("Rock, Paper, Scissors")
root.geometry("238x100")
root.resizable(width = False, height = False)

options=["Rock","Paper","Scissors"]

def battle():
    clrscn()
    fst=plyr1()
    snd=plyr2()
    
    if fst == snd:
        label5["text"]="Draw!"
    elif fst == "Rock" and snd == "Scissors":
        label5["text"]="Player 1 wins!"
    elif fst == "Paper" and snd == "Rock":
        label5["text"]="Player 1 wins!"
    elif fst == "Scissors" and snd == "Paper":
        label5["text"]="Player 1 wins!"
    else:
        label5["text"]="Player 2 wins!"    
    
def plyr1():
    p1=random.choice(options)
    label3["text"]=p1    
    return p1

def plyr2():
    p2=random.choice(options)
    label4["text"]=p2    
    return p2

def clrscn():
    label3["text"]=""
    label4["text"]=""
    label5["text"]=""

#button
play_button=Button(root,text="Battle!",command=battle)
play_button.grid(row=3,column=1,sticky='nsew')
#Labels
label1=Label(root,text="Player 1").grid(row=1,column=0,sticky='E')
label2=Label(root,text="Player 2").grid(row=1,column=2,sticky='W')
label3=Label(root,text="")
label3.grid(row=2,column=0,sticky='E')
label4=Label(root,text="")
label4.grid(row=2,column=2,sticky='W')
label5=Label(root,width=33,text="",bg='white')
label5.grid(row=4,column=0,columnspan=3)

root.mainloop()
