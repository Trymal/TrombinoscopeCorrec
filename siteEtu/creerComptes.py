import random
import hashlib
from setup import *
import time
from shutil import copy

def saveAccount(account):

    with open("./comptes.csv", "a") as fichier:
        fichier.write(account)

def uniqid(prefix = ''):
    return prefix + hex(int(time.time()))[2:10] + hex(int(time.time()*1000000) % 0x100000)[2:7]


nb_comptes = 150
m_hash = hashlib.sha256()

for k in range(nb_comptes):

    idunique = uniqid()

    prenom = random.choice(PRENOMS)
    nom = random.choice(NOMS)
    filiere = random.choice(FILIERES)
    groupe = random.choice(GROUPES[filiere])
    dateNais = str("%02d" % random.randint(1995,2003)) + "-" + str("%02d" % random.randint(1,12)) + "-" + str("%02d" % random.randint(1,30))

    mail = (prenom + "." + nom + "@gmail.com").lower()

    mdp = (nom[0] + prenom + idunique).lower().encode()
    m_hash.update(mdp)

    urlImg = "http://correc.alwaysdata.net/files/" + mail + ".png"

    compte = "{};{};{};{};{};{};{};{};{};\n".format(nom, prenom, mail, m_hash.hexdigest(), dateNais, filiere, groupe, idunique, urlImg)

    saveAccount(compte)
    copy('./photos/account.png',"./files/" + mail + ".png")