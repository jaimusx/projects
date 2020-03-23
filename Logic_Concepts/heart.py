#Created for logic on how o draw a heart.

num = int(input("column\t"))
c = int(num/2)
n = 3 + c

for i in range(n):
    for j in range(num):
        if(i == 0 and j%c != 0) or (i == 1 and j%c == 0) or i-j == 2 or i + j == num + 1:
            print("*", end = "")
        else:
            print(" ", end = "")
        print()
