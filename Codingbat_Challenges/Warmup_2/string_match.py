"""
From: https://codingbat.com/prob/p182414

Given 2 strings, a and b, return the number of the positions where they contain the same 
length 2 substring. So "xxcaazz" and "xxbaaz" yields 3, since the "xx", "aa", and "az" 
substrings appear in the same place in both strings.

string_match('xxcaazz', 'xxbaaz') → 3
string_match('abc', 'abc') → 2
string_match('abc', 'axc') → 0

Solution:
"""

def string_match(a, b):
    return sum(1 for i in range(min(len(a), len(b)) - 1) if a[i] + a[i + 1] == b[i] + b[i + 1])
