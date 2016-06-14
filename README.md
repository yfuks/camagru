# camagru


### Partie utilisateur

- L’application doit permettre à un utilisateur de s’inscrire, en demandant au minimum
une adresse email, un nom d’utilisateur et un mot de passe un tant soit peu
sécurisé. La fin de l’inscription doit être complétée avec un mail de confirmation.
- L’utilisateur doit ensuite être capable de se connecter avec son nom d’utilisateur
et son mot de passe. Il doit également pouvoir recevoir un mail de réinitialisation
de son mot de passe en cas d’oubli.
- L’utilisateur doit pouvoir se déconnecter en un seul clic depuis n’importe quelle
page du site.

### Partie montage

Cette partie ne doit être accessible qu’aux utilisateurs connectés, et rejeter poliment
l’internaute 1 dans le cas contraire.

Cette page devra etre composée de deux sections :

- Une section principale, contenant l’apercu de votre webcam, la liste des images
superposables disponibles et un bouton permettant de prendre la photo.
- Une section latérale, affichant les miniatures de toutes les photos prises précedemment.


- Les images superposables doivent être sélectionnables, et le bouton permettant de
prendre la photo ne doit pas être cliquable tant qu’aucune image n’est sélectionnée.
- Le traitement de l’image finale (donc entre autres la superposition des deux images)
doit être fait coté serveur, en PHP.
- Parce que tout le monde n’a pas de webcam, vous devez laisser la possibilité
d’uploader une image au lieu de la prendre depuis la caméra.
- L’utilisateur doit pouvoir supprimer ses montages, et uniquement les siens.

### Partie galerie

- Cette partie doit afficher l’intégralité des images prises par les membres du site,
triées par date de création, et doit pouvoir permettre à l’utilisateur de les commenter
et de les liker.
- Lorsque une image reçoit un nouveau commentaire, l’auteur de cette image doit
en être informé par mail.
- La liste des images doit être paginée.

### Partie bonus

 Si la partie obligatoire a été réalisée entièrement et parfaitement, vous pouvez ajouter
les bonus que vous souhaitez ; ils seront évalués à la discrétion de vos correcteurs. Vous
devez néanmoins toujours respecter les contraintes de base. Par exemple, le traitement
de l’image doit impérativement se faire côté serveur.
Si vous l’inspiration vous manque, voiçi quelques pistes :
- Faire un aperçu du rendu final en live, directement sur l’aperçu de la caméra. On
notera que c’est bien plus simple qu’il n’y paraît.
- “AJAXifier” les échanges avec le serveur.
- Faire une pagination infinie sur la partie galerie.
- Pouvoir partager ses images sur les réseaux sociaux.
- Pouvoir faire un rendu d’un GIF animé.
