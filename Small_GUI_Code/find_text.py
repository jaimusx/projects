from tkinter import *
from tkinter import scrolledtext

# List to keep all search results
search_list = []


# Function to find and highlight all instances of a string in the entry box as it are writen.
def get_text(var, indx, mode):
    word = my_var.get()
    search_list.clear()
    start = '1.0'
    text_box.tag_remove('found', start, END)
    global matches_found
    matches_found = 0
    if word:
        while 1:
            start = text_box.search(word, start, regexp=True, nocase=True, stopindex=END)
            if not start:
                break
            last = '%s+%dc' % (start, len(word))
            text_box.tag_add('found', start, last)
            matches_found += 1
            start = last
            text_box.tag_config('found', background='yellow')
    total_label.config(text=f"0:{str(matches_found)}")


# Function to create new highlight and go through all stings one at a time. Highlight will cycle.
def next_match():
    text_box.tag_remove('next', '1.0', END)
    end_search_label.config(text="")
    word = find_entry.get()
    count_pos = 0
    if word:
        start = "1.0" if search_list == [] else search_list[-1]
        start = text_box.search(word, start, nocase=True, stopindex=END)
        last = '%s+%dc' % (start, len(word))

        try:
            text_box.tag_add('next', start, last)
            text_box.tag_config('next', background='cyan', foreground='black', underline=True)
            counter_list = start.split('.')
            text_box.mark_set("insert", "%d.%d" % (int(counter_list[0]), int(counter_list[1])))
            text_box.see(float(int(counter_list[0])))
            search_list.append(last)
            for i in search_list:
                count_pos += 1
            total_label.config(text=f"{str(count_pos)}:{str(matches_found)}")
        except TclError:
            end_search_label.config(text="Search complete. No further matches", anchor='w')
            search_list.clear()


# Primary TK GUI window
master_window = Tk()

my_var = StringVar()
my_var.trace_add('write', get_text)

# Initiate frame for buttons, text entry box, and results labels
buttons_frame = Frame(master_window)
buttons_frame.grid(row=0, column=0, sticky="we")

# Buttons, entry box, and label creation.
find_label = Label(buttons_frame, text="Enter your search query:", font=("Helvetica", 12))
find_label.grid(row=0, column=0, columnspan=5, sticky='nsew')

end_search_label = Label(buttons_frame, text="", width=40)
end_search_label.grid(row=2, column=0, padx=(10, 0), sticky='w')

count_label = Label(buttons_frame, text="Count:", width=5, anchor='e')
count_label.grid(row=2, column=2, padx=10)

total_label = Label(buttons_frame, text="0:0", width=7)
total_label.grid(row=2, column=3, padx=10, sticky='nsew')

find_entry = Entry(buttons_frame, bd=4, textvariable=my_var, width=125)
find_entry.grid(row=1, column=0, columnspan=5, padx=10, sticky='nsew')
find_entry.focus()

next_btn = Button(buttons_frame, text="Next", width=20, command=next_match)
next_btn.grid(row=2, column=4, padx=10, pady=5, sticky='e')

# Scrollable text box frame ----------------------------------------------------
text_frame = LabelFrame(master_window, text="Text Box", padx=5, pady=5)
text_frame.grid(row=1, column=0, columnspan=3, padx=10, pady=10, sticky='nsew')

master_window.columnconfigure(0, weight=1)
master_window.rowconfigure(1, weight=1)

text_frame.rowconfigure(0, weight=1)
text_frame.columnconfigure(0, weight=1)

# Create the scrollable text box
text_box = scrolledtext.ScrolledText(text_frame, width=75, height=35)
text_box.grid(row=0, column=0, sticky='nsew')

mainloop()
