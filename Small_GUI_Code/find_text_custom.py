from _tkinter import TclError
from tkinter import StringVar
import customtkinter as ctk

# List to keep all search results
search_list = []

# Function to find and highlight all instances of a string in the entry box as it are writen.
def get_text(var, indx, mode):
    word = my_var.get()
    search_list.clear()
    start = "1.0"
    text_box.tag_remove("found", start, "end")
    text_box.tag_remove("next", "1.0", "end")
    global matches_found
    matches_found = 0
    if word:
        while 1:
            start = text_box.search(word, start, regexp=True, nocase=True, stopindex="end")
            if not start:
                break
            last = "%s+%dc" % (start, len(word))
            text_box.tag_add("found", start, last)
            matches_found += 1
            start = last
            text_box.tag_config("found", background="yellow")
    total_label.configure(text=f"0:{str(matches_found)}")


# Function to create new highlight and go through all stings one at a time. Highlight will cycle.
def next_match():
    text_box.tag_remove("next", "1.0", "end")
    end_search_label.configure(text="")
    word = find_entry.get()
    count_pos = 0
    if word:
        start = "1.0" if search_list == [] else search_list[-1]
        start = text_box.search(word, start, nocase=True, stopindex="end")
        last = "%s+%dc" % (start, len(word))

        try:
            text_box.tag_add("next", start, last)
            text_box.tag_config("next", background="cyan", foreground="black", underline=True)
            counter_list = start.split(".")
            text_box.mark_set("insert", "%d.%d" % (int(counter_list[0]), int(counter_list[1])))
            text_box.see(float(int(counter_list[0])))
            search_list.append(last)
            for _ in search_list:
                count_pos += 1
            total_label.configure(text=f"{str(count_pos)}:{str(matches_found)}")
        except TclError:
            end_search_label.configure(text="Search complete. No further matches", anchor="w")
            search_list.clear()


# Function to remove the initial text in the text box
def on_click(event):
    text_box.delete("1.0", "end")
    text_box.unbind("<Button-1>")

root = ctk.CTk()
root.geometry("600x700")
root.title("Word Finder")

my_var = StringVar()
my_var.trace_add("write", get_text)

# Initiate frame for buttons, text entry box, and results labels
buttons_frame = ctk.CTkFrame(root)
buttons_frame.grid(row=0, column=0, padx=5, pady=5, sticky="nsew")

# Buttons, entry box, and label creation.
find_label = ctk.CTkLabel(buttons_frame, text="Enter Your Search Query:")
find_label.grid(row=0, column=0, padx=10, columnspan=5, sticky="nsew")

end_search_label = ctk.CTkLabel(buttons_frame, text="", width=40)
end_search_label.grid(row=2, column=0, padx=(10, 0), sticky="w")

count_label = ctk.CTkLabel(buttons_frame, text="Count:", width=5, anchor="e")
count_label.grid(row=2, column=2, padx=10)

total_label = ctk.CTkLabel(buttons_frame, text="0:0", width=7)
total_label.grid(row=2, column=3, padx=10, sticky="nsew")

find_entry = ctk.CTkEntry(buttons_frame, textvariable=my_var, width=125)
find_entry.grid(row=1, column=0, columnspan=5, padx=5, sticky="nsew")
find_entry.focus()

next_btn = ctk.CTkButton(buttons_frame, text="Next", width=120, command=next_match)
next_btn.grid(row=2, column=4, padx=5, pady=5, sticky="e")

# Second frame for ccrollable text box
text_frame = ctk.CTkFrame(root, border_color="black")
text_frame.grid(row=1, column=0, padx=5, pady=(1, 5), sticky="nsew")

# Create the scrollable text box
text_box = ctk.CTkTextbox(text_frame)
text_box.grid(row=0, column=0, padx=5, pady=5, sticky="nsew")
text_box.insert("0.0", "Paste Text Here...")
text_box.bind("<Button-1>", on_click)

# Set the window to be scalable
root.columnconfigure(0, weight=1)
root.rowconfigure(1, weight=1)

buttons_frame.rowconfigure(0, weight=1)
buttons_frame.columnconfigure(0, weight=1)

text_frame.rowconfigure(0, weight=1)
text_frame.columnconfigure(0, weight=1)

# Main initilazation of the window
if __name__ == "__main__":
    root.mainloop()
