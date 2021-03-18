function toggleForm(objetSelect, formSelect) {

        // Disable display for the old form selected
    closeForm();

        // Enable display for form selected
    sessionStorage.setItem('formOpen', formSelect);
    document.getElementById(formSelect).style.display = "block";
    
        // Calcul position for form selected
    var objetSelectDiv = document.getElementById(objetSelect);


    var rect = objetSelectDiv.getBoundingClientRect();
    objetLeft = rect.left;
    objetTop = rect.top;
    objetWidth = rect.width;
    objetHeight = rect.height;

    if(objetLeft >= (document.body.offsetWidth / 2)){
        var leftPosition = objetLeft - 10 - document.getElementById(formSelect).offsetWidth +"px";
    }
    else{
        var leftPosition = 10 + objetWidth + objetLeft +"px";
    }
    
    var topPosition = objetTop - 10 +"px";
    if((objetTop - 10 + document.getElementById(formSelect).offsetHeight) >= (window.innerHeight)){
        topPosition = window.innerHeight - document.getElementById(formSelect).offsetHeight - 10 + "px";
    }
    else if((objetTop - objetHeight) <= (0)){
        topPosition = "10px";
    }

        // Apply position for form selected
    document.getElementById(formSelect).style.left = leftPosition;
    document.getElementById(formSelect).style.top = topPosition;

        // Select and display information objet on the form editing (Selected)
    if(formSelect == "formObjetEditing"){
        if(document.getElementById("table_"+objetSelect)){
            originDiv = $(document.getElementById("table_"+objetSelect))[0].children[0].children;
            no_plan = $(originDiv[0])[0].children[0].innerHTML;
            code_art = $(originDiv[1])[0].children[0].innerHTML;
            no_etude = $(originDiv[2])[0].children[0].innerHTML;
            revision = $(originDiv[3])[0].children[0].innerHTML;
            designation = $(originDiv[4])[0].children[0].innerHTML;
            type_obj = $(originDiv[5])[0].children[0].attributes[1].value;
            obj_img = $(originDiv[6])[0].innerHTML;

            if(type_obj === null || type_obj === ""){
                type_obj = 0;
            }
            
            $("#update_article_id").val(objetSelect);
            $("#update_article_no_plan").val(no_plan);
            $("#update_article_no_etude").val(no_etude);
            $("#update_article_revision").val(revision);
            $("#update_article_code_art").val(code_art);
            $("#update_article_designation").val(designation);
            $("#update_article_type_art").val(type_obj);
            $("#update_article_image").val(obj_img);
        }
        else{
            $("#update_article_id").val("");
            $("#update_article_no_plan").val("");
            $("#update_article_no_etude").val("");
            $("#update_article_revision").val("");
            $("#update_article_code_art").val("");
            $("#update_article_designation").val("");
            $("#update_article_type_art").val("");
            $("#update_article_image").val("");
        }
        
    }

    if(formSelect == "formObjetDuplicate"){
        if(document.getElementById("table_"+objetSelect)){
            originDiv = $(document.getElementById("table_"+objetSelect))[0].children[0].children;
            no_plan = $(originDiv[0])[0].children[0].innerHTML;
            $("#no_plan_duplicate_article_selected").val(no_plan);
        }
        else{
            $("#update_article_id").val("");
        }
        
    }

    
    
        
};
    // Function to close form
function closeForm() {
    if(sessionStorage.getItem('formOpen')){
        var objetOpen = sessionStorage.getItem('formOpen');
        document.getElementById(objetOpen).style.display = "none";
        sessionStorage.removeItem(objetOpen);
    }
}

function toggleFormNotFocus(pointerLeft, pointerTop, formSelect) {

        // Disable display for the old form selected
    closeForm();

        // Enable display for form selected
    sessionStorage.setItem('formOpen', formSelect);
    document.getElementById(formSelect).style.display = "block";
    
        // Calcul position for form selected
    if(pointerLeft >= (document.body.offsetWidth / 2)){
        var leftPosition = pointerLeft - 10 - document.getElementById(formSelect).offsetWidth +"px";
    }
    else{
        var leftPosition = 10 + pointerLeft +"px";
    }
    
    var topPosition = pointerTop - 100 +"px";
    if((pointerTop + document.getElementById(formSelect).offsetHeight - 100) >= (window.innerHeight)){
        topPosition = window.innerHeight - document.getElementById(formSelect).offsetHeight - 10 + "px";
    }
    else if((pointerTop - 100) <= (0)){
        topPosition = "10px";
    }

        // Apply position for form selected
    document.getElementById(formSelect).style.left = leftPosition;
    document.getElementById(formSelect).style.top = topPosition;        
};