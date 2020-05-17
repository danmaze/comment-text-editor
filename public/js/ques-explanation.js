(function($) {
    $(function() {
        $("form.comment-form").each(function() {
            $(this).removeAttr("id");
        });

        $(".post_explanation, .report_error").click(function() {
            $(".current_expform .comment-form").removeAttr("id");
            $(".current_expform").hide();
            $(".current_expform").removeClass("current_expform");
            var current_explanation = $("#" + $(this).attr("data-form"));
            current_explanation.addClass("current_expform");
            $(".current_expform .comment-form").attr("id", "commentform");
            $(".comment-respond").removeAttr("id");
            $(".current_expform .comment-respond").attr("id", "respond");
            $(".comment-form textarea").removeAttr("id");
            $(".current_expform .comment-form textarea").attr("id", "comment");
            $(".comment-form input[name=submit]").removeAttr("id");
            $(".current_expform .comment-form input[name=submit]").attr("id", "ns-submit-comments");
            current_explanation.show();
        });

        $(".show_answer").click(function() {
            $(this).hide();
            $("#" + $(this).attr("data-ques") + " .hide_answer").show();
            // $("#" + $(this).attr("data-ques") + " .nscbt-mark").addClass("highlight_ans", 1000, "easeOutBounce");
            $("#" + $(this).attr("data-ques") + " .nscbt-mark").show("slow");
            $("#" + $(this).attr("data-ques") + " .q_explanation").show("fast");
        });

        $(".hide_answer").click(function() {
            $(this).hide();
            $("#" + $(this).attr("data-ques") + " .show_answer").show();
            // $("#" + $(this).attr("data-ques") + " .nscbt-mark").removeClass("highlight_ans", 1000, "easeOutBounce");
            $("#" + $(this).attr("data-ques") + " .nscbt-mark").hide("slow");
            $("#" + $(this).attr("data-ques") + " .q_explanation").hide("fast");
        });
    });
})(jQuery);