(function ($) {
  /* function clearEditors(){
		for( var i = 0; i < tinymce.editors.length; i++ ){
			tinymce.editors[i].setContent("");
			$("[name='" + tinymce.editors[i].targetElm.name + "']").val("");
		}
	} */

  /*
   * Let's begin with validation functions
   */
  $.extend($.fn, {
    /*
     * check if field value lenth more than 3 symbols ( for name and comment )
     */
    validate: function () {
      $(".help-block").remove();
      if ($(this).val().length < 3) {
        $(".ns-comment").addClass("has-error");
        $(".ns-comment").append(
          '<span id="comment-help-block" class="help-block" style="font-size:75%">Please fill in the required fields.</span>'
        );
        return false;
      } else {
        $(".ns-comment").removeClass("has-error");
        $("#comment-help-block").remove();
        return true;
      }
    },
    /*
     * check if email is correct
     * add to your CSS the styles of .error field, for example border-color:red;
     */
    validateEmail: function () {
      $(".help-block").remove();
      var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/,
        emailToValidate = $(this).val();
      if (!emailReg.test(emailToValidate) || emailToValidate == "") {
        $(".ns-comment").addClass("has-error");
        $(".ns-comment").append(
          '<span id="comment-help-block" class="help-block" style="font-size:75%">Please fill in the required fields.</span>'
        );
        return false;
      } else {
        $(".ns-comment").removeClass("has-error");
        $("#comment-help-block").remove();
        return true;
      }
    },
  });

  $(document).on("submit", "#commentform", function (event) {
    event.preventDefault();

    // define some vars
    var button = $("#ns-submit-comments"), // submit button
      respond = $("#respond"), // comment form container
      commentlist = $(".comment-list"), // comment list container
      cancelreplylink = $("#cancel-comment-reply-link");

    // if user is logged in, do not validate author and email fields
    if ($("#author").length) $("#author").validate();

    if ($("#email").length) $("#email").validateEmail();

    // validate comment in any case
    $("#comment").validate();

    // if comment form isn't in process, submit it
    if (
      !button.hasClass("loadingform") &&
      !$(".ns-comment").hasClass("has-error")
    ) {
      // ajax request
      $.ajax({
        type: "POST",
        url: ajax_comment_params.ajaxurl, // admin-ajax.php URL
        data: $(this).serialize() + "&action=ajaxcomments", // send form data + action parameter
        beforeSend: function (xhr) {
          // what to do just after the form has been submitted
          button.addClass("loadingform").val("Posting...");
        },
        error: function (request, status, error) {
          if (status == 500) {
            $(".ns-comment").append(
              '<span id="comment-help-block" class="help-block" style="font-size:75%">There was an error while posting the comment.</span>'
            );
          } else if (status == "timeout") {
            $(".ns-comment").append(
              '<span id="comment-help-block" class="help-block" style="font-size:75%">Connection error! The server did not respond.</span>'
            );
          } else {
            // process WordPress errors
            var wpErrorHtml = request.responseText.split("<p>"),
              wpErrorStr = wpErrorHtml[1].split("</p>");
            $(".ns-comment").append(
              '<span id="comment-help-block" class="help-block" style="font-size:75%">' +
                wpErrorStr[0] +
                "</span>"
            );
          }
        },
        success: function (addedCommentHTML) {
          // if this post already has comments
          if (commentlist.length > 0) {
            // if in reply to another comment
            if (respond.parent().hasClass("comment")) {
              // if the other replies exist
              if (respond.parent().children(".children").length) {
                respond.parent().children(".children").append(addedCommentHTML);
              } else {
                // if no replies, add <ol class="children">
                addedCommentHTML =
                  '<ul class="children">' + addedCommentHTML + "</ul>";
                respond.parent().append(addedCommentHTML);
              }
              // close respond form
              cancelreplylink.trigger("click");
            } else {
              // simple comment
              commentlist.append(addedCommentHTML);
            }
          } else {
            // if no comments yet
            addedCommentHTML =
              '<ul class="ns-commentlist">' + addedCommentHTML + "</ul>";
            respond.after($(addedCommentHTML));
          }
          // clear textarea field
          $("#comment").val("");
          // clearEditors();

          // Start math typesetting
          if ($(".add_math").length)
            document.addEventListener("DOMContentLoaded", function () {
              const element = document.getElementById("ns-comment-text");
              if (element) {
                MathJax.typesetPromise([element]);
              }
            });
        },
        complete: function () {
          // what to do after a comment has been added
          button.removeClass("loadingform").val("Post Comment");
        },
      });
    }

    return false;
  });
})(jQuery);
