from tkinter import *
from tkinter import scrolledtext

def get_text(var, indx, mode):
    word = my_var.get()
    start = '1.0'
    txtbox.tag_remove('found', start, END)
    if len(word) > 0:
        txtbox.mark_set('next', txtbox.search(word, start, regexp=True, nocase=1))
        txtbox.see('next')
        if word:
            while 1:
                start = txtbox.search(word, start, regexp=True ,nocase=1, stopindex=END)
                if not start:
                    break
                last = '%s+%dc' % (start, len(word))
                txtbox.tag_add('found', start, last)
                start = last
                txtbox.tag_config('found', background='yellow')

def next_match():
    while (txtbox.compare('next', '<', END)) and 'found' in txtbox.tag_names('next'):
        txtbox.mark_set('next', 'next+1c')
    n_match = txtbox.tag_nextrange('found', 'next')
    if n_match:
        txtbox.tag_remove('next', '1.0', END)
        txtbox.mark_set('next', n_match[0])
        txtbox.see('next')
        txtbox.tag_add('next','next', '%s+%dc' %('next',len(my_var.get())))
        txtbox.tag_config('next', background='cyan')

master_window = Tk()

my_var = StringVar()
my_var.trace_add('write', get_text)

# Parent widget for the buttons
buttons_frame = Frame(master_window)
buttons_frame.grid(row=0, column=0, sticky=W+E)

box1 = Entry(buttons_frame, bd=4, textvariable=my_var, width=125)
box1.grid(row=0, column=1, padx=10, pady=10, sticky='nsew')

n_btn = Button(buttons_frame, text="Next", command=next_match, width=10)
n_btn.grid(row=0, column=2, padx=10, pady=10, sticky='e')

# Group1 Frame ----------------------------------------------------
group1 = LabelFrame(master_window, text="Text Box", padx=5, pady=5)
group1.grid(row=1, column=0, columnspan=3, padx=10, pady=10, sticky='nsew')

master_window.columnconfigure(0, weight=1)
master_window.rowconfigure(1, weight=1)

group1.rowconfigure(0, weight=1)
group1.columnconfigure(0, weight=1)

# Create the textbox
txtbox = scrolledtext.ScrolledText(group1, width=100, height=50)
txtbox.grid(row=0, column=0, sticky='nesw')

mainloop()
