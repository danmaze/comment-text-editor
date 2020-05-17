<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://nigerianscholars.com
 * @since      1.0.0
 *
 * @package    Comment_Text_Editor
 * @subpackage Comment_Text_Editor/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Comment_Text_Editor
 * @subpackage Comment_Text_Editor/public
 * @author     Your Name <ihenetudan@gmail.com>
 */
class Comment_Text_Editor_Public
{

    /**
     * The ID of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string    $plugin_name    The ID of this plugin.
     */
    private $plugin_name;

    /**
     * The version of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string    $version    The current version of this plugin.
     */
    private $version;

    /**
     * Initialize the class and set its properties.
     *
     * @since    1.0.0
     * @param      string    $plugin_name       The name of the plugin.
     * @param      string    $version    The version of this plugin.
     */
    public function __construct($plugin_name, $version)
    {

        $this->plugin_name = $plugin_name;
        $this->version = $version;

    }

    /**
     * Register the stylesheets for the public-facing side of the site.
     *
     * @since    1.0.0
     */
    public function enqueue_styles()
    {

        /**
         * This function is provided for demonstration purposes only.
         *
         * An instance of this class should be passed to the run() function
         * defined in Comment_Text_Editor_Loader as all of the hooks are defined
         * in that particular class.
         *
         * The Comment_Text_Editor_Loader will then create the relationship
         * between the defined hooks and the functions defined in this
         * class.
         */

        wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__) . 'css/comment-text-editor-public.css', array(), $this->version, 'all');

    }

    /**
     * Register the JavaScript for the public-facing side of the site.
     *
     * @since    1.0.0
     */
    public function enqueue_scripts()
    {

        /**
         * This function is provided for demonstration purposes only.
         *
         * An instance of this class should be passed to the run() function
         * defined in Comment_Text_Editor_Loader as all of the hooks are defined
         * in that particular class.
         *
         * The Comment_Text_Editor_Loader will then create the relationship
         * between the defined hooks and the functions defined in this
         * class.
         */

        // wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/comment-text-editor-public.js', array( 'jquery' ), $this->version, false );

        // Add the JavaScript for the Math Editor
        if (is_tax(array('ns_subjects')) || is_singular(array('tutorials', 'questions')) || is_page_template('cbt-practice.php')) {
            wp_enqueue_script('math-editor', plugin_dir_url(__FILE__) . 'js/math-editor.js', array('jquery'), $this->version, false);
        }

        // Add the comment explanation JavaScript for pages like CBT practice and individual subject past questions that have multiple comment forms
        if (is_tax('ns_subjects') || is_page_template('cbt-practice.php')) {
            wp_enqueue_script('ques-explanation', plugin_dir_url(__FILE__) . 'js/ques-explanation.js', array('jquery'), $this->version, false);
        }

        wp_register_script('ajax_comment', plugin_dir_url(__FILE__) . 'js/ajax-comment.js', array('jquery'), $this->version, false);
        wp_localize_script('ajax_comment', 'ajax_comment_params', array(
            'ajaxurl' => site_url() . '/wp-admin/admin-ajax.php',
        ));
        wp_enqueue_script('ajax_comment');

        // wp_deregister_script('comment-reply');
        // wp_register_script('comment-reply', plugin_dir_url( __FILE__ ) . 'js/comment-reply.js');

    }

    /**
     * Displays an extra text area for more comments.
     *
     * @param int $post_id The ID of the post where the comment form was rendered.
     */
    public function show_math_editor()
    {
        if (is_tax(array('ns_subjects', 'ns_tutorials')) || is_singular(array('tutorials', 'questions')) || is_page_template('cbt-practice.php')) {
            $file = plugin_dir_path(__FILE__) . 'views/math-editor-modal.php';
            if ( file_exists( $file ) ) {
                require_once $file;
            }
        }
    }

    /**
     * Rich text editor for comment area
     */
    public function comment_custom_editor($default)
    {
        if (is_admin()) {
            return $default;
        }

        /* ob_start();

        wp_editor( '', 'comment', array(
        'media_buttons' => false,
        'textarea_rows' => '3',
        'teeny' => false,
        'tinymce' => array(
        'content_css' => plugin_dir_url( __FILE__ ) . 'css/tinymce-custom.css'
        ),
        'quicktags' => false
        )
        );

        $comment_editor = ob_get_clean();
        $comment_editor = '<div id="ns-comment" class="form-group" style="margin-bottom:20px">'
        . $comment_editor .
        '<span id="comment-help-block" class="help-block" style="font-size:75%;margin-bottom:20px"></span>
        </div>'; */

        if (is_tax(array('ns_subjects', 'ns_tutorials')) || is_page_template('cbt-practice.php')) {

            return $default;

        } else {

            ob_start();

            $file = plugin_dir_path(__FILE__) . 'views/comment-editor.php';
            if ( file_exists( $file ) ) {
                require_once $file;
            }

            $comment_editor = ob_get_clean();

            return $comment_editor;

        }

    }

    /**
     * Uses the rich text editor for comment area
     *
     * @param array $defaults The comment form default arguments
     */
    public function custom_comment_form($defaults)
    {
        if (is_admin()) {
            return $defaults;
        }

        // $defaults['comment_field'] = $this->comment_rich_text_editor();

        return $defaults;
    }

    public function comment_editor_buttons($default_buttons)
    {

        if (is_admin()) {
            return $default_buttons;
        }

        $default_buttons = array('bold', 'italic', 'underline', 'bullist', 'superscript', 'subscript', 'equation');
        return $default_buttons;
    }

    public function math_editor_register($plugin_array)
    {
        $plugin_array['equation'] = plugins_url('js/equation-editor.js', __FILE__);
        return $plugin_array;
    }

    /**
     * Uses the rich text editor for comment area
     *
     * @param array $defaults The comment form default arguments
     */
    public function submit_ajax_comment()
    {
        /*
         * Wow, this cool function appeared in WordPress 4.4.0, before that the code was much more longer
         *
         * @since 4.4.0
         */
        $comment = wp_handle_comment_submission(wp_unslash($_POST));
        if (is_wp_error($comment)) {
            $error_data = intval($comment->get_error_data());
            if (!empty($error_data)) {
                wp_die('<p>' . $comment->get_error_message() . '</p>', __('Comment Submission Failure'), array('response' => $error_data, 'back_link' => true));
            } else {
                wp_die('Unknown error');
            }
        }

        /*
         * Set Cookies
         */
        $user = wp_get_current_user();
        do_action('set_comment_cookies', $comment, $user);

        /*
         * If you do not like this loop, pass the comment depth from JavaScript code
         */
        $comment_depth = 1;
        $comment_parent = $comment->comment_parent;
        while ($comment_parent) {
            $comment_depth++;
            $parent_comment = get_comment($comment_parent);
            $comment_parent = $parent_comment->comment_parent;
        }

        /*
         * Set the globals, so our comment functions below will work correctly
         */
        $GLOBALS['comment'] = $comment;
        $GLOBALS['comment_depth'] = $comment_depth;

        /*
         * Echo formatted comment html
         */
        $comment_post_type = get_post_type($comment->comment_post_ID);
        if ($comment_post_type == 'questions') {

            $comment_text = clean_comment_text(get_comment_text());
            $comment_output = '
            <p class="com-ajax-success">Thanks for your contribution. It will be reviewed shortly.</p>
            <div class="ns-school-defn2">
            	<p style="font-size:16px;margin-bottom:0">' . $comment_text . '</p>
            </div>';
            echo $comment_output;

        } else {

            format_comment($comment, $args, $comment_depth);

        }

        die();

    }
}
