import random

class bcolors:
    HEADER = '\033[95m'
    OKBLUE = '\033[94m'
    OKGREEN = '\033[92m'
    WARNING = '\033[93m'
    FAIL = '\033[91m'
    ENDC = '\033[0m'
    BOLD = '\033[1m'
    UNDERLINE = '\033[4m'


class Person:
    def __init__(self, name, hp, mp, atk, df, magic, items):
        self.maxhp = hp
        self.hp = hp
        self.maxmp = mp
        self.mp = mp
        self.atkl = atk - 10
        self.atkh = atk + 10
        self.df = df
        self.magic = magic
        self.items = items
        self.name = name
        self.actions = ["Attack", "Magic", "Items"]

    def generate_damage(self):
        return random.randrange(self.atkl, self.atkh)

    def take_damage(self, dmg):
        self.hp -= dmg
        if self.hp < 0:
            self.hp = 0
        return self.hp

    def heal(self, dmg):
        self.hp += dmg
        if self.hp < 0:
            self.hp = self.maxhp

    def get_hp(self):
        return self.hp

    def get_max_hp(self):
        return self.maxhp

    def get_mp(self):
        return self.mp

    def get_max_mp(self):
        return self.maxmp

    def reduce_mp(self, cost):
        self.mp -= cost

    def choose_action(self):
        i = 1
        print("\n" + "    " + bcolors.BOLD + self.name + ":" + bcolors.ENDC)
        print(bcolors.OKBLUE + bcolors.BOLD + "    ACTIONS:" + bcolors.ENDC)
        for item in self.actions:
            print("       " + str(i) + ":", item)
            i += 1

        while True:
            try:
                choice = int(input("    Choose Action: "))
            except ValueError:
                print(
                    "\n" + bcolors.BOLD + bcolors.FAIL + "This is not a valid Action! Please try again\n" +
                    bcolors.ENDC)
                continue

            if choice not in range(1, 4):
                print(
                    "\n" + bcolors.BOLD + bcolors.FAIL + "This is not a valid Action! Please try again\n" +
                    bcolors.ENDC)
                continue
            else:
                break
        return choice

    def choose_magic(self):
        i = 0
        print("\n" + bcolors.OKBLUE + bcolors.BOLD + "    Magic:" + bcolors.ENDC)
        for spell in self.magic:
            print("        " + str(i) + ":", spell.name, "(cost:", str(spell.cost) + ")")
            i += 1

        while True:
            try:
                mag_choice = int(input("    Choose Magic: "))
            except ValueError:
                print(
                    "\n" + bcolors.BOLD + bcolors.FAIL + "This is not a valid Action! Please try again\n" +
                    bcolors.ENDC)
                continue

            if mag_choice not in range(0, 7):
                print(
                    "\n" + bcolors.BOLD + bcolors.FAIL + "This is not a valid Action! Please try again\n" +
                    bcolors.ENDC)
                continue
            else:
                break
        return mag_choice

    def choose_enemy_spell(self):
        magic_choice = random.randrange(0, len(self.magic))
        spell = self.magic[magic_choice]
        magic_dmg = spell.generate_damage()

        pct = self.hp / self.maxhp * 100

        if self.mp < spell.cost or spell.type == "white" and pct > 50:
            spell, magic_dmg = self.choose_enemy_spell()
            return spell, magic_dmg
        else:
            return spell, magic_dmg

    def choose_item(self):
        i = 0
        print("\n" + bcolors.OKBLUE + bcolors.BOLD + "    Items:" + bcolors.ENDC)
        for item in self.items:
            print("        " + str(i) + ".", item["item"].name + ":", item["item"].description,
                  "(x" + str(item["quantity"]) + ")")
            i += 1

        while True:
            try:
                itm_choice = int(input("    Choose and item: "))
            except ValueError:
                print(
                    "\n" + bcolors.BOLD + bcolors.FAIL + "This is not a valid Action! Please try again\n" +
                    bcolors.ENDC)
                continue

            if itm_choice not in range(0, 7):
                print(
                    "\n" + bcolors.BOLD + bcolors.FAIL + "This is not a valid Action! Please try again\n" +
                    bcolors.ENDC)
                continue
            else:
                break
        return itm_choice

    def choose_target(self, enemies):
        i = 1
        print("")
        print(bcolors.FAIL + bcolors.BOLD + "    TARGET:" + bcolors.ENDC)
        for enemy in enemies:
            if enemy.get_hp() != 0:
                print("       " + str(i) + ".", enemy.name)
                i += 1
        while True:
            try:
                choice = int(input("    Choose Target: ")) - 1
            except ValueError:
                print(
                    "\n" + bcolors.BOLD + bcolors.FAIL + "This is not a valid Action! Please try again\n" +
                    bcolors.ENDC)
                continue

            if choice not in range(0, len(enemies)):
                print(
                    "\n" + bcolors.BOLD + bcolors.FAIL + "This is not a valid Action! Please try again\n" +
                    bcolors.ENDC)
                continue
            else:
                break
        return choice

    def get_enemy_stats(self):
        hp_bar = ""
        bar_ticks = (self.hp / self.maxhp) * 100 / 2

        while bar_ticks > 0:
            hp_bar += "█"
            bar_ticks -= 1

        while len(hp_bar) < 50:
            hp_bar += " "

        hp_string = str(self.hp) + "/" + str(self.maxhp)
        current_hp = ""

        if len(hp_string) < 11:
            decreased = 11 - len(hp_string)

            while decreased > 0:
                current_hp += " "
                decreased -= 1

            current_hp += hp_string
        else:
            current_hp = hp_string

        print("                    __________________________________________________")
        print(bcolors.BOLD + self.name + ": " + current_hp + " |" + bcolors.FAIL + hp_bar + bcolors.ENDC +
              bcolors.BOLD + "|")

    def get_stats(self):
        hp_bar = ""
        mp_bar = ""
        bar_ticks = (self.hp / self.maxhp) * 100 / 4
        mp_ticks = (self.mp / self.maxmp) * 100 / 10

        while bar_ticks > 0:
            hp_bar += "█"
            bar_ticks -= 1

        while len(hp_bar) < 25:
            hp_bar += " "

        while mp_ticks > 0:
            mp_bar += "█"
            mp_ticks -= 1

        while len(mp_bar) < 10:
            mp_bar += " "

        # hp bar alignment
        hp_string = str(self.hp) + "/" + str(self.maxhp)
        current_hp = ""

        if len(hp_string) < 9:
            decreased = 9 - len(hp_string)

            while decreased > 0:
                current_hp += " "
                decreased -= 1

            current_hp += hp_string
        else:
            current_hp = hp_string

        # mp bar alignment
        mp_string = str(self.mp) + "/" + str(self.maxmp)
        current_mp = ""

        if len(mp_string) < 7:
            decreased = 7 - len(mp_string)

            while decreased > 0:
                current_mp += " "
                decreased -= 1

            current_mp += mp_string
        else:
            current_mp = mp_string

        print("                    _________________________               __________")
        print(bcolors.BOLD + self.name + ":   " + current_hp + " |" + bcolors.OKGREEN + hp_bar + bcolors.ENDC +
              bcolors.BOLD + "|    " + current_mp + "  |" + bcolors.OKBLUE + mp_bar + bcolors.ENDC + bcolors.BOLD + "|")