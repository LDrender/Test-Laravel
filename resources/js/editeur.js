function addEditeur( visibleEditeur, hiddenEditeur_1) {
	var addVisibleEditeur = document.getElementById(visibleEditeur)
	var removeHiddenEditeur_1 = document.getElementById(hiddenEditeur_1)
	

	if(addVisibleEditeur.classList.contains('active')){
		addVisibleEditeur.classList.remove('active')

		sessionStorage.removeItem('visibleEditeur')
		sessionStorage.removeItem('hiddenEditeur_1')
	  }
	  else{
		addVisibleEditeur.classList.add('active')
		removeHiddenEditeur_1.classList.remove('active')

		sessionStorage.setItem('visibleEditeur', visibleEditeur)
		sessionStorage.setItem('hiddenEditeur_1', removeHiddenEditeur_1)
	  }
	
}


function removeEditeur(removeEditeur) {
	var editeur = document.getElementById(removeEditeur)
	editeur.classList.remove('active')

	sessionStorage.removeItem('visibleEditeur')
	sessionStorage.removeItem('hiddenEditeur_1')
}