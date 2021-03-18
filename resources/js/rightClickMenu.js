(function() {
  
    "use strict";
  
    //////////////////////////////////////////////////////////////////////////////
    //////////////////////////////////////////////////////////////////////////////
    //
    // H E L P E R    F U N C T I O N S
    //
    //////////////////////////////////////////////////////////////////////////////
    //////////////////////////////////////////////////////////////////////////////
  
    /**
     * Function to check if we clicked inside an element with a particular class
     * name.
     * 
     * @param {Object} e The event
     * @param {String} className The class name to check against
     * @return {Boolean}
     */
    function clickInsideElement( e, className ) {
      var el = e.srcElement || e.target;
      
      if ( el.classList.contains(className) ) {
        return el;
      } else {
        while ( el = el.parentNode ) {
          if ( el.classList && el.classList.contains(className) ) {
            return el;
          }
        }
      }
  
      return false;
    }
  
    /**
     * Get's exact position of event.
     * 
     * @param {Object} e The event passed in
     * @return {Object} Returns the x and y position
     */
    function getPosition(e) {
      var posx = 0;
      var posy = 0;
  
      if (!e) var e = window.event;
      
      if (e.pageX || e.pageY) {
        posx = e.pageX;
        posy = e.pageY;
      } else if (e.clientX || e.clientY) {
        posx = e.clientX + document.body.scrollLeft + document.documentElement.scrollLeft;
        posy = e.clientY + document.body.scrollTop + document.documentElement.scrollTop;
      }
  
      return {
        x: posx,
        y: posy
      }
    }
  
    //////////////////////////////////////////////////////////////////////////////
    //////////////////////////////////////////////////////////////////////////////
    //
    // C O R E    F U N C T I O N S
    //
    //////////////////////////////////////////////////////////////////////////////
    //////////////////////////////////////////////////////////////////////////////
    
    /**
     * Variables.
     */
    var contextMenuLinkClassName = "context-menu__link";
    var contextMenuActive = "context-menu--active";
  
    var taskItemClassName = "click";
    var taskItemInContext;
  
    var clickCoords;
    var clickCoordsX;
    var clickCoordsY;

    var menu = null;

    var menuState = 0;
    var menuWidth;
    var menuHeight;
  
    var windowWidth;
    var windowHeight;

  
    /**
     * Initialise our application's code.
     */
    function init() {
      contextListener();
      clickListener();
      resizeListener();
    }
  
    /**
     * Listens for contextmenu events.
     */
    function contextListener() {
      document.addEventListener( "contextmenu", function(e) {
        taskItemInContext = clickInsideElement( e, taskItemClassName );

        toggleMenuOff();

        if(taskItemInContext){
          var selectTaskItemContextId = taskItemInContext.getAttribute("id");
          var selectTaskItemContextClass = taskItemInContext.getAttribute("class");
          var selectTaskItemContextDataID = taskItemInContext.getAttribute("data-id");

          if(selectTaskItemContextClass.includes("objet")){
              menu = document.querySelector("#context-menu-edit");
          }
          else if(selectTaskItemContextClass.includes("line")){
              if(selectTaskItemContextDataID == 1 || selectTaskItemContextDataID == 0 || selectTaskItemContextId.includes("label_")){
                  menu = document.querySelector("#context-menu-link-edit");
              }
              else{
                  menu = document.querySelector("#context-menu-link-add");
              }

          }
          else if(selectTaskItemContextId.includes("map")){
              menu = document.querySelector("#context-menu-create");
          }

        
          if ( taskItemInContext ) {
            e.preventDefault();
            toggleMenuOn();
            positionMenu(e);
          } else {
            taskItemInContext = null;
            toggleMenuOff();
          }
        }
        
      });
    }
  
    /**
     * Listens for click events.
     */
    function clickListener() {
      document.addEventListener( "click", function(e) {
        var clickeElIsLink = clickInsideElement( e, contextMenuLinkClassName );
  
        if ( clickeElIsLink ) {
          e.preventDefault();
          menuItemListener( clickeElIsLink );
        } else {
          var button = e.which || e.button;
          if ( button === 1 ) {
            toggleMenuOff();
          }
        }
      });
    }
  
    /**
     * Window resize event listener
     */
    function resizeListener() {
      window.onresize = function(e) {
        toggleMenuOff();
      };
    }
  
    /**
     * Turns the custom context menu on.
     */
    function toggleMenuOn() {
      if ( menuState !== 1 ) {
        menuState = 1;
        menu.classList.add( contextMenuActive );
      }
    }
  
    /**
     * Turns the custom context menu off.
     */
    function toggleMenuOff() {
      if ( menuState !== 0 ) {
        menuState = 0;
        document.querySelector("#context-menu-edit").classList.remove( contextMenuActive );
        document.querySelector("#context-menu-create").classList.remove( contextMenuActive );
        document.querySelector("#context-menu-link-add").classList.remove( contextMenuActive );
        document.querySelector("#context-menu-link-edit").classList.remove( contextMenuActive );
      }
    }
  
    /**
     * Positions the menu properly.
     * 
     * @param {Object} e The event
     */
    function positionMenu(e) {
      clickCoords = getPosition(e);
      clickCoordsX = clickCoords.x;
      clickCoordsY = clickCoords.y;
  
      menuWidth = menu.offsetWidth + 4;
      menuHeight = menu.offsetHeight + 4;
  
      windowWidth = window.innerWidth;
      windowHeight = window.innerHeight;
  
      if ( (windowWidth - clickCoordsX) < menuWidth ) {
        menu.style.left = windowWidth - menuWidth + "px";
      } else {
        menu.style.left = clickCoordsX + "px";
      }
  
      if ( (windowHeight - clickCoordsY) < menuHeight ) {
        menu.style.top = windowHeight - menuHeight + "px";
      } else {
        menu.style.top = clickCoordsY + "px";
      }
    }
  
    /**
     * Dummy action function that logs an action when a menu item link is clicked
     * 
     * @param {HTMLElement} link The link that was clicked
     */
    function menuItemListener( link ) {
      //console.log( "Task ID - " + taskItemInContext.getAttribute("id") + ", Task action - " + link.getAttribute("data-action"));
      
      var dataAction = link.getAttribute("data-action");

      switch(dataAction){
          case "add_Objet" :
            toggleFormNotFocus(clickCoordsX, clickCoordsY, "formObjetAdd");
            break;
          case "add_Link" :
            addEditeur('newLink', 'newObject');
            break;
          case "edit_Objet" :
            //toggleFormNotFocus(clickCoordsX, clickCoordsY, "formObjetEditing");
            toggleForm(taskItemInContext.getAttribute("id"), "formObjetEditing");
            break;
          case "duplicate_Objet" :
            //toggleFormNotFocus(clickCoordsX, clickCoordsY, "formObjetDuplicate");
            toggleForm(taskItemInContext.getAttribute("id"), "formObjetDuplicate");
            break;
          case "delete_Objet" :
            alert("Voulez vous réelement supprimer cet objet");
            break;
          case "add_Raccordement" :
            toggleFormNotFocus(clickCoordsX, clickCoordsY, "formObjetAddRaccordement");
            break;
          case "select_Raccordement" :
            toggleFormNotFocus(clickCoordsX, clickCoordsY, "formObjetSelectRaccordement");
            break;
          case "edit_Raccordement" :
            toggleFormNotFocus(clickCoordsX, clickCoordsY, "formObjetEditRaccordement");
            break;
          case "delete_Raccordement" :
            alert("Voulez vous réelement supprimer ce lien");
            break;
      }
      toggleMenuOff();
    }
  
    /**
     * Run the app.
     */
    init();
  
  })();
