import random
import hashlib
from setup import *


def saveAccount(account):

    with open("./comptes.csv", "a") as fichier:
        fichier.write(account)


nb_comptes = 150

m_hash = hashlib.sha256()

for nb in range(nb_comptes):
    prenom = random.choice(PRENOMS)
    nom = random.choice(NOMS)
    filiere = random.choice(FILIERES)
    groupe = random.choice(GROUPES[filiere])


    mail = (prenom + "." + nom + "@gmail.com").lower()

    mdp = (nom[0] + prenom).lower().encode()
    m_hash.update(mdp)

    compte = "{};{};{};{};{};{};{}\n".format(nom, prenom, mail, filiere, groupe, m_hash.hexdigest(),
                                                   DIR_PP)
    saveAccount(compte)
