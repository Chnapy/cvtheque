# Tests / Bugs

## 1) Affichage Erreur : Corrigé
* L'affichage de l'image ne s'effectu pas lors de l'affichage du profil

## 2) Estétique / Bouton : Non Corrigé
* Lors du changement de la photo, le bouton de valitation à un mauvais titre.
* Actuellement : "profile.edit.submit"

## 3) Lien voir Profil : Non Corrigé
* Lorsque l'on est sur la page de profil, le lien "voir mon profil" est toujours présent

## 4) Passe temps / BdD : Non Corrigé
* Lors de la supression d'un passe temps, il est toujours présent dans la base de données
* C'est peut être normal, mais à force la BdD peut devenir énnorme en données inutiles
* Les hobbys supprimés sont sous un user_id = null

## 5) Estétique / Texte : Non Corrigé
* Juste sous le bouton "Créer un compte" se trouve un petit texte avec marqué "Hobbys"
* Il est inutile ou au mauvais endroit

## 6) Supression Compte / bloquant ? : Non Corrigé
* Lors de la supression d'un compte, une erreur et une page symphony s'affiche (problème de route)
* Le compte est néanmoins suprimé

## 7) Mauvaise liaison (Erreur suivant le 6) : Non Corrigé
* Après le bug du 6) si l'on fait un retour, on se retrouve sur la page de supression du profil (sensé être suprimé)
* Notons qu'il n'est plus dans la BdD

## 8) Mauvaise liaison (Erreur suivant le 6 et 7) : Non Corrigé
* Après l'affichage de la page de validation de supression, lors d'un clic sur "retour au profil" on est renvoyé sur l'acceuil

## 9) Estétique (Erreur suivant 7 et 8) : Non Corrigé
* Lorsque l'on va sur la page "Register" (depuis l'acceuil) la mention "Votre profil a été supprimé" est affiché
* Que dans le cas suivant l'étape d'erreur 6, 7 puis 8

## 10) Problème de liaison (Erreur suivant  7, 8 et 9) : Non Corrigé
* Lors d'un connexion avec un compte déjà existant on arrive directement sur la page de confirmation de suppression du compte
* Ne se fait réalise qu'à la première connexion suivant les erreurs précédente, surement sur au bug numéro 6.

## 11) Connexion / Register : Non Corrigé
* Lors d'une connexion sur la page register, si l'on utilise de mauvais identifiants on est renvoyé sur l'acceuil
* il est préférable d'actualiser / mettre un message d'erreur ? sans retourner à l'acceuil.

## 12) [...]