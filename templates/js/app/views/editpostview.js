var EditPostView = Backbone.View.extend( {

    initialize: function(){
        $('html, body').animate({ scrollTop: 0 }, 'fast'); // Can't decide whether I like the animation or not
        this.tinymce = tinymce;
        this.render();
    },

    render: function(){

        // Create vars so we can pass them into callback function
        var partials = [];
        tinymce = this.tinymce;

        var editpost = new Partial( "editpost" );
        partials.push( editpost );

        // When all partials are done fetching call callback function
        var complete = _.invoke( partials, "fetch" );
        $.when.apply($, complete).done( function(){

            template = _.template( editpost.get("template") );
            $("body").append( template );

            tinymce.init({
                selector: 'textarea',
                height: 500,
                menubar: false,
                plugins: [
                    'advlist autolink lists link image charmap print preview anchor',
                    'searchreplace visualblocks code fullscreen',
                    'insertdatetime media table contextmenu paste code'
                ],
                toolbar: 'undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
                content_css: [
                    '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
                    '//www.tinymce.com/css/codepen.min.css']
            });

            $( "#postit" ).click( function(event){
                event.preventDefault();
                $.post( "/post",
                    {
                        title: $("#title").val(),
                        category: $("#category").val(),
                        content: tinymce.get("content").getContent(),
                    },
                    function(data){
                        console.log( data.error );
                        if( data.error === false ){
                            window.location.hash = '/home';
                        }
                        else{
                            console.log( data.message );
                        }
                    }, "json" );
            } );



        } );

    }

} );