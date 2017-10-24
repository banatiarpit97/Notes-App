$(function(){
    var activenote = 0;
    var editmode = false;

	$.ajax({
		url:"loadnotes.php",
		success:function(data){
            $("#notes").html(data);
            clickNote();
            clickDelete();
		},
		error: function(){
			$('.alertContent').text("There was an issue with the Ajax call");
		}
	});

	$("#addnote").click(function(){
		console.log("hh")
		$.ajax({
			url:"createnotes.php",
			success:function(data){
				if(data=='error'){
					$('.alertContent').text("There was an issue inserting the new note in db");
					$("#alert").fadeIn();
				}
				else{
					activenote = data;
					$("textarea").val("");
					showhide(["#notepad", "#allnotes"], ["#notes", "#addnote", "#edit", "#done"]);
					$("textarea").focus();
				}
			},
			error: function(){
			   $('.alertContent').text("There was an issue with the Ajax call");
		    }
		});
	});

	$("#allnotes").click(function(){
	  $.ajax({
		url:"loadnotes.php",
		success:function(data){
            $("#notes").html(data);
			showhide(["#notes", "#addnote", "#edit"], ["#notepad", "#allnotes"]);
			clickNote();
			clickDelete();

		},
		error: function(){
			$('.alertContent').text("There was an issue with the Ajax call");
		}
	  });
	})

	function showhide(array1, array2){
       for(i=0;i<array1.length;i++){
       	$(array1[i]).show();
       }
        for(i=0;i<array2.length;i++){
       	$(array2[i]).hide();
       }
	}

	$("textarea").keyup(function(){
		$.ajax({
			url:"updatenotes.php",
			type:"POST",
			data:{note:$(this).val(), id:activenote},
			success:function(data){
               if(data=='error'){
			      $('.alertContent').text("There was an issue updating the note in db");
               }
			},
		    error: function(){
			    $('.alertContent').text("There was an issue with the Ajax call");
		    }
		})
	})

	$("#edit").click(function(){
		editmode=true;
		$(".noteheader").addClass("col-xs-7 col-sm-9");
		showhide(["#done", ".delete"], [this]);
	});

	$("#done").click(function(){
		editmode=false;
		$(".noteheader").removeClass("col-xs-7 col-sm-9");
		showhide(["#edit"], [this, ".delete"]);

	})

	function clickNote(){

		$(".noteheader").click(function(){
			if(!editmode){
				activenote = $(this).attr("id");
				$("textarea").val($(this).find(".text").text());
				showhide(["#notepad", "#allnotes"], ["#notes", "#addnote", "#edit"]);
				$("textarea").focus();
			}
		})
    }

    function clickDelete(){
    	$(".delete").click(function(){
    		var deletebutton = $(this);
    		var cl = "."+deletebutton.next().attr("id");
    		console.log(cl)
    		console.log(deletebutton.next().parent().html());
    		$.ajax({
				url:"deletenotes.php",
				type:"POST",
				data:{id:deletebutton.next().attr("id")},
				success:function(data){
	               if(data=='error'){
				      $('.alertContent').text("There was an issue deleting the note from db");
	               }
	               else{
	               	// console.log($(cl))
	               	//  $(cl).remove();
	               	$("#notes").html("")
	               		$.ajax({
							url:"loadnotes.php",
							success:function(data){
					            $("#notes").html(data);
								$(".noteheader").addClass("col-xs-7 col-sm-9");
					            $(".delete").show();
								$(".delete").css("display", "block")
								clickDelete();
							},
							error: function(){
								$('.alertContent').text("There was an issue with the Ajax call");
							}
	                    });
								// showhide(["#done", ".delete"],[]);
	               	   // deletebutton.parent().remove();
	               }
				},
			    error: function(){
				    $('.alertContent').text("There was an issue with the Ajax call");
			    }
		    })
    	})
    }
});