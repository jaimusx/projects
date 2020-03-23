from tkinter import *
import math #incase you want to do square roots and powers later

root = Tk()
root.resizable(width = False, height = False)
root.title("Calculator")

num1=StringVar()

def rplc_char():
    changer=box1.get()
    changed=changer.replace('÷','/')
    changed=changed.replace('x','*')
    return changed
       
def calculate():
    uinput=rplc_char()
    
    try:
        sum1=eval(uinput)
        clrscn()
        box1.insert(END,sum1)
    except:
        clrscn()
        box1.insert(0,'ERROR')

def action(i):
    value=num1.get()
    num1.set(value+i)
    
def clrscn():
    box1.delete(0, END)
    return

#Buttons
button0 = Button(root,text="0",width=4,height=2,command=lambda:action('0'))
button0.grid(row=5,column=0,columnspan=2,sticky='nsew')
button1 = Button(root,text="1",width=4,height=2,command=lambda:action('1'))
button1.grid(row=4,column=0,sticky='nsew')
button2 = Button(root,text="2",width=4,height=2,command=lambda:action('2'))
button2.grid(row=4,column=1,sticky='nsew')
button3 = Button(root,text="3",width=4,height=2,command=lambda:action('3'))
button3.grid(row=4,column=2,sticky='nsew')
button4 = Button(root,text="4",width=4,height=2,command=lambda:action('4'))
button4.grid(row=3,column=0,sticky='nsew')
button5 = Button(root,text="5",width=4,height=2,command=lambda:action('5'))
button5.grid(row=3,column=1,sticky='nsew')                 
button6 = Button(root,text="6",width=4,height=2,command=lambda:action('6'))
button6.grid(row=3,column=2,sticky='nsew')                 
button7 = Button(root,text="7",width=4,height=2,command=lambda:action('7'))
button7.grid(row=2,column=0,sticky='nsew')                 
button8 = Button(root,text="8",width=4,height=2,command=lambda:action('8'))
button8.grid(row=2,column=1,sticky='nsew')                 
button9 = Button(root,text="9",width=4,height=2,command=lambda:action('9'))
button9.grid(row=2,column=2,sticky='nsew')                 
buttonpls = Button(root,text="+",width=4,height=2,command=lambda:action('+'))
buttonpls.grid(row=2,column=3,rowspan=2,sticky='nsew')
buttonclr = Button(root,text="C",width=4,height=2,command=clrscn)
buttonclr.grid(row=1,column=0,sticky='nsew')
buttonmns = Button(root,text="-",width=4,height=2,command=lambda:action('-'))
buttonmns.grid(row=1,column=3,sticky='nsew')                 
buttondvd = Button(root,text="÷",width=4,height=2,command=lambda:action('÷'))
buttondvd.grid(row=1,column=1,sticky='nsew')                 
buttonmlt = Button(root,text="x",width=4,height=2,command=lambda:action('x'))
buttonmlt.grid(row=1,column=2,sticky='nsew')                 
buttonpnt = Button(root,text=".",width=4,height=2,command=lambda:action('.'))
buttonpnt.grid(row=5,column=2,sticky='nsew')
buttonetr = Button(root,text="=",width=4,height=2,command=calculate)
buttonetr.grid(row=4,column=3,rowspan=2,sticky='nsew')                 
#Entrybox
box1 = Entry(root,bd=20,textvariable=num1,justify=RIGHT,insertwidth=1,font=20)
box1.grid(row=0,column=0,columnspan=4,sticky='nsew')             

#main program declaration
root.mainloop()
