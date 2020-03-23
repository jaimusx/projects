#Created by Jaime Aviles 10/24/17
#This was a challenge from  my friend to see if I 
#could make a rock/paper/scissors game.
from tkinter import *
import random

#Creates attributes for the GUI window.
root=Tk()
root.title("Rock, Paper, Scissors")
root.geometry("238x100")
root.resizable(width = False, height = False)

options=["Rock","Paper","Scissors"]

#Once button is pressed, selects random item from options list.
def battle():
    fst=plyr1()
    snd=plyr2()
    #This determins what selection wins.
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
    
#Sets player one random selection.
def plyr1():
    p1=random.choice(options)
    label3["text"]=p1    
    return p1

#Sets player two random selection.
def plyr2():
    p2=random.choice(options)
    label4["text"]=p2    
    return p2

#Sets button.
play_button=Button(root,text="Battle!",command=battle)
play_button.grid(row=3,column=1,sticky='nsew')
#Sets labels.
label1=Label(root,text="Player 1").grid(row=1,column=0,sticky='E')
label2=Label(root,text="Player 2").grid(row=1,column=2,sticky='W')
label3=Label(root,text="")
label3.grid(row=2,column=0,sticky='E')
label4=Label(root,text="")
label4.grid(row=2,column=2,sticky='W')
label5=Label(root,width=33,text="",bg='white')
label5.grid(row=4,column=0,columnspan=3)

#Initializes the GUI window.
if __name__ == "__main__":
	root.mainloop()