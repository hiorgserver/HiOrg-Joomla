

$(function() {
    $("#hiorgcal").find("tr.hiorgcal_class_entries_table").click(function() {
      
      
      element = $(this).next().children().children();
      
      //remove lower border when field is collapsed 
      if (element.is(":visible")) {
      element.parent().animate({ borderBottomWidth: "0px" });
      } else {
          element.parent().animate({ borderBottomWidth: "1px" });
      }
      
      element.slideToggle('slow');
      
      
});
    
    
    
});