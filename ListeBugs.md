# Tests / Bugs

## 1) Affichage Erreur : Corrig�
* L'affichage de l'image ne s'effectu pas lors de l'affichage du profil

## 2) Est�tique / Bouton : Non Corrig�
* Lors du changement de la photo, le bouton de valitation � un mauvais titre.
* Actuellement : "profile.edit.submit"

## 3) Lien voir Profil : Non Corrig�
* Lorsque l'on est sur la page de profil, le lien "voir mon profil" est toujours pr�sent

## 4) Passe temps / BdD : Non Corrig�
* Lors de la supression d'un passe temps, il est toujours pr�sent dans la base de donn�es
* C'est peut �tre normal, mais � force la BdD peut devenir �nnorme en donn�es inutiles
* Les hobbys supprim�s sont sous un user_id = null

## 5) Est�tique / Texte : Non Corrig�
* Juste sous le bouton "Cr�er un compte" se trouve un petit texte avec marqu� "Hobbys"
* Il est inutile ou au mauvais endroit

## 6) Supression Compte / bloquant ? : Non Corrig�
* Lors de la supression d'un compte, une erreur et une page symphony s'affiche (probl�me de route)
* Le compte est n�anmoins suprim�

## 7) Mauvaise liaison (Erreur suivant le 6) : Non Corrig�
* Apr�s le bug du 6) si l'on fait un retour, on se retrouve sur la page de supression du profil (sens� �tre suprim�)
* Notons qu'il n'est plus dans la BdD

## 8) Mauvaise liaison (Erreur suivant le 6 et 7) : Non Corrig�
* Apr�s l'affichage de la page de validation de supression, lors d'un clic sur "retour au profil" on est renvoy� sur l'acceuil

## 9) Est�tique (Erreur suivant 7 et 8) : Non Corrig�
* Lorsque l'on va sur la page "Register" (depuis l'acceuil) la mention "Votre profil a �t� supprim�" est affich�
* Que dans le cas suivant l'�tape d'erreur 6, 7 puis 8

## 10) Probl�me de liaison (Erreur suivant  7, 8 et 9) : Non Corrig�
* Lors d'un connexion avec un compte d�j� existant on arrive directement sur la page de confirmation de suppression du compte
* Ne se fait r�alise qu'� la premi�re connexion suivant les erreurs pr�c�dente, surement sur au bug num�ro 6.

## 11) Connexion / Register : Non Corrig�
* Lors d'une connexion sur la page register, si l'on utilise de mauvais identifiants on est renvoy� sur l'acceuil
* il est pr�f�rable d'actualiser / mettre un message d'erreur ? sans retourner � l'acceuil.

## 12) [...]