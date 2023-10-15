(function ($) {
  $(document).on("click", ".add_math", function (event) {
    event.preventDefault();
    const element = document.getElementById("symbol");
    if (element) {
      MathJax.typesetPromise([element]);
    }
    // $('#math-editor-modal').modal('show');
  });

  $(document).on("click", "#insert_math", function (e) {
    var editor_textarea = $("#math-editor-textarea");
    $("textarea#comment")
      .val(function (i, text) {
        return text + "\\( " + editor_textarea.val() + " \\)";
      })
      .focus();
    editor_textarea.val("");
    $("#math-equation-preview").text("");
    $("#math-editor-modal").modal("hide");
  });

  // Handle click event for symbol type options
  $(document).on("click", ".symbols-type", function () {
    $(".symbols-type-options").hide();
    $(".symbols-type").removeClass("symbols-in-view");
    $(this).addClass("symbols-in-view");
    $("#" + $(this).attr("data-id")).show();
  });

  // Handle click event for individual symbol buttons
  $(document).on("click", ".symbol", function () {
    var mathtex = $(this).attr("data-tex");
    $("#math-editor-textarea")
      .val(function (i, text) {
        return text + mathtex;
      })
      .focus();
    preview_math();
  });

  // Preview math after some time has been allowed for the user to finish typing
  var timer = null;
  $(document).on("keydown", "#math-editor-textarea", function () {
    clearTimeout(timer);
    timer = setTimeout(preview_math, 1000);
  });

  // Function to add math to preview div and add to MathJax queue for typesetting
  function preview_math() {
    $("#math-equation-preview").text(
      "\\(" + $("#math-editor-textarea").val() + "\\)"
    );
    const element = document.getElementById("math-equation-preview");
    if (element) {
      MathJax.typesetPromise([element]);
    }
  }

  // Preview math on paste
  $(document).on("paste", "#math-editor-textarea", function () {
    preview_math();
  });
})(jQuery);
