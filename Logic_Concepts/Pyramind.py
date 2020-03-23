# Pyramid
def prmd():
    cont = True
    while cont:
        num = input("\nEnter the number of rows you want for your Pyramid:\t")
        try:
            val = int(num)
            print()
            for i in range(0, val):
                print(' ' * (val-i-1), '* ' * (i+1))
                cont = False
        except:
            print("\nThis is not a valid input. Please type in a number:")

def cnt_prmd():
    cont = True
    while cont:
        choice = input("\nDo you wish to make another pyramid?:(y/n)\t")
        if choice.upper() in ['Y', 'YES']:
            prmd()
        elif choice.upper() in ['N', 'NO']:
            cont = False
            print("\nThanks for Playing. Good Bye\n")
        else:
            print("\nThis is not a valid option. Please try again:")
            continue

if __name__ == "__main__":
    prmd()
    cnt_prmd()
