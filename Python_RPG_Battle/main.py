import random
from classes.game import Person, bcolors
from classes.magic import Spell
from classes.inventory import Item

#Creat Black Magic
fire = Spell("Fire", 10, 350, "black")
thunder = Spell("Thunder", 10, 350, "black")
blizzard = Spell("Blizzard", 10, 350, "black")
meteor = Spell("Meteor", 20, 800, "black")
quake = Spell("Quake", 14, 440, "black")

#create White Magic
cure = Spell("Cure", 12, 420, "white")
cura = Spell("Cura", 18, 580, "white")

#Creat some Itmes
potion = Item("Potion", "potion", "Heals 50 HP", 150)
hipotion = Item("Hi-Potion", "potion", "Heals 100 HP", 300)
superpotion = Item("Super Potion", "potion", "Heals 500 HP", 900)
elixer = Item("Elixer", "elixer", "Fully restores HP/MP of one party member", 9999)
hielixer = Item("MegaElixer", "elixer" ,"Fully restores party's HP/MP", 9999)

grenade = Item("Grenade", "attack","Deals 500 damage", 1000)

player_spells = [fire, thunder, blizzard, meteor, cure, cura]
enemy_spells = [fire, meteor, cura]
player_items = [{"item": potion, "quantity": 0}, {"item": hipotion, "quantity": 5},
                {"item": superpotion, "quantity": 5}, {"item": elixer, "quantity": 5},
                {"item": hielixer, "quantity": 2}, {"item": grenade, "quantity": 1}]

#Instantiates Player and NPC(s)
player1 = Person("Buttz", 3260, 10, 300, 34, player_spells, player_items)
player2 = Person("Cloud", 4160, 188, 311, 34, player_spells, player_items)
player3 = Person("Vaan ", 2089, 174, 288, 34, player_spells, player_items)

enemy1 = Person("Imp  ",1250, 130, 560, 325, enemy_spells,[])
enemy2 = Person("Scaar",11200, 701, 525, 25, enemy_spells,[])
enemy3 = Person("Imp  ",1250, 130, 560, 325, enemy_spells,[])

players = [player1, player2, player3]
enemies = [enemy1, enemy2, enemy3]

defeated_enemies = 0
defeated_players = 0

running = True
i = 0

print(bcolors.FAIL + bcolors.BOLD + "\nYOU ARE BEING ATTACKED!" + bcolors.ENDC)

while running:
    print("====================\n")
    print("NAME               HP                                       MP")

    for player in players:
        player.get_stats()

    print("")

    for enemy in enemies:
        enemy.get_enemy_stats()

    for player in players:
        # check if player won
        if defeated_enemies == 3:
            print("\n" + bcolors.OKGREEN + "You Win!\n♫♫ Fanfare ♫♫" + bcolors.ENDC)
            running = False
            break

        start = True

        while start:
            start = False
            choice = player.choose_action()
            index = choice - 1

            if index == 0:
                dmg = player.generate_damage()
                enemy = player.choose_target(enemies)

                enemies[enemy].take_damage(dmg)
                print("\n" + player.name.replace(" ", "") + " attacked " + enemies[enemy].name.replace(" ", "") + " for", dmg, "points of damage.")

                if enemies[enemy].get_hp() == 0:
                    print(bcolors.BOLD + bcolors.FAIL + enemies[enemy].name.replace(" ", "") + " HAS FALLEN!" + bcolors.ENDC)
                    del enemies[enemy]
                    defeated_enemies += 1

            elif index == 1:
                check_mp = True
                while check_mp:
                    mag_choice = player.choose_magic()
                    magic_choice = mag_choice - 1
                    spell = player.magic[magic_choice]
                    magic_dmg = spell.generate_damage()
                    current_mp = player.get_mp()

                    if spell.cost > current_mp:
                        print(bcolors.FAIL + "\nNot enough MP. Please choose a different spell. Type 0 to go back." + bcolors.ENDC)
                        continue
                    else:
                        check_mp  = False

                if magic_choice == -1:
                    start = True
                    continue

                player.reduce_mp(spell.cost)

                if spell.type == "white":
                    player.heal(magic_dmg)
                    print(bcolors.OKBLUE + "\n" + spell.name + " heals", player.name, "for", str(magic_dmg), "HP." + bcolors.ENDC)
                    if player.hp > player.maxhp:
                       player.hp = player.maxhp

                elif spell.type == "black":
                    enemy = player.choose_target(enemies)
                    enemies[enemy].take_damage(magic_dmg)
                    print(bcolors.OKBLUE + "\n" + spell.name + " deals", str(magic_dmg), "points of damage to " + enemies[enemy].name.replace(" ", "") + bcolors.ENDC)

                    if enemies[enemy].get_hp() == 0:
                        print(bcolors.BOLD + bcolors.FAIL + enemies[enemy].name.replace(" ", "") + " HAS FALLEN!" + bcolors.ENDC)
                        del enemies[enemy]
                        defeated_enemies += 1

            elif index == 2:
                choose_item = True
                while choose_item:
                    itm_choice = player.choose_item()
                    item_choice = itm_choice -1
                    item = player.items[item_choice]["item"]

                    if player.items[item_choice]["quantity"] == 0:
                        print(bcolors.FAIL + "\nThere are no more " + str(item.name) +"s left. Please choose a different item. Type 0 to go back." + bcolors.ENDC)
                        continue
                    else:
                        break

                if item_choice == -1:
                    start = True
                    continue

                player.items[item_choice]["quantity"] -= 1

                if item.type == "potion":
                    player.heal(item.prop)
                    print(bcolors.OKGREEN + "\n" + item.name + " heals", player.name, "for", str(item.prop), "HP." + bcolors.ENDC)
                    if player.hp > player.maxhp:
                       player.hp = player.maxhp

                elif item.type == "elixer":
                    if item.name == "MegaElixer":
                        print("\n" + player.name.replace(" ", ""), "uses", item.name)
                        print(bcolors.OKGREEN + "HP and MP fully restored to all party members!" + bcolors.ENDC)
                        for i in players:
                            i.hp = i.maxhp
                            i.mp = i.maxmp
                    else:
                        player.hp = player.maxhp
                        player.mp = player.maxmp
                        print(player.name.replace(" ", ""), "uses", item.name)
                        print(bcolors.OKGREEN + player.name.replace(" ", "") + " HP and MP fully restored!" + bcolors.ENDC)

                elif item.type == "attack":
                    enemy = player.choose_target(enemies)
                    enemies[enemy].take_damage(item.prop)
                    print(bcolors.FAIL + "\n" + item.name + " deals", str(item.prop), "points of damage to " +  enemies[enemy].name.replace(" ", "") + bcolors.ENDC)

                    if enemies[enemy].get_hp() == 0:
                        print(bcolors.BOLD + bcolors.FAIL + enemies[enemy].name.replace(" ", "") + " HAS FALLEN!" + bcolors.ENDC)
                        del enemies[enemy]
                        defeated_enemies += 1
        else:
            continue

    #enemy attack phase
    for enemy in enemies:
        # check if enemies won
        if defeated_players == 3:
            print(bcolors.BOLD + bcolors.FAIL + "\nYou are DIED!\nGame Over" + bcolors.ENDC)
            running = False
            break

        enemy_choice = random.randrange(0,2)

        if enemy_choice == 0:
            #chose to attack
            target = random.randrange(0, len(players))
            enemy_dmg = enemy.generate_damage()

            players[target].take_damage(enemy_dmg)
            print("")
            print(enemy.name.replace(" ", "") + " attacks " + players[target].name.replace(" ", "") + " for " + str(enemy_dmg) + " points of damage.")

            if players[target].get_hp() == 0:
                print("")
                print(bcolors.BOLD + bcolors.FAIL + players[target].name.replace(" ", "") + " HAS FALLEN!" + bcolors.ENDC)
                del players[target]
                defeated_players += 1

        elif enemy_choice == 1:
            spell, magic_dmg = enemy.choose_enemy_spell()
            enemy.reduce_mp(spell.cost)

            if spell.type == "black":
                target = random.randrange(0, len(players))
                players[target].take_damage(magic_dmg)
                print("")
                print(enemy.name.replace(" ", "") + " cast", spell.name, "on", players[target].name.replace(" ", ""), "for", magic_dmg, "points of damage.")

                if players[target].get_hp() == 0:
                    print(bcolors.BOLD + bcolors.FAIL + players[target].name.replace(" ", "") + " HAS FALLEN!" + bcolors.ENDC)
                    del players[target]
                    defeated_players += 1

            elif spell.type == "white":
                enemy.heal(magic_dmg)
                print("")
                print(enemy.name.replace(" ", "") + " cast", spell.name, ". Restores", magic_dmg, "of HP.")