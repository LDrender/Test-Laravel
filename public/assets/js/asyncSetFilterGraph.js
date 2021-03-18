function getFilterGraph() {

	var form=$('#display_article_filter');
  
  $.ajax({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      
    type: "POST",
    url: "./api/filterGraph",
    data: form.serialize(),
    dataType: "json",
    success: function(data) {
        if(data.success) {
            console.log(data.description)
        } else {
            console.log(data.description)
        }
    }
  });
        

};