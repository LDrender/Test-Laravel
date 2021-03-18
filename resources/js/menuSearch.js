

function addMenuSearch( visibleMenuSearch, buttonMenu) {
  var addVisibleMenuSearch = document.getElementById(visibleMenuSearch)
  var modButtonMenu = document.getElementById(buttonMenu)

  if(modButtonMenu.classList.contains('fa-caret-square-down')){
    addVisibleMenuSearch.classList.add('active')
    modButtonMenu.classList.replace('fa-caret-square-down', 'fa-caret-square-up')
  }
  else{
    addVisibleMenuSearch.classList.remove('active')
    modButtonMenu.classList.replace('fa-caret-square-up', 'fa-caret-square-down')
  }
  
}

function addMenuFilter() {
  var addVisibleMenuFilter = document.getElementById("menuFilter")
  var iconButtonFilter = document.getElementById("developFilterMenuIcon")
  var modButtonMenuFilter = document.getElementById("buttonFilter")

  if(iconButtonFilter.classList.contains('fa-caret-right')){
    addVisibleMenuFilter.classList.add('active')
    modButtonMenuFilter.classList.add('active')
    iconButtonFilter.classList.replace('fa-caret-right', 'fa-caret-left')
  }
  else{
    addVisibleMenuFilter.classList.remove('active')
    modButtonMenuFilter.classList.remove('active')
    iconButtonFilter.classList.replace('fa-caret-left', 'fa-caret-right')
    getFilterGraph()
  }
  
}

function closeMenuFilter() {
  var addVisibleMenuFilter = document.getElementById("menuFilter")
  var iconButtonFilter = document.getElementById("developFilterMenuIcon")
  var modButtonMenuFilter = document.getElementById("buttonFilter")

  if(!iconButtonFilter.classList.contains('fa-caret-right')){
    addVisibleMenuFilter.classList.remove('active')
    modButtonMenuFilter.classList.remove('active')
    iconButtonFilter.classList.replace('fa-caret-left', 'fa-caret-right')
    getFilterGraph()
  }
  
}